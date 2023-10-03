<script setup>
import { storeToRefs } from "pinia";
import { useTaskStore } from "~/stores/TaskStore";

definePageMeta({
  middleware: ['auth'],
})

const taskStore = useTaskStore();
const {tasks, getInProgress, getOpen, getDone, getClose, getWontDo, isLoading} = storeToRefs(taskStore);

if (!taskStore.isTaskLoaded) {
	await taskStore.getTasks();
}


</script>

<template>
	<Loader v-if="isLoading" />
	<div v-else class="">
		<TaskTable 
			status-class="bg-gray-400"
			status="Open" 
			:tasks="getOpen"
		/>

		<TaskTable 
			status-class="bg-yellow-500"
			status="In Progress" 
			:tasks="getInProgress"
		/>
		<TaskTable 
			status-class="bg-green-500"
			status="Done" 
			:tasks="getDone"
		/>
	</div>
</template>

<style scoped>
</style>
