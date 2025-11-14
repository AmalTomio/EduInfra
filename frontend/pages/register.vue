<template>
  <v-container class="fill-height d-flex align-center justify-center">
    <v-card class="pa-8 rounded-xl elevation-6" max-width="500">
      <h2 class="text-center mb-6">Create Account</h2>

      <v-text-field
        v-model="fullName"
        label="Full Name"
        outlined
        dense
      ></v-text-field>

      <v-select
        v-model="role"
        :items="roles"
        label="Select Role"
        outlined
        dense
      ></v-select>

      <v-text-field
        v-model="email"
        label="Email Address"
        outlined
        dense
        :rules="[emailRule]"
      ></v-text-field>

      <v-text-field
        v-model="password"
        label="Password"
        outlined
        dense
        :type="showPassword ? 'text' : 'password'"
        append-icon="mdi-eye"
        @click:append="showPassword = !showPassword"
      ></v-text-field>

      <v-text-field
        v-model="confirmPassword"
        label="Confirm Password"
        outlined
        dense
        :type="showConfirmPassword ? 'text' : 'password'"
        append-icon="mdi-eye"
        @click:append="showConfirmPassword = !showConfirmPassword"
        :rules="[confirmPasswordRule]"
      ></v-text-field>

      <v-btn
        color="primary"
        block
        class="mt-4"
        @click="registerUser"
      >
        Create Account
      </v-btn>

      <p class="text-center mt-4">
        Already have an account?
        <a href="/login">Sign in here</a>
      </p>
    </v-card>
  </v-container>
</template>

<script>
export default {
  name: "RegisterPage",
  data() {
    return {
      fullName: "",
      role: "",
      email: "",
      password: "",
      confirmPassword: "",
      showPassword: false,
      showConfirmPassword: false,
      roles: ["Parent", "Teacher", "Admin"],
    };
  },
  computed: {
    emailRule() {
      if (this.role && this.role !== "Parent" && !this.email.endsWith("@skcjp.com")) {
        return "Email must end with @skcjp.com for non-parent roles.";
      }
      return true;
    },
    confirmPasswordRule() {
      if (this.confirmPassword && this.confirmPassword !== this.password) {
        return "Passwords do not match.";
      }
      return true;
    },
  },
  methods: {
    registerUser() {
      if (!this.fullName || !this.role || !this.email || !this.password || !this.confirmPassword) {
        alert("Please fill out all fields.");
        return;
      }
      if (this.password !== this.confirmPassword) {
        alert("Passwords do not match.");
        return;
      }

      console.log("Registered:", {
        fullName: this.fullName,
        role: this.role,
        email: this.email,
      });
      alert("Account created successfully! (Backend integration later)");
    },
  },
};
</script>
