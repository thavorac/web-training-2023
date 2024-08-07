<template>
    <div class="container">
        <div v-if="alertMessage" :class="alertClass">{{ alertMessage }}</div>

        <h2>Transfer Balance</h2>
        <form @submit.prevent="transferBalance" class="form">
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="FromaccountName">From Account</label>
                    <select v-model="FromAccountId" id="FromaccountName" class="form-control" required>
                        <option value="" disabled>Select Account</option>
                        <option v-for="account in incomeAndMainAccounts" :key="account.id" :value="account.id">
                            {{ account.name }}
                        </option>
                    </select>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="ToaccountName">To Account</label>
                    <select v-model="ToAccountId" id="ToaccountName" class="form-control" required>
                        <option value="" disabled>Select Account</option>
                        <option v-for="account in incomeAndMainAccounts" :key="account.id" :value="account.id">
                            {{ account.name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="row type">
                <div class="col-sm-6 form-group">
                    <label for="accountBalance">Balance</label>
                    <input v-model="amount" type="number" id="accountBalance" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mt-4">
                    <label for="description" class="mb-1 font-semibold text-xl">Description</label>
                    <textarea v-model="description" id="description" class="form-control border-black shadow-sm w-full h-48"
                              placeholder="Lorem Ipsum Is A Dummy Text"></textarea>
                </div>
            </div>
            <div class="row bt">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 me-9">
                    <button type="button" @click="handleCancel"
                            class="text-[#82868B] bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">CANCEL</button>
                    <button type="submit"
                            class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">TRANSFER</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import {  useRouter } from 'vue-router';

const router = useRouter();

const emit = defineEmits(['cancel']);
const alertMessage = ref('');
const alertClass = ref('');
const accounts = ref([]);
const FromAccountId = ref(null);
const ToAccountId = ref(null);
const amount = ref(0);
const description = ref('');

const handleCancel = () => {
    emit('cancel');
    router.push('/admin/accounts');
};
// const incomeAccounts = computed(() => accounts.value.filter(account=> account.type === 'income'));
const incomeAndMainAccounts = computed(() =>
  accounts.value.filter(account => account.type === 'income' || account.type === 'main')
);

const fetchAccounts = async () => {
    try {
        const response = await axios.get('http://localhost:80/api/accounts');
        accounts.value = response.data;
    } catch (error) {
        console.error('Error fetching accounts:', error);
    }
};


const transferBalance = async () => {
    try {
        const response = await axios.post('http://localhost:80/api/transfer', {
            from_account_id: FromAccountId.value,
            to_account_id: ToAccountId.value,
            balance: amount.value
        });
        alertMessage.value = response.data.message;
        alertClass.value = 'alert alert-success';
        fetchAccounts();
        router.push('/admin/accounts');
    } catch (error) {
        alertMessage.value = error.response.data.message || 'An error occurred';
        alertClass.value = 'alert alert-danger';
    }
};

onMounted(fetchAccounts);
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
    padding-top: 30px;
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
