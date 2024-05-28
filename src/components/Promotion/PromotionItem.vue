<script setup lang="ts">
import { ref, computed, watch } from 'vue';
import CategoryView from '../../views/CategoryView.vue';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import IconCategories from '../icons/IconCategories.vue';
import IconsCirclePlus from '../icons/IconCirclePlus.vue';
import IconSearch from '../icons/IconSearch.vue';
import CreateFormPromotion from './CreateFormPromotion.vue';
import ActionButton from '../CrudAction/ActionButton.vue';


interface Product {
    id: number;
    name: string;
    description: string;
    qty: number;
    date: string;
    revenue: number;
    netProfit: number;
    status: string;
}

const page = ref(1);
const search = ref("");
const showCreateForm = ref(false);

const mockData = ref<Product[]>([
    { id: 1, name: 'Product A', description: 'Description A', qty: 10, date: '2023-01-01', revenue: 100, netProfit: 20, status: 'Available' },
    { id: 2, name: 'Pruduct A', description: 'Description A', qty: 10, date: '2023-01-01', revenue: 100, netProfit: 20, status: 'Available' },
    { id: 3, name: 'Sroduct B', description: 'Description B', qty: 5, date: '2023-02-01', revenue: 200, netProfit: 50, status: 'Available' },
    { id: 4, name: 'Broduct C', description: 'Description C', qty: 8, date: '2023-03-01', revenue: 150, netProfit: 30, status: 'Unavailable' },
    // Add more mock products as needed
]);

const filteredData = computed(() => {
    if (!search.value) {
        return mockData.value;
    }
    return mockData.value.filter(product => product.name.toLowerCase().includes(search.value.toLowerCase()));
});

// Method to toggle the create form
const toggleCreateForm = () => {
    showCreateForm.value = true;
};

// Method to handle cancel event
const handleCancel = () => {
    showCreateForm.value = false;
};

interface Product {
    id: number;
    name: string;
    description: string;
    qty: number;
    date: string;
    revenue: number;
    netProfit: number;
    status: string;
}

const handleEdit = (product: Product) => {
    console.log('Edit product:', product);
};

const handleDelete = (product: Product) => {
    console.log('Delete product:', product);
};

const handleDetail = (product: Product) => {
    console.log('View details of product:', product);
};


</script>

<template>
    <CategoryView :subtitle="'Promotion'">
        <div class="w-full selection:bg-gray-100 py-10 px-10 mt-10 rounded-lg bg-gray-200 shadow-md">
            <div class="w-full bg-white rounded-md p-2">
                <template v-if="!showCreateForm">
                    <div class="flex">
                        <div class="bg-gray-100 flex items-center py-3 px-3 space-x-4 rounded-md">
                            <IconCategories :w="'12'" :h="'12'" class="text-[#F66603]" />
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold">Total</span>
                                <span class="font-sans font-semibold text-2xl">{{ filteredData.length }}</span>
                            </div>
                            <button @click="toggleCreateForm"
                                class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
                                <IconsCirclePlus class="w-10 h-10" stroke="2.0" />
                                <span class="text-xl font-semibold">Promotion</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex pr-4 mt-4">
                        <div class="flex-grow"></div>
                        <div class="relative text-gray-400">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <IconSearch class="w-6 h-6" stroke="2.0" />
                            </div>
                            <input v-model="search" type="text" placeholder="Search"
                                class="appearance-none ps-12 rounded-md placeholder:text-gray-400 shadow-md font-semibold text-gray-700 hover:shadow-md outline-0 hover:outline-0 focus:outline-0 focus:ring-0 focus:border-0 border-0" />
                        </div>
                    </div>

                    <div class="relative overflow-auto shadow-md sm:rounded-lg mt-4">
                        <table class="w-full overflow-auto text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-lg font-sans text-[#8E95A9]">Product ID</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Promotion Name</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Qty</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Date</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Revenue</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Net Profit</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Status</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="filteredData.length === 0">
                                    <tr>
                                        <td colspan="8" class="px-6 py-6 text-center text-gray-500">No products found
                                        </td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <tr v-for="(product, index) in filteredData"
                                        :class="`bg-white ${index == filteredData.length - 1 ? '' : 'border-b'} border-gray-200 cursor-pointer hover:bg-gray-100`"
                                        :key="product.id">
                                        <th scope="row" class="px-6 py-6 font-medium text-gray-800">{{ product.id }}
                                        </th>
                                        <td class="px-6 py-6">{{ product.name }}</td>
                                        <td class="px-6 py-6">{{ product.qty }}</td>
                                        <td class="px-6 py-6">{{ product.date }}</td>
                                        <td class="px-6 py-6">{{ product.revenue }}</td>
                                        <td class="px-6 py-6">{{ product.netProfit }}</td>
                                        <td class="px-6 py-6">{{ product.status }}</td>
                                        <ActionButton :product="product" @edit="handleEdit" @delete="handleDelete"
                                            @detail="handleDetail" />
                                        <!-- <td class="px-6 py-6">action</td> -->

                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <!-- paginate -->

                    </div>
                </template>

                <template v-else>
                    <CreateFormPromotion @cancel="handleCancel" /> <!-- Listen for cancel event -->
                </template>
            </div>
            <div class="text-xl text-right font-semibold text-black">Product </div>
        </div>
    </CategoryView>
</template>
