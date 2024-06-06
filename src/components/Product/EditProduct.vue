<script setup lang="ts">
import { useRouter } from 'vue-router';
const emit = defineEmits(['cancel']);
const router = useRouter();

const handleCancel = () => {
    router.push('/admin');
};

</script>
<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-3  px-4 max-w-2xl lg:py-16">
            <p class="mb-4 font-semibold text-xl dark:text-white text-[#58AB5D]">Edit Product</p>
            <form action="">
                <div class="pt-1 grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 font-semibold text-gray-900 dark:text-white">Product
                            Name</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name" required="">
                    </div>
                    <div class="w-full">
                        <label for="brand" class="block mb-2 font-semibold text-gray-900 dark:text-white">Brand</label>
                        <select id="brand"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Select brand</option>
                            <option value="AP">Apple</option>
                            <option value="SM">Samsung</option>
                            <option value="SN">Sony</option>
                            <option value="NK">Nike</option>
                            <option value="AD">Adidas</option>
                            <option value="SR">Sara</option>
                            <option value="NV">Nivea</option>
                            <option value="DV">Dove</option>
                            <option value="CN">Chanel</option>
                            <option value="RB">Rebok</option>
                            <option value="PM">Puma</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="price" class="block mb-2  font-semibold text-gray-900 dark:text-white">Price</label>
                        <input type="number" name="price" id="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="$2999" required="">
                    </div>
                    <div>
                        <label for="category"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Category</label>
                        <select id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Select category</option>
                            <option value="TV">TV/Monitors</option>
                            <option value="PC">PC</option>
                            <option value="GA">Gaming/Console</option>
                            <option value="PH">Phones</option>
                        </select>
                    </div>

                    <div>
                        <label for="size" class="block mb-2 font-semibold text-gray-900 dark:text-white">Size</label>
                        <select id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Select size</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">

                        <label class="block mb-2 font-semibold text-gray-900 dark:text-white"
                            for="multiple_files">Upload multiple files</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="multiple_files" type="file" multiple>

                    </div>
                    <!-- <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" rows="8"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your description here"></textarea>
                    </div> -->
                </div>
                <div class="flex flex-col md:flex-row justify-end mt-5 space-y-2 md:space-y-0 md:space-x-2">
                    <button type="button" @click="handleCancel"
                        class="text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        CANCEL</button>
                    <button type="button" @click="createCategory"
                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">CREATE</button>
                </div>
            </form>
        </div>
    </section>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

label,
button {
    font-family: "Rubik", sans-serif;
}
</style>