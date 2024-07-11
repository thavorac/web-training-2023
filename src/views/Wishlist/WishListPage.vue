<template>

    <div class="container-fluid">
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


        <div class="mb-1">

            <wishlist-product />
        </div>
    </div>

    <div>
        <SubFooter />
    </div>
    <div class="">
        <Footer></Footer>
    </div>


</template>

<script setup lang="ts">
// import SearchButton from '@/components/basic/SearchButton.vue';
import WishlistProduct from '../../components/WishlistProduct.vue';
import MenuHeader from '../../components/MenuHeader.vue';
import CategoriesHead from '../../components/CategoriesHead.vue';
import Footer from '../../components/Footer.vue';
import SubHeader from '../../components/SubHeader.vue';
import ChevronRight from '../../components/icons/ChevronRight.vue';
import SubFooter from '../../components/SubFooter.vue';
</script>