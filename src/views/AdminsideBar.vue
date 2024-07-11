<template> 
  <div class="container">
      <div class="sidebar">
          <nav>
              <ul>
                  <li>
                      <a href="#" class="logo">
                          <img src="../assets/image/profile.jpg" alt="">
                          <span class="nav-item">TOUN DINA</span>
                      </a>
                  </li>
                  <li>
                      <RouterLink to="/dashboard">
                          <DashBoardIcon class="icon"/>
                          <span class="nav-item">Dashboard</span>
                      </RouterLink>
                  </li>
                  <li>
                      <a href="#">
                          <ListIcon class="icon"/>
                          <span class="nav-item">Order</span>
                      </a>
                  </li>
                  <li>
                      <a href="#">
                          <CustomerIcon class="icon" />
                          <span class="nav-item">Customer</span>
                      </a>
                  </li>
                  <li>
                      <RouterLink to="/getProducts">
                          <ManagePdIcon class="icon"/>
                          <span class="nav-item">Product</span>
                      </RouterLink>
                  </li>
                  <li>
                    <RouterLink to="/getCategory">
                         <ControlIcon class="icon"/>
                          <span class="nav-item">Category</span>
                    </RouterLink>
                  </li>
                  <li>
                      <a href="#">
                          <SettingIcon class="icon"/>
                          <span class="nav-item">Setting</span>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="logout">
                          <LogOutIcon class="icon"/>
                          <span class="nav-item">Log out</span>
                      </a>
                  </li>
              </ul>
          </nav>
      </div>
      <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
    <div class="flex flex-1 justify-between sm:hidden">
      <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
      <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Showing
          {{ ' ' }}
          <span class="font-medium">1</span>
          {{ ' ' }}
          to
          {{ ' ' }}
          <span class="font-medium">10</span>
          {{ ' ' }}
          of
          {{ ' ' }}
          <span class="font-medium">97</span>
          {{ ' ' }}
          results
        </p>
      </div>
      <div>
        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
          <a href="#" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
            <span class="sr-only">Previous</span>
            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
          </a>
          <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
          <a href="#" aria-current="page" class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">1</a>
          <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">2</a>
          <a href="#" class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">3</a>
          <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
          <a href="#" class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">8</a>
          <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">9</a>
          <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">10</a>
          <a href="#" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
            <span class="sr-only">Next</span>
            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
          </a>
        </nav>
      </div>
    </div>
  </div>
      <!-- <RouterView/> -->
  </div>
</template>

<script setup>

// import ManageProduct from '@/views/ManageProducts.vue';
import { RouterLink} from 'vue-router';
import DashBoardIcon from '@/components/icons/DashBoardIcon.vue';
import ListIcon from '@/components/icons/ListIcon.vue';
import CustomerIcon from '@/components/icons/CustomerIcon.vue';
import ProductIcon from '@/components/icons/ProductIcon.vue';
import ManagePdIcon from '@/components/icons/ManagePdIcon.vue';
import SettingIcon from '@/components/icons/SettingIcon.vue';
import ControlIcon from '@/components/icons/ControlIcon.vue';
import LogOutIcon from '@/components/icons/LogOutIcon.vue'

// import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid'

const items = [
  { id: 1, title: 'Back End Developer', department: 'Engineering', type: 'Full-time', location: 'Remote' },
  { id: 2, title: 'Front End Developer', department: 'Engineering', type: 'Full-time', location: 'Remote' },
  { id: 3, title: 'User Interface Designer', department: 'Design', type: 'Full-time', location: 'Remote' },
]

</script>

<style scoped>
  /* Google Fonts - Poppins */
  * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      /* font-family: "Poppins", sans-serif; */
      border: none;
      text-decoration: none;
      outline: none;
  }

  body {
      background-color: #dfe9f5;
  }

  nav {
      position: absolute;
      top: 0px;
      bottom: 0;
      height: 100%;
      left: 0;
      background-color: #5F85DD;
      width: 80px;
      overflow: hidden;
      transition: width 0.2s linear;
      box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
      z-index: 99999;
  }

  .logo {
      text-align: center;
      display: flex;
      transition: all 0.5s ease;
      margin: 10px 0 0 10px;
  }

  .logo img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
  }

  .logo span {
      
      font-weight: bold;
      padding: 15px;
      font-size: 18px;
      text-transform: uppercase;
  }

  a {
      position: relative;
      color: rgb(85, 83, 83);
      font-size: 17px;
      display: table;
      width: 300px;
      padding: 10px;

  }

  a .icon {
      margin-left: 20px;
     font-weight: bold;
     color: black;
  }

  .fas {
      position: relative;
      width: 70px;
      height: 40px;
      top: 14px;
      font-size: 20px;
      text-align: center;
  }
  .nav-item {
      position: absolute;
      bottom: 10px;
      left: 50px;
      margin-left: 30px;
  }

  a:hover {
      background-color: #eee;
  }

  nav:hover {
      width: 280px;
      transition: all 0.5s, ease;
  }

  .logout {
      position: absolute;
      bottom: 0;
  }
</style>
