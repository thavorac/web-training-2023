<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
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

const purchases = ref([]);
const suppliers = ref([]);
const products = ref([]); // Added for product information
const loading = ref(true);

const getPurchases = async () => {
    try {
        const response = await axios.get('http://localhost/api/purchases');
        purchases.value = response.data;
    } catch (error) {
        console.error('Error fetching purchases:', error);
    }
};

const getSuppliers = async () => {
    try {
        const response = await axios.get('http://localhost/api/suppliers');
        suppliers.value = response.data;
    } catch (error) {
        console.error('Error fetching suppliers:', error);
    }
};

const getProducts = async () => { // Added function to fetch products
    try {
        const response = await axios.get('http://localhost/api/products'); // Endpoint for products
        products.value = response.data;
        console.log('list products', response.data);
    } catch (error) {
        console.error('Error fetching products:', error);
    }
};

onMounted(async () => {
    await Promise.all([getPurchases(), getSuppliers(), getProducts()]); // Fetch products
    loading.value = false;
});

const purchasesWithDetails = computed(() => {
    return purchases.value.map(purchase => {
        const supplier = suppliers.value.find(sup => sup.id === purchase.supplier_id);
        const product = products.value.find(prod => prod.id === purchase.product_id); // Assuming product_id is in purchase
        return {
            ...purchase,
            supplier_company: supplier ? supplier.company : 'Unknown',
            product_name: product ? product.name : 'Unknown', // Added product_name
            product_origin_price: product ? product.origin_price : 'Unknown',
        };
    });
});

const deletePurchase = (purchaseId: number) => {
    axios.delete(`http://localhost/api/purchases/${purchaseId}`)
        .then(() => {
            getPurchases(); // Fetch data again after deletion
            Swal.fire("Deleted!", "Your purchase has been deleted.", "success");
        })
        .catch((error) => {
            Swal.fire("Error!", "An error occurred while deleting the purchase.", "error");
        });
};

const confirmDelete = (purchaseId: number) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, reject this order!"
    }).then((result) => {
        if (result.isConfirmed) {
            deletePurchase(purchaseId);
        }
    });
};
// Swal.fire({
//   title: "Do you want to save the changes?",
//   showDenyButton: true,
//   showCancelButton: true,
//   confirmButtonText: "Save",
//   denyButtonText: `Don't save`
// }).then((result) => {
//   /* Read more about isConfirmed, isDenied below */
//   if (result.isConfirmed) {
//     Swal.fire("Saved!", "", "success");
//   } else if (result.isDenied) {
//     Swal.fire("Changes are not saved", "", "info");
//   }
// });


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
                        <span class="font-sans font-semibold text-2xl">{{ purchases.length }}</span>
                    </div>
                </template>
                <RouterLink to="/admin/product"
                    class="bg-[#7367F0] no-underline px-4 py-3 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
                    <!-- <IconsCirclePlus className="w-10 h-10" stroke="2.0" /> -->
                    <span class="text-xl font-semibold"> Order Request</span>
                </RouterLink>
            </div>
        </div>
        <div class="relative overflow-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full overflow-auto text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-lg font-sans"> ID</th>
                        <th scope="col" class="px-6 py-3 text-lg font-sans"> Product</th>
                        <th scope="col" class="px-6 py-3 text-lg font-sans"> Bprice</th>
                        <th scope="col" class="px-6 py-3 text-lg">Qty</th>
                        <th scope="col" class="px-6 py-3 text-lg">Total Price</th>
                        <th scope="col" class="px-6 py-3 text-lg">Date</th>
                        <th scope="col" class="px-6 py-3 text-lg">Status</th>
                        <!-- <th scope="col" class="px-6 py-3 text-lg">Action</th> -->

                    </tr>
                </thead>
                <tbody>
                    <tr v-if="loading">
                        <th colspan="6">
                            <IconSkLoading className="w-6 h-6" />
                        </th>
                    </tr>
                    <template v-else>
                        <tr v-for="(purchase, index) in purchasesWithDetails" :key="index"
                            :class="`bg-white ${index === purchasesWithDetails.length - 1 ? '' : 'border-b'} border-gray-200 cursor-pointer hover:bg-gray-100`">
                            <td class="px-6 py-6">{{ purchase?.id }}</td>
                            <!-- <td class="px-6 py-6">{{ purchase?.supplier_company }}</td> -->
                            <td class="px-6 py-6">{{ purchase?.product_name }}</td>
                            <td class="px-6 py-6">{{ purchase?.product_origin_price }}</td>
                            <td class="px-6 py-6">{{ purchase?.qty }}</td>
                            <td class="px-6 py-6">${{ purchase?.total_price }}</td>
                            <td class="px-6 py-6">{{ purchase?.created_at }}</td>

                            <!-- <td :class="{
                                'px-6 py-6 text-left': true,
                                'text-orange-800': purchase?.status === 'pending',
                                ' text-teal-800': purchase?.status === 'completed',
                                ' text-red-800': purchase?.status === 'reject',
                                'bg-blue-200 text-blue-800': purchase?.status === 'delivery'
                            }">
                                {{ purchase?.status }}
                            </td> -->
                            <td class="px-6 py-6 flex space-x-2">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="green" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>


                                <svg @click="confirmDelete(purchase.id)" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </td>

                        </tr>
                    </template>
                </tbody>
            </table>
            <!-- Add pagination here if needed -->
        </div>
    </div>
</template>