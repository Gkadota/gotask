<script  setup>
import { storeToRefs } from "pinia";


const props = defineProps({
  priority: {required: true, type: String}
});


const prioList = ref({
    LOW:'bg-gray-400',
    MEDIUM: 'bg-orange-400',
    HIGH: 'bg-red-500'
});

const prioClass = computed(() => ([prioList.value[props.priority]]));



</script>

<template>
  <span class="text-gray-100 rounded-2xl px-2 py-1 text-xs" :class="prioClass">
    <span><font-awesome-icon icon="fa-solid fa-flag" /></span>
   {{ priority }}
   </span>
</template>

<style scoped></style>
