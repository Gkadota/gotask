<script lang="ts" setup></script>

<template>
   <div class="body-bg min-h-screen pt-1 md:pt-20 pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif;">
    <header class="max-w-lg mx-auto ">
        <div class="flex justify-center">
            <img class="w-52 lg:w-64" src="~/assets/logo/gotask-logo.png" alt="GoTask" />
        </div>

        <p class="text-md font-bold text-gray-100 text-center mt-5 tracking-wider">Your Ultimate Task Management Companion.</p>
    </header>


    <main class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl">
      <slot />
    </main>

    <div class="max-w-lg mx-auto text-center mt-12 mb-6">
      <p class="text-white">Task Management Made Effortless with GoTask! </p>
    </div>

</div>
</template>

<style scoped></style>
