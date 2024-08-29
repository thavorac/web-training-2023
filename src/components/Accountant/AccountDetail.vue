<script setup lang="ts">
import { ref, onMounted, computed, watch } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
import BackIcon from '../icons/BackIcon.vue';
import DollaIcon from '../icons/DollaIcon.vue';
import Datepicker from 'vue3-datepicker'; // Import the datepicker component

interface Transaction {
  id: number;
  account_name: string;
  type_Tran: string;
  balance: number;
  total_balance: number;
  description: string;
  date: string; // Format 'YYYY-MM-DD'
}

const transactions = ref<Transaction[]>([]);
const startDate = ref<Date | undefined>(undefined);
const endDate = ref<Date | undefined>(undefined);

const route = useRoute();

onMounted(async () => {
  const accountId = route.params.accountId as string;

  // Set end date to today
  const today = new Date();
  endDate.value = today;

  // Set start date to one month before today
  const lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
  startDate.value = lastMonth;

  try {
    const response = await axios.get<{ transactions: Transaction[] }>(`http://localhost/api/account-histroy/${accountId}`);
    transactions.value = response.data.transactions.map(transaction => ({
      ...transaction,
      balance: typeof transaction.balance === 'string' ? parseFloat(transaction.balance) : transaction.balance,
      total_balance: typeof transaction.total_balance === 'string' ? parseFloat(transaction.total_balance) : transaction.total_balance,
    }));
    console.log(response.data.transactions);
  } catch (error) {
    console.error('Error fetching transaction history:', error);
  }
});

const formatBalance = (type_Tran: string, balance: number) => {
  return type_Tran === 'income' ? `+${balance}$` : `-${balance}$`;
};

const totalIncome = computed(() => {
  return filteredData.value
    .filter(transaction => transaction.type_Tran === 'income')
    .reduce((sum, transaction) => sum + transaction.balance, 0);
});

const totalOutcome = computed(() => {
  return filteredData.value
    .filter(transaction => transaction.type_Tran === 'outcome')
    .reduce((sum, transaction) => sum + transaction.balance, 0);
});



const parseDate = (dateString: string): Date => {
  const [day, month, year] = dateString.split('/').map(Number);
  return new Date(year, month - 1, day); // JavaScript months are zero-based
};

const filteredData = computed(() => {
  if (!startDate.value || !endDate.value) {
    return transactions.value;
  }

  const start = new Date(startDate.value).setHours(0, 0, 0, 0);
  const end = new Date(endDate.value).setHours(23, 59, 59, 999);

  console.log('Filtering between:', start, end); // Debug log for start and end dates

  return transactions.value.filter(transaction => {
    const transactionDate = parseDate(transaction.date).getTime();

    if (isNaN(transactionDate)) {
      console.error(`Invalid transaction date: ${transaction.date}`);
      return false; // Exclude invalid dates from filtering
    }

    console.log('Transaction date:', transactionDate); // Debug log for transaction date
    return transactionDate >= start && transactionDate <= end;
  });
});

watch([startDate, endDate], () => {
  console.log('Start Date:', startDate.value);
  console.log('End Date:', endDate.value);
});
const printreceipt = () => {
  const originalContent = document.body.innerHTML;
  const receiptContent = document.querySelector('.data')?.outerHTML; // Use optional chaining
  if (receiptContent) { // Ensure receiptContent is not null
    document.body.innerHTML = receiptContent; // Replace body content with the table
    window.print();
    document.body.innerHTML = originalContent; // Restore original content after printing
  } else {
    console.error('Table content not found');
  }
};

</script>


<template>
  <div class="container mx-auto">
    <h2>{{ transactions[0]?.account_name }}</h2>
    <div class="flex justify-between bg-gray-100 items-center py-3 px-3 space-x-4 rounded-md mt-8">
      <RouterLink to="/admin/accounts"
        class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
        <BackIcon class="w-10 h-10" stroke="2.0" />
        <span class="text-xl font-semibold">Back</span>
      </RouterLink>

      <div class="flex">
        <div class="total-box mr-4 flex items-center">
          <DollaIcon class="mt-2 mr-6" />
          <div>
            <span>Balance <h4>{{ transactions[0]?.type_Tran === 'outcome' ? '-' : '' }}{{ transactions[0]?.total_balance }}</h4></span>
          </div>
        </div>
        <div class="total-box mr-4 flex items-center">
          <DollaIcon class="mt-2 mr-6" />
          <div>
            <span>Income <h4>{{ totalIncome }}</h4></span>
          </div>
        </div>
        <div class="total-box flex items-center">
          <DollaIcon class="mt-2 mr-6" />
          <div>
            <span>Outcome <h4>{{ transactions[0]?.type_Tran === 'outcome' ? '-' : '' }}{{totalOutcome }}</h4></span>
          </div>
        </div>
      </div>
    </div>

    <div v-if="transactions.length === 0" class="mt-4 text-center text-red-500">
      <p>Data not found </p>
    </div>

    <div v-else class="relative overflow-auto shadow-md sm:rounded-lg mt-4">
      <!-- Datepicker for start date -->
        <div class="d-flex justify-between">
          <div class="flex items-center space-x-1">
        <div class="relative">
          <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
          </div>
          <Datepicker v-model="startDate"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Select date start" />
        </div>
        <span class="mx-1 text-gray-500">to</span>
        <!-- Datepicker for end date -->
        <div class="relative">
          <div class="absolute z-30 inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
          </div>
          <Datepicker v-model="endDate"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Select date end" />
        </div>
       
      </div>
      <div class="float-end p-5 ps-5 gap-6 print:hidden">
        <div>
          <!-- Print receipt Button -->
          <button @click="printreceipt" class="btn btn-primary mt-3 ">Print</button>
        </div>
      </div>
        </div>
      <div class="data relative overflow-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full overflow-auto text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 bg-gray-50">
          <tr>
            <!-- <th scope="col" class="px-6 py-3 text-lg font-sans">ID</th> -->
            <th scope="col" class="px-6 py-3 text-lg font-sans">Account Name</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Description</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Type Transfer</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Amount</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(transaction, index) in filteredData" :key="index">
            <!-- <td class="px-6 py-3">{{ transaction.id }}</td> -->
            <td class="px-6 py-3">{{ transaction.account_name }}</td>
            <td class="px-6 py-3">{{ transaction.description }}</td>
            <td :class="{ 'text-green-600': transaction.type_Tran === 'income', 'text-red-600': transaction.type_Tran === 'outcome' }" class="px-6 py-3">
              {{ transaction.type_Tran }}
            </td>
            <td :class="{ 'text-green-600': transaction.type_Tran === 'income', 'text-red-600': transaction.type_Tran === 'outcome' }" class="px-6 py-3">
              {{ formatBalance(transaction.type_Tran, transaction.balance) }}
            </td>
            <td class="px-6 py-3">{{ transaction.date }}</td>
          </tr>
        </tbody>
      </table>
      </div>
     
    </div>
  </div>
</template>

<style scoped>
.total-box {
  padding: 15px 50px;
  border-radius: 7px;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}
.total-box p {
  padding-left: 20px;
}
</style>
