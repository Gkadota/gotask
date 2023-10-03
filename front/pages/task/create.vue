<script  setup>
import { storeToRefs } from "pinia";
import { useAuthStore } from "~/stores/AuthStore";
import { useTaskStore } from "~/stores/TaskStore";

definePageMeta({
  middleware: ['auth'],
})




const priorityOption = ref([
  { text: 'LOW', value: 'LOW' },
  { text: 'MEDIUM', value: 'MEDIUM' },
  { text: 'HIGH', value: 'HIGH' }
])


const catergoryOption = ref([
  { text: 'Development', value: 'Development' },
  { text: 'Documentation', value: 'Documentation' },
  { text: 'Technical', value: 'Technical' },
  { text: 'QA', value: 'QA' },
  { text: 'Design', value: 'Design' },
])


const form = reactive({
  title: '',
  description: '',
  status: 'OPEN',
  category: 'Development',
  due_date: '',
  created_at: '',
  assignee_id: '',
  creator_id: '',
  priority: 'LOW'
});

const errorInput = reactive({
  title: '',
  description: '',
  category: '',
  due_date: '',
  created_at: '',
  assignee_id: '',
  creator_id: '',
  priority: ''
});

const taskStore = useTaskStore();
const authStore = useAuthStore();
async function createTaskHandler() {
  try {

    form.assignee_id = authStore.user.id;
    form.creator_id = authStore.user.id;
    let { error } = await taskStore.createTask(form);

    if (error?.value) {
      throw error;
    }
       taskStore.getTasks();
    return navigateTo('/task');


  } catch (err) {
    const errorMsgs = useGetErrors(err);
    if (errorMsgs) {
      errorInput.title = errorMsgs?.title?.[0];
      errorInput.description = errorMsgs?.description?.[0];
      errorInput.category = errorMsgs?.category?.[0];
      errorInput.due_date = errorMsgs?.due_date?.[0];
      errorInput.created_at = errorMsgs?.created_at?.[0];
      errorInput.assignee_id = errorMsgs?.assignee_id?.[0];
      errorInput.priority = errorMsgs?.priority?.[0];
    }
  }
}
</script>

<template>
  <div class="shadow-lg rounded-xl min-w-full  px-4 bg-white flex flex-col relative  overflow-hidden">
    <div class="flex items-center justify-center p-12">
      <div class="mx-auto w-full max-w-[550px]">
        <div class="text-center mb-3"><span class="text-xl  text-black font-bold">Create New Task</span></div>
        <form @submit.prevent="createTaskHandler">

          <TaskInput id="title" label="Title" v-model="form.title" :error-input="errorInput.title" />

          <div class="mb-5">
            <label for="countries" class="mb-3 block text-base font-medium text-[#07074D]">Description</label>
            <textarea
              v-model="form.description"
              class=" rounded border border-[#e0e0e0] leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:border-primary"
              name="body" placeholder='Type Your Comment'></textarea>
            <p class="text-red-600 bg-white">{{ errorInput.description || null }} </p>
          </div>


          <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
              <div class="mb-5">
                <label for="priority" class="mb-3 block text-base font-medium text-[#07074D]">Priority</label>
                <select id="priority" v-model="form.priority"
                  class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-primary focus:shadow-md">
                  <option v-for="prio in priorityOption" :key="prio.value" :value="prio.value">
                    {{ prio.text }}
                  </option>

                </select>
              </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
              <div class="mb-5">
                <label for="category" class="mb-3 block text-base font-medium text-[#07074D]">Category</label>
                <select id="category" v-model="form.category"
                  class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-primary focus:shadow-md">
                  <option v-for="catergory in catergoryOption" :key="catergory.value" :value="catergory.value">
                    {{ catergory.text }}
                  </option>
                </select>
              </div>
            </div>
          </div>

          <TaskInput id="due_date" label="Due Date" v-model="form.due_date" :error-input="errorInput.due_date"
            type="date" />

          <div class="flex justify-end">
            <button :disabled="taskStore.isLoading" class="hover:shadow-form rounded-xl disabled:bg-secondary-100 disabled:cursor-not-allowed bg-primary hover:bg-secondary-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
              <span v-show="taskStore.isLoading"><font-awesome-icon class="animate-spin"  icon="fa-solid fa-circle-notch" /></span>
              <span v-show="!taskStore.isLoading">Create</span>
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</template>

<style scoped></style>
