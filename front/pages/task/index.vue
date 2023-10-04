<script setup>
import { storeToRefs } from "pinia";
import { useTaskStore } from "~/stores/TaskStore";

definePageMeta({
  middleware: ['auth'],
})


const selectedSort = ref('all');
const taskStore = useTaskStore();
const {tasks, getInProgress, getOpen, getDone, getClose, getWontDo, isLoading} = storeToRefs(taskStore);

if (!taskStore.isTaskLoaded) {
	await taskStore.getTasks();
}


const allBtnClass = computed(() => ([selectedSort.value === 'all' ? 'bg-primary text-gray-100' : 'bg-white  text-slate-800']));
const statusBtnClass = computed(() => ([selectedSort.value === 'status' ? 'bg-primary text-gray-100' : 'bg-white  text-slate-800']));

function selectSortHandler(sort) {
	selectedSort.value = sort;
}
</script>

<template>
	<Loader v-if="isLoading" />
	<div v-else class="">

		<div class="flex items-center justify-center rounded-md  mb-10">
            <button @click="selectSortHandler('all')" :class="allBtnClass" class="px-8 hover:text-gray-100 text-sm hover:bg-primary border border-slate-200 rounded-l-lg font-medium  py-2 inline-flex space-x-1 items-center">
				<span><font-awesome-icon icon="fa-solid fa-border-all" /></span>
                <span>All</span>
            </button>
            

			<button @click="selectSortHandler('status')" :class="statusBtnClass" class=" hover:text-gray-100 text-sm hover:bg-primary border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
				<span ><font-awesome-icon icon="fa-solid fa-bars-progress" /></span>
                <span>By Status</span>
            </button>
            
        </div>

		<div v-if="selectedSort === 'all'">
			<TaskTable 
			status-class="bg-primary"
			status="All" 
			:tasks="tasks"
		/>
		</div>
		
		<!-- By Status -->
		<div v-if="selectedSort === 'status'">
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

		<TaskTable 
			status-class="bg-gray-600"
			status="Close" 
			:tasks="getClose"
		/>

		<TaskTable 
			status-class="bg-red-400"
			status="Won't Do" 
			:tasks="getWontDo"
		/>
		</div>
	</div>
</template>

<style scoped>
</style>
