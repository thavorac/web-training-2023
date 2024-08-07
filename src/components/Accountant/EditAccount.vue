<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();
const accountId = ref<number | null>(null);

const accountName = ref<string>('');
const accountBalance = ref<string>('');
const selectedType = ref<string>('');
const alertMessage = ref<string>('');
const alertClass = ref<string>('');

const emit = defineEmits(['cancel']);

const handleCancel = () => {
    emit('cancel');
    router.push('/admin/accounts'); // Redirect to the accounts list page or another relevant page
};

const fetchAccount = async () => {
    if (accountId.value === null) {
        console.error('Account ID is null');
        alertMessage.value = 'Invalid account ID.';
        alertClass.value = 'alert alert-danger';
        return;
    }

    try {
        const response = await axios.get(`http://localhost:80/api/accounts/${accountId.value}`);
        const account = response.data;

        accountName.value = account.name;
        accountBalance.value = account.balance;
        selectedType.value = account.type;
    } catch (error) {
        console.error('Error fetching account details:', error);
        alertMessage.value = 'Failed to load account details. Please check the console for more details.';
        alertClass.value = 'alert alert-danger';
    }
};

const editAccount = async () => {
    if (accountId.value === null) {
        console.error('Account ID is null');
        alertMessage.value = 'Invalid account ID.';
        alertClass.value = 'alert alert-danger';
        return;
    }

    try {
        const response = await axios.put(`http://localhost:80/api/accounts/${accountId.value}`, {
            name: accountName.value,
            type: selectedType.value,
            balance: accountBalance.value
        });

        if (response.data) {
            alertMessage.value = 'Account updated successfully!';
            alertClass.value = 'alert alert-success';
            setTimeout(() => {
            emit('cancel');
            router.push('/admin/accounts');
            }, 2000);
        } else {
            throw new Error('Account update failed.');
        }
    } catch (error) {
        console.error(error);
        alertMessage.value = error.message;
        alertClass.value = 'alert alert-danger';
    }
};

onMounted(() => {
    const idParam = route.params.accountsId;
    if (typeof idParam === 'string' && !isNaN(parseInt(idParam, 10))) {
        accountId.value = parseInt(idParam, 10);
    } else {
        console.error('Invalid account ID parameter:', idParam);
        alertMessage.value = 'Invalid account ID parameter.';
        alertClass.value = 'alert alert-danger';
    }

    if (accountId.value !== null) {
        fetchAccount();
    }
});
</script>

<template>
    <div class="container">
        <div v-if="alertMessage" :class="alertClass">{{ alertMessage }}</div>

        <h2>Edit Account</h2>
        <form @submit.prevent="editAccount" class="form">
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="accountName">Account Name</label>
                    <input v-model="accountName" type="text" id="accountName" class="form-control" required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="accountBalance">Balance</label>
                    <input v-model="accountBalance" type="number" id="accountBalance" class="form-control" required>
                </div>
            </div>
            <div class="row type">
                <div class="col-sm-6 form-group">
                    <label for="type">Account Type</label>
                    <select v-model="selectedType" id="type" class="form-control" required>
                        <option value="" disabled>Select a Type</option>
                        <option value="income">Income</option>
                        <option value="outcome">Outcome</option>
                    </select>
                </div>
            </div>
            <div class="row bt">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 me-9">
                    <button type="button" @click="handleCancel"
                        class="text-[#82868B] bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">CANCEL</button>
                    <button type="submit"
                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">UPDATE</button>
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
