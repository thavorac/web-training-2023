<script setup>
import SaleComponent from '../../components/SaleComponent.vue'
// import MenuHeader from '../../components/MenuHeader.vue';
// import CategoriesHead from '../../components/CategoriesHead.vue';
// import Footer from '../../components/Footer.vue';
// import SubHeader from '../../components/SubHeader.vue';
// import ChevronRight from '../../components/icons/ChevronRight.vue';
// import SubFooter from '../../components/SubFooter.vue';
import AllProduct from './AllProduct.vue';

</script>

<template>
    <div class="electronic relative">
        <!-- Fixed Header -->
        <!-- <div class="fixed top-0 left-0 right-0 bg-white z-50">
            <div>
                <RouterLink class="no-underline" to="/">
                    <MenuHeader />
                </RouterLink>
            </div>
            <div class="categoryHead">
                <CategoriesHead />
            </div>

        </div> -->

        <!-- Spacer to push content below fixed header -->
        <!-- <div class="pt-20"></div> -->

        <!-- Main Content -->
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

        <!-- SubFooter and Footer -->
        <!-- <div>
            <SubFooter />
        </div>
        <div>
            <Footer></Footer>
        </div> -->
    </div>
</template>

<style scoped>
.AllProduct {
    margin-bottom: 60px;
    margin-top: -80px;
}

/* Ensure the fixed header has a background color to cover content underneath */
.fixed {
    background-color: white;
}

/* Additional spacing for the header */
.pt-20 {
    padding-top: 5rem;
    /* Adjust this value to match the height of the fixed header */
}
</style>
