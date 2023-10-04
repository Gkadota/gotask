<script setup>
import { useTaskStore } from "~/stores/TaskStore";

definePageMeta({
  middleware: ['auth'],
})

const route = useRoute();
const taskStore = useTaskStore();
const task = ref({});

const { data } = await taskStore.getTaskById(route.params.id);
task.value = data.value;

const prioList = ref({
  LOW: 'bg-gray-400',
  MEDIUM: 'bg-orange-400',
  HIGH: 'bg-red-500'
});



const statusList = ref({
  OPEN: 'bg-gray-400',
  IN_PROGRESS: 'bg-yellow-600',
  DONE: 'bg-green-500',
  CLOSED: 'bg-gray-200',
  WONT_DO: 'bg-orange-400',
});
const prioClass = computed(() => ([prioList.value[task.value.priority]]));
const statusClass = computed(() => ([statusList.value[task.value.status?.replace(" ", '_')]]));
const nameInitial = computed(() => task.value.assignee.first_name.substring(0, 1).toUpperCase())


function addNewCommentHandler(newComment) {
  task.value.comments = [newComment, ...task.value.comments];
}


function deleteCommentCallBack(commentId) {
  let comments = task.value.comments;
  task.value.comments = comments.filter(comment => comment.id !== commentId);
}

function updateCommentCallBack({id:commentId, body}) {
  let commentIndex = task.value.comments.findIndex(comment => comment.id === commentId);
  task.value.comments[commentIndex].body = body;
}

function updateTaskHandler() {
	taskStore.$patch({ selectedTaskId: task.value.id });
	navigateTo('/task/update');
}

</script>

<template>
  <Loader v-if="taskStore.isLoading" />
  <div v-else class="flex w-full  h-fit px-8 py-4 flex-col">
    <div class="item-center pb-2">
      <span :class="prioClass" class="font-bold ml-1  text-gray-100  text-lg rounded-t-3xl px-6 py-3">
        {{ task?.priority }}
      </span>
    </div>
    <!-- card -->
    <div class="shadow-lg rounded-xl min-w-full p-8 px-10 bg-white flex flex-col relative  overflow-hidden">
      
      <!-- Edit Button -->
      <div class="flex justify-end">
        <a @click="updateTaskHandler" class="text-gray-400 text-xl hover:text-secondary-600 -mx-2 -my-3">
        <span><font-awesome-icon icon="fa-solid fa-pen" /></span>
        </a>
      </div>

      <div class="w-full h-full block">
        <p class="text-gray-800 text-5xl font-medium mb-5 px-2">
          {{ task?.title }}
        </p>
        <p class="text-gray-600 text-md font-medium mb-2 tracking-wider px-2">
          {{ task?.description }}
        </p>



        <div class="flex justify-between mt-6">
          <div class="justify-start flex flex-col">

            <div>
              <span class="font-bold text-gray-500 text-md">Status : </span>

              <span :class="statusClass" class="text-gray-100  text-md rounded-xl px-6 py-2 ">
                {{ task?.status }}
              </span>

              <span class=" ml-5 font-bold text-gray-500 text-md">Category : </span>
              <span class="text-gray-100  text-md rounded-full px-6 py-2 bg-secondary-600">
                {{ task?.category }}
              </span>


            </div>

          </div>
          <div class="justify-end">
            <p class="text-red-600 text-md font-medium mb-2">
              <span><font-awesome-icon icon="fa-solid fa-calendar" /></span>
              Due Date: {{ task?.due_date }}
            </p>

            <p class="text-gray-600 text-md font-medium mb-2 mr-3">
              <span><font-awesome-icon icon="fa-solid fa-calendar" /></span>
              Start Date: {{ task?.created_at }}
            </p>
          </div>
        </div>


        <!-- Avatar Section -->
        <div class="flex items-center border-b-2 mb-2 py-2">
          <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center font-bold text-white text-xl">
            {{ nameInitial }}
          </div>
          <div class="pl-3">

            <div class="font-medium">
              {{ task.assignee.first_name }} {{ task.assignee.last_name }}
            </div>
            <div class="text-gray-600 text-sm ">
              Assignee
            </div>

          </div>
        </div>

        <!-- Comment Section -->
        <div class="w-full  ">

          <!-- Comment Form -->
          <CommentForm :task-id="task.id" @new-comment="addNewCommentHandler" />


          <!-- Comment List -->
          <div class="mt-3 mb-6 flex  flex-col relative overflow-auto h-80">
            <CommentCard v-for="comment in task.comments" :key="comment.id" 
              @delete-comment="deleteCommentCallBack"
              @update-comment="updateCommentCallBack"
              :comment="comment.body" :name="`${comment.user.first_name} ${comment.user.last_name}`"
              :created="comment.created_at" :commentId="comment.id" />

          </div>



        </div>


      </div>
    </div>
  </div>
</template>

<style scoped></style>
