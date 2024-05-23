<template>
    <div class="container ms-3">
        <div class="jumbotron  w-96" style="margin-top: 5%">
            <h1>Create Category</h1>
            <hr>
            <div v-if="successMessage" class="alert alert-success mb-1">
                <h4>{{ successMessage }}</h4>
            </div>
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


const submitForm = async () => {
    try {
        const response = await axios.post('http://localhost:80/api/categories', formData.value,{
            headers:{
                "Content-Type":"application/json",
            },
          
        });
        console.log(response.data); // Handle response as needed
        clearFormData();
    } catch (error) {
        console.error(error);
        // Handle error
    }
};

const successMessage = ref('');
const formData = ref({
    name: '',
});

const clearFormData = () => {
    // Clear form data
    formData.value = {
      name: '',
    };
  };

// const submitForm = async () => {
//     try {
//         // Make a POST request to create the product
//         const response = await fetch('/api/products/create', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify(formData.value)
//         });

//         if (response.ok) {
//             successMessage.value = 'Product created successfully!';
//             // Clear form data
//             formData.value = {
//                 name: '',
//                 pricing: '',
//                 discount: '',
//                 color: '',
//                 size: '',
//                 brand: '',
//                 category_id: '',
//                 supplier_id: ''
//             };
//         } else {
//             throw new Error('Failed to create product');
//         }
//     } catch (error) {
//         console.error(error);
//         // Handle error
//         successMessage.value = 'Failed to create product';
//     }
// };
</script>

<style scoped>
/* Add your component-specific styles here */
</style>