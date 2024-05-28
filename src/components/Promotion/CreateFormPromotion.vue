<script setup>
import { defineEmits } from 'vue';

const emit = defineEmits(['cancel']);

const handleCancel = () => {
    emit('cancel');
};
</script>

<template>
    <div class="flex p-3">
        <form class="ms-3" action="">
            <div>
                <div class="row d-flex justify-between">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="" class="mb-2 font-semibold text-xl">Product Name</label>
                            <input type="text" class="form-control border-1" placeholder="Lorem Ipsum"
                                style="width: 556px; border-color: #232321;">
                        </div>
                        <div class="mt-1">
                            <p><label for="" class="mb-0 font-semibold text-xl">Description</label></p>
                            <textarea class="form-control" placeholder="Lorem Ipsum Is A Dummy Text"
                                style="width: 556px; height: 180px;  border-color: #232321;"></textarea>
                        </div>
                        <div class="mt-3">
                            <label for="" class="mb-2 font-semibold text-xl">Category</label>
                            <select class="form-control" style="width: 556px;  border-color: #232321;">
                                <option value="#">Choose Category</option>
                                <option value="">Man</option>
                                <option value="">Women</option>
                                <option value="">Cosmetics</option>
                                <option value="">Shoe & Bag</option>
                                <option value="">Electronic</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="" class="mb-2 font-semibold text-xl">Brand Name</label>
                            <input type="text" class="form-control " placeholder="Tonny Black"
                                style="width: 556px;  border-color: #232321;">
                        </div>
                        <div class=" mt-3 d-flex gap-4">
                            <div class="mt-2">
                                <label for="" class="mb-1 font-semibold text-xl">SKU</label>
                                <input type="text" class="form-control " placeholder="#32A53"
                                    style="width: 266px;  border-color: #232321;">
                            </div>
                            <div class="mt-2">
                                <label for="" class="mb-1 font-semibold text-xl">Stock Quantity</label>
                                <input type="text" class="form-control " style="width: 266px;  border-color: #232321;"
                                    placeholder="211">
                            </div>
                        </div>
                        <div class=" mt-3 d-flex gap-4">
                            <div class="mt-2">
                                <label for="" class="mb-1 font-semibold text-xl">Regular Price</label>
                                <input type="text" class="form-control " placeholder="$110.40"
                                    style="width: 266px;  border-color: #232321;">
                            </div>
                            <div class="mt-2">
                                <label for="" class="mb-1 font-semibold text-xl">Sale Price</label>
                                <input type="text" class="form-control " style="width: 266px;  border-color: #232321;"
                                    placeholder="$450">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div
                            style="width: 400px; height: 328px; border-radius: 8px; background-color:#cccccc; border-width: 1px; border-color: #232321 ;">

                        </div>
                        <label for="" class="mt-4 font-semibold text-xl">Product Name</label>
                        <div class="flex items-center justify-center w-full mt-4">

                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                                style="width: 457px; height: 164px;">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" aria-hidden="true">
                                    <svg class="w-12 h-12 mb-4 text-gray-500 dark:text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="#003F62">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>

                                    <!-- <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg> -->
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                        800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" />
                            </label>
                        </div>

                        <!-- File Uploading Progress Form -->
                        <div class="flex flex-col bg-gray-50 border-t  rounded-xl mt-4 ">
                            <!-- Body -->
                            <div class="">
                                <div>
                                    <!-- Uploading File Content -->
                                    <div class="mb-0 flex justify-between items-center">
                                        <div class="flex items-center gap-x-1">
                                            <span
                                                class="size-8 flex justify-center items-center border border-gray-200 text-gray-500 rounded-lg">
                                                <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                    <polyline points="17 8 12 3 7 8"></polyline>
                                                    <line x1="12" x2="12" y1="3" y2="15"></line>
                                                </svg>
                                            </span>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">preline-ui.html</p>
                                                <p class="text-xs text-gray-500">7 KB</p>
                                            </div>
                                        </div>
                                        <div class="inline-flex items-center gap-x-2">
                                            <svg class="flex-shrink-0 size-4 text-teal-500"
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
                                                </path>
                                            </svg>
                                            <a class="text-gray-500 hover:text-gray-800" href="#">
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M3 6h18"></path>
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                    <line x1="10" x2="10" y1="11" y2="17"></line>
                                                    <line x1="14" x2="14" y1="11" y2="17"></line>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End Uploading File Content -->

                                    <!-- Progress Bar -->
                                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden"
                                        role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-teal-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                                            style="width: 100%"></div>
                                    </div>
                                    <!-- End Progress Bar -->
                                </div>
                            </div>
                            <!-- End Body -->

                        </div>
                        <!-- End File Uploading Progress Form -->
                        <div>
                            <!-- Uploading File Content -->
                            <div class="flex flex-col bg-gray-50 border-t  rounded-xl mt-3 ">
                                <div class="flex justify-between">

                                    <div class="flex  items-center gap-x-3">
                                        <span
                                            class="size-8 flex justify-center items-center border border-gray-200 text-gray-500 rounded-lg">
                                            <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" x2="12" y1="3" y2="15"></line>
                                            </svg>
                                        </span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">preline-ui.mp4</p>
                                            <p class="text-xs text-gray-500">105.5 MB</p>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-center gap-x-2">
                                        <a class="text-gray-500 hover:text-gray-800" href="#">
                                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <rect width="4" height="16" x="6" y="4"></rect>
                                                <rect width="4" height="16" x="14" y="4"></rect>
                                            </svg>
                                        </a>
                                        <a class="text-gray-500 hover:text-gray-800" href="#">
                                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M3 6h18"></path>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                <line x1="10" x2="10" y1="11" y2="17"></line>
                                                <line x1="14" x2="14" y1="11" y2="17"></line>
                                            </svg>
                                        </a>
                                    </div>

                                </div>
                                <!-- Progress Bar -->
                                <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden" role="progressbar"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition duration-500"
                                        style="width: 25%"></div>
                                </div>
                                <!-- End Progress Bar -->
                            </div>
                            <!-- End Uploading File Content -->


                        </div>


                    </div>
                </div>
                <div class="row mt-5">
                    <hr>
                </div>
                <div class="row">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 me-9">
                        <button type="button" @click="handleCancel()"
                            class="text-[#82868B] bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">CANCEL</button>
                        <button type="button"
                            class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">CREATE</button>
                        <!-- <button class="w-32 bg-[#7367F0] font-medium font-sm rounded-lg text-white">CREATE</button> -->
                    </div>
                </div>
            </div>
        </form>

    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

label,
button {
    font-family: "Rubik", sans-serif;
}
</style>