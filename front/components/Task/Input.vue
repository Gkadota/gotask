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
    <div class="mb-5">
        <label :for="id" class="mb-3 block text-base font-medium text-[#07074D]">
            {{ label }}
        </label>
        <input :id="id" :type="type" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#6A64F1] focus:shadow-md" 
            />

        <p class="text-red-600 bg-white">{{ errorInput || null }}  </p>
    </div>
</template>

<style scoped></style>

