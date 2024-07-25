<template>
    <div>
      <div class="icon">
        <RouterLink to="/Homepage">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="white"
            viewBox="0 0 24 24"
            strokeWidth="1.5"
            stroke="green"
            class="size-6"
          >
            <title>Back To Home Page</title>
            <path
              strokeLinecap="round"
              strokeLinejoin="round"
              d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
            />
          </svg>
        </RouterLink>
      </div>
      <div class="container mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
          <div
            v-for="(product, index) in promotedProducts"
            :key="index"
            class="item bg-white rounded-lg overflow-hidden shadow-md"
          >
            <div class="pic bg-gray-200 group relative overflow-hidden">
              <img
                :src="`http://localhost/storage/${product.image}`"
                class="object-cover overflow-hidden transform transition-transform duration-500 group-hover:scale-110"
                alt="Product Image"
              />
            </div>
            <div class="content">
              <div class="category">
                <div class="text">
                  <p class="font-bold text-sm text-gray-800">{{ product.name }}</p>
                  <p class="text-xs text-gray-600 mt-1 overflow-hidden text-ellipsis whitespace-nowrap">
                    {{ product.description }}
                  </p>
                </div>
                <div class="icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    @click="goToProductDetail(product.id)"
                    title="click to see product detail"
                    fill="skyblue"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-6"
                  >
                    <title>click to see product detail</title>
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                    />
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                    />
                  </svg>
                </div>
              </div>
              <div class="star flex items-center mt-1">
                <img src="../../assets/image/star.png" alt="Star Rating" />
                <span>{{ product.rate }}</span>
              </div>
              <div>
                <PricingBtn
                  style="margin-top: 8px; margin-left: -10px"
                  :newPriceBtn="`$${product.discounted_price.toFixed(2)}`"
                  :fullPriceBtn="`$${product.pricing.toFixed(2)}`"
                ></PricingBtn>
              </div>
            </div>
            <div class="AddToCardButton flex justify-between">
              <AddToCardButton
                class="cursor-pointer"
                color="#F8F6F8"
                text="Wishlist"
                colorText="#5E5873"
                width="151px"
                height="42px"
                :icon="none"
                raduis="4px 1px 1px 4px"
                @click="addToWishlist(product)"
              >
                <CartIcon />
              </AddToCardButton>
              <AddToCardButton
                class="cursor-pointer"
                color="#7367F0"
                text="Add to cart"
                colorText="#FFFFFF"
                width="151px"
                height="42px"
                :icon="none"
                raduis="1px 4px 4px"
                @click="addToCart(product)"
              >
                <ShopIcon />
              </AddToCardButton>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed, onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  import { useStore } from 'vuex';
  import PricingBtn from '../../components/basic/PricingBtn.vue';
  import AddToCardButton from '../../components/basic/AddToCardButton.vue';
  import ShopIcon from '../../components/basic/ShopIcon.vue';
  import CartIcon from '../../components/basic/CartIcon.vue';
  import PaginationView from '../../views/PaginationView.vue';
  import { RouterLink } from 'vue-router';
  
  const store = useStore();
  const router = useRouter();
  
  const products = ref([]);
  const currentPage = ref(1);
  const totalPages = ref(0);
  
  const getProducts = async () => {
    try {
      const response = await axios.get('http://localhost:80/api/products'); // Adjust the API endpoint as needed
      products.value = response.data;
    } catch (error) {
      console.error('Error fetching products:', error);
    }
  };

  
  // Filter products to only include those with a discount
  const promotedProducts = computed(() => {
    return products.value.filter(product => product.discounted_price < product.pricing);
  });
  
  const goToPage = (page) => {
    currentPage.value = page;
    getProducts(page);
  };
  
  const goToProductDetail = (productId) => {
    router.push({ path: `/product-detail1/${productId}` });
  };
  
  const addToCart = async (product) => {
    try {
      const response = await axios.post('http://localhost/api/cart', {
        product_id: product.id,
        quantity: 1
      });
      console.log('Product added to cart:', response.data);
    } catch (error) {
      console.error('Error adding product to cart:', error);
    }
  };
  
  const addToWishlist = (product) => {
    store.dispatch('addToWishlist', product);
  };
  
  onMounted(() => {
    getProducts();
  });
  </script>
  
  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
  
  * {
    padding: 0px;
    margin: 0px;
    box-sizing: border-box;
  }
  
  .AddToCardButton {
    margin-top: -12px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .icon {
    width: 50px;
    border: 1.5px;
    padding-top: 6px;
    cursor: pointer;
    margin-left: 10px;
  }
  
  .icon svg:hover {
    stroke: rgba(246, 242, 238, 0.951);
    fill: green;
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
    height: 40px;
  }
  
  .item .content .category .text .name {
    font-size: 16px;
    font-weight: 400;
    line-height: 19px;
    font-family: 'Lato', sans-serif;
    color: #6e6b7b;
  }
  
  .item .content .category .text p {
    margin-top: 20px;
    width: 140px;
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
  
  .product-item {
    margin-bottom: 20px;
  }
  
  .price {
    font-size: 18px;
    margin-top: 10px;
  }
  
  .discounted-price {
    color: red;
    font-weight: bold;
    margin-right: 10px;
  }
  
  .original-price {
    text-decoration: line-through;
    color: gray;
  }
  </style>
  