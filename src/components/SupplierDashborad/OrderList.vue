<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import IconSkLoading from '../loading/SmsLoading.vue';
import IconCategories from '../icons/IconCategories.vue';
import { useSearchStore } from '../../stores/search';
import { useStore } from 'vuex';
import { usePurchasesStore } from '../../stores/purchases';

const printreceipt = () => {
    const originalContent = document.body.innerHTML;
    const receiptContent = document.querySelector('.container').innerHTML;
    document.body.innerHTML = receiptContent;
    window.print();
    document.body.innerHTML = originalContent;
};

const purchaseStore = usePurchasesStore();
const store = useStore();
const supplier = computed(() => store.getters.getSupplier);

const purchases = ref([]);
const suppliers = ref([]);
const products = ref([]);
const loading = ref(true);
const searchStore = useSearchStore();

const search = computed(() => searchStore.search);

const getPurchases = async () => {
    try {
        const response = await axios.get('http://localhost/api/purchases');
        purchases.value = response.data;
    } catch (error) {
        console.error('Error fetching purchases:', error);
    }
};

const getPurchasesOfSupplier = async (supplierId: number) => {
    try {
        const response = await axios.get(`http://localhost/api/suppliers/${supplierId}/purchases`);
        purchases.value = response.data;
        console.log('all purchases of supplier: ', response.data);
    } catch (error) {
        console.log('Error fetching purchases of one supplier :', error);
    }
}

const getProducts = async () => {
    try {
        const response = await axios.get('http://localhost/api/products');
        products.value = response.data;
    } catch (error) {
        console.error('Error fetching products:', error);
    }
};

onMounted(async () => {
    // console.log('log supplier store', supplier.value.id);
    await Promise.all([getPurchasesOfSupplier(supplier.value.id), getProducts()]);
    loading.value = false;
});

const purchasesWithDetails = computed(() => {
    return purchases.value.map(purchase => {
        const supplier = suppliers.value.find(sup => sup.id === purchase.supplier_id);
        const product = products.value.find(prod => prod.id === purchase.product_id);
        return {
            ...purchase,
            supplier_company: supplier ? supplier.company : 'Unknown',
            product_name: product ? product.name : 'Unknown',
            product_origin_price: product ? product.origin_price : 'Unknown',
        };
    })
        .filter(purchase => {
            return purchase.product_name.toLowerCase().includes(search.value.toLowerCase());
        });
});

    const updatePurchaseStatus = async (purchaseId:number, status:string) => {
        try {
            await axios.patch(`http://localhost/api/purchase/${purchaseId}`, { status });
            Swal.fire("Updated!", `The purchase status has been updated to ${status}.`, "success");
        } catch (error) {
            console.error('Error updating purchase status:', error);
            Swal.fire("Error!", "An error occurred while updating the purchase status.", "error");
        }
    };

    const confirmUpdateStatus = (purchaseId:number, status:string) => {
        const statusAction = status === 'accepted' ? 'accept' : 'reject';
        const confirmButtonColor = status === 'accepted' ? 'green' : '#3085d6';

        Swal.fire({
            title: `Are you sure you want to ${statusAction} this order?`,
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: confirmButtonColor,
            cancelButtonColor: "#d33",
            confirmButtonText: `Yes, ${statusAction} it!`
        }).then((result) => {
            if (result.isConfirmed) {
                updatePurchaseStatus(purchaseId, status);
            }
        });
    };
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
                            <td class="px-6 py-6">{{ purchase?.product_name }}</td>
                            <td class="px-6 py-6">{{ purchase?.product_origin_price }}</td>
                            <td class="px-6 py-6">{{ purchase?.qty }}</td>
                            <td class="px-6 py-6">${{ purchase?.total_price }}</td>
                            <td class="px-6 py-6">{{ purchase?.created_at }}</td>
                            <td class="px-6 py-6 flex space-x-2">
                                <!-- accept icon -->
                                <svg @click="confirmUpdateStatus(purchase.id, 'accepted')"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="green" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                <!-- reject icon -->
                                <svg @click="confirmUpdateStatus(purchase.id, 'rejected')"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="red" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                <!-- print receipt -->

                                <i @click="printreceipt" class='bx bx-printer text-blue-600 text-xl '></i>

                                <!-- <button @click="printreceipt" class="btn btn-primary ">Print Receipt</button> -->

                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</template>
