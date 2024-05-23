<template>
    <div class="container">
        <div class="card w-9/12 mt-3 ms-5">
            <div class="card-header">
                <h4>Add Product</h4>
            </div>
            <form action=""  @submit.prevent="submitForm">
                <div class="card-body">
                <div class="mb-2">
                    <label for="name">Name</label>
                    <input type="text" v-model="formData.name" class="form-control" placeholder="Enter Product Name">
                </div>

                <div class="mb-2">
                    <label for="pricing">Pricing</label>
                    <input type="number" id="pricing" v-model="formData.pricing" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="discount">Discount</label>
                    <input type="number" id="discount" v-model="formData.discount" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="color">Color</label>
                    <input type="text" id="color" v-model="formData.color" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="size">Size</label>
                    <input type="text" id="size" v-model="formData.size" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="category_id">Category_id</label>
                    <input type="text" id="category_id" v-model="formData.category_id" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="supplier_id">Supplier_id</label>
                    <input type="text" id="supplier_id" v-model="formData.supplier_id" class="form-control">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary">Create Product</button>
                    <router-link to="/reporte" class="btn btn-success ms-2">Back to Product View</router-link>
                </div>
            </div>
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
        const response = await axios.post('http://localhost:80/api/products', formData.value,{
            headers:{
                "Content-Type":"application/json",
            }
        });
        console.log(response.data); // Handle response as needed
    } catch (error) {
        console.error(error);
        // Handle error
    }
};

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
</script>

<!-- <script setup>
import { ref } from 'vue';
import axios from 'axios';

const model = ref({
    name: '',
    pricing: '',
    discount: '',
    color: '',
    size: '',
    category_id: '',
    supplier_id: ''
});

const saveProduct = () => {
    axios.post('http://localhost/api/products', model.value)
        .then(res => {
            console.log(res.data);
            alert(res.data.message);

            // Reset model
            model.value = {
                name: '',
                pricing: '',
                discount: '',
                color: '',
                size: '',
                category_id: '',
                supplier_id: ''
            };
        })
        .catch(error => {
            console.error('Error saving product:', error);
            // Handle error
        });
};

</script> -->