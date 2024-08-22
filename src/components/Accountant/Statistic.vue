<template>
  <div>
    <h1>Account Statistics</h1>

    <div>
      <label for="period">Select Period: </label>
      <select id="period" v-model="selectedPeriod" @change="updateCharts">
        <option value="weekly">Weekly</option>
        <option value="monthly">Monthly</option>
        <option value="yearly">Yearly</option>
      </select>
    </div>

    <h2>{{ selectedPeriodLabel }} Statistics</h2>
    <p>Income: {{ selectedStatistics.income }}</p>
    <p>Outcome: {{ selectedStatistics.outcome }}</p>

    <h2>Doughnut Chart</h2>
    <Doughnut :data="doughnutChartData" :options="doughnutChartOptions" />

    <h2>Bar Chart</h2>
    <canvas ref="barChartCanvas"></canvas>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, watch } from 'vue';
import axios from 'axios';
import { Doughnut } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement, BarElement, CategoryScale, LinearScale } from 'chart.js';

// Register necessary components with ChartJS
ChartJS.register(Title, Tooltip, Legend, ArcElement, BarElement, CategoryScale, LinearScale);

// Reactive references
const transactions = ref([]);
const statistics = ref({
  weekly: { income: 0, outcome: 0 },
  monthly: { income: 0, outcome: 0 },
  yearly: { income: 0, outcome: 0 },
});
const selectedPeriod = ref('weekly');

const doughnutChartData = ref({
  labels: ['Income', 'Outcome'],
  datasets: [
    {
      label: 'Income vs Outcome',
      data: [],
      backgroundColor: [
        'rgba(75, 192, 192, 0.2)',
        'rgba(255, 99, 132, 0.2)',
      ],
      borderColor: [
        'rgba(75, 192, 192, 1)',
        'rgba(255, 99, 132, 1)',
      ],
      borderWidth: 1,
    },
  ],
});

const doughnutChartOptions = ref({
  responsive: true,
  plugins: {
    legend: {
      position: 'top',
    },
    title: {
      display: true,
      text: 'Income vs Outcome',
    },
  },
});

const barChartData = ref({
  labels: [],
  datasets: [
    {
      label: 'Sales',
      data: [],
      backgroundColor: 'rgba(75, 192, 192, 0.2)',
      borderColor: 'rgba(75, 192, 192, 1)',
      borderWidth: 1,
    },
  ],
});

const barChartOptions = ref({
  responsive: true,
  plugins: {
    legend: {
      position: 'top',
    },
    title: {
      display: true,
      text: 'Sales Over Time',
    },
  },
});

const barChartCanvas = ref<HTMLCanvasElement | null>(null);
let barChartInstance: ChartJS | null = null; // Track the chart instance

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

const fetchHistory = async () => {
  try {
    const response = await axios.get('http://localhost:80/api/all-history');
    transactions.value = response.data.transactions;
    statistics.value = response.data.statistics;
    updateCharts(); // Initialize charts after fetching data
  } catch (error) {
    console.error('Error fetching history:', error);
  }
};

const updateCharts = () => {
  const currentStatistics = statistics.value[selectedPeriod.value];
  doughnutChartData.value.datasets[0].data = [currentStatistics.income, currentStatistics.outcome];
  
  // Update bar chart data
  barChartData.value.labels = transactions.value.map(t => t.date);
  barChartData.value.datasets[0].data = transactions.value.map(t => t.balance);
  
  // Destroy existing chart if it exists
  if (barChartInstance) {
    barChartInstance.destroy();
  }
  
  // Create new chart
  if (barChartCanvas.value) {
    barChartInstance = new ChartJS(barChartCanvas.value, {
      type: 'bar',
      data: barChartData.value,
      options: barChartOptions.value,
    });
  }
};

onMounted(() => {
  fetchHistory();
});

// Watch for period changes and update charts
watch(selectedPeriod, () => {
  updateCharts();
});
</script>

<style scoped>
canvas {
  max-width: 600px;
  margin: 0 auto;
}
</style>
