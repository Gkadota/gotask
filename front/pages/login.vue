<script setup>
import { useAuthStore } from "~/stores/AuthStore";

definePageMeta({
    layout: 'custom',
    middleware: ['guest'],
})

const form = reactive({
    email: '',
    password: ''
});

const errorInput = reactive({
    email: null,
    password: null,
});

const authStore = useAuthStore();

async function loginHandler() {

    try {
        let { error } = await authStore.login(form);

        if (error?.value) {
            throw error;
        }

        return navigateTo('/');


    } catch (err) {
        const errorMsgs = useGetErrors(err);
        if (errorMsgs) {
            errorInput.email = errorMsgs?.email?.[0];
            errorInput.password = errorMsgs?.password?.[0];
        }
    }


}
</script>

<template>
    <div>
        <section>
            <h3 class="font-bold text-2xl">Welcome to GoTask</h3>
            <p class="text-gray-600 pt-2">Sign in to your account.</p>
        </section>

        <section class="mt-10">
            <form class="flex flex-col" @submit.prevent="loginHandler">
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                    <input v-model="form.email" type="text" id="email"
                        class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-secondary-600 transition duration-500 px-3 pb-3">
                    <p class="text-red-600 bg-white">{{ errorInput.email }} </p>
                </div>
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                    <input v-model="form.password" type="password" id="password"
                        class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-secondary-600 transition duration-500 px-3 pb-3">
                    <p class="text-red-600 bg-white">{{ errorInput.password }} </p>
                </div>

                <button :disabled="authStore.isLoading" class="btn-primary" type="submit">
                    <span v-show="authStore.isLoading"><font-awesome-icon class="animate-spin"  icon="fa-solid fa-circle-notch" /></span>
                    <span v-show="!authStore.isLoading">Sign In</span>
                </button>
                <div class=" text-center mt-12 mb-6">
                    <p class="text-blue-600 hover:text-blue-700">Don't have an account? <NuxtLink to="/register"
                            class="font-bold hover:underline">Sign up</NuxtLink>.</p>
                </div>

            </form>
        </section>
    </div>
</template>

<style scoped></style>
