<script setup lang="ts">
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

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
const categories = ref([]);

// Function to fetch product data from backend
const getProduct = async (productId: number) => {
    try {
        const response = await axios.get(`http://localhost:80/api/products/${productId}`);
        const product = response.data.data;

        // Update reactive variables with product data
        productName.value = product.name;
        brand.value = product.brand;
        price.value = product.pricing;
        category.value = product.category_id.toString(); // Ensure category_id is string for select binding
        size.value = product.size;
        description.value = product.description;
    } catch (error) {
        console.error('Error fetching product:', error);
    }
};

// Fetch categories from backend
const getCategories = async () => {
    try {
        const response = await axios.get("http://localhost:80/api/categories");
        categories.value = response.data.data;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

// Function to handle image upload
const handleImageUpload = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        image.value = target.files[0];
    }
};

// Fetch product and categories when component mounts
onMounted(() => {
    const productId = Number(route.params.productId);
    if (!isNaN(productId)) {
        getProduct(productId);
    } else {
        console.error('Invalid productId:', route.params.productId);
    }
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
        handleCancel(); // Redirect after successful creation
    }

    try {
        const response = await axios.post(`http://localhost:80/api/products/${productId}`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'X-HTTP-Method-Override': 'PATCH'
            }
        });

        // Update reactive variables with updated product data
        const updatedProduct = response.data.data;
        productName.value = updatedProduct.name;
        brand.value = updatedProduct.brand;
        price.value = updatedProduct.pricing;
        category.value = updatedProduct.category_id.toString(); // Ensure category_id is string for select binding
        size.value = updatedProduct.size;
        description.value = updatedProduct.description;

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
                            placeholder="Type product name">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="brand" class="block mb-2 font-semibold text-gray-900 dark:text-white">Brand</label>
                        <input v-model="brand" type="text" name="brand" id="brand"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type brand">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="size" class="block mb-2 font-semibold text-gray-900 dark:text-white">Size</label>
                        <input v-model="size" type="text" name="size" id="size"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type size">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="price" class="block mb-2 font-semibold text-gray-900 dark:text-white">Price</label>
                        <input v-model.number="price" type="number" name="price" id="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="$2999">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="category"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Category</label>
                        <select v-model="category" name="category" id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option disabled value="">Select category</option>
                            <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block mb-2 font-semibold text-gray-900 dark:text-white" for="image">Upload
                            Image</label>
                        <input @change="handleImageUpload"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="image" type="file">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Description</label>
                        <textarea v-model="description" id="description" rows="4"
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
