<template>
    <div class="container ms-3">
        <div class="jumbotron w-96" style="margin-top: 5%">
            <h1>Create Category</h1>
            <hr>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" v-model="formData.name" class="form-control" placeholder="Enter Category Name">
                </div>
                <button type="submit" class="btn btn-success mt-5">Save/Insert Data</button>
                <router-link to="/getCategory" class="btn btn-primary mt-5 ms-2">Back to Category View</router-link>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import Swal from 'sweetalert2'; // Import SweetAlert2

const submitForm = async () => {
    try {
        const response = await axios.post('http://localhost:80/api/categories', formData.value, {
            headers: {
                "Content-Type": "application/json",
            },
        });
        console.log(response.data); // Handle response as needed
        Swal.fire({
            icon: 'success',
            title: 'Category Added Successfully!',
            text: 'Create Successfully'
        });
        clearFormData();
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Failed to Add Category',
            text: error.message || 'Something went wrong!',
        });
        console.error(error);
    }
};

const formData = ref({
    name: '',
});

const clearFormData = () => {
    // Clear form data
    formData.value = {
        name: '',
    };
};

</script>

<style scoped>
/* Add your component-specific styles here */
</style>
