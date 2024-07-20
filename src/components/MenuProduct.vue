<template>
  <div class="container-fluid rounded shadow-sm">
    <div class="row h-16">
      <div class="container">
        <div class="row mt-2">
          <div class="col-md-2"></div>
          <div class="col-md-8 d-flex justify-between align-items-center mt-2">
            <!-- All products link -->
            <RouterLink to="/showProducts" class="no-underline text-slate-950 hover:text-orange-400"
              :class="{ 'active-link': activeCategory === null }">
              All
            </RouterLink>

            <!-- Category links -->
            <RouterLink v-for="(category, index) in categories" :key="category.id"
              :to="{ name: 'CategoryProducts', params: { categoryId: category.id } }"
              class="no-underline text-slate-950 hover:text-orange-400"
              :class="{ 'active-link': activeCategory === category.id }" @click="setActiveCategory(category.id)">
              {{ category.name }}
            </RouterLink>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { getCategories } from '../composable/categoryService';
import { RouterLink, useRouter } from 'vue-router';

export default {
  name: "MenuProduct",
  components: {
    RouterLink
  },
  setup() {
    const router = useRouter();
    const categories = ref([]);
    const activeCategory = ref(null);

    // Fetch categories on component mount
    onMounted(async () => {
      try {
        categories.value = await getCategories();
      } catch (error) {
        console.error("Failed to load categories", error);
      }
    });

    // Function to set active category and navigate
    const setActiveCategory = (categoryId) => {
      activeCategory.value = categoryId;
    };

    // Function to navigate to product detail page
    const goToProductDetail = (productId) => {
      router.push({ path: `/product-detail1/${productId}` });
    };

    // Function to add a product to the wishlist
    const addToWishlist = (product) => {
      // Assuming store is available globally or injected
      store.dispatch('addToWishlist', product);
    };

    return {
      categories,
      activeCategory,
      setActiveCategory,
      goToProductDetail,
      addToWishlist
    };
  }
};
</script>

<style scoped>
/* Optional: Define active-link style for active category */
.active-link {
  font-weight: bold;
  color: orange;
  /* Example color for active link */
}
</style>
