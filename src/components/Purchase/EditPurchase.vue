<template>
    <div class="p-3">
        <p class="font-semibold text-xl dark:text-white text-[#58AB5D]">Edit Purchase</p>
    </div>
    <div v-if="purchase && product" class="container con mt-3 flex justify-start items-start">
        <div class="row">
            <div class="img col-md-5 group relative overflow-hidden">
                <img width="100%" :src="`http://localhost/storage/${product.image}`"
                    class="object-cover transform transition-transform duration-500 group-hover:scale-110" alt="" />
            </div>
            <div class="col-sm-6 mt-1 ms-12 leading-6">
                <form @submit.prevent="updatePurchase">
                    <p>{{ product.name }}</p>
                    <p>Original Price : ${{ product.origin_price }}</p>
                    <div class="col-sm-10">
                        <label for="qty" class="block mb-2 font-semibold">Qty</label>
                        <input id="qty" type="number" v-model="purchase.qty"
                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-200 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Input qty" required>
                    </div>
                    <div class="col-sm-10 mt-3">
                        <label for="supplier"
                            class="block mb-3 font-semibold text-gray-900 dark:text-white">Supplier</label>
                        <select v-model="purchase.supplier_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-200 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select supplier</option>
                            <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{
                                supplier.name }}</option>
                        </select>
                    </div>
                    <div
                        class="col-sm-12 flex flex-col md:flex-row justify-start mt-5 space-y-2 md:space-y-0 md:space-x-2">
                        <button type="button" @click="handleCancel"
                            class="text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            CANCEL
                        </button>
                        <button type="submit"
                            class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                            UPDATE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();

const purchase = ref({
    supplier_id: '',
    product_id: '',
    qty: 1,
    status: 'pending'
});
const product = ref(null);
const suppliers = ref([]);

const handleCancel = () => {
    router.push('/admin/purchase');
};

const fetchPurchaseDetails = async () => {
    const purchaseId = route.params.id;
    try {
        const response = await axios.get(`http://localhost/api/purchases/${purchaseId}`);
        purchase.value = response.data;
        await fetchProductDetail(purchase.value.product_id);
    } catch (error) {
        console.error('Error fetching purchase details:', error);
    }
};

const fetchProductDetail = async (productId) => {
    try {
        const response = await axios.get(`http://localhost/api/products/${productId}`);
        product.value = response.data.data;
        await fetchSuppliers(productId);
    } catch (error) {
        console.error('Error fetching product details:', error);
    }
};

const fetchSuppliers = async (productId) => {
    try {
        const response = await axios.get(`http://localhost/api/products/${productId}/suppliers`);
        suppliers.value = response.data;
    } catch (error) {
        console.error('Error fetching suppliers:', error);
    }
};

const updatePurchase = async () => {
    const purchaseId = route.params.id; // Ensure purchaseId is defined
    try {
        console.log('Before update:', purchase.value);
        await axios.patch(`http://localhost/api/purchases/${purchaseId}`, purchase.value);
        console.log('After update:', purchase.value);
        router.push('/admin/purchase');
    } catch (error) {
        console.error('Error updating purchase:', error);
    }
};

onMounted(() => {
    fetchPurchaseDetails();
});
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Rubik:wght@600&display=swap');

* {
    font-family: "Rubik", sans-serif;
    font-optical-sizing: auto;
    font-weight: 600;
    font-style: normal;
}

.con {
    width: 1022px;
    height: 400px;
}

img {
    object-fit: cover;
}
</style>
