<template>
    <div class="w-full">
        <!-- <div class="lg:w-2/3 w-full mx-auto mt-8 overflow-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
                <thead>
                    <tr>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 rounded-tl rounded-bl">Item</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 ">Q</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 ">Item</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 ">Item</th>
                    </tr>
                </thead>

            </table>
        </div> -->
        <div class="lg:w-2/3 w-full mx-auto mt-8">
            <div class="flex flex-wrap -mx-2 mt-8">
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="first_name" class="leading-7 text-sm text-gray-600">First Name</label>
                        <input
                            type="email"
                            id="zip_code"
                            name="zip_code"
                            class="w-full bg-gray-100 rounded border border-gray-300"
                            v-model="customer.zip_code"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="first_name" class="leading-7 text-sm text-gray-600">Last Name</label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            class="w-full bg-gray-100 rounded border border-gray-300"
                            v-model="customer.first_name"
                            :disabled="paymentProcessing"
                        >

                    </div>

                </div>
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="first_name" class="leading-7 text-sm text-gray-600">Email Adress</label>
                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            class="w-full bg-gray-100 rounded border border-gray-300"
                            v-model="customer.last_name"
                            :disabled="paymentProcessing"
                        >

                    </div>

                </div>
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="first_name" class="leading-7 text-sm text-gray-600">Street Adress</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="w-full bg-gray-100 rounded border border-gray-300"
                            v-model="customer.email"
                            :disabled="paymentProcessing"
                        >

                    </div>

                </div>
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="first_name" class="leading-7 text-sm text-gray-600">City</label>
                        <input
                            type="text"
                            id="adress"
                            name="adress"
                            class="w-full bg-gray-100 rounded border border-gray-300"
                            v-model="customer.adress"
                            :disabled="paymentProcessing"
                        >

                    </div>

                </div>
                <div class="p-2 w-1/6">
                    <div class="relative">
                        <label for="first_name" class="leading-7 text-sm text-gray-600">State</label>
                        <input
                            type="text"
                            id="city"
                            name="city"
                            class="w-full bg-gray-100 rounded border border-gray-300"
                            v-model="customer.city"
                            :disabled="paymentProcessing"
                        >

                    </div>

                </div>
                <div class="p-2 w-1/6">
                    <div class="relative">
                        <label for="first_name" class="leading-7 text-sm text-gray-600">Zip Code</label>
                        <input
                            type="text"
                            id="city"
                            name="city"
                            class="w-full bg-gray-100 rounded border border-gray-300"
                            v-model="customer.city"
                            :disabled="paymentProcessing"
                        >

                    </div>

                </div>

            </div>

        </div>

    </div>
</template>
<script>
    export default{
        data(){
            return{
                customer:{
                    first_name: '',
                    last_name: '',
                    email: '',
                    address: '',
                    city: '',
                    state: '',
                    zip_code: '',
                },
                paymentProcessing: false
            }
        }
    }
</script>