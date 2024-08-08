<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-3 px-4 max-w-2xl lg:py-16">
            <!-- Bootstrap Alerts for Error and Success Messages -->
            <!-- <div v-if="errorMessage" class="alert alert-danger mt-4" role="alert">
                {{ errorMessage }}
            </div>
            <div v-if="successMessage" class="alert alert-success mt-4" role="alert">
                {{ successMessage }}
            </div> -->
            <p class="mb-4 font-semibold text-xl dark:text-white text-[#58AB5D]">Add a new supplier</p>
            <form @submit.prevent="submitForm">
                <div class="pt-1 grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <!-- Supplier Name -->
                    <div class="w-full">
                        <label for="name" class="block mb-2 font-semibold text-gray-900 dark:text-white">Supplier
                            Name</label>
                        <input v-model="name" type="text" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type supplier name" required>
                    </div>

                    <!-- Gender -->
                    <div class="w-full">
                        <label for="gender"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Gender</label>
                        <select v-model="gender" id="gender"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select gender</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="O">Other</option>
                        </select>
                    </div>

                    <!-- Telephone Number -->
                    <div class="w-full">
                        <label for="phone" class="block mb-2 font-semibold text-gray-900 dark:text-white">Telephone
                            Number</label>
                        <input v-model="phone" type="number" placeholder="093211943"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <!-- Email -->
                    <div class="w-full">
                        <label for="email" class="block mb-2 font-semibold text-gray-900 dark:text-white">Email</label>
                        <input v-model="email" type="email" placeholder="sopharongtha13@gmail.com"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <!-- Categories -->
                    <div class="w-full">
                        <label for="category"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Category</label>
                        <select v-model="selectedCategory" id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>

                    <!-- Products -->
                    <div class="w-full">
                        <label for="products"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Products</label>
                        <div class="relative">
                            <button type="button" @click="toggleDropdown"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                Select Products
                            </button>
                            <div v-show="dropdownOpen"
                                class="absolute z-10 mt-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto w-full">
                                <div class="p-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" v-model="selectAll" @change="toggleSelectAll"
                                            class="mr-2">
                                        Select All
                                    </label>
                                    <div v-for="product in filteredProducts" :key="product.id"
                                        class="flex items-center mt-2">
                                        <input type="checkbox" :value="product.id" v-model="selectedProducts"
                                            class="mr-2">
                                        <span>{{ product.name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Company -->
                    <div class="w-full">
                        <label for="company"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Company</label>
                        <input v-model="company" type="text" placeholder="Company A"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="w-full">
                        <label for="password"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Password</label>
                        <input v-model="password" type="text" placeholder="Input password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-2">
                        <label for="address"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Address</label>
                        <textarea v-model="address" id="address" rows="5"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your address here"></textarea>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col md:flex-row justify-end mt-5 space-y-2 md:space-y-0 md:space-x-2">
                    <button type="button" @click="handleCancel"
                        class="text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        CANCEL
                    </button>
                    <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        SUBMIT
                    </button>
                </div>
            </form>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

// Define reactive variables
const name = ref('');
const gender = ref('');
const phone = ref('');
const email = ref('');
const company = ref('');
const password = ref('');
const address = ref('');
const selectedProducts = ref([]);
const selectedCategory = ref('');
const products = ref([]);
const categories = ref([]);
const errorMessage = ref('');
const successMessage = ref('');
const dropdownOpen = ref(false);
const selectAll = ref(false);


const handleCancel = () => {
    router.push('/admin/supplier');
};

// Computed property for filtered products
const filteredProducts = computed(() => {
    if (!selectedCategory.value) return products.value;
    return products.value.filter(product => product.category_id === selectedCategory.value);
});

// Method to handle form submission
const submitForm = async () => {
    try {
        const response = await axios.post('http://localhost/api/suppliers', {
            name: name.value,
            gender: gender.value,
            phone: phone.value,
            email: email.value,
            company: company.value,
            password: password.value,
            address: address.value,
            product_ids: selectedProducts.value
        });
        successMessage.value = response.data.message;
        errorMessage.value = '';
        handleCancel(); // Redirect after successful creation

        // Clear the form fields after successful submission
        name.value = '';
        gender.value = '';
        phone.value = '';
        email.value = '';
        company.value = '';
        password.value= '';
        address.value = '';
        selectedProducts.value = [];
        selectedCategory.value = '';
        selectAll.value = false;
    } catch (error) {
        errorMessage.value = error.response?.data?.message || 'An error occurred';
        successMessage.value = '';
    }
};

// Method to fetch products
const getProducts = async () => {
    try {
        const response = await axios.get('http://localhost/api/products');
        products.value = response.data;
    } catch (error) {
        console.error('Error fetching products:', error);
    }
};

// Method to fetch categories
const getCategories = async () => {
    try {
        const response = await axios.get('http://localhost/api/categories');
        categories.value = response.data.data;
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
};

// Toggle dropdown visibility
const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
};

// Toggle select all functionality
const toggleSelectAll = () => {
    selectAll.value = !selectAll.value;
    if (selectAll.value) {
        selectedProducts.value = filteredProducts.value.map(product => product.id);
    } else {
        selectedProducts.value = [];
    }
};

// Update select all checkbox based on selected products
const updateSelectAll = () => {
    selectAll.value = filteredProducts.value.length > 0 && filteredProducts.value.every(product => selectedProducts.value.includes(product.id));
};

// Watch for changes in selected products and category
watch(selectedProducts, updateSelectAll);
watch(selectedCategory, () => {
    selectedProducts.value = [];
});

// On component mount, fetch products and categories
onMounted(async () => {
    await getProducts();
    await getCategories();
});

</script>

<style scoped>
/* Add your component-specific styles here */
</style>
