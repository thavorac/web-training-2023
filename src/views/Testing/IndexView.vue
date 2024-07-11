<template>
    <div>

        <div date-rangepicker class="flex items-center">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input name="start" type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date start">
            </div>
            <span class="mx-4 text-gray-500">to</span>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input name="end" type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date end">
            </div>
        </div>

    </div>
    <div class="mt-5">
        <CreateFormBanner />
    </div>
    <div class="mt-5">
        <CreateSubCategory />
    </div>
    <div class="m-5">
        <CreateFormProduct />
    </div>
    <div class="m-5">
        <CreateFormCategory />
    </div>
    <div class="m-5">
        <UpdateFormCategory />
    </div>
    <div class="mt-5">
        <AdminProfile />
    </div>

    <!-- <div class="mb-5">
        <wishlist-product />
    </div> -->

    <WishList1 />
    <!-- <div class="mb-5">
        <ProductDetail1 />
    </div> -->



</template>

<script setup lang="ts">
// import SearchButton from '@/components/basic/SearchButton.vue';
// import WishlistProduct from '../../components/WishlistProduct.vue';
// import ProductDetail1 from '../../components/ProductDetail1.vue';
import CreateFormCategory from '../../components/Category/CreateFormCategory.vue'
import CreateSubCategory from '../../components/Category/CreateSubCategory.vue';
import CreateFormProduct from '@/components/Product/CreateFormProduct.vue';
import UpdateFormCategory from '@/components/Category/UpdateFormCategory.vue';
import AdminProfile from '@/components/AdminProfile/AdminProfile.vue';
import CreateFormBanner from '@/components/Banner/CreateFormBanner.vue'
import WishList1 from '@/components/WishList1.vue'
// import SaleComponent from '../../components/SaleComponent.vue';
// import WelcomeItem from '../../components/WelcomeItem.vue';
</script>