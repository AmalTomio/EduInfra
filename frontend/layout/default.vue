<!-- layouts/default.vue -->
<template>
  <v-app>
    <LayoutAppBar @toggle-drawer="drawer = !drawer" />
    
    <LayoutNavigationDrawer v-model="drawer" />

    <v-main>
      <v-container fluid>
        <slot />
      </v-container>
    </v-main>
  </v-app>
</template>

<script setup>
import { ref } from 'vue'

definePageMeta({
  middleware: 'auth'
})

const drawer = ref(true)
</script>