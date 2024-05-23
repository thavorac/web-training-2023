<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Add Product</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" v-model="model.name" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="pricing">Pricing</label>
                    <input type="number" id="pricing" v-model="model.pricing" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="discount">Discount</label>
                    <input type="number" id="discount" v-model="model.discount" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="color">Color</label>
                    <input type="text" id="color" v-model="model.color" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="size">Size</label>
                    <input type="text" id="size" v-model="model.size" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="category_id">Category_id</label>
                    <input type="text" id="category_id" v-model="model.category_id" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="supplier_id">Supplier_id</label>
                    <input type="text" id="supplier_id" v-model="model.supplier_id" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="button" @click="saveProduct" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
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

</script>