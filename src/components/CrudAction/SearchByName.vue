<script setup lang="ts">
import { ref } from 'vue';
import IconSearch from '../icons/IconSearch.vue';

// Define the search query as a ref
const search = ref('');

// Emit an event when the search query changes
const updateSearchQuery = () => {
    emit('update:searchQuery', search.value);
};

// Emit an event to reset filters
const resetFilters = () => {
    emit('reset-filters');
};
</script>

<template>
    <div class="flex pr-4 mt-4 space-x-4">
        <div class="relative text-gray-400">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <IconSearch class="w-6 h-6" stroke="2.0" />
            </div>
            <input v-model="search" @input="updateSearchQuery" type="text" placeholder="Search"
                class="appearance-none pl-12 rounded-md placeholder:text-gray-400 shadow-md font-semibold text-gray-700 hover:shadow-md outline-none border-none focus:ring-0" />
        </div>

        <button @click="resetFilters" class="">
            <div class="flex items-center">
                <span class="font-medium text-sm text-blue-500 cursor-pointer">All Products</span>
                <a class="pt-1" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#1E90FF" class="size-5">
                        <path fill-rule="evenodd"
                            d="M2 10a.75.75 0 0 1 .75-.75h12.59l-2.1-1.95a.75.75 0 1 1 1.02-1.1l3.5 3.25a.75.75 0 0 1 0 1.1l-3.5 3.25a.75.75 0 1 1-1.02-1.1l2.1-1.95H2.75A.75.75 0 0 1 2 10Z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </button>
    </div>
</template>
