// plugins/vuetify.js
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import "@mdi/font/css/materialdesignicons.css";

export default defineNuxtPlugin((nuxtApp) => {
  const vuetify = createVuetify({
    components,
    directives,
    theme: {
      light: {
        dark: false,
        colors: {
          primary: "#1976D2",
          secondary: "#424242",
        },
      },
      icons: {
        defaultSet: "mdi",
      },
    },
  });

  nuxtApp.vueApp.use(vuetify);
});
