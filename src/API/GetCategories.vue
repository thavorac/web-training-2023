<template>
    <div class="relative overflow-x-auto ">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="bg-orange-400 pt-4">
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th>name</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="Category in categories" :key="Category">
                    <td>{{ Category.id }}</td>
                    <td>{{ Category.name }}</td>
                    <td>{{ Category.created_at }}</td>
                    <td>{{ Category.updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const categories = ref([]);

onMounted(async () => {
    try {
        const response = await fetch('http://localhost/api/categories');
        const data = await response.json();
        console.log(data);
        categories.value = data;
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
});
</script>
