<script setup lang="ts">
import { ref } from 'vue';
import { useSidebar } from '../composable/sidebar'
import { RouterLink } from 'vue-router';
import ShoppingCard from '../components/icons/ShoppingCard.vue';
import SettingIcon from '@/components/icons/SettingIcon.vue';
import SidebarLink from '@/components/sidebar/SidebarLink.vue';
import ChildSideLink from '@/components/sidebar/ChildSideLink.vue';
import IconBurger from '@/components/icons/IconBurger.vue';
import IconBag from '@/components/icons/IconBag.vue'
import IconControl from '@/components/icons/IconControl.vue';
import IconOrder from '@/components/icons/IconOrder.vue';
import IconPromotion from '@/components/icons/IconPromotion.vue';
const { route } = useSidebar();
const showSide = ref(true);
const sidebars = ref([
    {
        path: "/admin/product",
        title: "Product",
    },
    {
        path: "/admin/category",
        title: "Control",
        children: [
            {
                path: "/admin/category",
                title: "Category"
            },
            {
                path: "/admin/sub-category",
                title: "Sub-Category"
            },
            {
                path: "/admin/banner",
                title: "Banner"
            }


        ]
    },
    {
        path: "/admin/order",
        title: "Order"
    },
    {
        path: "/admin/promotion",
        title: "Promotion"
    },
    {
        path: "/admin/setting",
        title: "Setting"
    }


]);
function toggleEvent() {
    console.log("toggle")
    showSide.value = !showSide.value;
}   
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
</style>

<template>
    <div class="relative w-full h-full flex">
        <button @click="toggleEvent" :class="`absolute transition-all ${showSide ? 'opacity-0 w-0' : 'opacity-100'}`">
            <IconBurger className=" text-gray-400 h-8 w-8" />
        </button>
        <div
            :class="` bg-[#668DE2] fixed z-10 transition-all ${showSide ? 'w-[300px] h-[calc(100vh-0px)] opacity-100' : 'w-0 opacity-0'}  text-gray-700`">
            <ul class="w-full h-full space-y-10">
                <li class="flex pt-4 space-x-4 items-center">
                    <div class=" ps-5">
                        <ShoppingCard :className="'w-12 text-[#4765EA ]'" />
                    </div>
                    <RouterLink to="" class=" w-12 text-black text-2xl font-sans  px-0
                        font-semibold text-center  " @click="toggleEvent">
                        Luminae
                    </RouterLink>
                </li>
                <li class="flex mt-10 flex-col space-y-4 ">
                    <ul v-for="(side, index) in sidebars" :key="index">
                        <SidebarLink :route="route" :link="side.path" :title="side.title">
                            <template v-if="side.path.match('/admin/category')">
                                <IconControl className="w-6 h-6 text-white items-center" />
                            </template>
                            <template v-else-if="side.path.match('/admin/product')">
                                <IconBag className="w-6 h-6 text-white items-center" />
                            </template>
                            <template v-else-if="side.path.match('/admin/order')">
                                <IconOrder className="w-6 h-6 text-white items-center" />
                            </template>
                            <template v-else-if="side.path.match('/admin/setting')">
                                <SettingIcon className="w-6 h-6 text-white items-center" />
                            </template>
                            <template v-else-if="side.path.match('/admin/promotion')">
                                <IconPromotion className="w-6 h-6 text-white items-center" />
                            </template>


                        </SidebarLink>
                        <div :class="` transition-all ${side.children?.length && route.path.match(side.path) ? 'scale-100' : 'scale-0'}`"
                            style="margin-left: 50px; margin-right: 20px">
                            <template v-if="side.children?.length && route.path.match(side.path)">
                                <!-- <div class=" "> -->
                                <div class="bg-[#91B7FF] rounded-md py-2 mt-2">
                                    <ul class="px-10 space-y-4 " v-for="(childSide, index) in side.children"
                                        :key="index">
                                        <div></div>
                                        <ChildSideLink :route="route" :link="childSide.path" :title="childSide.title"
                                            :className="`${index == 0 && index == side.children.length - 1 ? 'rounded-md' : ' rounded-t-md'}`" />
                                    </ul>
                                </div>
                                <!-- </div> -->
                            </template>
                        </div>

                    </ul>
                </li>
            </ul>
        </div>

        <div :class="` transition-all flex flex-col w-full`"
            :style="`${showSide ? 'margin-left:300px' : 'margin-left:0px;'}`">
            <RouterView />
        </div>
    </div>
</template>