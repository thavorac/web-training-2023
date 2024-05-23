<template>
    <div>
        <table ref="dataTable" class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ user.firstName }}</td>
                    <td>{{ user.lastName }}</td>
                    <td>{{ user.username }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import 'https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css';
import 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css';
import 'jquery';
import 'bootstrap'; // Import Bootstrap JS if needed
import 'datatables.net'; // Import DataTables JS

const users = [
    { firstName: 'John', lastName: 'Doe', username: 'johndoe' },
    { firstName: 'Jane', lastName: 'Doe', username: 'janedoe' },
    { firstName: 'Jane', lastName: 'Doe', username: 'janedoe' },
    { firstName: 'Jane', lastName: 'Doe', username: 'janedoe' },
    { firstName: 'Jane', lastName: 'Doe', username: 'janedoe' },
    { firstName: 'Jane', lastName: 'Doe', username: 'janedoe' },
    // Add more users as needed
];

let dataTable = null;

onMounted(() => {
    dataTable = $(dataTableRef.value).DataTable(); // Initialize DataTables
});

onBeforeUnmount(() => {
    if (dataTable !== null) {
        dataTable.destroy(); // Destroy the DataTable instance to avoid memory leaks
        dataTable = null;
    }
});

const dataTableRef = ref(null);
</script>

<style scoped>
/* Add any custom styles if needed */
</style>