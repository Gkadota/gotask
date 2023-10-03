<script setup>
defineProps({
  tasks: { required: true, type: Array},
  status: { required: true, type: String},
  statusClass: { required: true, type: String},
});

</script>

<template>
  <div class="">
    <div class="-mb-4 pl-0.5 ">
      <div :class="`${statusClass}  shadow-md p-2 text-gray-100  rounded-t-2xl w-24 text-center `">{{ status }}</div>
    </div>
    <table class="table text-gray-400 border-separate space-y-6 text-sm min-w-full ">
      <thead class="bg-white text-gray-500  ">
        <tr class=" ">
          <th class="p-3">Title</th>
          <th class="p-3 text-left">Category</th>
          <th class="p-3 text-left">Priority</th>
          <th class="p-3 text-left">Start Date</th>
          <th class="p-3 text-left">Due Date</th>
          <th class="p-3 text-left">Action</th>
        </tr>
      </thead>
      <tbody>
        <TaskCardRow v-for="task in tasks" :key="task?.id"
						:title="task.title" 
						:task-id="task.id"
						:category="task.category" 
						:priority="task.priority" 
						:start-date="task.created_at"
						:due-date="task.due_date" 
            :assignee_id="task.assignee_id"
						status="In Progress"
					/>
      </tbody>
    </table>
  </div>
</template>

<style scoped>

.table {
	border-spacing: 0 15px;
}

i {
	font-size: 1rem !important;
}

.table tr {
	border-radius: 20px;
  min-width: 100%;
}

tr td:nth-child(n+6),
tr th:nth-child(n+6) {
	border-radius: 0 .625rem .625rem 0;
}

tr td:nth-child(1),
tr th:nth-child(1) {
	border-radius: .625rem 0 0 .625rem;
}
</style>
