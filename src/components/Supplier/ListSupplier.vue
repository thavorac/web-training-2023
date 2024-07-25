<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import { RouterLink } from 'vue-router';
import CategoryView from '../../views/CategoryView.vue';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import IconCategories from '../icons/IconCategories.vue';
import IconsCirclePlus from '../icons/IconCirclePlus.vue';
import IconSearch from '../icons/IconSearch.vue';
import IconEdit from '../icons/IconEdit.vue';
import IconDelete from '../icons/IconDelete.vue';
import IconDetail from '../icons/IconDetail.vue';
import Swal from 'sweetalert2';

const suppliers = ref<any[]>([]);
const products = ref<any[]>([]);
const loading = ref(true);

const getSuppliers = async () => {
    try {
        const response = await axios.get('http://localhost/api/suppliers');
        suppliers.value = response.data;
    } catch (error) {
        console.error('Error fetching suppliers:', error);
    } finally {
        loading.value = false;
    }
};

const getProducts = async () => {
    try {
        const response = await axios.get('http://localhost/api/products');
        products.value = response.data;
        console.log(response.data)
    } catch (error) {
        console.error('Error fetching products', error);
    } finally {
        loading.value = false;
    }
}

const deleteSupplier = (supplierId: number) => {
    axios.delete(`http://localhost/api/suppliers/${supplierId}`)
        .then(() => {
            getSuppliers(); // Fetch data again after deletion
            Swal.fire("Deleted!", "Your supplier has been deleted.", "success");
        })
        .catch((error) => {
            Swal.fire("Error!", "An error occurred while deleting the supplier.", "error");
        });
};
// Function to confirm deletion using SweetAlert
const confirmDelete = (supplierId: number) => {
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
            deleteSupplier(supplierId) // Just call the function
                .then(() => {
                    Swal.fire(
                        "Deleted!",
                        "Your Supplier has been deleted.",
                        "success"
                    );
                })
                .catch(() => {
                    Swal.fire(
                        "Error!",
                        "An error occurred while deleting the Supplier.",
                        "error"
                    );
                });
        }
    });
};




getSuppliers();
getProducts();

// Add pagination and search refs here if needed
// const page = ref(1);
// const search = ref("");
</script>

<template>
    <div class="w-full bg-white rounded-md p-2">
        <div class="flex">
            <div class="bg-gray-100 flex items-center py-3 px-3 space-x-4 rounded-md">
                <IconCategories :w="'12'" :h="'12'" className="text-[#F66603]" />
                <template v-if="loading">
                    <IconSkLoading className="w-6 h-6" />
                </template>
                <template v-else>
                    <div class="flex flex-col">
                        <span class="text-sm font-semibold">Total</span>
                        <span class="font-sans font-semibold text-2xl">{{ suppliers.length }}</span>
                    </div>
                </template>
                <RouterLink to="/admin/supplier/create"
                    class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
                    <IconsCirclePlus className="w-10 h-10" stroke="2.0" />
                    <span class="text-xl font-semibold"> Supplier</span>
                </RouterLink>
            </div>
        </div>
        <div class="flex pr-4 mt-4">
            <div class="flex-grow"></div>
            <div class="relative text-gray-400">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <IconSearch className="w-6 h-6" stroke="2.0" />
                </div>
                <input type="text" placeholder="Search" class="appearance-none ps-12
                        rounded-md placeholder:text-gray-400 shadow-md font-semibold text-gray-700
                        hover:shadow-md outline-0 hover:outline-0 focus:outline-0 
                        focus:ring-0
                        focus:border-0 border-0" />
            </div>
        </div>
        <div class="relative overflow-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full overflow-auto text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">ID</th>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">Name</th>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">Gender</th>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">Company</th>
                        <th scope="col" class="px-6 py-3 text-lg">Phone_Num</th>
                        <th scope="col" class="px-6 py-3 text-lg">Address</th>
                        <th scope="col" class="px-6 py-3 text-lg">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="loading">
                        <th colspan="8">
                            <IconSkLoading className="w-6 h-6" />
                        </th>
                    </tr>
                    <template v-else>
                        <tr v-for="(supplier, index) in suppliers" :key="supplier.id"
                            :class="`bg-white ${index === suppliers.length - 1 ? '' : 'border-b'} border-gray-200 cursor-pointer hover:bg-gray-100`">
                            <td class="px-6 py-6">{{ index + 1 }}</td>
                            <td class="px-6 py-6">{{ supplier.name }}</td>
                            <td class="px-6 py-6">{{ supplier.gender }}</td>
                            <td class="px-6 py-6">{{ supplier.company }}</td>
                            <td class="px-6 py-6">{{ supplier.phone }}</td>
                            <td class="px-6 py-6">{{ supplier.address }}</td>
                            <td class="px-6 py-6 flex space-x-2">
                                <RouterLink :to="`/admin/supplier/${supplier.id}/edit`">
                                    <IconEdit class="w-6 h-6 text-blue-500 cursor-pointer" />
                                </RouterLink>
                                <IconDelete @click="confirmDelete(supplier.id)"
                                    class="w-6 h-6 text-red-500 cursor-pointer" />
                                <IconDetail class="w-6 h-6 text-green-500 cursor-pointer" />
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <!-- Add pagination here if needed -->
        </div>
    </div>
</template>

<style scoped>
.truncate-cell {
    max-width: 150px;
    /* Adjust as needed */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>
