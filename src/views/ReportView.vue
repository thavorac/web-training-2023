<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>
                    Students
                    <RouterLink class="btn btn-primary float-end" to="/reporte/create">Add Student</RouterLink>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Pricing</th>
                            <th>Discount</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Brand</th>
                            <th>Category_id</th>
                            <th>Supplier_id</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody v-if="products.length > 0">
                        <tr v-for="Product in products" :key="Product">
                            <td>{{ Product.id }}</td>
                            <td>{{ Product.name }}</td>
                            <td>{{ Product.pricing }}</td>
                            <td>{{ Product.discount }}</td>
                            <td>{{ Product.color }}</td>
                            <td>{{ Product.size }}</td>
                            <td>{{ Product.brand }}</td>
                            <td>{{ Product.category_id }}</td>
                            <td>{{ Product.supplier_id }}</td>
                            <td>
                                <RouterLink to="/" class="btn btn-success">Edit</RouterLink>
                                <RouterLink type="button" to="/" class="btn btn-danger">Delete</RouterLink>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="10">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const products = ref([]);

onMounted(async () => {
    try {
        const response = await fetch('http://localhost/api/products');
        const data = await response.json();
        console.log(data);
        products.value = data;
    } catch (error) {
        console.error('Error fetching products:', error);
    }
});
</script>
