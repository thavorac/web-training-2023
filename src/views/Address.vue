<template>
    <div class="w-full">
        <div class="lg:w-2/3 w-full mx-auto mt-8">
            <div>
                    <h4>Add New Adress</h4>
                    Be sure to check "Deliver to this address" when you have finished
                </div>
            <div class="flex flex-wrap -mx-2 mt-8">
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="full_name" class="leading-7 text-sm text-gray-600">Full Name:</label>
                        <input
                            type="text"
                            id="full_name"
                            name="full_name"
                            class="w-full bg-gray-100 rounded border border-gray-300 py-2"
                            v-model="customer.full_name"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="birth_day" class="leading-7 text-sm text-gray-600">Phone Number:</label>
                        <input
                            type="text"
                            id="birth_day"
                            name="birth_day"
                            class="w-full bg-gray-100 rounded border border-gray-300 py-2"
                            v-model="customer.birth_day"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="email_address" class="leading-7 text-sm text-gray-600">Email Address:</label>
                        <input
                            type="email"
                            id="email_address"
                            name="email_address"
                            class="w-full bg-gray-100 rounded border border-gray-300 py-2"
                            v-model="customer.email_address"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="flat_house_no" class="leading-7 text-sm text-gray-600">Flat, House No:</label>
                        <input
                            type="text"
                            id="flat_house_no"
                            name="flat_house_no"
                            class="w-full bg-gray-100 rounded border border-gray-300 py-2"
                            v-model="customer.flat_house_no"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="landmark" class="leading-7 text-sm text-gray-600">Landmark (e.g. near Boeung Baitong Market):</label>
                        <input
                            type="text"
                            id="landmark"
                            name="landmark"
                            class="w-full bg-gray-100 rounded border border-gray-300 py-2"
                            v-model="customer.landmark"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2 w-1/6">
                    <div class="relative">
                        <label for="town_city" class="leading-7 text-sm text-gray-600">Town/City:</label>
                        <input
                            type="text"
                            id="town_city"
                            name="town_city"
                            class="w-full bg-gray-100 rounded border border-gray-300 py-2"
                            v-model="customer.town_city"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2 w-1/6">
                    <div class="relative">
                        <label for="address_type" class="leading-7 text-sm text-gray-600">Address Type:</label>
                        <input
                            type="text"
                            id="address_type"
                            name="address_type"
                            class="w-full bg-gray-100 rounded border border-gray-300 py-2"
                            v-model="customer.address_type"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2 ">
                    <button 
                        class=" bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" 
                        :disabled="paymentProcessing"
                        @click="saveAddress"
                    >
                        Save Address
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                customer: {
                    full_name: '',
                    birth_day: '',
                    email_address: '',
                    flat_house_no: '',
                    landmark: '',
                    town_city: '',
                    address_type: ''
                },
                paymentProcessing: false
            }
        },
        methods: {
            saveAddress() {
                // Add logic to save address here
                console.log('Address saved:', this.customer);
            }
        }
    }
</script>

<style scoped>
    .w-full {
        max-width: 1500px;
    }
</style>
