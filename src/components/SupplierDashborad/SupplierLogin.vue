<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import axios from 'axios';

const supplier = ref({
    email: '',
    password: ''
});

const router = useRouter();
const store = useStore();

const loginSupplier = async () => {
    try {
        const { data } = await axios.post('http://localhost:80/api/suppliers/login', supplier.value);
        console.log('Response Data:', data);

        if (data.message === 'Login successful') {
            console.log('Login Successful, redirecting...');
            // Update Vuex store
            store.dispatch('login', { supplier: data.supplier, token: data.token });
            console.log('data', data);

            // Redirect to supplier dashboard

            let nav = await router.replace({ name: 'SupplierLayout', });
            console.log('nav', nav)
        } else {
            alert(data.message); // Show error message
        }
    } catch (error) {
        console.error('Error while logging in:', error);
        alert('Error, please try again'); // Show error message
    }
};
</script>

<template>
    <div class="w-full m-0 p-0">
        <div class="grid grid-cols-2 min-h-screen bg-image">
            <!-- Background Image Side -->
            <div class=""></div>

            <!-- Login Side -->
            <div class="flex justify-center items-center">
                <div class="w-1/2 h-custom-667 bg-white font-Poppins rounded-xl opacity-2">
                    <form @submit.prevent="loginSupplier">
                        <div class="text-custom-21 pt-4 px-3">
                            <p>Welcome to <span class="text-[#779341] font-bold">Supplier</span> </p>
                            <p class="text-5xl font-extrabold mb-5 text-green-800">Log In</p>
                        </div>
                        <div class="flex flex-col mb-3 px-3 gap-y-5">
                            <label class="text-base font-normal font-Poppins text-black" for="email">
                                Enter your username or email address
                            </label>
                            <input v-model="supplier.email" id="email" class="w-full rounded-custom-9" type="text"
                                placeholder="Username or email address">
                        </div>
                        <div class="flex flex-col px-3 gap-y-5">
                            <label class="text-base font-normal font-Poppins text-black" for="password">
                                Enter your Password
                            </label>
                            <input v-model="supplier.password" id="password" class="w-full rounded-custom-9"
                                type="password" placeholder="Password">
                        </div>
                        <div class="mt-28 flex justify-end mr-4">
                            <button type="submit"
                                class="bg-[#779341] text-lg hover:bg-green-700 text-white font-medium w-custom-236 h-custom-54 rounded-custom-1">
                                Log In
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
body {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

.bg-image {
    background-image: url("https://img.freepik.com/premium-photo/logistic-network-distribution-background-logistic-transport-concept_250469-9178.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: left;
    width: 100%;
    height: 100vh;
}
</style>
