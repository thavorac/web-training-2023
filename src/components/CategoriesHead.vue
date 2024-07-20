<script setup lang="ts">
import { ref } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

import SignIn from '../components/basic/SignIn.vue';
import IconPerson from '../components/icons/IconPerson.vue';
import IconHeart from '../components/icons/IconHeart.vue';
import IconCard from '../components/icons/IconCard.vue';
import IconCategories from '../components/icons/IconCategories.vue';

const store = useStore();
const router = useRouter();
import { useCartStore } from '@/stores/useCartStore';

const data = useCartStore();

// Reactive variables
const isProfileDropdownVisible = ref(false);

// Toggle profile dropdown visibility
const toggleProfileDropdown = () => {
  isProfileDropdownVisible.value = !isProfileDropdownVisible.value;
};

// Getters and state from Vuex
const isAuthenticated = store.getters.isAuthenticated;
const user = store.getters.getUser;

// Logout function
const logoutHandler = () => {
  store.dispatch('logout');
  router.push('/signin'); // Redirect to sign-in page after logout
};
</script>

  <style scoped>
    /* Add your component-specific styles here */
  </style>


<template>
  <div class="container-fluid bg-gray-900 box-border">
      <div class="row">
          <div class="col-md-4 font-bold text-white d-flex" style="font-size: 20px;">
              <!-- path 1 -->
              <div class="row">
                  <div class="col-md-4  d-flex justify-evenly align-items-center ps-5">
                      <SignIn class="gap-2 font-bold" text="Categories">
                          <IconCategories class="mt-1" />
                      </SignIn>
                  </div>
              </div>
              <div class="row d-flex align-items-center">
                  <div>
                      <button 
                          class="text-white focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm ps-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 "
                          type="button">
                          USD
                          <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                              fill="none" viewBox="0 0 10 6">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="m1 1 4 4 4-4" />
                          </svg>
                      </button>                  
                  </div>
              </div>
              <div class="row d-flex align-items-center">
                  <div>
                      <button 
                          class="text-white focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                          type="button">
                          English
                          <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                              fill="none" viewBox="0 0 10 6">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="m1 1 4 4 4-4" />
                          </svg>
                      </button>

                  </div>
              </div>
          </div>
          <div class="col-md-4 border-x-2 text-gray-600">
              <!-- path 2 -->
              <div class="row">
                  <div class="col-md-2 ms-4 p-0 box-border">
                      <img src="../assets/image/Men cosmetic.png" alt="">
                  </div>
                  <div class="col-md-6 m-0 p-0 leading-none box-border ">
                      <p class="pt-2 text-white p-0 mb-2 font-bold">Weekly Men's Toiletries Coupons</p>
                      <p style="color:#C4C4C4 ; font-size: 12px; line-height: 13px;">We extend exclusive discounts
                          to
                          our male clientele
                      </p>
                  </div>
              </div>
          </div>
          <div class="col-md-4 d-flex justify-evenly align-items-center">
              <!-- path 3 -->
              <!-- sign in -->
              <template v-if="isAuthenticated">
              <!-- Display profile and logout when logged in -->
              <div>
                <button id="profileButton" @click="toggleProfileDropdown"
                  class="text-white focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm ps-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  type="button">
                  <IconPerson class="mt-1" />
                  {{ user.first_name }} {{ user.last_name }} <!-- Assuming user has a 'name' property -->   
                </button>

                <!-- Profile dropdown menu -->
                <div v-if="isProfileDropdownVisible" id="profileDropdown"
                  class="z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 absolute">
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="profileButton">
                    <li>
                      <router-link to="/user-profile"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</router-link>
                    </li>
                    <li>
                      <a href="#" @click="logoutHandler"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logout</a>
                    </li>
                  </ul>
                </div>
              </div>
            </template>
            <template v-else>
              <!-- Show sign-in button when not logged in -->
              <router-link class="no-underline" to="/sign-in">
                <SignIn text="Sign in">
                  <IconPerson />
                </SignIn>
              </router-link>
            </template>
              
              <router-link class="no-underline" to="/wishlist-page1">
                  <SignIn text="Favorites">
                      <IconHeart />
                  </SignIn>
              </router-link>
              <RouterLink class="no-underline" to="/cart">
                  <SignIn text="Card">
                      <IconCard />
                      ({{ data.countCartItems }})
                  </SignIn>
              </RouterLink>
          </div>
      </div>
  </div>
</template>

