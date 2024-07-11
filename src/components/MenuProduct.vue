<template>
  <div class="container-fluid">
    <div class="row h-16">
      <div class="container">
        <div class="row mt-2">
          <div class="col-md-2"></div>
          <div class="col-md-8 d-flex justify-between align-items-center mt-2">
            <!-- Check if categories is not null or undefined -->
            <RouterLink to="/showProducts" class="no-underline text-slate-950 hover:text-orange-400">All</RouterLink>
            <a v-for="(category, index) in categories" :key="index"
              class="no-underline text-slate-950 hover:text-orange-400" @mouseover="mouseOver(index)"
              @mouseleave="hidePanel" href="#">
              {{ category.name }}
            </a>
          </div>
          <div class="col-md-2"></div>
        </div>
        <div v-if="isActive" :class="isActiveClass" @mouseleave="hidePanel">
          <template v-if="selectIndex === 0">
            <ListMenu @noHide="noHide" />
          </template>
          <template v-else-if="selectIndex === 1">
            <ListMenu1 @noHide="noHide" />
          </template>
          <template v-else-if="selectIndex === 2">
            <ListMenu2 @noHide="noHide" />
          </template>
          <template v-else-if="selectIndex === 3">
            <ListMenu3 @noHide="noHide" />
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { getCategories } from '../composable/categoryService';
import ListMenu from './ListMenu.vue';
import ListMenu1 from './ListMenu1.vue';
import ListMenu2 from './ListMenu2.vue';
import ListMenu3 from './ListMenu3.vue';
import { RouterLink } from 'vue-router';

export default {
  components: { ListMenu, ListMenu1, ListMenu2, ListMenu3 },
  name: "MenuProduct",
  data() {
    return {
      isActive: false,
      noHideValue: false,
      selectIndex: null,
      categories: [],
      isActiveClass: ''
    };
  },
  async mounted() {
    try {
      this.categories = await getCategories();
    } catch (error) {
      console.error("Failed to load categories", error);
    }
  },
  methods: {
    mouseOver(index) {
      this.selectIndex = index;
      this.isActive = true;
      // Adjust the class dynamically based on the index
      if (index === 0) {
        this.isActiveClass = "z-50 absolute top-56 left-10";
      } else if (index === 1) {
        this.isActiveClass = "z-50 absolute top-56 left-30";
      } else if (index === 2) {
        this.isActiveClass = "z-50 absolute top-56 right-40";
      } else if (index === 3) {
        this.isActiveClass = "z-50 absolute top-56 right-5";
      }
    },
    hidePanel() {
      if (!this.noHideValue) {
        this.isActive = false;
      }
    },
    noHide(value) {
      this.noHideValue = value;
    }
  }
}
</script>

<style scoped>
/* Add scoped styles if needed */
</style>
