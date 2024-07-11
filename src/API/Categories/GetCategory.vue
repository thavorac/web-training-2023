<template>
    <div class="container">
        <div class="jumbotron ms-2">
            <p class="text-2xl font-bold mt-1" >Manage Category {{ categories.length }}</p>
            <div class="line mb-3 mt-1 me-5 w-40 float-end m-0 p-0">
                <router-link to="/form-category" class="btn btn-primary">Add New Category</router-link>
            </div>
            <hr />
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Category ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created_At</th>
                        <th scope="col">Updated_At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in paginatedCategories" :key="category.id" style="background:white;">
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <td>{{ category.created_at }}</td>
                        <td>{{ category.updated_at }}</td>
                        <td class="flex space-x-2">
                            <router-link :to="'/edit-category/' + category.id" class="btn btn-success" :title="'hello'">Edit</router-link>
                            <button @click="confirmDelete(category.id)" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Pagination -->
            <PaginationView :totalPages="totalPages" :currentPage="currentPage" @goToPage="goToPage" />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useFetch } from '../../composable/useFetch.js';
import Swal from 'sweetalert2'

import PaginationView from '@/views/PaginationView.vue';

const categories = ref([]);
const { data, error } = useFetch("http://localhost/api/categories");

// Pagination logic
const itemsPerPage = 7; // Adjust this value as needed
const currentPage = ref(1);

const deleteCategory = async (categoryId) => {
    try {
        const response = await fetch(`http://localhost/api/categories/${categoryId}`, {
            method: 'DELETE'
        });
        const data = await response.json();
        // Refresh products after deletion
        const updatedCategories = categories.value.filter(category => category.id !== categoryId);
        categories.value = updatedCategories;
    } catch (error) {
        console.error('Error deleting category:', error);
    }
}

onMounted(async () => {
    try {
        const response = await fetch('http://localhost/api/categories');
        const data = await response.json();
        categories.value = data;
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
});

const confirmDelete = (categoryId) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
        deleteCategory(categoryId);
      Swal.fire(
        "Deleted!",
        "Your file has been deleted.",
        "success"
      );
    }
  });
};

const totalPages = computed(() => Math.ceil(categories.value.length / itemsPerPage));

const paginatedCategories = computed(() => {
    const startIndex = (currentPage.value - 1) * itemsPerPage;
    const endIndex = currentPage.value * itemsPerPage;
    return categories.value.slice(startIndex, endIndex);
});

const goToPage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
    }
}
</script>

<style scoped>
/* Add your component-specific styles here */
</style>
