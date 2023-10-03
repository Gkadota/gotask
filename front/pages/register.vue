<script  setup>
import { useAuthStore } from "~/stores/AuthStore"

definePageMeta({
    layout: 'custom',
    middleware: ['guest'],
})

const form = reactive({
  first_name: 'mich',
  last_name: 'asombrado',
  email: 'mich@gmail.com',
  password: 'password',
  password_confirmation: 'password',
});

const errorInput = reactive({
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const authStore = useAuthStore();
async function registerHandler() {

  try {
    let {error } = await authStore.register(form);

    if (error?.value) {
      throw error;
    }

    navigateTo('/');

  } catch (err) {
    const errorMsgs = useGetErrors(err);
    if (errorMsgs) {
      errorInput.first_name = errorMsgs?.first_name?.[0];
      errorInput.last_name = errorMsgs?.last_name?.[0];
      errorInput.email = errorMsgs?.email?.[0];
      errorInput.password = errorMsgs?.password?.[0];
      errorInput.password_confirmation = errorMsgs?.password_confirmation?.[0];
    }
  }
}
</script>

<template>
  <div>
    <section>
      <h3 class="font-bold text-2xl text-center">Create a Gotask account</h3>
      <p class="text-sm font-bold text-gray-600 text-center mt-5 tracking-wider">Join the Productivity Revolution -
        Register with GoTask Today!</p>
    </section>

    <section class="mt-10">
      <form class="flex flex-col" @submit.prevent="registerHandler">

        <FormInput id="firstName" label="First Name" v-model="form.first_name" :error-input="errorInput.first_name" />

        <FormInput id="lastName" label="Last Name" v-model="form.last_name" :error-input="errorInput.last_name" />

        <FormInput id="email" label="Email Address" v-model="form.email" :error-input="errorInput.email" />

        <FormInput type="password" id="password" label="Password" v-model="form.password" :error-input="errorInput.password" />

        <FormInput type="password" id="password_confirmation" label="Confirm Password" v-model="form.password_confirmation" :error-input="errorInput.password_confirmation" />

        <button class="btn-primary" type="submit">Create an Account</button>
        <div class=" text-center mt-12 mb-6">
          <p class="text-blue-600 hover:text-blue-700">Already have an account? <NuxtLink to="/login"
              class="font-bold hover:underline">Sign in</NuxtLink>.</p>
        </div>

      </form>
    </section>
  </div>
</template>

<style scoped></style>
