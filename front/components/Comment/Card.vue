<script  setup>
import { useCommentStore } from "~/stores/CommentStore";
const emit = defineEmits(['deleteComment', 'updateComment']);
const props = defineProps({
  comment: { required: true, type: String },
  name: { required: true, type: String },
  commentId: { required: true, type: Number },
  created: { required: true, type: String },
});

const nameInitial = computed(() => props.name.substring(0, 1).toUpperCase());

const commentStore = useCommentStore();

const isOnEditMode = ref(false);

const isLoading = ref(false);

const commentInput = ref(props.comment);
const commentErrorInput = ref('');

async function deleteCommentHandler() {

  if (!confirm('Are you sure?')) return false;

  try {
    isLoading.value = true;
    const { data, error } = await commentStore.deleteComment(props.commentId);

    if (error?.value) {
      throw error;
    }

    if (data.value.success) {
      alert('comment deleted');
      emit('deleteComment', props.commentId);
    }
    isLoading.value = false;

  } catch (error) {
    console.log(error);
    isLoading.value = false;
    alert('Something Went wrong please try again');
  }
}


async function updateCommentHandler() {

  if (!confirm('Are you sure?')) return false;

  try {
    isLoading.value = true;
    const { data, error } = await commentStore.updateComment(props.commentId, commentInput);

    if (error?.value) {
      throw error;
    }

    if (data.value.success) {
      emit('updateComment', { id: props.commentId, body: commentInput });
      alert('comment updated');
      isOnEditMode.value = false;
    }
    isLoading.value = false;

  } catch (error) {
    isLoading.value = false;
    alert('Something Went wrong please try again');
  }
}

function toggleEditHandler() {
  isOnEditMode.value = !isOnEditMode.value;
}
</script>

<template>
  <div v-if="isLoading"
    class="bg-gray-100 mt-3 min-w-full rounded-2xl p-2 py-12 shadow-lg hover:shadow-2xl transition duration-500 flex flex-col ">
    <span class="justify-center text-center text-gray-500"><font-awesome-icon class="animate-spin"
        icon="fa-solid fa-circle-notch" /></span>
  </div>
  <div v-else
    class="bg-gray-100 mt-3 min-w-full rounded-2xl p-2 py-6 shadow-lg hover:shadow-2xl transition duration-500 flex flex-col">

    <div class="flex justify-end">
      <a @click="toggleEditHandler" class="text-gray-400 hover:text-secondary-600  mx-2">
        <span><font-awesome-icon class="w-6" icon="fa-solid fa-pen" /></span>
      </a>

      <a @click="deleteCommentHandler" class="text-gray-400 hover:text-secondary-600  ml-2">
        <span><font-awesome-icon class="w-6" icon="fa-solid fa-trash" /></span>
      </a>
    </div>


    <div class="flex items-center">
      <!-- Letter Avatar -->
      <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center font-bold text-white text-xl">
        {{ nameInitial }}
      </div>
      <div class="px-3">
        <h1 class="  text-md text-gray-700 font-semibold hover:underline cursor-pointer"> {{ name }}</h1>
        <span class="font-normal text-sm text-gray-500"> {{ created }}</span>
      </div>
    </div>


    <div class="mt-4">

      <p v-show="!isOnEditMode" class="mt-4 text-sm text-gray-600 p-2">
        {{ comment }}
      </p>

      <form v-show="isOnEditMode" @submit.prevent="updateCommentHandler" class="py-4 flex flex-col">
        <TaskInput class=" py-2" id="edit-comment" label="Edit Comment" v-model="commentInput"
          :error-input="commentErrorInput" />
        <div class="-mr-1 flex justify-end">
          <button @click.prevent="isOnEditMode = false"
            class="bg-gray-200 text-gray-800 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-600">
            <span>Cancel</span>
          </button>

          <button :disabled="isLoading"
            class="bg-primary text-gray-200 font-medium py-1 px-4 border border-secondary-600 rounded-lg tracking-wide mr-1 hover:bg-secondary-600">
            <span v-show="isLoading"><font-awesome-icon class="animate-spin" icon="fa-solid fa-circle-notch" /></span>
            <span v-show="!isLoading">Update</span>
          </button>
        </div>
      </form>

    </div>
  </div>
</template>

<style scoped></style>
