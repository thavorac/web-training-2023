<template>
  <div>

    <div class="row float-end">
      <div class="col-12">
        <label for="period">Select Period: </label>
        <select id="period" v-model="selectedPeriod" @change="fetchHistory">
          <option value="weekly">Weekly</option>
          <option value="monthly">Monthly</option>
          <option value="yearly">Yearly</option>
        </select>
      </div>
    </div>

    <div class="pt-7">
      <h2>{{ selectedPeriodLabel }} Transaction History</h2>
      <div class="flex float-end mr-7 mt-">
        <div class="total-box mr-4 flex items-center">
          <DollaIcon class="mt-2 mr-6" />
          <div>
            <span>Income</span>
            <h4>{{ selectedStatistics.income }}</h4>
          </div>
        </div>
        <div class="total-box flex items-center">
          <DollaIcon class="mt-2 mr-6" />
          <div>
            <span>Outcome</span>
            <h4>{{ selectedStatistics.outcome }}</h4>
          </div>
        </div>
      </div>
    </div>

    <table class="data w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-lg font-sans">Date</th>
          <th scope="col" class="px-6 py-3 text-lg font-sans">Account Name</th>
          <th scope="col" class="px-6 py-3 text-lg font-sans">Amount</th>
          <th scope="col" class="px-6 py-3 text-lg font-sans">Type</th>
          <th scope="col" class="px-6 py-3 text-lg font-sans">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="transaction in paginatedTransactions" :key="transaction.id">
          <td class="px-6 py-3">{{ transaction.date }}</td>
          <td class="px-6 py-3">{{ transaction.account_name }}</td>
          <td class="px-6 py-3">{{ transaction.balance }}</td>
          <td class="px-6 py-3">{{ transaction.type_Tran }}</td>
          <td class="px-6 py-3">{{ transaction.description }}</td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination Controls -->
    <div class="pagination-controls mt-4">
      <button @click="previousPage" :disabled="currentPage === 1">Previous</button>
      <span>Page {{ currentPage }} of {{ totalPages }}</span>
      <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import axios from 'axios';
import DollaIcon from '../icons/DollaIcon.vue';

const transactions = ref([]);
const statistics = ref({
  weekly: { income: '', outcome: '' },
  monthly: { income: '', outcome: '' },
  yearly: { income: '', outcome: '' },
});
const selectedPeriod = ref('weekly');

// Pagination state
const currentPage = ref(1);
const itemsPerPage = ref(5); // Change this value for more or fewer items per page

const fetchHistory = async () => {
  try {
    const response = await axios.get('http://localhost:80/api/all-history', {
      params: { period: selectedPeriod.value },
    });
    transactions.value = response.data.transactions;
    statistics.value = response.data.statistics;
  } catch (error) {
    console.error('Error fetching history:', error);
  }
};

const selectedStatistics = computed(() => {
  return statistics.value[selectedPeriod.value];
});

const selectedPeriodLabel = computed(() => {
  switch (selectedPeriod.value) {
    case 'weekly':
      return 'Weekly';
    case 'monthly':
      return 'Monthly';
    case 'yearly':
      return 'Yearly';
    default:
      return '';
  }
});

// Computed property for paginated transactions
const paginatedTransactions = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  const end = start + itemsPerPage.value;
  return transactions.value.slice(start, end);
});

// Total pages computed based on items per page
const totalPages = computed(() => {
  return Math.ceil(transactions.value.length / itemsPerPage.value);
});

// Pagination methods
const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
};

const previousPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
};

onMounted(() => {
  fetchHistory();
});

watch(selectedPeriod, () => {
  currentPage.value = 1; // Reset to first page when period changes
  fetchHistory();
});
</script>

<style>
.total-box {
  padding: 15px 50px;
  border-radius: 7px;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}
.total-box p {
  padding-left: 20px;
}
.table {
  width: 700px;
  height: 500px;
}
.pagination-controls {
  display: flex;
  justify-content: center;
  align-items: center;
}
.pagination-controls button {
  margin: 0 10px;
  padding: 5px 10px;
}
</style>
