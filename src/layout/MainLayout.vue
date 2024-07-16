<template>
    <div class="w-screen h-screen flex ">
        <div class="w-[280px] h-[calc(100vh-0px)] text-white " v-show="showSide" style="background-color: #52b8ef;">
            <nav>
                <ul>
                    <li>
                        <a href="#" class="logo">
                            <img src="../assets/image/profile.jpg" alt="">
                            <span class="nav-item">TOUN DINA</span>
                        </a>
                    </li>
                    <li>
                        <RouterLink to="/getProducts">
                            <ManagePdIcon class="icon" />
                            <span class="nav-item">Product</span>
                        </RouterLink>
                    </li>
                    <!-- <li>
                      <RouterLink to="/dashboard">
                          <DashBoardIcon class="icon"/>
                          <span class="nav-item">Dashboard</span>
                      </RouterLink>
                  </li> -->
                    <li>
                        <a href="#">
                            <ListIcon class="icon" />
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
                        <RouterLink to="/getCategory">
                            <ControlIcon class="icon" />
                            <span class="nav-item">Category</span>

                        </RouterLink>
                    </li>
                    <li>
                        <a href="#">
                            <SettingIcon class="icon" />
                            <span class="nav-item">Setting</span>
                        </a>
                    </li>
                    <!-- <li>
                      <a href="#" class="logout">
                          <LogOutIcon class="icon"/>
                          <span class="nav-item">Log out</span>
                      </a>
                  </li> -->
                </ul>
            </nav>
        </div>
        <div class="w-full h-full bg-gray-400">
            <div class="h-[50px] bg-gray-100 flex items-center shadow-sm px-[20px] w-full py-[10px] z-10 border-b">
                <!-- menu -->
                <div class="cursor-pointer w-[30px]" @click="toggleSideBar">
                    <DashBoardIcon />
                    <!-- <div class="float-right">
                        <a href="#" class="logo">
                          <img src="../assets/image/profile.jpg" alt="">
                          <span class="nav-item">TOUN DINA</span>
                      </a>
                 
                    </div>      -->
                </div>
            </div>
            <div class="h-[calc(100vh-50px)] bg-gray-50 p-[20px]">
                <div class="border border-gray-300 rounded-md pe-2 p-[20px] h-full">
                    <RouterView />
                </div>
            </div>
        </div>
        <!-- Side bar -->
        <!-- <div class="w-[400px] h-full bg-gray-200 text-white">
            <div class="h-[50px] bg-gray-900 flex justify-start items-center">
                <div class="px-[20px]">
                    <h3 class="font-bold text-xll">Admin Dashboard</h3>
                </div>
            </div>
            <div class="h-[calc(100vh-50px)] bg-gray-800">
               <div class="px-[20px] flex flex-col space-y-[10px]">
                <RouterLink to="#" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:text-gray-">
                    <DashBoardIcon/>
                    Dashboard
                </RouterLink>
               </div>
            </div>
        </div>
        <div class="w-full h-full bg-gray-400">
            <div class="h-[50px] bg-gray-900">
                Header Sidebar
            </div>
            <div class="h-[calc(100vh-50px)] bg-white"></div>
        </div>
    </div>
    -->


    </div>
    <!-- Main -->
</template>



<script setup>
import { RouterLink, RouterView } from 'vue-router';
import DashBoardIcon from '@/components/icons/DashBoardIcon.vue';
import ListIcon from '@/components/icons/ListIcon.vue';
import CustomerIcon from '@/components/icons/CustomerIcon.vue';
import ProductIcon from '@/components/icons/ProductIcon.vue';
import ManagePdIcon from '@/components/icons/ManagePdIcon.vue';
import SettingIcon from '@/components/icons/SettingIcon.vue';
import ControlIcon from '@/components/icons/ControlIcon.vue';
import LogOutIcon from '@/components/icons/LogOutIcon.vue'

import { ref } from 'vue';

// const showDropDown = ref(false);
const showSide = ref(true);

const toggleSideBar = () => {
    showSide.value = !showSide.value;
};

// export default {
//     data(){
//         return {
//             showDropDown: false,
//             showSide:true
//         }
//     },
//     methods:{
//         toggleSideBar(){
//             this.showSide = !this.showSide
//         }
//     }
// }
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

/* nav {
     
      position: absolute;
      top: 0px;
      bottom: 0;
      height: 100%;
      left: 0;
      background-color: #5F85DD;
      width: 270px;
      overflow: hidden;
      transition: width 0.2s linear;
      box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
      z-index: 99999;
  } */

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
    padding: 13px;

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
    width: 285px;
    border-end-end-radius: 20px;
    background-color: whitesmoke;

}

/* nav:hover {
      width: 280px;
      transition: all 0.5s, ease;
  } */

.logout {
    position: absolute;
    bottom: 0;
}
</style>
