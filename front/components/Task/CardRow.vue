<script setup>
import { useTaskStore } from "~/stores/TaskStore";

const props = defineProps({
	title: { required: true, type: String },
	category: { required: true, type: String },
	priority: { required: true, type: String },
	startDate: { required: true, type: String },
	dueDate: { required: true, type: String },
	assignee_id: { required: true, type: Number },
	taskId: { required: true },
	status: { required: true, type: String },
});


const taskStore = useTaskStore();
function selectTaskHandler() {
	taskStore.$patch({ selectedTaskId: props.taskId });
	navigateTo('/task/update');
}


async function deleteTaskHandler() {

	if (!confirm('Are you sure?')) return false;


	try {

		const { data, error } = await taskStore.deleteTask(props.taskId);

		if (error?.value) {
			throw error;
		}

		if (data.value.success) {
			alert('task deleted');
			await taskStore.getTasks();
		}

	} catch (error) {
		alert('Something Went wrong please try again');
	}
}

</script>
<template>
	<tr class="bg-white text-gray-500 shadow-md ">
		<td class="p-4">
			<div class="flex align-items-center">

				<div class="ml-3">
					<div class="font-bold text-md">{{ title }}</div>
				</div>
			</div>
		</td>
		<td class="p-3">
			{{ category }}
		</td>
		<td class="p-3 font-bold ">
			<TaskPriority :priority="priority" />
		</td>
		<td class="p-3">
			<span class="bg-gray-400 text-gray-50 rounded-md px-2 ">{{ startDate }}</span>
		</td>
		<td class="p-3">
			<span class="bg-orange-300 text-gray-50 rounded-md px-2 ">{{ dueDate }}</span>
		</td>
		<td class="p-2 ">
			<NuxtLink :to="`/task/${taskId}`" class=" text-gray-400 hover:text-secondary-600 mr-2">
				<span><font-awesome-icon icon="fa-solid fa-eye" /></span>
			</NuxtLink>
			<a @click="selectTaskHandler" class="text-gray-400 hover:text-secondary-600  mx-2">
				<span><font-awesome-icon class="w-6" icon="fa-solid fa-pen" /></span>
			</a>
			<a @click="deleteTaskHandler" class="text-gray-400 hover:text-secondary-600  ml-2">
				<span><font-awesome-icon class="w-6" icon="fa-solid fa-trash" /></span>
			</a>
		</td>
	</tr>
</template>

<style scoped>
tr td:nth-child(n+6),
tr th:nth-child(n+6) {
	border-radius: 0 .625rem .625rem 0;
}
</style>
