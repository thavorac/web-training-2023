<template>
    <div class="container">
        <div class="jumbotron" style="margin-top: 5%">
            <h1>Create Product</h1>
            <hr>
            <form @submit.prevent="submitForm">
                @csrf

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" v-model="formData.name" class="form-control" placeholder="Enter Product Name">
                </div>
                <div class="form-group">
                    <label>Pricing</label>
                    <input type="text" v-model="formData.pricing" class="form-control"
                        placeholder="Enter Product Price">
                </div>
                <div class="form-group">
                    <label>Discount</label>
                    <input type="text" v-model="formData.discount" class="form-control"
                        placeholder="Enter Product Discount">
                </div>
                <div class="form-group">
                    <label>Color</label>
                    <input type="text" v-model="formData.color" class="form-control" placeholder="Enter Product Color">
                </div>
                <div class="form-group">
                    <label>Size</label>
                    <input type="text" v-model="formData.size" class="form-control" placeholder="Enter Product Size">
                </div>
                <div class="form-group">
                    <label>Brand</label>
                    <input type="text" v-model="formData.brand" class="form-control" placeholder="Enter Product Brand">
                </div>
                <div class="form-group">
                    <label>Category ID</label>
                    <input type="text" v-model="formData.category_id" class="form-control"
                        placeholder="Enter Product Category ID">
                </div>
                <div class="form-group">
                    <label>Supplier ID</label>
                    <input type="text" v-model="formData.supplier_id" class="form-control"
                        placeholder="Enter Product Supplier ID">
                </div>
                <button type="submit" class="btn btn-success mt-5">Save/Insert Data</button>
                <a href="/getProducts" class="btn btn-primary mt-5 ms-2">Back to Product View</a>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const successMessage = ref('');
const formData = ref({
    name: '',
    pricing: '',
    discount: '',
    color: '',
    size: '',
    brand: '',
    category_id: '',
    supplier_id: ''
});

const submitForm = async () => {
    try {
        const response = await axios.get('/api/products', formData.value, {
            headers: {
                "Content-Type": "application/json"
            }
        });
        successMessage.value = response.data.message; // Assuming the response contains a success message
        // Clear form data after successful submission
        clearFormData();
    } catch (error) {
        console.error(error);
        // Handle error
    }
};

const clearFormData = () => {
    formData.value = {
        name: '',
        pricing: '',
        discount: '',
        color: '',
        size: '',
        brand: '',
        category_id: '',
        supplier_id: ''
    };
};
</script>

<style scoped>
/* Add your component-specific styles here */
</style>