<template>
    <div class="container mx-auto p-4">
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <div class="block text-green-500 mb-2 font-bold text-2xl uppercase">Edit Form Category</div>
                <br>
                <label for="category-name" class="block mb-2 font-semibold text-xl">Category's Name</label>
                <input id="category-name" v-model="formData.name" type="text"
                    class="form-control border-black shadow-sm w-full max-w-md" placeholder="Category Name">
            </div>
            <div class="mt-4">
                <label for="description" class="block mb-2 font-semibold text-xl">Description</label>
                <textarea id="description" v-model="formData.description"
                    class="form-control border-black shadow-sm w-full max-w-md h-40"
                    placeholder="Category Description"></textarea>
            </div>
            <div class="flex flex-col md:flex-row justify-end mt-5 space-y-2 md:space-y-0 md:space-x-2">
                <button type="button" @click="handleCancel"
                    class="text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    CANCEL</button>
                <button type="submit"
                    class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                    UPDATE</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
import { defineEmits } from 'vue';

import { useRouter } from 'vue-router';

const emit = defineEmits(['cancel']);
const router = useRouter();


const handleCancel = () => {
    router.push('/admin/category');
};


const route = useRoute();
const categoryId = route.params.id;

const formData = ref({
    name: '',
    description: ''
});

const getCategoriesAndEdit = async (categoryId) => {
    try {
        console.log(`Fetching category with ID: ${categoryId}`);
        const response = await axios.get(`http://localhost/api/categories/${categoryId}`);
        const category = response.data;
        console.log(category);
        formData.value = {
            name: category.name,
            description: category.description
        };

    } catch (error) {
        console.error('Error fetching category:', error.response ? error.response.data : error);
    }
};

const submitForm = async () => {
    try {
        console.log(`Submitting form with data:`, formData.value);
        let response;
        if (categoryId) {
            response = await axios.patch(`http://localhost/api/categories/${categoryId}`, { ...formData.value, "_method": "PATCH" });
        } else {
            response = await axios.post('http://localhost/api/categories', { ...formData.value });
        }
        console.log(response.data.message);

        clearFormData();
        // Redirect to "/admin/category" after successful update
        router.push('/admin/category');

    } catch (error) {
        console.error('Error submitting form:', error.response ? error.response.data : error);
    }
};

const clearFormData = () => {
    formData.value = {
        name: '',
        description: ''
    };
};

onMounted(() => {
    if (categoryId) {
        getCategoriesAndEdit(categoryId);

    }
});
</script>
