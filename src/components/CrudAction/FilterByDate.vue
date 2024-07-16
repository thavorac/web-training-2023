<script setup lang="ts">
import { ref, watch } from 'vue';

// Define the start and end date as refs
const startDate = ref<string | null>(null);
const endDate = ref<string | null>(null);

// Emit an event when the start date changes
const updateStartDate = () => {
    emit('update:startDate', startDate.value);
};

// Emit an event when the end date changes
const updateEndDate = () => {
    emit('update:endDate', endDate.value);
};

// Watch for changes and call the update functions
watch(startDate, updateStartDate);
watch(endDate, updateEndDate);
</script>

<template>
    <div class="flex pr-4 mt-4 space-x-4">
        <div class="relative text-gray-400">
            <input v-model="startDate" type="date" placeholder="Start Date"
                class="appearance-none rounded-md placeholder:text-gray-400 shadow-md font-semibold text-gray-700 hover:shadow-md outline-none border-none focus:ring-0" />
        </div>
        <div class="relative text-gray-400">
            <input v-model="endDate" type="date" placeholder="End Date"
                class="appearance-none rounded-md placeholder:text-gray-400 shadow-md font-semibold text-gray-700 hover:shadow-md outline-none border-none focus:ring-0" />
        </div>
    </div>
</template>
