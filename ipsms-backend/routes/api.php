<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Public authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// In routes/api.php
Route::post('/refresh', [AuthController::class, 'refreshAlternative']);

// Protected routes (require authentication)
Route::middleware(['auth:api'])->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);
    
    // Your existing dashboard routes
    Route::middleware(['role:teacher'])->get('/teacher/dashboard', function () {
        return response()->json([
            'success' => true,
            'message' => 'Teacher Dashboard',
            'data' => []
        ]);
    });

    Route::middleware(['role:principal'])->get('/principal/dashboard', function () {
        return response()->json([
            'success' => true,
            'message' => 'Principal Dashboard',
            'data' => []
        ]);
    });

    Route::middleware(['role:parent'])->get('/parent/dashboard', function () {
        return response()->json([
            'success' => true,
            'message' => 'Parent Dashboard',
            'data' => []
        ]);
    });

    Route::middleware(['role:clerk'])->get('/clerk/dashboard', function () {
        return response()->json([
            'success' => true,
            'message' => 'Clerk Dashboard',
            'data' => []
        ]);
    });

    Route::middleware(['role:guard'])->get('/guard/dashboard', function () {
        return response()->json([
            'success' => true,
            'message' => 'Security Guard Dashboard',
            'data' => []
        ]);
    });
});

// Fallback for undefined routes
Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'API endpoint not found'
    ], 404);
});