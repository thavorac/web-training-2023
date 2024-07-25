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

const loading = ref(true);

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
                <RouterLink to="/admin/purchase/create"
                    class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
                    <IconsCirclePlus className="w-10 h-10" stroke="2.0" />
                    <span class="text-xl font-semibold"> Purchase History</span>
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
                        <th scope="col" class="px-6 py-3 text-lg font-sans">Purchase ID</th>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">Product Name</th>
                        <th scope="col" class="px-6 py-3 text-lg font-sans">Supplier Name</th>
                        <th scope="col" class="px-6 py-3 text-lg">Qty</th>
                        <th scope="col" class="px-6 py-3 text-lg">Total Price</th>
                        <th scope="col" class="px-6 py-3 text-lg">Status</th>
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
                            <td class="px-6 py-6">{{ supplier.company }}</td>
                            <td class="px-6 py-6">{{ supplier.phone }}</td>
                            <td class="px-6 py-6 truncate-cell">{{ supplier.item }}</td>
                            <td class="px-6 py-6">{{ supplier.address }}</td>
                            <td :class="{
                                'px-6 py-6 text-center': true,
                                'text-orange-800': supplier?.status === 'pending',
                                ' text-teal-800': supplier?.status === 'completed',
                                ' text-red-800': supplier?.status === 'reject',
                                'bg-blue-200 text-blue-800': supplier?.status === 'delivery'
                            }">
                                {{ supplier?.status }}
                            </td>
                            <td class="px-6 py-6 flex space-x-2">
                                <IconEdit class="w-6 h-6 text-blue-500 cursor-pointer" />
                                <IconDelete class="w-6 h-6 text-red-500 cursor-pointer" />
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
