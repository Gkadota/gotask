<script setup>
import { storeToRefs } from "pinia";
import { useTaskStore } from "~/stores/TaskStore";

definePageMeta({
  middleware: ['auth'],
})

const taskStore = useTaskStore();
const {
  tasks,
  getInProgress,
  getOpen,
  getDone,
  getClose,
  getWontDo,
  isLoading,
  getLowPriority,
  getHighPriority,
  getMediumPriority,
} = storeToRefs(taskStore);

if (!taskStore.isTaskLoaded) {
  await taskStore.getTasks();
}


</script>

<template>
  <Loader v-if="isLoading" />
  <section v-else class="text-gray-600 body-font min-w-full px-12">
    <div class="container py-10 mx-auto ">
      <div class="flex flex-wrap w-full mb-8">
        <div class="w-full mb-6 lg:mb-0">
          <h1 class="sm:text-4xl text-5xl font-medium title-font mb-3 text-gray-700 text-center">Welcome to GoTask</h1>
          <div class="h-1 w-50 bg-gray-200 rounded"></div>
        </div>
      </div>

      <div class="text-3xl  mb-9 text-gray-700 font-medium ">
        <span ><font-awesome-icon icon="fa-solid fa-solid fa-flag" /></span>
        <span class="ml-3">Priority</span>
      </div>
      <div class="flex flex-wrap -m-4 text-center">
        <div class="p-4 sm:w-1/3 w-1/4">
          <div class="bg-yellow-600 rounded-lg p-2 xl:p-6">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-white">{{ getLowPriority?.length || 0 }}</h2>
            <p class="leading-relaxed text-gray-100 font-bold">Low</p>
          </div>
        </div>
        <div class="p-4 sm:w-1/3 w-1/2">
          <div class="bg-orange-600 rounded-lg p-2 xl:p-6">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-white">{{ getMediumPriority?.length || 0 }}</h2>
            <p class="leading-relaxed text-gray-100 font-bold">Medium</p>
          </div>
        </div>
        <div class="p-4 sm:w-1/3 w-1/2">
          <div class="bg-red-600 rounded-lg p-2 xl:p-6">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-white">{{ getHighPriority?.length || 0 }}</h2>
            <p class="leading-relaxed text-gray-100 font-bold">High</p>
          </div>
        </div>
      </div>

      <div class="text-3xl  mb-9 text-gray-700 font-medium mt-10">
        <span ><font-awesome-icon icon="fa-solid fa-bars-progress" /></span>
        <span class="ml-3">Status</span>
      </div>
      <div class="flex flex-wrap -m-4 text-center">
        <div class="p-4 sm:w-1/4 w-1/4">
          <div class="bg-gray-500 rounded-lg p-2 xl:p-6">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-white">{{ getOpen?.length || 0 }}</h2>
            <p class="leading-relaxed text-gray-100 font-bold">Open</p>
          </div>
        </div>
        <div class="p-4 sm:w-1/4 w-1/2">
          <div class="bg-yellow-500 rounded-lg p-2 xl:p-6">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-white">{{ getInProgress?.length || 0 }}</h2>
            <p class="leading-relaxed text-gray-100 font-bold">In Progress</p>
          </div>
        </div>
        <div class="p-4 sm:w-1/4 w-1/2">
          <div class="bg-green-500 rounded-lg p-2 xl:p-6">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-white">{{ getDone?.length || 0 }}</h2>
            <p class="leading-relaxed text-gray-100 font-bold">Done</p>
          </div>
        </div>
        <div class="p-4 sm:w-1/4 w-1/2">
          <div class="bg-gray-400 rounded-lg p-2 xl:p-6">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-white">{{ getClose?.length || 0 }}</h2>
            <p class="leading-relaxed text-gray-100 font-bold">Closed</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped></style>
