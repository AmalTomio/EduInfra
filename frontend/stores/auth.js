import { defineStore } from "pinia";
// import {jwtDecode} from "jwt-decode";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: null,
    token: null,
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
    userRole: (state) => state.user?.role || null,
  },

  actions: {
    async login(email, password) {
      // const { $api } = useNuxtApp();
      try {
      //   const response = await $api.post("/login", { email, password });
      //   const token = response.data.token;
      //   const user = jwtDecode(token);

      //   this.user = user;
      //   this.token = token;

      //   localStorage.setItem("token", token);
      //   return user;
      // } catch (error) {
      //   throw new Error(error.response?.data?.message || "Login failed");
      // }
      const mockUser = {
          name: "Test User",
          email,
          role: email.includes("@skcjp.com") ? "Teacher" : "Parent",
        };

        this.user = mockUser;
        this.token = "mock-token";

        localStorage.setItem("token", this.token);
        return mockUser;
      } catch (error) {
        throw new Error("Login failed");
      }
    },

    logout() {
      this.user = null;
      this.token = null;
      localStorage.removeItem("token");
      navigateTo("/login");
    },

    loadUser() {
      const token = localStorage.getItem("token");
      if (token) {
        this.token = token;
        // this.user = jwtDecode(token);
                this.user = { name: "Test User", role: "Guest" }; // ✅ Mocked user

      }
    },
  },
});
