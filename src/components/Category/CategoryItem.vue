<script setup lang="ts">
import { useFetch } from '@/composable/useFetch';
import CategoryView from '../../views/CategoryView.vue';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import IconCategories from '../icons/IconCategories.vue';
import IconsCirclePlus from '../icons/IconCirclePlus.vue';
import IconSearch from '../icons/IconSearch.vue';
import CreateFormCategory from './CreateFormCategory.vue'; // Import the CreateFormCategory component
import { ref, toRefs } from 'vue';
import ActionButton from '../CrudAction/ActionButton.vue';

interface Product {
    // Define your Product interface here if not already defined
}

const { page, search, showCreateForm } = toRefs({
    page: ref(1),
    search: ref(""),
    showCreateForm: ref(false)
});

// const { loading, data } = useFetch<any>(`${import.meta.env.VITE_BACKEND}/api/categories?page=${toValue(page)}&search=${toValue(search)}`);
const { loading, data } = useFetch<any>(import.meta.env.VITE_BACKEND + `/api/categories?page=${page.value}&search=${search.value}`);
// Method to toggle the create form
const toggleCreateForm = () => {
    showCreateForm.value = !showCreateForm.value;
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
</script>

<template>
    <CategoryView :subtitle="'Category'">
        <div class="w-full selection:bg-gray-100 py-10 px-10 mt-10 rounded-lg bg-gray-200 shadow-md">
            <div class="w-full bg-white rounded-md p-2">
                <template v-if="!showCreateForm">
                    <div class="flex">
                        <div class="bg-gray-100 flex items-center py-3 px-3 space-x-4 rounded-md">
                            <IconCategories :w="'12'" :h="'12'" className="text-[#F66603]" />
                            <template v-if="loading">
                                <IconSkLoading className="w-6 h-6" />
                            </template>
                            <template v-else>
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold">Total</span>
                                    <span class="font-sans font-semibold text-2xl">{{ data?.total }}</span>
                                </div>
                            </template>
                            <button @click="toggleCreateForm"
                                class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
                                <IconsCirclePlus className="w-10 h-10" stroke="2.0" />
                                <span class="text-xl font-semibold">Category</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex pr-4 mt-4">
                        <div class="flex-grow"></div>
                        <div class="relative text-gray-400">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <IconSearch className="w-6 h-6" stroke="2.0" />
                            </div>
                            <input type="text" placeholder="Search"
                                class="appearance-none ps-12 rounded-md placeholder:text-gray-400 shadow-md font-semibold text-gray-700 hover:shadow-md outline-0 hover:outline-0 focus:outline-0 focus:ring-0 focus:border-0 border-0" />
                        </div>
                    </div>

                    <div class="relative overflow-auto shadow-md sm:rounded-lg mt-4">
                        <table class="w-full overflow-auto text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-lg font-sans">Category Name</th>
                                    <th scope="col" class="px-6 py-3 text-lg">Description</th>
                                    <th scope="col" class="px-6 py-3 text-lg">Created_At</th>
                                    <th scope="col" class="px-6 py-3 text-lg">Updated_At</th>
                                    <th scope="col" class="px-6 py-3 text-lg">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="loading">
                                    <th colspan="3">
                                        <IconSkLoading className="w-6 h-6" />
                                    </th>
                                </tr>
                                <template v-else>
                                    <tr v-for="(category, index) in data?.data"
                                        :class="`bg-white ${index == data?.data.length ? '' : 'border-b'} border-gray-200 cursor-pointer hover:bg-gray-100`"
                                        :key="index">
                                        <th scope="row" class="px-6 py-6 font-medium text-gray-800">{{ category?.name }}
                                        </th>
                                        <td class="px-6 py-6">
                                            {{ category?.description }}
                                        </td>
                                        <td class="px-6 py-6">
                                            {{ category?.created_at }}
                                        </td>
                                        <td class="px-6 py-6">
                                            {{ category?.updated_at }}
                                        </td>
                                        <!-- You need to define the 'product' variable or pass it as a prop -->
                                        <td class="">
                                            <ActionButton @edit="handleEdit" @delete="handleDelete"
                                                @detail="handleDetail" />
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <!-- paginate -->
                    </div>
                </template>

                <template v-else>
                    <CreateFormCategory @cancel="handleCancel" /> <!-- Listen for cancel event -->
                </template>
            </div>
            <div class="text-xl text-right font-semibold text-black">Categories and sub-categories</div>
        </div>
    </CategoryView>
</template>
