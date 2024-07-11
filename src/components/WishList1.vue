<!-- ProductDetail.vue -->
<template>
  <div>
    <div>
      <RouterLink class="no-underline" to="/">
        <MenuHeader />
      </RouterLink>
    </div>
    <div class="categoryHead">
      <CategoriesHead />
    </div>
    <!-- <div class="mb-5">
      <SubHeader>
        <ChevronRight width="5" color="black" class="mt-1" />
      </SubHeader>
    </div> -->

    <section style="background-color: #eee;">
      <div class="icon">
        <RouterLink to="/showProducts">
          <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" strokeWidth={1.5} stroke="green"
            className="size-6">
            <path strokeLinecap="round" strokeLinejoin="round"
              d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
        </RouterLink>

      </div>
      <div class="container justify-center py-1">
        <!-- <h2 class="text-2xl font-bold mb-4">Product Details</h2> -->
        <!-- Product details display -->
        <div v-if="product">
          <div class="bg-white rounded-lg overflow-hidden shadow-md p-4">
            <img :src="`http://localhost/storage/${product.image}`"
              class="object-cover overflow-hidden transform transition-transform duration-500 group-hover:scale-110"
              alt="Product Image">
            <div class="mt-4">
              <h3 class="text-xl font-bold">{{ product.name }}</h3>
              <p class="text-gray-600 mt-2">{{ product.description }}</p>
              <p class="text-gray-800 mt-2">Brand: {{ product.brand }}</p>
              <p class="text-gray-800 mt-2">Price: ${{ product.pricing }}</p>
            </div>
          </div>
        </div>

        <h2 class="text-2xl font-bold mt-8">Wishlist</h2>
        <div class="d-flex flex-wrap">
          <!-- Loop through each product in the wishlist -->
          <div v-for="product in wishlist" :key="product.id" class="flex-grow-1 me-3">
            <div class="card shadow-0 border rounded-3">
              <div class="card-body" style="padding-bottom: 3px;">
                <div class="d-flex flex-wrap">
                  <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                    <!-- Product image -->
                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                      <img :src="`http://localhost/storage/${product.image}`" class="" />
                      <a href="#!">
                        <div class="hover-overlay">
                          <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 mb-2">
                    <!-- Product name and brand -->
                    <h5 style="color: #5E5873;">{{ product.name }}</h5>
                    <span>By <span style="color: #7367F0;">{{ product.brand }}</span></span>
                    <!-- Stars and other details -->
                    <div class="stars">
                      <!-- Assuming there's a slot or component for stars -->
                      <slot></slot>
                    </div>
                    <div class="inStock">
                      {{ text }} <!-- Make sure this is properly bound -->
                    </div>
                    <div class="qty1">
                      <Qty1></Qty1>
                    </div>
                    <!-- Delivery information -->
                    <p class="text mb-4 mb-md-0 mt-2" style="color: #B9B9C3;">
                      Delivery by, Wed Apr 25 <!-- Replace with dynamic date if needed -->
                    </p>
                    <!-- Offer details -->
                    <p style="color: #28C76F;">5% off 1 offers Available</p>
                  </div>
                  <div class="col-12 col-lg-3 border-sm-start-none border-start">
                    <div class="d-flex flex-row align-items-center">
                      <!-- Product pricing -->
                      <h4 class="me-1 mt-3"
                        style="color: #7367F0; font-size: 14px; padding-left: 140px; padding-top: 20px;">
                        ${{ product.pricing }} <!-- Display product pricing -->
                      </h4>
                    </div>
                    <div class="d-flex flex-column justify-content-center mt-2">
                      <!-- Buttons for Wishlist and Add to Cart -->
                      <AddToCardButton @click="removeFromWishlist(product.id)" color="#F8F8F8" text="Wishlist"
                        colorText="#5E5873" width="167px" height="38px" raduis="5px" class="m-auto py-2">
                        <IconRemove class="w-5 h-5" />
                      </AddToCardButton>
                      <AddToCardButton class="addtocard m-auto" color="#7367F0" text="Add To Cart" colorText="#ffffff"
                        width="167px" height="38px" raduis="5px">
                        <ShopOutline />
                      </AddToCardButton>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Placeholder or additional content -->

        </div>
      </div>
    </section>
    <div>
      <SubFooter />
    </div>
    <div class="">
      <Footer></Footer>
    </div>
  </div>
</template>

<script setup>
import { computed, ref, onMounted } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';
import axios from 'axios';

import AddToCardButton from './basic/AddToCardButton.vue';
import IconRemove from './basic/IconRemove.vue';
import ShopOutline from './basic/ShopOutline.vue';
import Qty1 from './basic/Qty1.vue';
import MenuHeader from '../components/MenuHeader.vue';
import CategoriesHead from '../components/CategoriesHead.vue';
import Footer from '../components/Footer.vue';
import SubHeader from '../components/SubHeader.vue';
import ChevronRight from '../components/icons/ChevronRight.vue';
import SubFooter from '../components/SubFooter.vue';

const store = useStore();
const wishlist = computed(() => store.getters.wishlistItems);
const route = useRoute();

const product = ref(null);

const fetchProductDetails = async (productId) => {
  try {
    const response = await axios.get(`http://localhost/api/products/${productId}`);
    product.value = response.data;
  } catch (error) {
    console.error('Error fetching product details:', error);
  }
};

const productId = route.params.id;
onMounted(() => {
  fetchProductDetails(productId);
});

const removeFromWishlist = (productId) => {
  store.dispatch('removeFromWishlist', productId);
};
</script>


<style scoped>
@media (max-width: 767.98px) {
  .border-sm-start-none {
    border-left: none !important;
  }
}

.bg-image {
  width: 310px;
  height: 230px;
  border-radius: 8px 8px 0px 0px;
  margin: 0px;
  padding: 0px;
}

.bg-image img {
  width: 70%;
  margin: 0px;
  padding: 0px;
}



.heart {
  /* margin-left: -40px; */
}

.button2 {
  gap: 10px;
  margin-left: 38px;
  /* padding-top: 20px; */
}

.inStock {
  color: #28C76F;
  font-size: 14px;
  padding-top: 9px;
}

.qty1 {
  margin-top: 10px;
  margin-bottom: -13px;
}

.stars {
  padding-top: 5px;
  margin-left: -3px;
}

.icon {
  width: 50px;
  /* height: 18px; */
  border: 1.5px;
  padding-top: 10px;
  cursor: pointer;
  margin-left: 10px;
  /* fill: red; */
}

.icon svg:hover {
  stroke: rgba(246, 242, 238, 0.951);
  fill: green;
}
</style>
