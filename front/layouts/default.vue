<script  setup>
import { useAuthStore } from "~/stores/AuthStore";

const authStore = useAuthStore();

async function logoutHandler() {
  if (!confirm('Are you sure?')) return false;

  const { error } = await authStore.logout();

  if (error?.value) {
    alert('Someting went wrong. Please try again');
    return false;
  }


  navigateTo('/login');
}
</script>

<template>
  <div class="grid md:grid-cols-6 md:grid-rows-10 ">

    <!-- Top Navbar  -->
    <nav class="md:col-span-6 md:row-span-1 bg-white p-4  flex  self-center">
      <div class="flex justify-start ">
        <img class="w-28" src="~/assets/logo/gotask-logo.png" alt="GoTask" />
      </div>

      <div class="flex  justify-end md:justify-end items-center  flex-1">
        <span class="text-md font-bold"> Hi, {{ authStore.user?.first_name }}</span>

        <NuxtLink to="/task/create"
          class=" btn bg-secondary-700 text-white ml-2 border-secondary-700 md:border-2 hover:bg-secondary-600 ">
          <span class="text-md">Create New Task</span>
          <span class=" ml-1"><font-awesome-icon icon="fa-solid fa-plus" /></span>
        </NuxtLink>
        <a @click="logoutHandler" class="btn bg-red-700 text-white ml-2  md:border-2 hover:bg-red-600 ">
          <span v-show="authStore.isLoading" class="px-5"><font-awesome-icon class="animate-spin"
              icon="fa-solid fa-circle-notch" /></span>
          <span v-show="!authStore.isLoading">
            <span class="text-md">Logout</span>
            <span class=" ml-1"><font-awesome-icon icon="right-from-bracket" /></span>
          </span>
        </a>
      </div>
    </nav>
    <!-- SiNav bar -->
    <div class="md:col-span-1 md:row-span-9  md:flex md:justify-end bg-blue-950  min-h-screen ">
      <aside class="text-left flex-1">

        <ul class="text-sm mt-6 hidden md:block  text-align-right " id="menu">

          <li>
            <NuxtLink to="/" class="flex justify-start side-nav-btn items-center ">
              <span class="mr-2"><font-awesome-icon icon="fa-solid fa-house" /></span>
              <span class="">Home</span>
            </NuxtLink>
          </li>

          <li>
            <NuxtLink to="/task" class="flex justify-start side-nav-btn">
              <span class="mr-2"><font-awesome-icon icon="fa-solid fa-list-check" /></span>
              <span class="ml-1">Task</span>
            </NuxtLink>
          </li>

        </ul>
      </aside>
    </div> <!-- End of navbar -->

    <main class=" py-6 md:col-span-5 bg-gray-100  flex  justify-center">
      <slot />
    </main>
  </div>
</template>

<style scoped>
.router-link-active {
  @apply bg-blue-400 text-gray-200 font-bold;
}
</style>
