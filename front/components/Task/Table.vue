<script setup>
import { useTaskStore } from "~/stores/TaskStore";

const props = defineProps({
  tasks: { required: true, type: Array },
  status: { required: true, type: String },
  statusClass: { required: true, type: String },
});

const taskStore = useTaskStore();

const isLoading = ref(false);
const searchTerm = ref('');
const isStatusAll = computed(() => props.status?.toLowerCase() === 'all');


async function searchTaskHandler() {
  isLoading.value = true;

  try {
    const { error } = await taskStore.searchTask(searchTerm);

    if (error.value) {
      isLoading.value = false;
      throw error;
    }

    isLoading.value = false;

  } catch (error) {
    console.log(error);
    isLoading.value = false;
  }


}
</script>

<template>
  
  <div>
    <div v-show="isStatusAll">
      <form @submit.prevent="searchTaskHandler">
        <label for="default-search"
          class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
        <div class="relative">
          <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <font-awesome-icon icon="fa-solid fa-magnifying-glass" />
          </div>
          <input v-model="searchTerm" type="search" id="default-search"
            class="block p-4 bg-white  pl-10 w-full text-sm text-gray-900  rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400 "
            placeholder="Search Task" required>
          <button  type="button"
            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
        </div>
      </form>
    </div>

    <div v-if="!isStatusAll" class="-mb-4 pl-0.5 ">
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
          <tr v-if="isLoading">
            <td colspan="7"><div class="items-start flex-1 justify-items-start -mt-40"><Loader   /></div></td>
          </tr>
        <TaskCardRow v-else v-for="task in tasks" :key="task?.id" :title="task.title" :task-id="task.id"
          :category="task.category" :priority="task.priority" :start-date="task.created_at" :due-date="task.due_date"
          :assignee_id="task.assignee_id" status="In Progress" />

          <tr v-if="tasks.length === 0">
            <td colspan="7"><div class=" text-lg flex-1 text-center font-medium"> No Task Found</div></td>
          </tr>
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
