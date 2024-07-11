<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-3 px-4 max-w-2xl lg:py-16">
            <p class="mb-4 font-semibold text-xl dark:text-white text-[#58AB5D]">Add a new product</p>
            <form @submit.prevent="submitForm">
                <div class="pt-1 grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 font-semibold text-gray-900 dark:text-white">Product
                            Name</label>
                        <input v-model="form.name" type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name" required>
                    </div>
                    <div class="w-full">
                        <label for="brand" class="block mb-2 font-semibold text-gray-900 dark:text-white">Brand</label>
                        <select v-model="form.brand" id="brand"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled>Select brand</option>
                            <option v-for="brand in brands" :key="brand" :value="brand">{{ brand }}</option>
                        </select>
                    </div>
                    <!-- <div class="w-full">
                        <label for="name" class="block mb-2 font-semibold text-gray-900 dark:text-white">Brand
                        </label>
                        <input v-model="form.brand" type="text" name="brand" id="brand"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product brand" required>
                    </div> -->
                    <div class="w-full">
                        <label for="price" class="block mb-2 font-semibold text-gray-900 dark:text-white">Price</label>
                        <input v-model="form.pricing" type="number" name="price" id="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="$2999" required>
                    </div>
                    <div>
                        <label for="category_id"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Category</label>
                        <select v-model="form.category_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled>Select category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{
                                category.name }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="size" class="block mb-2 font-semibold text-gray-900 dark:text-white">Size</label>
                        <select v-model="form.size" id="size"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled>Select size</option>
                            <option v-for="size in sizes" :key="size" :value="size">{{ size }}</option>
                        </select>
                    </div>
                    <!-- <div class="w-full">
                        <label for="size" class="block mb-2 font-semibold text-gray-900 dark:text-white">Size
                        </label>
                        <input v-model="form.size" type="text" name="size" id="size"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product size" required>
                    </div> -->
                    <div class="sm:col-span-2">
                        <label for="multiple_files" class="block mb-2 font-medium text-gray-900 dark:text-white">Upload
                            multiple files</label>
                        <input ref="fileInput" @change="handleFileChange"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="multiple_files" type="file" multiple>
                    </div>
                    <div class="sm:col-span-2">
                        <img v-if="uploadedImageUrl" :src="uploadedImageUrl" alt="Uploaded Image"
                            class="mt-3 max-w-full h-auto">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" rows="8" v-model="form.description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your description here"></textarea>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row justify-end mt-5 space-y-2 md:space-y-0 md:space-x-2">
                    <button type="button" @click="handleCancel"
                        class="text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        CANCEL
                    </button>
                    <button type="submit"
                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                        CREATE
                    </button>
                </div>
            </form>
            <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
            <p v-if="successMessage" class="text-green-500 mt-4">{{ successMessage }}</p>
        </div>
    </section>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

const form = reactive({
    name: '',
    brand: '',
    pricing: '',
    category_id: '',
    size: '',
    image: null,
    description: '',
});

const brands = ['Brand A', 'Brand B', 'Brand C']; // Example brands

const sizes = ['Small', 'Medium', 'Large']; // Example sizes
const uploadedImageUrl = ref(null);
const errorMessage = ref('');
const successMessage = ref('');


const categories = ref([]);
const getCategories = async () => {
    try {
        const response = await axios.get("http://localhost:80/api/categories");
        categories.value = response.data.data;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

onMounted(() => {
    getCategories();
});


const handleFileChange = (event) => {
    const files = event.target.files;
    if (files && files[0]) {
        form.image = files[0];
        const reader = new FileReader();
        reader.onload = (e) => {
            uploadedImageUrl.value = e.target.result;
        };
        reader.readAsDataURL(files[0]);
    }
};

const handleCancel = () => {
    router.push('/admin/product'); // Navigate to /admin/product route
};

const submitForm = async () => {
    try {
        const formData = new FormData();
        formData.append('name', form.name);
        formData.append('pricing', form.pricing);
        formData.append('size', form.size);
        formData.append('brand', form.brand);
        formData.append('description', form.description);
        formData.append('category_id', form.category_id);
        if (form.image) {
            formData.append('image', form.image);
        }

        const response = await fetch('http://localhost:80/api/products', {
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
            const data = await response.json();
            successMessage.value = 'Product created successfully!';
            handleCancel(); // Redirect after successful creation
        } else {
            const errorData = await response.json();
            errorMessage.value = errorData.message || 'Failed to create product';
        }
    } catch (error) {
        errorMessage.value = 'An error occurred while creating the product';
        console.error('Error:', error);
    }
};


</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap');

label,
p,
button {
    font-family: "Rubik", sans-serif;
}
</style>
