<script setup lang="ts">
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

// Define emits for cancel action
const emit = defineEmits(['cancel']);
const router = useRouter();
const route = useRoute();

// Reactive variables to hold product data
const productName = ref('');
const brand = ref('');
const price = ref(0);
const category = ref('');
const size = ref('');
const description = ref('');
const image = ref<File | null>(null);

// Function to handle image upload
const handleImageUpload = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        image.value = target.files[0];
    }
};

// Function to fetch product data from backend
const getProduct = async (productId: number) => {
    try {
        const response = await axios.get(`http://localhost:80/api/products/${productId}`);
        const product = response.data.data;

        // Update reactive variables with product data
        productName.value = product.name;
        brand.value = product.brand;
        price.value = product.pricing;
        category.value = product.category_id;
        size.value = product.size;
        description.value = product.description;
    } catch (error) {
        console.error('Error fetching product:', error);
    }
};

// Fetch product data when component mounts
onMounted(() => {
    const productId = Number(route.params.productId);
    if (!isNaN(productId)) {
        getProduct(productId);
    } else {
        console.error('Invalid productId:', route.params.productId);
    }
});

// Function to fetch categories
const categories = ref([]);
const getCategories = async () => {
    try {
        const response = await axios.get("http://localhost:80/api/categories");
        categories.value = response.data.data;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

// Fetch categories when component mounts
onMounted(() => {
    getCategories();
});

// Function to handle form submission and product update
const updateProduct = async () => {
    const productId = Number(route.params.productId);
    const formData = new FormData();
    formData.append('name', productName.value);
    formData.append('brand', brand.value);
    formData.append('pricing', price.value.toString());
    formData.append('category_id', category.value);
    formData.append('size', size.value);
    formData.append('description', description.value);

    if (image.value) {
        formData.append('image', image.value);
    }

    try {
        const response = await axios.patch(`http://localhost:80/api/products/${productId}`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });
        console.log('Product updated successfully:', response.data);
        router.push('/admin'); // Navigate to the admin page after successful update
    } catch (error) {
        if (error.response) {
            console.error('Error response:', error.response.data);
        } else {
            console.error('Error updating product:', error.message);
        }
    }
};

// Function to handle cancel action
const handleCancel = () => {
    router.push('/admin');
};
</script>

<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-3 px-4 max-w-2xl lg:py-16">
            <p class="mb-4 font-semibold text-xl dark:text-white text-[#58AB5D]">Edit Product</p>
            <form @submit.prevent="updateProduct">
                <div class="pt-1 grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 font-semibold text-gray-900 dark:text-white">Product
                            Name</label>
                        <input v-model="productName" type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name" required>
                    </div>
                    <div class="w-full">
                        <label for="brand" class="block mb-2 font-semibold text-gray-900 dark:text-white">Brand</label>
                        <select v-model="brand" id="brand"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option disabled value="">Select brand</option>
                            <option value="A">Brand A</option>
                            <option value="B">Brand B</option>
                            <option value="C">Brand C</option>
                            <option value="D">Brand D</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="price" class="block mb-2 font-semibold text-gray-900 dark:text-white">Price</label>
                        <input v-model.number="price" type="number" name="price" id="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="$2999" required>
                    </div>
                    <div>
                        <label for="category_id"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Category</label>
                        <select v-model="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option disabled value="">Select category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{
                                category.name }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="size" class="block mb-2 font-semibold text-gray-900 dark:text-white">Size</label>
                        <select v-model="size" id="size"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option disabled value="">Select size</option>
                            <option value="S">small</option>
                            <option value="M">Medium</option>
                            <option value="L">Large</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block mb-2 font-semibold text-gray-900 dark:text-white"
                            for="multiple_files">Upload Image</label>
                        <input @change="handleImageUpload"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="multiple_files" type="file">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Description</label>
                        <textarea v-model="description" id="description" rows="8"
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
                        UPDATE
                    </button>
                </div>
            </form>
        </div>
    </section>
</template>



<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

label,
button {
    font-family: "Rubik", sans-serif;
}
</style>
