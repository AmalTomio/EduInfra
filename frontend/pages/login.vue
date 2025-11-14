<template>
  <v-container class="fill-height d-flex align-center justify-center">
    <v-card width="400" class="pa-6">
      <v-card-title class="text-h5 text-center mb-4">
        EduInfra Login
      </v-card-title>

      <v-form @submit.prevent="handleLogin">
        <v-text-field
          v-model="email"
          label="Email"
          prepend-inner-icon="mdi-email"
          type="email"
          required
        />
        <v-text-field
          v-model="password"
          label="Password"
          prepend-inner-icon="mdi-lock"
          type="password"
          required
        />
        <v-btn
          color="primary"
          block
          class="mt-4"
          type="submit"
          :loading="loading"
        >
          Login
        </v-btn>
      </v-form>

      <v-alert v-if="error" type="error" class="mt-3" dismissible>
        {{ error }}
      </v-alert>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "~/stores/auth";

const email = ref("");
const password = ref("");
const loading = ref(false);
const error = ref("");
const auth = useAuthStore();

const handleLogin = async () => {
  error.value = "";
  loading.value = true;
  try {
    const user = await auth.login(email.value, password.value);

    // Redirect based on role
    switch (user.role) {
      case "principal":
        navigateTo("/dashboard/principal");
        break;
      case "teacher":
        navigateTo("/dashboard/teacher");
        break;
      case "parent":
        navigateTo("/dashboard/parent");
        break;
      case "clerk":
        navigateTo("/dashboard/clerk");
        break;
      case "security":
        navigateTo("/dashboard/security");
        break;
      default:
        navigateTo("/");
    }
  } catch (err) {
    error.value = err.message;
  } finally {
    loading.value = false;
  }
};
</script>

<style scoped>
.fill-height {
  min-height: 100vh;
}
</style>
