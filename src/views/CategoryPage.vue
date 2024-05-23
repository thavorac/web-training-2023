<script setup>
import { onMounted, ref } from 'vue';
import { request } from "../composable/request.js"

const list = ref([]);

const getList = async () => {
    const res = await request("categories","get",{});
    console.log(res); // Log the response to see its structure
    if(res){
        list.value = res;
    }
}

onMounted(getList);
</script>

<template>
<div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <div>
            <h1>Category {{ list.length }}</h1>
        </div>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Name</th>
            <th>Created_AT</th>
            <th>Updated_at</th>
        </tr>
        <tr v-for="(category , index ) in list " :key="category.id">
            <td>{{ index + 1 }}</td>
            <td>{{ category.id }}</td>
            <td>{{ category.name }}</td>
            <td>{{ category.created_at }}</td>
            <td>{{ category.updated_at }}</td>
        </tr>
    </table>
</div>
</template>
