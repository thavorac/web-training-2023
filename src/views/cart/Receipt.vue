<template>
  <div class="container pt-5">
    <div v-if="order">
      <!-- receipt section -->
      <div class="receipt pt-5">
        <h1>Receipt</h1>
        <aside>
          <address id="from">
            WeasyPrint<br />
            Cambodia
          </address>
          <address id="to">
            To<br />
            Address:<br />
            Tek Tla,<br />
            Phnom Penh
          </address>
        </aside>
        <dl id="informations">
          <dt>Order ID</dt>
          <dd>{{ order.id }}</dd>
          <dt>Date</dt>
          <dd>{{ new Date(order.created_at).toLocaleDateString() }}</dd>
        </dl>
        <!-- receipt items table -->
        <div>
          <table>
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="recipe in recipes" :key="recipe.id" class="whitespace-nowrap odd:bg-white even:bg-gray-100">
                <td class="py-3 px-2">{{ recipe.product.name }}</td>
                <td class="py-3 px-2">{{ recipe.product.pricing || 0 }}</td>
                <td class="py-3 px-2">{{ recipe.quantity }}</td>
                <td class="py-3 px-2">{{ (recipe.product.pricing || 0) * recipe.quantity }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Total footer -->
        <div class="footer-total ">
          <footer>
            <table id="total">
              <thead>
                <tr>
                  <th>Date Order</th>
                  <th>Account number</th>
                  <th>Total due</th>
                </tr>
              </thead>
              <tbody>
                <tr >
                  <td>{{ new Date(order.created_at).toLocaleDateString() }}</td>
                  <!-- Assuming account number is user_id -->
                  <td>{{ order.user_id }}</td>
                  <td>{{ order.total || 0 }}</td>
                </tr>
              </tbody>
            </table>
          </footer>
        </div>
      </div>
      <!-- Buttons -->
      <div class=" p-5 ps-5 gap-6 print:hidden">
        <div>
          <!-- Print receipt Button -->
          <button @click="printreceipt" class="btn btn-primary mt-3 ">Print Receipt</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
// import { ref, onMounted } from 'vue';
// import axios from 'axios';

// const order = ref(null);
// const recipes = ref([]);
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';

const order = ref(null);
const recipes = ref([]);
const route = useRoute();

const fetchRecipes = async (orderId: number) => {
  try {
    const response = await axios.get(`http://localhost:80/api/orders/${orderId}/recipes`);
    recipes.value = response.data.order.order_product; // Adjust according to the API response
    order.value = response.data.order; // Adjust according to the API response
    console.log(response.data)
  } catch (error) {
    console.error('Failed to fetch recipes:', error);
  }
};

onMounted(() => {
  let orderId = +route.params.id; // Replace with dynamic order ID as needed
  console.log('recipt id',route.params);
  fetchRecipes(orderId);
});
// const fetchRecipes = async (orderId) => {
//   try {
//     const response = await axios.get(`http://localhost:80/api/orders/${orderId}/recipes`);
//     recipes.value = response.data.order.order_product; // Adjust according to the API response
//     order.value = response.data.order; // Adjust according to the API response
//     console.log(response.data);
//   } catch (error) {
//     console.error('Failed to fetch recipes:', error);
//   }
// };

// onMounted(() => {
//   const orderId = route.params.orderId; // Get orderId from route params
//   fetchRecipes(orderId);
// });

const printreceipt = () => {
  const originalContent = document.body.innerHTML;
  const receiptContent = document.querySelector('.container').innerHTML;
  document.body.innerHTML = receiptContent;
  window.print();
  document.body.innerHTML = originalContent;
};
</script>
  <style scoped>
  /* Scoped styles for the component */
  @font-face {
    font-family: Pacifico;
    src: url(pacifico.ttf);
  }
  @font-face {
    font-family: Source Sans Pro;
    font-weight: 400;
    src: url(sourcesanspro-regular.otf);
  }
  @font-face {
    font-family: Source Sans Pro;
    font-weight: 700;
    src: url(sourcesanspro-bold.otf);
  }
  
  /* General HTML and body styling */
  html {
    color: #14213d;
    font-family: Source Sans Pro;
    font-size: 11pt;
    line-height: 1.6;
  }
  body {
    margin: 0;
  }
  /* Header styling */
  h1 {
    color: #1ee494;
    font-family: Pacifico;
    font-size: 40pt;
    margin: 0;
  }
  
  /* Aside styling */
  aside {
    display: flex;
    margin: 2em 0 4em;
  }
  aside address {
    
    font-style: normal;
    white-space: pre-line;
  }
  aside address#from {
    color: #a9a;
    flex: 1;
  }
  aside address#to {
    text-align: right;
  }
  
  /* Definition list (dl) styling */
  dl {
    position: absolute;
    right: 0;
    text-align: right;
    top: 0;
  }
  dt, dd {
    display: inline;
    margin: 0;
  }
  dt {
    color: #a9a;
  }
  dt::before {
    content: '';
    display: block;
  }
  dt::after {
    content: ':';
  }
  
  /* Table styling */
  table {
    border-collapse: collapse;
    width: 100%;
  }
  th {
    border-bottom: .2mm solid #a9a;
    color: rgb(156, 110, 156);
    font-size: 10pt;
    font-weight: 900;
    padding-bottom: .25cm;
    text-transform: uppercase;
  }
  td {
    padding-top: 7mm;
  }
  td:last-of-type {
    color: #1ee494;
    font-weight: bold;
    text-align: right;
  }
  th, td {
    text-align: center;
  }
  th:first-of-type, td:first-of-type {
    text-align: left;
  }
  th:last-of-type, td:last-of-type {
    text-align: right;
  }
  
  /* Footer styling */
  footer {
    content: '';
    display: block;
    height: 6cm;
  }
  table#total {
    background: #e6e5e5;
    border-color: #f6f6f6;
    border-style: solid;
    border-width: 2px; 
    font-size: 20pt;
    margin: 0 auto; 
    padding: 20px; 
    width: 100%;
    box-sizing: border-box; 
    height: auto;
  }

  </style>
  