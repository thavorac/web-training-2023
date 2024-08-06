<script setup lang="ts">
</script>
<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-3 px-4 max-w-2xl lg:py-16">
            <p class="mb-4 font-semibold text-xl dark:text-white text-[#58AB5D]">Add a new purchase</p>
            <form>
                <div class="pt-1 grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="name" class="block mb-2 font-semibold text-gray-900 dark:text-white">Supplier
                            Name</label>
                        <input type="text" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type supplier name" required>
                    </div>
                    <div class="w-full">
                        <label for="gender"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Gender</label>
                        <select id="gender"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select gender</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="O">Other</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="phone" class="block mb-2 font-semibold text-gray-900 dark:text-white">Telephone
                            Number</label>
                        <input type="number" placeholder="093211943"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="w-full">
                        <label for="email" class="block mb-2 font-semibold text-gray-900 dark:text-white">Email</label>
                        <input type="email" placeholder="sopharongtha13@gmail.com"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="w-full">
                        <label for="category_id"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Product</label>
                        <select id="category_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select product</option>
                            <!-- <option v-for="product in products" :key="product.id" :value="product.id">
                                {{ product.name }}
                            </option> -->
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="company"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Company</label>
                        <input type="text" placeholder="Company A"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="address"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Address</label>
                        <textarea id="address" rows="5"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your address here"></textarea>
                    </div>
                    <div class="w-full">
                        <label for="category_id"
                            class="block mb-2 font-semibold text-gray-900 dark:text-white">Status</label>
                        <select
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select status</option>
                            <option value="completed">Accept</option>
                            <option value="reject">Reject</option>
                            <option value="pending">Pending</option>
                            <option value="delivery">Delivery</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row justify-end mt-5 space-y-2 md:space-y-0 md:space-x-2">
                    <button type="button"
                        class="text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        CANCEL
                    </button>
                    <button type="submit"
                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                        CREATE
                    </button>
                </div>
            </form>

        </div>
    </section>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap');

label,
p,
button {
    font-family: "Rubik", sans-serif;
}
</style>
