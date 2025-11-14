// nuxt.config.js
import { transformAssetUrls } from "vite-plugin-vuetify";

export default defineNuxtConfig({
  compatibilityDate: "2025-07-15",
  devtools: { enabled: true },

  build: {
    transpile: ["vuetify"],
  },

  modules: ["@pinia/nuxt", "@nuxtjs/color-mode"],

  vite: {
    vue: {
      template: {
        transformAssetUrls,
      },
    },
  },

  css: ["vuetify/styles", "@mdi/font/css/materialdesignicons.css"],

  plugins: ["~/plugins/vuetify"],

  runtimeConfig: {
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE || "http://localhost:8000",
    },
  },

  colorMode: {
    preference: "light",
  },

  ssr: false, // single-page application mode
});
