<script setup></script>

<template>
    <div style="width: 989px; height: 515px; border-color: #939393;" class="border shadow-md shadow-[#939393] p-5">
        <form class="ms-3" action="">
            <div class="mb-3">
                <label for="" class="mb-3 font-semibold text-xl">Category's Name</label>
                <input type="text" class="form-control border-black shadow-sm" placeholder="men" style="width: 556px;">
            </div>
            <div class="mt-4">
                <p><label for="" class="mb-1 font-semibold text-xl">Description</label></p>
                <textarea class="form-control border-black shadow-sm" placeholder="Lorem Ipsum Is A Dummy Text"
                    style="width: 556px; height: 180px;"></textarea>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 me-9">
                <button type="button"
                    class="text-[#82868B] bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">CANCEL</button>
                <button type="button"
                    class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">UPDATE</button>
                <!-- <button class="w-32 bg-[#7367F0] font-medium font-sm rounded-lg text-white">CREATE</button> -->
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