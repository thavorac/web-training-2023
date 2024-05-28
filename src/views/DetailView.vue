<script setup>

import MenuHeader from '../components/MenuHeader.vue';
import CategoriesHead from '../components/CategoriesHead.vue';
import ProductDetail1 from '../components/ProductDetail1.vue';
import Footer from '../components/Footer.vue';
import SubHeader from '../components/SubHeader.vue';
import SubFooter from '../components/SubFooter.vue';

</script>

<template>
    <div class="electronic">
        <div>
            <MenuHeader />
        </div>
        <div class="categoryHead">
            <CategoriesHead />
        </div>
        <div class="mb-5">
            <SubHeader>
                <ChevronRight />
            </SubHeader>
        </div>
        <div>
            <ProductDetail1 text="In Stock">
                <Share />
            </ProductDetail1>
        </div>
        <div class="mt-5">

        </div>
        <div>
            <SubFooter />
        </div>
        <div class="">
            <Footer></Footer>
        </div>
    </div>

</template>