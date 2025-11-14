<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:principal,teacher,parent,clerk,guard',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $roleName = $request->role;
        $email = $request->email;

        // Email domain restriction for STAFF
        if ($roleName !== 'parent') {
            if (!Str::endsWith($email, '@skcjp.com')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Staff must use an email ending with @skcjp.com.'
                ], 422);
            }
        }

        try {
            // Create user (without role column)
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Assign role using Spatie Permissions
            $user->assignRole($roleName);

            // Generate token for immediate login
            $token = JWTAuth::attempt($request->only('email', 'password'));

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'data' => [
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => $this->getTokenExpiry(),
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $roleName,
                    ],
                    'redirect_to' => $this->getRedirectPath($roleName)
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password'
                ], 401);
            }

            $user = JWTAuth::user();
            $role = $this->getUserRole($user);

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data' => [
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => $this->getTokenExpiry(),
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $role,
                    ],
                    'redirect_to' => $this->getRedirectPath($role)
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate();

            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Logout failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function refresh()
    {
        try {
            $token = JWTAuth::refresh();
            $user = JWTAuth::setToken($token)->toUser();
            $role = $this->getUserRole($user);

            return response()->json([
                'success' => true,
                'data' => [
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => $this->getTokenExpiry(),
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $role,
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token refresh failed',
                'error' => $e->getMessage()
            ], 401);
        }
    }

    public function me(Request $request)
    {
        try {
            $user = $request->user();
            $role = $this->getUserRole($user);

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $role,
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get user data',
                'error' => $e->getMessage()
            ], 401);
        }
    }

    /**
     * Get token expiry time in seconds
     */
    private function getTokenExpiry()
    {
        $ttl = config('jwt.ttl', 60);
        return $ttl * 60;
    }

    /**
     * Safely get user role with fallback
     */
    private function getUserRole($user)
    {
        try {
            if (!$user) {
                return 'user';
            }

            if (method_exists($user, 'getRoleNames') && $user->roles()->exists()) {
                $role = $user->getRoleNames()->first();
                return $role ?: 'user';
            }
            
            if (isset($user->role) && !empty($user->role)) {
                return $user->role;
            }
            
            return 'user';
        } catch (\Exception $e) {
            return 'user';
        }
    }

    /**
     * Get redirect path based on user role
     */
    private function getRedirectPath($role)
    {
        return match ($role) {
            'principal' => '/dashboard/principal',
            'teacher'   => '/dashboard/teacher',
            'parent'    => '/dashboard/parent',
            'clerk'     => '/dashboard/clerk',
            'guard'     => '/dashboard/guard',
            default     => '/dashboard',
        };
    }
}