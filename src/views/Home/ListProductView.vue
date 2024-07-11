<script setup>
import SaleComponent from '../../components/SaleComponent.vue'
import MenuHeader from '../../components/MenuHeader.vue';
import CategoriesHead from '../../components/CategoriesHead.vue';
import Footer from '../../components/Footer.vue';
import SubHeader from '../../components/SubHeader.vue';
import ChevronRight from '../../components/icons/ChevronRight.vue';
import SubFooter from '../../components/SubFooter.vue';
import AllProduct from './AllProduct.vue';

</script>


<template>

    <div class="electronic">
        <div>
            <RouterLink class="no-underline" to="/">
                <MenuHeader />
            </RouterLink>
        </div>
        <div class="categoryHead">
            <CategoriesHead />
        </div>
        <div class="mb-5">
            <SubHeader>
                <ChevronRight width="5" color="black" class="mt-1" />
            </SubHeader>
        </div>

        <div class="AllProduct">
            <AllProduct />
        </div>
        <!-- copy -->
        <!-- <div class="container grid grid-cols-4 gap-1">
            <SaleComponent v-for="product in data.products" :key="product.id" :product="product" />
        </div> -->

        <div>
            <SubFooter />
        </div>
        <div class="">
            <Footer></Footer>
        </div>
    </div>


</template>

<style scoped>
.AllProduct {
    margin-bottom: 60px;
    margin-top: -15px;
}
</style>
