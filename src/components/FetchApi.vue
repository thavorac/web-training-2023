<template>
    <div class="container">
        <!-- relative overflow-x-auto -->
        <table class="table table-bordered">
            <!-- w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 -->
            <thead class="">
                <!-- text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 -->
                <tr class="pt-4">
                    <th style="background-color: orange;" scope="col" class="">name</th>
                    <!-- px-6 py-3  -->
                    <th style="background-color: orange;">pricing</th>
                    <th style="background-color: orange;">discount</th>
                    <th style="background-color: orange;">color</th>
                    <th style="background-color: orange;">size</th>
                    <th style="background-color: orange;">brand</th>
                    <th style="background-color: orange;">category_id</th>
                    <th style="background-color: orange;">supplier_id</th>
                    <th style="background-color: orange;">Edit</th>
                    <th style="background-color: orange;">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="Product in products" :key="Product">
                    <td>{{ Product.name }}</td>
                    <td>{{ Product.pricing }}</td>
                    <td>{{ Product.discount }}</td>
                    <td>{{ Product.color }}</td>
                    <td>{{ Product.size }}</td>
                    <td>{{ Product.brand }}</td>
                    <td>{{ Product.category_id }}</td>
                    <td>{{ Product.supplier_id }}</td>
                    <td>
                        <a href="" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                        <a href="" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
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
