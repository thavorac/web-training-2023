<script setup lang="ts"></script>


<template>
    <div class="w-full m-0 p-0">
        <div class="grid grid-cols-2 min-h-screen">
            <!-- image side -->
            <div class="bg-blue-600">image</div>
            <!-- login side -->
            <div class="bg-red-500 flex justify-center items-center">
                <div class="w-custom-539 h-custom-667 bg-white font-Poppins rounded-xl">
                    <form action="" class="">
                        <div class="text-custom-21 pt-5 px-3">
                            <p>Welcome to <span class="text-[#779341] font-bold">Supplier</span> </p>
                            <p class="text-custom-55 text-black font-bold font-Poppins ">Log In</p>
                        </div>
                        <div class="flex flex-col mb-3 px-3 gap-y-4">
                            <label class="text-base font-normal font-Poppins text-black " for="">Enter your username
                                or
                                email address</label>
                            <input class="w-2/3 rounded-custom-9" type="text" placeholder="Username or email address">
                        </div>
                        <div class="flex flex-col px-3 gap-y-4">
                            <label class="text-base font-normal font-Poppins text-black " for="">Enter your
                                Password</label>
                            <input class="w-2/3 rounded-custom-9" type="password" placeholder="Password">
                        </div>
                        <div class="mt-52 flex justify-end mr-10">
                            <button
                                class="bg-[#779341] text-base text-white font-medium font-Poppins w-custom-236 h-custom-54 rounded-custom-1">Log
                                In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>