import axios from "axios";

export default defineNuxtPlugin(() => {
  const config = useRuntimeConfig();

  const api = axios.create({
    baseURL: config.public.apiBase + "/api", // backend URL
    headers: {
      "Content-Type": "application/json",
    },
  });

  return {
    provide: {
      api,
    },
  };
});
