<template>
  <div>
    <h1>Account Statistics</h1>
    <div v-if="loading">Loading...</div>
    <div v-if="error" class="error">{{ error }}</div>
    <div v-else>
      <!-- Filter Options -->
      <div class="row float-end">
        <div class="col-12">
          <label for="filter">Filter by:</label>
        <select v-model="selectedFilter" id="filter">
          <option value="day">Day</option>
          <option value="week">Week</option>
          <option value="month">Month</option>
        </select>
        </div>
      </div>
      <div class="flex">
        <div class="total-box mr-4 flex items-center">
          <DollaIcon class="mt-2 mr-2" />
          <div>
            <span>Income</span>
            <h4>{{ totalIncome }}</h4>
          </div>
        </div>
        <div class="total-box flex items-center">
          <DollaIcon class="mt-2 mr-2" />
          <div>
            <span>Outcome</span>
            <h4>{{ totalOutcome }}</h4>
          </div>
        </div>
      </div>

      <div class="relative overflow-auto shadow-md sm:rounded-lg mt-4 text-gray-500">
        <table class="w-full overflow-auto text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-lg font-sans">Account</th>
              <th scope="col" class="px-6 py-3 text-lg font-sans">Date</th>
              <th scope="col" class="px-6 py-3 text-lg font-sans">Description</th>
              <th scope="col" class="px-6 py-3 text-lg font-sans">Balance</th>
              <th scope="col" class="px-6 py-3 text-lg font-sans">Transaction Type</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tran in paginatedTransactions" :key="tran.date + tran.account_name">
              <td class="px-6 py-6">{{ tran.account_name }}</td>
              <td class="px-6 py-6">{{ tran.date }}</td>
              <td class="px-6 py-6">{{ tran.description }}</td>
              <td class="px-6 py-6">{{ tran.balance }}</td>
              <td class="px-6 py-6">{{ tran.type_Tran }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination Controls -->
      <div class="pagination">
        <button @click="previousPage" :disabled="currentPage === 1">Previous</button>
        <span>Page {{ currentPage }} of {{ totalPages }}</span>
        <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
      </div>

      <!-- Display filtered transactions with pagination -->
      <div class="row mt-4 mb-5">
        <div class="col-6">
          <div class="chart">
            <h3>Transaction Line Chart</h3>
            <Line :data="chartData.line" :options="chartOptions" />
          </div>
        </div>
        <div class="col-6">
          <div class="chart">
            <h3>Transaction Bar Chart</h3>
            <Bar :data="chartData.bar" :options="chartOptions" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, watch, computed } from 'vue';
import axios from 'axios';
import { Line, Bar } from 'vue-chartjs';
import DollaIcon from '../icons/DollaIcon.vue';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  LineElement,
  BarElement,
  CategoryScale,
  LinearScale,
  PointElement,
  ChartData,
  ChartOptions,
} from 'chart.js';

// Register Chart.js components
ChartJS.register(
  Title,
  Tooltip,
  Legend,
  LineElement,
  BarElement,
  CategoryScale,
  LinearScale,
  PointElement
);

// Define TypeScript interfaces for the data structure
interface Transaction {
  account_name: string;
  date: string;
  description: string;
  balance: number;
  type_Tran: string;
}

interface AccountStatistic {
  account_name: string;
  default: string;
  income: number;
  outcome: number;
  transactions: Transaction[];
}

// Reactive variables with types
const statistics = ref<AccountStatistic[]>([]);
const allTransactions = ref<Transaction[]>([]);
const filteredTransactions = computed(() => filterTransactions(selectedFilter.value));
const paginatedTransactions = computed(() => paginate(filteredTransactions.value));
const selectedFilter = ref<string>('day');
const currentPage = ref<number>(1);
const itemsPerPage = 10; // Number of items per page
const loading = ref(true);
const error = ref<string | null>(null);
const totalIncome = ref<string>('0.00');
const totalOutcome = ref<string>('0.00');

// Define chart data and options types
const chartData = ref<{
  line: ChartData<'line'>;
  bar: ChartData<'bar'>;
}>({
  line: { labels: [], datasets: [] },
  bar: { labels: [], datasets: [] },
});

const chartOptions = ref<ChartOptions<'line' | 'bar'>>({
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      display: true,
      position: 'top',
    },
    tooltip: {
      callbacks: {
        label: (tooltipItem) => {
          return `${tooltipItem.label}: ${tooltipItem.raw}`;
        },
      },
    },
  },
});

