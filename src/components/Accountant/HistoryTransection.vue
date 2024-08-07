<template>
  <div>
    <h1>Account Statistics</h1>
    <div class="controls">
      <select v-model="period" @change="fetchStatistics">
        <option value="day">Today</option>
        <option value="week">This Week</option>
        <option value="month">This Month</option>
      </select>
    </div>
    <div v-if="statistics">
      <div class="flex">
        <div class="total-box mr-4 flex items-center">
          <DollaIcon class="mt-2 mr-6" />
          <div>
            <span>Income <h4>{{ statistics.income }}</h4></span>
          </div>
        </div>
        <div class="total-box flex items-center">
          <DollaIcon class="mt-2 mr-6" />
          <div>
            <span>Outcome <h4>{{ statistics.outcome }}</h4></span>
          </div>
        </div>
      </div>
      <p><strong>Period:</strong> {{ statistics.period }}</p>
      <p><strong>Income:</strong> {{ statistics.income }}</p>
      <p><strong>Outcome:</strong> {{ statistics.outcome }}</p>
      <p><strong>Balance:</strong> {{ statistics.balance }}</p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import DollaIcon from '../icons/DollaIcon.vue';

const period = ref<'day' | 'week' | 'month'>('day');
const statistics = ref<{ period: string; income: number; outcome: number; balance: number } | null>(null);

const fetchStatistics = async () => {
  try {
    const response = await axios.get(`http://localhost:80/api/transactions/statistics?period=${period.value}`);
    statistics.value = response.data;
  } catch (error) {
    console.error('Error fetching statistics:', error);
  }
};

onMounted(() => {
  fetchStatistics(); // Fetch statistics on component mount
});
</script>

<style scoped>
.controls {
  text-align: right;
  margin-bottom: 1rem;
}
select{
  border-radius: 7px;
}
.total-box {
  padding: 15px 50px;
  border-radius: 7px;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}
.total-box p {
  padding-left: 20px;
}
</style>
