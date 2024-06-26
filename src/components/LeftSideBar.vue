<script setup>
import search from './basic/search.vue';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import IconsCorrect from '../components/icons/IconsCorrect.vue';

const sizes = [
  { label: '2XS', classes: 'text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-200 dark:focus:ring-blue-800' },
  { label: 'XS', classes: 'text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-200 dark:focus:ring-blue-800' },
  { label: 'S', classes: 'text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-200 dark:focus:ring-blue-800' },
  { label: 'M', classes: 'text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-200 dark:focus:ring-blue-800' },
  { label: 'L', classes: 'text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800' },
  { label: 'XL', classes: 'text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800' },
  { label: '2XL', classes: 'text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800' },
  { label: '3XL', classes: 'text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800' }
];
</script>

<template>
    <div class="container" style="width: 359px; height: 1659px; background-color: skyblue">
        <div class="row">
            <div class="left">
                <!-- icon  -->
                <slot></slot>
                <span>All Categories</span>
                <p>BRAND</p>
            </div>
            <div>
                <p>MODEL</p>
                <Menu as="div" class="relative inline-block text-left">
                <div>
                <MenuButton class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Options
                    <ChevronDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
                </MenuButton>
            </div>
            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
            <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1">
                <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm','no-underline']">Account settings</a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm','no-underline']">Support</a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm ','no-underline']">License</a>
                </MenuItem>
                <form method="POST" action="#">
                    <MenuItem v-slot="{ active }">
                    <button type="submit" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block w-full px-4 py-2 text-left text-sm']">Sign out</button>
                    </MenuItem>
                </form>
                </div>
            </MenuItems>
            </transition>
            </Menu>
          </div>
        </div>
        <div>
            <p>STYLE</p>
            <div class="flex items-center mb-2">
                <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">Default checkbox</label>
            </div>
            <div class="flex items-center mb-2">
                <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">Casual</label>
            </div>
            <div class="flex items-center mb-2">
                <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">Business casual</label>
            </div>
            <div class="flex items-center mb-2">
                <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">Bohemian</label>
            </div>
            <div class="flex items-center mb-2">
                <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">Minimalist</label>
            </div>
            <div class="flex items-center mb-2">
                <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">Uniqlo</label>
            </div>
            <div class="flex items-center mb-2">
                <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">Zara</label>
            </div>
            <div class="flex items-center mb-2">
                <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">Gucci</label>
            </div>
            <div class="flex items-center mb-2">
                <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">Mango</label>
            </div>
            <div class="flex items-center mb-2">
                <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">Ralph Lauren</label>
            </div>
            <div class="flex items-center mb-2">
                <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">Calvin Klein</label>
            </div>
            <div class="flex items-center mb-2">
                <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-3100">Rachel Pally</label>
            </div>
        </div>
        <hr>
       <div class="grid gap-2 grid-cols-6">
            <div class=" relative ">
                <input  id="draft" class=" peer/dra hidden" type="radio" name="status" checked>
                <label for="draft" class="peer-checked/dra:text-sky-500 w-5 h-5  border-0 peer-checked/red:bg-blue-50 border-gray-500 rounded-full cursor-pointer inline-block" style="background-color: red;"></label>
                
                <div class="hidden peer-checked/dra:block absolute inset-0 text-white transition duration-700 ease-in-out">
                    <IconsCorrect/>
                </div>
            </div>
            <div class="relative">
                <input id="radioButton3" class="peer/radioButton3 hidden" type="radio" name="status" >
                <label for="radioButton3" class="peer-checked/radioButton3:text-sky-500  w-5 h-5 border-0 border-gray-500 rounded-full cursor-pointer inline-block" style="background-color: black;"></label>
                <div class="hidden peer-checked/radioButton3:block absolute inset-0 text-white">
                    <IconsCorrect/>
                </div>
            </div>
            <div class="relative">
                <input id="radioButton4" class="peer/radioButton4 hidden" type="radio" name="status">
                <label for="radioButton4" class="peer-checked/radioButton4:text-sky-500  w-5 h-5 border-0 border-gray-500 rounded-full cursor-pointer inline-block" style="background-color: pink;"></label>
                <div class="hidden peer-checked/radioButton4:block absolute inset-0    text-white">
                    <IconsCorrect/>
                </div>
            </div>
            <div class="relative">
                <input type="radio" id="radioButton5" class="peer/radioButton5 hidden" name="status">
                <label for="radioButton5" class="peer-checked/radioButton5:text-sky-500 w-5 h-5 border-0 border-gray-500 rounded-full cursor-pointer inline-block" style="background-color: brown;"></label>
                <div class="hidden peer-checked/radioButton5:block absolute inset-0    text-white">
                    <IconsCorrect/>
                </div>
            </div>
            <div class="relative">
                <input type="radio" id="radioButton6" class="peer/radioButton6 hidden" name="status">
                <label for="radioButton6" class="peer-checked/radioButton6:text-sky-500 w-5 h-5 border-0 border-gray-500 rounded-full cursor-pointer inline-block" style="background-color: green;"></label>
                <div class="hidden peer-checked/radioButton6:block absolute inset-0 text-white">
                    <IconsCorrect/>
                </div>
            </div>
        
            <div class="relative">
                <input type="radio" id="radioButton7" class="peer/radioButton7 hidden" name="status">
                <label for="radioButton7" class="peer-checked/radioButton7:text-sky-500 w-5 h-5 border-0 border-gray-500 rounded-full cursor-pointer inline-block" style="background-color: blue;"></label>
                <div class="hidden peer-checked/radioButton7:block absolute inset-0 text-white">
                    <IconsCorrect/>
                </div>
            </div>
            <div class="relative">
                <input type="radio" id="radioButton8" class="peer/radioButton8 hidden" name="status">
                <label for="radioButton8" class="peer-checked/radioButton8:text-sky-500 w-5 h-5 border-0 border-gray-500 rounded-full cursor-pointer inline-block" style="background-color: black;"></label>
                <div class="hidden peer-checked/radioButton8:block absolute inset-0 text-white">
                    <IconsCorrect/>
                </div>
            </div>
            <div class="relative">
                <input type="radio" id="radioButton9" class="peer/radioButton9 hidden" name="status">
                <label for="radioButton9" class="peer-checked/radioButton9:text-sky-500 w-5 h-5 border-0 border-gray-500 rounded-full cursor-pointer inline-block" style="background-color: yellow;"></label>
                <div class="hidden peer-checked/radioButton9:block absolute inset-0 text-white">
                    <IconsCorrect/>
                </div>
            </div>
            <div class="relative">
                <input type="radio" id="radioButton10" class="peer/radioButton10 hidden" name="status">
                <label for="radioButton10" class="peer-checked/radioButton10:text-sky-500 w-5 h-5 border-0 border-gray-500 rounded-full cursor-pointer inline-block" style="background-color: purple;"></label>
                <div class="hidden peer-checked/radioButton10:block absolute inset-0 text-white">
                    <IconsCorrect/>
                </div>
            </div>
            <div class="relative">
                <input type="radio" id="radioButton11" class="peer/radioButton11 hidden">
                <label for="radioButton11" class="peer-checked/radioButton11:text-sky-500 w-5 h-5 border-0 border-gray-500 rounded-full cursor-pointer inline-block" style="background-color: blue;"></label>
                <div class="hidden peer-checked/radioButton11:block absolute inset-0 text-white">
                    <IconsCorrect/>
                </div>
            </div>
            <div class="relative">
                <input type="radio" id="radioButton12" class="peer/radioButton12 hidden" name="status">
                <label for="radioButton12" class="peer-checked/radioButton12:text-sky-500 w-5 h-5 border-0 border-gray-500 rounded-full cursor-pointer inline-block" style="background-color: gold;"></label>
                <div class="hidden peer-checked/radioButton12:block absolute inset-0 text-white">
                    <IconsCorrect/>
                </div>
            </div>
       </div>
       <div class="grid grid-cols-4 gap-0">
            <button v-for="(size, index) in sizes" :key="index" :class="size.classes">{{ size.label }}</button>
        </div>
        <hr>
    </div>
 
</template>

<style scoped>
#radioButton:checked + label {
  background-color: #DC143C; /* Change this to your desired color */
}
</style>