================================= Product Item Can search and filter by date
==============================================
<script setup lang="ts">
import { ref, computed, toValue } from 'vue';
import ProductView from '../../views/ProductView.vue';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import IconCategories from '../icons/IconCategories.vue';
import IconsCirclePlus from '../icons/IconCirclePlus.vue';
import IconSearch from '../icons/IconSearch.vue';
import CreateFormProduct from './CreateFormProduct.vue';
import ActionButton from '../CrudAction/ActionButton.vue';
import Datepicker from 'vue3-datepicker'; // Import the datepicker component
import { useFetch } from '@/composable/useFetch';

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

// const { loading, data } = useFetch<any>(import.meta.env.VITE_BACKEND + /api/categories?page=${toValue(page)}&search=${toValue(search)});

const page = ref(1);
const search = ref("");
const showCreateForm = ref(false);
const startDate = ref<Date | null>(null);
const endDate = ref<Date | null>(null);

const mockData = ref<Product[]>([
    { id: 1, name: 'Product A', description: 'Description A', qty: 10, date: '2023-01-01', revenue: 100, netProfit: 20, status: 'Available' },
    { id: 2, name: 'Product A', description: 'Description A', qty: 10, date: '2023-01-01', revenue: 100, netProfit: 20, status: 'Available' },
    { id: 3, name: 'Product B', description: 'Description B', qty: 5, date: '2023-02-01', revenue: 200, netProfit: 50, status: 'Available' },
    { id: 4, name: 'Product C', description: 'Description C', qty: 8, date: '2023-03-01', revenue: 150, netProfit: 30, status: 'Unavailable' },
    // Add more mock products as needed
]);

const filteredData = computed(() => {
    let filtered = mockData.value;

    if (search.value) {
        filtered = filtered.filter(product => product.name.toLowerCase().includes(search.value.toLowerCase()));
    }

    if (startDate.value) {
        filtered = filtered.filter(product => new Date(product.date) >= startDate.value);
    }

    if (endDate.value) {
        filtered = filtered.filter(product => new Date(product.date) <= endDate.value);
    }

    return filtered;
});
// Method to reset all filters
const resetFilters = () => {
    search.value = "";
    startDate.value = null;
    endDate.value = null;
};

// Method to toggle the create form
const toggleCreateForm = () => {
    showCreateForm.value = true;
};

// Method to handle cancel event
const handleCancel = () => {
    showCreateForm.value = false;
};

const handleEdit = (product: Product) => {
    console.log('Edit product:', product);
};

const handleDelete = (product: Product) => {
    console.log('Delete product:', product);
};

const handleDetail = (product: Product) => {
    console.log('View details of product:', product);
};


</script><template>
    <ProductView :subtitle="'Product'">
        <div class="w-full py-10 px-10 mt-10 rounded-lg bg-gray-200 shadow-md">
            <div class="w-full bg-white rounded-md p-2">
                <template v-if="!showCreateForm">
                    <div class="flex items-center py-3 px-3 space-x-4 rounded-md bg-gray-100">
                        <IconCategories :w="'12'" :h="'12'" class="text-[#F66603]" />
                        <!-- laoding -->
                        <!-- <template v-if="loading">
                            <IconSkLoading className="w-6 h-6" />
                        </template> -->
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold">Total</span>
                            <span class="font-sans font-semibold text-2xl">{{ filteredData.length }}</span>
                        </div>
                        <button @click="toggleCreateForm"
                            class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
                            <IconsCirclePlus class="w-10 h-10" stroke="2.0" />
                            <span class="text-xl font-semibold">Add Product</span>
                        </button>
                    </div>

                    <div class="flex pr-4 mt-4 space-x-1 justify-between">
                        <!-- filter date -->
                        <!-- Datepicker for start date -->
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <Datepicker v-model="startDate"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date start" />
                            </div>
                            <span class="mx-2 text-gray-500">to</span>
                            <!-- Datepicker for end date -->
                            <div class="relative">
                                <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <Datepicker v-model="endDate"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date end" />
                            </div>
                        </div>
                        <!-- search field -->
                        <div class="relative text-gray-400 space-x-4 ">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                                <IconSearch class="w-6 h-6" stroke="2.0" />
                            </div>
                            <input v-model="search" type="text" placeholder="Search"
                                class="appearance-none pl-12 rounded-md placeholder:text-gray-400 shadow-md font-semibold text-gray-700 hover:shadow-md outline-none border-none focus:ring-0" />
                            <!-- button reset filter -->
                            <button @click="resetFilters" class=" ">
                                <div class="flex items-center">
                                    <span class="font-medium text-sm text-blue-500 cursor-pointer">All Products</span>
                                    <a class="pt-1" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="#1E90FF" class="size-5">
                                            <path fill-rule="evenodd"
                                                d="M2 10a.75.75 0 0 1 .75-.75h12.59l-2.1-1.95a.75.75 0 1 1 1.02-1.1l3.5 3.25a.75.75 0 0 1 0 1.1l-3.5 3.25a.75.75 0 1 1-1.02-1.1l2.1-1.95H2.75A.75.75 0 0 1 2 10Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="relative overflow-auto shadow-md sm:rounded-lg mt-4">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-lg font-sans text-[#8E95A9]">Product ID</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Image</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Product Name</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Qty</th>
                                    <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Date</th>
                                    <!-- <th scope="col" class="px-6 py-3 text-lg text-[#8E95A9]">Revenue</th> -->
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
                                        :class="bg - white ${ index == filteredData.length - 1 ? '' : 'border-b' } border - gray - 200 cursor - pointer hover: bg - gray - 100"
                                        :key="product.id">
                                        <th scope="row" class="px-6 py-6 font-medium text-gray-800">{{ product.id }}
                                        </th>
                                        <td class="px-6 py-6">{{ product.name }}</td>
                                        <td class="px-6 py-6">{{ product.image }}</td>
                                        <td class="px-6 py-6">{{ product.qty }}</td>
                                        <td class="px-6 py-6">{{ product.date }}</td>
                                        <!-- <td class="px-6 py-6">{{ product.revenue }}</td> -->
                                        <td class="px-6 py-6">{{ product.netProfit }}</td>
                                        <td class="px-6 py-6">{{ product.status }}</td>
                                        <ActionButton :product="product" @edit="handleEdit" @delete="handleDelete"
                                            @detail="handleDetail" />
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </template>
                <template v-else>
                    <CreateFormProduct @cancel="handleCancel" />
                </template>
            </div>
            <div class="text-xl text-right font-semibold text-black">Product</div>
        </div>
    </ProductView>
</template>