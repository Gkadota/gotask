import { defineStore } from "pinia";

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
            let { data, error } = await useApiFetch("/api/user");

            if (error.value) {
                return {error};
            }

            this.user = data.value;

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

            let {data, error} = await useApiFetch("/logout", {method: "POST"});
            
            if (error.value) return {error};
            this.user = {};
            return {data};
        },

        async register(userInfo) {
            await this.getCookie();
            let {data, error} = await useApiFetch("/register", {
                method: "POST",
                body: userInfo
            });

            if (error.value) return {error};

            console.log('register', data);
        },

        
    },
});