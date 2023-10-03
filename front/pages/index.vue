<script setup>
import { useTaskStore } from "~/stores/TaskStore";

definePageMeta({
  middleware: ['auth'],
})

const taskStore  = useTaskStore();


</script>


<template>
  <Loader v-if="taskStore.isLoading" />

  <div v-else>
    Welcome gench
    <font-awesome-icon icon="fa-solid fa-fan"  class="w-5"/>

    <div>
    <font-awesome-icon icon="fa-solid fa-user-secret" />
  </div>
  </div>
</template>

<style scoped></style>
