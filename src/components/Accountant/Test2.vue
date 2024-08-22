<template>
    <div>
      <!-- Doughnut Chart -->
      <div>
        <h2>Doughnut Chart Example</h2>
        <Doughnut :data="doughnutChartData" :options="doughnutChartOptions" />
      </div>
      
      <!-- Bar Chart -->
      <div>
        <h2>Bar Chart Example</h2>
        <canvas ref="barChartCanvas"></canvas>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted } from 'vue'
  import { Doughnut } from 'vue-chartjs'
  import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement, BarElement, CategoryScale, LinearScale } from 'chart.js'
  
  // Register necessary components with ChartJS
  ChartJS.register(Title, Tooltip, Legend, ArcElement, BarElement, CategoryScale, LinearScale)
  
  // Doughnut Chart Data and Options
  const doughnutChartData = ref({
    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    datasets: [
      {
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
        ],
        borderWidth: 1,
      },
    ],
  })
  
  const doughnutChartOptions = ref({
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Doughnut Chart Example',
      },
    },
  })
  
  // Bar Chart Data and Options
  const barChartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'Sales',
        data: [12, 19, 3, 5, 2, 3, 7],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
      },
    ],
  }
  
  const barChartOptions = {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Bar Chart Example',
      },
    },
  }
  
  const barChartCanvas = ref<HTMLCanvasElement | null>(null)
  
  onMounted(() => {
    if (barChartCanvas.value) {
      new ChartJS(barChartCanvas.value, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions,
      })
    }
  })
  </script>
  
  <style scoped>
  canvas {
    max-width: 600px;
    margin: 0 auto;
  }
  </style>
  