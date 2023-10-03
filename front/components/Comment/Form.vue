<script  setup>
import { useAuthStore } from "~/stores/AuthStore";
import { useCommentStore } from "~/stores/CommentStore";
import { useTaskStore } from "~/stores/TaskStore";


const emit = defineEmits(['newComment']);
const props = defineProps({
  taskId: {required: true, type: Number}
});

const commentBody = ref('');
const commentErrorInput = ref('');

const commentStore = useCommentStore();
const taskStore = useTaskStore();
const authStore = useAuthStore();
async function postCommentHandler() {
  

  try {

    const {data, error} = await commentStore.createComment({
      user_id: authStore.user?.id,
      task_id: props.taskId,
      body:commentBody
    })

    if (error.value) {
        throw error
    }

    if (data.value) {
       emit('newComment', data.value);
    }

  } catch (err) {
    const errorMsgs = useGetErrors(err);
    if (errorMsgs) {
      commentErrorInput = errorMsgs?.body?.[0];
    }
  }
}
</script>

<template>
  <form @submit.prevent="postCommentHandler" class="w-full mix-w-full bg-white rounded-lg px-4 pt-2">

    <h2 class="px-4 pt-3 pb-2 text-gray-800 text-md">Add a new comment</h2>
    <div class="w-full md:w-full px-3 mb-2 mt-2">
      <textarea
        v-model="commentBody"
        class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
        name="body" placeholder='Type Your Comment' required></textarea>
        <p class="text-red-600 bg-white">{{ commentErrorInput || null }} </p>
    </div>
    <div class="w-full md:w-full flex items-start md:w-full px-3">
      <div class="flex items-start w-1/2 text-gray-700 px-2 mr-auto">
        
      </div>
      <div class="-mr-1">
        <button 
          :disabled="commentStore.isLoading"
          class="bg-primary text-gray-200 font-medium py-1 px-4 border border-secondary-600 rounded-lg tracking-wide mr-1 hover:bg-secondary-600"
          >
          <span v-show="commentStore.isLoading"><font-awesome-icon class="animate-spin"  icon="fa-solid fa-circle-notch" /></span>
              <span v-show="!commentStore.isLoading">Post Comment</span>
        </button>
      </div>
    </div>
  </form>
</template>

<style scoped></style>
