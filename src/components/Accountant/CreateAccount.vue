<template>
    <div class="container">
        <div v-if="alertMessage" :class="alertClass">{{ alertMessage }}</div>

        <h2>Create Account</h2>
        <form @submit.prevent="createAccount" class="form">
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="accountName">Account Name</label>
                    <input v-model="accountName" type="text" id="accountName" class="form-control" required>
                </div>
                <!-- <div class="col-sm-6 form-group">
                    <label for="accountBalance">Balance</label>
                    <input v-model="accountBalance" type="number" id="accountBalance" class="form-control" required>
                </div> -->
            </div>
         
            <div class="row bt">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 me-9">
                    <button type="button" @click="handleCancel"
                        class="text-[#82868B] bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">CANCEL</button>
                    <button type="submit"
                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">CREATE</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

const accountName = ref('');
// const accountBalance = ref('');
const alertMessage = ref('');
const alertClass = ref('');

const emit = defineEmits(['cancel']);

const handleCancel = () => {
    emit('cancel');
    router.push('/admin/accounts'); // Redirect to the accounts list page or another relevant page
};

const createAccount = async () => {
    try {
        const response = await axios.post('http://localhost:80/api/accounts', {
            name: accountName.value,
            // balance: accountBalance.value
        });

        console.log(response.data);  // Log the response data

        if (response.data.success) {
            alertMessage.value = 'Account created successfully!';
            alertClass.value = 'alert alert-success';
            accountName.value = '';
            // accountBalance.value = '';
            router.push('/admin/accounts');
        } else {
            throw new Error(response.data.message || 'Account creation failed.');
        }
    } catch (error) {
        console.error(error);  // Log the error
        alertMessage.value = error.message;
        alertClass.value = 'alert alert-danger';
    }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

label,
button {
    font-family: "Rubik", sans-serif;
}

.container {
    margin: 0 auto;
}

.form {
    margin-top: 30px;
}

.form-group {
    margin-bottom: 15px;
}

.form-label {
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.type {
    padding-top: 50px;
}

.bt {
    padding-top: 150px;
}

.btn {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
}

.btn:hover {
    background-color: #0056b3;
}

.alert {
    margin-top: 20px;
    padding: 15px;
    border-radius: 4px;
}

.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}
</style>
