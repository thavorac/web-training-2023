<template>
    <div class="flex">
        <form class="max-w-md w-full ps-4 pt-2" action="">
            <div class="mb-3">
                <label for="" class="mb-3 font-semibold text-xl">Sub-Category's Name</label>
                <input type="text" class="form-control border-black shadow-sm w-full" placeholder="Shoes">
            </div>
            <div class="mt-3">
                <label for="" class="mb-2 font-semibold text-xl">Category</label>
                <select class="form-control border-black shadow-sm w-full border-color: #232321;">
                    <option value="#">Choose Category</option>
                    <option value="">Man</option>
                    <option value="">Women</option>
                    <option value="">Cosmetics</option>
                    <option value="">Shoe & Bag</option>
                    <option value="">Electronic</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="" class="mb-1 font-semibold text-xl">Description</label>
                <textarea class="form-control border-black shadow-sm w-full h-48"
                    placeholder="Lorem Ipsum Is A Dummy Text"></textarea>
            </div>

            <div class="flex justify-end mt-5">
                <button type="button" @click="handleCancel"
                    class="text-[#82868B] bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">CANCEL</button>
                <button type="button"
                    class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">CREATE</button>
            </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import { defineEmits } from 'vue';

const emit = defineEmits(['cancel']);

const handleCancel = () => {
    emit('cancel');
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

label,
button {
    font-family: "Rubik", sans-serif;
}
</style>