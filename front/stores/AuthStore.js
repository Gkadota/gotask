import { defineStore } from "pinia";
import { useTaskStore } from "./TaskStore";

export const useAuthStore = defineStore("authStore", {
    state: () => ({
        user: {},
        isLoading: false,
    }),

    getters: {
        isLoggedIn() {
            return Object.keys(this.user || {}).length > 0;
        },
    },

    actions: {
        async getCookie() {
            await useApiFetch("/sanctum/csrf-cookie");
        },

        async fetchUser() {
            this.isLoading = true;
            let { data, error } = await useApiFetch("/api/user");

            if (error.value) {
                return {error};
            }

            this.user = data.value;
            this.isLoading = false;
            return {data};
        },

        async login(credentials) {
            this.isLoading = true;
            await this.getCookie();

            let response = await useApiFetch("/login", {
                method: "POST",
                body: credentials,
            });

            if (response.error.value) {
                this.isLoading = false;
                return response;
            }

              await this.fetchUser();
             this.isLoading = false;
             return response;
        },
 
        async logout() {
            this.isLoading = true;
            let {data, error} = await useApiFetch("/logout", {method: "POST"});
            
            if (error.value) return {error};

            const taskStore = useTaskStore();
            taskStore.$reset()
            this.user = {};
            this.isLoading = false;
            return {data};
        },

        async register(userInfo) {
            this.isLoading = true;
            await this.getCookie();
            let response = await useApiFetch("/register", {
                method: "POST",
                body: userInfo
            });

            this.isLoading = false;
        
            return response;
        },

        
    },
});