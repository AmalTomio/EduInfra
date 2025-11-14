<!-- components/LayoutAppBar.vue -->
<template>
  <v-app-bar
    color="primary"
    prominent
    fixed
  >
    <v-app-bar-nav-icon @click="$emit('toggle-drawer')"></v-app-bar-nav-icon>
    
    <v-toolbar-title class="text-h5 font-weight-bold">
      <v-icon color="white" size="32" class="mr-2">
        mdi-school-outline
      </v-icon>
      EduInfra
    </v-toolbar-title>

    <v-spacer></v-spacer>

    <div class="d-flex align-center ga-2">
      <v-btn
        variant="text"
        class="login-btn text-none"
        to="/login"
      >
        Log Masuk
      </v-btn>

      <v-btn
        variant="outlined"
        color="white"
        class="text-none"
        to="/register"
      >
        Daftar
      </v-btn>
    </div>
  </v-app-bar>
</template>

<style scoped>
.login-btn:hover {
  background-color: rgba(255, 255, 255, 0.1) !important;
}
</style>