// Fetch account statistics data
const fetchStatistics = async () => {
  try {
    const response = await axios.get<{
      success: boolean;
      statistics: AccountStatistic[];
      total_income: string;
      total_outcome: string;
    }>('http://localhost/api/account-statistics');

    if (response.data.success) {
      statistics.value = response.data.statistics;
      totalIncome.value = response.data.total_income;
      totalOutcome.value = response.data.total_outcome;
      aggregateTransactions();
      updateChartData();
    } else {
      error.value = 'Failed to fetch data';
    }
  } catch (err) {
    error.value = 'An error occurred while fetching data';
  } finally {
    loading.value = false;
  }
};

// Aggregate all transactions from statistics
const aggregateTransactions = () => {
  allTransactions.value = statistics.value.flatMap(stat =>
    stat.transactions.map(tran => ({
      ...tran,
      account_name: stat.account_name
    }))
  );
};

// Filter transactions based on the selected period
const filterTransactions = (period: string) => {
  const now = new Date();
  const startDate = new Date();

  if (period === 'day') {
    // Filter for the current day
    startDate.setHours(0, 0, 0, 0);
  } else if (period === 'week') {
    // Filter for the current week
    startDate.setDate(now.getDate() - now.getDay()); // Start of the week
  } else if (period === 'month') {
    // Filter for the current month
    startDate.setDate(1); // Start of the month
  }

  return allTransactions.value.filter(tran => {
    const tranDate = new Date(tran.date.split('/').reverse().join('/'));
    return tranDate >= startDate;
  });
};
// Paginate transactions based on the current page
const paginate = (transactions: Transaction[]) => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return transactions.slice(start, end);
};

// Handle previous page button click
const previousPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
};

// Handle next page button click
const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
};

// Compute total number of pages
const totalPages = computed(() => Math.ceil(filteredTransactions.value.length / itemsPerPage));

// Update chart data based on statistics
const updateChartData = () => {
  const labels: string[] = [];
  const incomeData: number[] = [];
  const outcomeData: number[] = [];

  // Collect data for the charts
  filteredTransactions.value.forEach((tran) => {
    labels.push(tran.date);
    if (tran.type_Tran === 'income') {
      incomeData.push(tran.balance);
      outcomeData.push(0);
    } else if (tran.type_Tran === 'outcome') {
      incomeData.push(0);
      outcomeData.push(tran.balance);
    }
  });

  // Update line chart data
  chartData.value.line = {
    labels,
    datasets: [
      {
        label: 'Income',
        data: incomeData,
        borderColor: 'green',
        fill: false,
      },
      {
        label: 'Outcome',
        data: outcomeData,
        borderColor: 'red',
        fill: false,
      },
    ],
  };

  // Update bar chart data
  chartData.value.bar = {
    labels,
    datasets: [
      {
        label: 'Income',
        data: incomeData,
        backgroundColor: 'green',
      },
      {
        label: 'Outcome',
        data: outcomeData,
        backgroundColor: 'red',
      },
    ],
  };
};

// Watchers for dynamic data changes
watch([filteredTransactions, currentPage], () => {
  updateChartData();
});

// Fetch data on component mount
onMounted(fetchStatistics);
</script>

<style scoped>
.error {
  color: red;
}
.filter-container {
  display: flex;
  align-items: center;
  gap: 10px; /* Optional: Adds space between the label and select */
}
.filter-class{
  text-align: left;
}
.chart {
  width: 100%;
  max-width: 600px; /* Maximum width */
  height: 300px; /* Fixed height to maintain aspect ratio */
  margin-top: 20px;
  @media (max-width: 768px) {
    max-width: 100%; /* Full width on smaller screens */
  }
}

.totals {
  margin-bottom: 20px;
}

.select {
  margin: 10px;
}

.flex {
  display: flex;
  flex-wrap: wrap;
}

.total-box {
  padding: 15px 50px;
  border-radius: 7px;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}
.total-box p {
  padding-left: 20px;
}
.pagination {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  gap: 10px; /* Adds space between buttons */
  flex-wrap: wrap; /* Allow buttons to wrap */
}

.pagination button {
  background-color: #4CAF50; /* Green background */
  border: none;
  color: white; /* White text */
  padding: 7px 10px; /* Padding around text */
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 5px; /* Rounded corners */
  transition: background-color 0.3s ease;
  max-width: 150px; /* Prevent buttons from being too large */
}

.pagination button:disabled {
  background-color: #cccccc; /* Gray background for disabled button */
  cursor: not-allowed; /* Change cursor to not-allowed */
}

.pagination button:not(:disabled):hover {
  background-color: #45a049; /* Darker green when hovering */
}
</style>
