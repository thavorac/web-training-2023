<template>
    <div>
        <!-- <h1>Products in Category: {{ categoryName }}</h1> -->
        <div v-if="loading">Loading...</div>
        <div v-else-if="error">{{ error }}</div>
        <div v-else>
            <div v-if="products.length === 0">No products found.</div>
            <div class="container-fluid">
                <div class="container mx-auto">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div v-for="(product, index) in products" :key="index"
                            class="item bg-white rounded-lg overflow-hidden shadow-md">
                            <div class="pic bg-gray-200 group relative overflow-hidden">
                                <img :src="`http://localhost/storage/${product.image}`"
                                    class="object-cover overflow-hidden transform transition-transform duration-500 group-hover:scale-110"
                                    alt="Product Image" />
                            </div>
                            <div class="content">
                                <div class="category">
                                    <div class="text">
                                        <p class="font-bold text-sm text-gray-800">{{ product.name }}</p>
                                        <p
                                            class="text-xs text-gray-600 mt-1 overflow-hidden text-ellipsis whitespace-nowrap">
                                            {{ product.description }}
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" @click="goToProductDetail(product.id)"
                                            title="click to see product detail" fill="skyblue" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <title>click to see product detail</title>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="star flex items-center mt-1">
                                    <img src="../../assets/image/star.png" alt="Star Rating" />
                                    <span>{{ product.rate }}</span>
                                </div>
                                <div>
                                    <PricingBtn style="margin-top: 8px; margin-left: -10px;" discountBtn="-10%"
                                        :newPriceBtn="`$${product.pricing}`" fullPriceBtn="$290" />
                                </div>
                            </div>
                            <div class="AddToCardButton flex justify-between" @click="addToWishlist(product)">
                                <AddToCardButton class="cursor-pointer" color="#F8F6F8" text="Wishlist"
                                    colorText="#5E5873" width="151px" height="42px" :icon="none"
                                    raduis="4px 1px 1px 4px">
                                    <CartIcon />
                                </AddToCardButton>
                                <AddToCardButton class="cursor-pointer" @click="addToCart(product)" color="#7367F0"
                                    text="Add to cart" colorText="#FFFFFF" width="151px" height="42px" :icon="none"
                                    raduis="1px 4px 4px">
                                    <ShopIcon />
                                </AddToCardButton>
                            </div>
                        </div>
                    </div>

                    <div class="float-end pe-4">
                        <PaginationView :totalPages="totalPages" :currentPage="currentPage" @goToPage="goToPage" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch, } from 'vue';
import { useRoute } from 'vue-router';
import { getProductsByCategoryId } from '../../composable/productService';
import PricingBtn from '../../components/basic/PricingBtn.vue';
import AddToCardButton from '../../components/basic/AddToCardButton.vue';
import ShopIcon from '../../components/basic/ShopIcon.vue';
import CartIcon from '../../components/basic/CartIcon.vue';
import PaginationView from '../../views/PaginationView.vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';


const store = useStore();
const router = useRouter();

const route = useRoute();
const categoryId = ref(route.params.categoryId);
const categoryName = ref('');
const products = ref([]);
const loading = ref(true);
const error = ref(null);
const totalPages = ref(0);
const currentPage = ref(1);


const fetchProducts = async (categoryId) => {
    loading.value = true;
    error.value = null;
    try {
        const response = await getProductsByCategoryId(categoryId);
        console.log('API response:', response);
        if (response && Array.isArray(response.data)) {
            products.value = response.data;
            categoryName.value = response.categoryName || 'Unknown Category';
        } else {
            products.value = [];
            categoryName.value = 'Unknown Category';
        }
    } catch (err) {
        console.error('Failed to load products', err);
        error.value = 'Failed to load products';
        products.value = [];
    } finally {
        loading.value = false;
    }
};


watch(
    () => route.params.categoryId,
    (newCategoryId) => {
        fetchProducts(newCategoryId);
    },
    { immediate: true }
);

onMounted(() => {
    fetchProducts(categoryId.value);
});

// Function to navigate to product detail page
const goToProductDetail = (productId) => {
    router.push({ path: `/product-detail1/${productId}` });
};

// Function to add a product to the wishlist
const addToWishlist = (product) => {
    store.dispatch('addToWishlist', product);
};

const addToCart = (product) => {
    console.log(`Adding product to cart: ${product.name}`);
};

const goToPage = (page) => {
    console.log(`Navigating to page: ${page}`);
    currentPage.value = page;
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

* {
    padding: 0px;
    margin: 0px;
    box-sizing: border-box;
}

.product-item {
    border: 1px solid #ddd;
    padding: 16px;
    margin-bottom: 16px;
}

.AddToCardButton {
    margin-top: -12px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.item {
    width: 320px;
    height: 440px;
    box-shadow: 0px 0px 12px 0px #56565665;
    margin-left: 20px;
    margin-top: 10px;
    border-radius: 9px;
}

.item .pic {
    width: 320px;
    height: 250px;
    border-radius: 8px 8px 0px 0px;
}

.item .pic img {
    width: 100%;
    height: 100%;
}

.item .content {
    width: 300px;
    height: 153px;
    padding: 20px;
    gap: 12px;
    color: #ffffff;
}

.item .content .category {
    width: 260px;
    height: 44px;
    gap: 80px;
    display: flex;
}

.item .content .category .text {
    width: 160px;
    height: 44px;
    gap: 4px;
}

.item .content .category .text .f-text {
    width: 38px;
    height: 20px;
    font-size: 20px;
    font-weight: 600;
    color: #5e5873;
    font-family: 'Lato', sans-serif;
}

.item .content .category .text .s-text {
    width: 160px;
    margin-top: 4px;
    height: 20px;
    font-size: 14px;
    font-weight: 400;
    line-height: 25px;
    font-family: 'Lato', sans-serif;
    color: #6e6b7b;
}

.item .content .category .icon {
    width: 20px;
    height: 18px;
    border: 1.5px;
    padding-top: 10px;
    cursor: pointer;
    display: inline-block;
    transition: transform 0.3s ease;
}

.item .content .category .icon svg:hover {
    fill: rgba(243, 174, 77, 0.804);
}

.item .content .star {
    width: 260px;
    height: 25px;
    gap: 12px;
    position: relative;
    line-height: 25px;
}

.item .content .star .img {
    width: 120px;
    height: 24px;
}

.item.content .star span {
    width: 29px;
    height: 25px;
    font-size: 12px;
    font-weight: 400;
    line-height: 25px;
    text-align: center;
    color: #555555;
}

.icon {
    width: 20px;
    height: 18px;
    border: 1.5px;
    padding-top: 10px;
    cursor: pointer;
    display: inline-block;
    /* Ensures the div takes the size of the SVG */
    transition: transform 0.3s ease;
    /* Smooth transition for scaling */
}

.icon svg:hover {
    fill: rgba(243, 174, 77, 0.804);

}
</style>