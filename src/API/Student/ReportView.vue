<template>
    <div class="container">
        <div class="card ms-3 mt-2">
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
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody v-if="products.length > 0">
                        <tr v-for="product in products" :key="product.id">
                            <td>{{ product.id }}</td>
                            <td>{{ product.name }}</td>
                            <td>{{ product.pricing }}</td>
                            <td>{{ product.discount }}</td>
                            <td>{{ product.color }}</td>
                            <td>{{ product.size }}</td>
                            <td>{{ product.brand }}</td>
                            <td>{{ product.category_id }}</td>
                            <td>{{ product.supplier_id }}</td>
                            <td>
                                <RouterLink :to="'/edit-product/' + product.id" class="btn btn-success" :title="'hello'">Edit</RouterLink>
                            </td>
                            <td>
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
import { useRouter } from 'vue-router';

const products = ref([]);
const router = useRouter();


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

const deleteProduct = async (productId) => {
  try {
    const response = await fetch(`http://localhost/api/products/${productId}`, {
      method: 'DELETE'
    });
    const data = await response.json();
    // Refresh products after deletion
    const updatedProducts = products.value.filter(product => product.id !== productId);
    products.value = updatedProducts;
  } catch (error) {
    console.error('Error deleting product:', error);
  }
};
</script>