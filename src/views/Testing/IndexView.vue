<template>
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

    <!-- <div class="container-fluid">
       
        <div class="mb-5">
            <wishlist-product />
        </div>
        <div class="mb-5">
            <ProductDetail1 />
        </div>
       

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
// import SaleComponent from '../../components/SaleComponent.vue';
// import WelcomeItem from '../../components/WelcomeItem.vue';
</script>