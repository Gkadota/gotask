<script setup>
const props = defineProps({
    label: { required: true, type: String },
    modelValue: { required: true },
    errorInput: { required: true, type: String },
    id: { required: true, type: String },
    type: { type: String, default: 'text' }
})

defineEmits(['update:modelValue'])

</script>

<template>
    <div class="mb-3 pt-3 rounded bg-gray-200">
        <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" :for="id">{{ label }}</label>
        <input 
            :id="id"
            :type="type" 
            :value="modelValue" 
            @input="$emit('update:modelValue', $event.target.value)"
            class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-secondary-600 transition duration-500 px-3 pb-1">
        <p class="text-red-600 bg-white">{{ errorInput || null }} </p>
    </div>
</template>

<style scoped>
</style>

