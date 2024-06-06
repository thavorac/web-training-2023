<script setup lang="ts">
import { defineEmits, ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const emit = defineEmits(['cancel']);
const router = useRouter();

// Initialize model
const model = ref({
    category: {
        name: '',
        description: '',
    }
});

const handleCancel = () => {
    router.push('/admin/category');
};

const createCategory = () => {
    axios.post('http://localhost/api/categories', model.value.category)
        .then(res => {
            console.log(res.data);
            alert(res.data.message);
            // Clear the form inputs
            model.value.category.name = '';
            model.value.category.description = '';
            // Redirect to the ProductItem page
            // router.push('/product');
        })
        .catch(error => {
            console.error('Error saving student:', error);
        });
};
</script>

<template>
    <!-- Your template code here -->
    <div class="container mx-auto p-4">
        <form action="">
            <div class="mb-4">
                <label for="category-name" class="block mb-2 font-semibold text-xl">Category's Name</label>
                <input id="category-name" v-model="model.category.name" type="text"
                    class="form-control border-black shadow-sm w-full max-w-md" placeholder="men">
            </div>
            <div class="mt-4">
                <p><label for="description" class="block mb-2 font-semibold text-xl">Description</label></p>
                <textarea id="description" v-model="model.category.description"
                    class="form-control border-black shadow-sm w-full max-w-md h-40"
                    placeholder="Lorem Ipsum Is A Dummy Text"></textarea>
            </div>
            <div class="flex flex-col md:flex-row justify-end mt-5 space-y-2 md:space-y-0 md:space-x-2">
                <button type="button" @click="handleCancel"
                    class="text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    CANCEL</button>
                <button type="button" @click="createCategory"
                    class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">CREATE</button>
            </div>
        </form>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

label,
button {
    font-family: "Rubik", sans-serif;
}
</style>
