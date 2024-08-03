<template>
  <div class="container pt-5">
    <div v-for="(orderProduct, show) in orderProducts" :key="index">
      <!-- Invoice section -->
      <div class="invoice pt-5" v-show="showInvoice">
        <h1>Invoice</h1>
        <aside>
          <address id="from">
            WeasyPrint
            Cambodia
          </address>
          <address id="to">
            To
            Address:
            Tek Tla,
            Phnom Penh
          </address>
        </aside>
        <dl id="informations">
          <dt>Invoice number</dt>
          <dd>12345</dd>
          <dt>Date</dt>
          <dd>March 31, 2018</dd>
        </dl>
        <!-- Invoice items table -->
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
              <tr  class="whitespace-nowrap odd:bg-white even:bg-gray-100">
                <td class="py-3 px-2">{{ findProduct(orderProduct.product_id).name }}</td>
                <td class="py-3 px-2">{{ findProduct(orderProduct.product_id).pricing }}</td>
                <td class="py-3 px-2">{{ orderProduct.quantity }}</td>
                <td class="py-3 px-2">{{ findProduct(orderProduct.product_id).price * orderProduct.quantity }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Total footer -->
        <div class="footer-total">
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
                <tr>
                  <td>{{ order.created_at }}</td>
                  <td>132 456 789 012</td>
                  <td>{{ orders.orderTotal }}</td>
                </tr>
              </tbody>
            </table>
          </footer>
        </div>
      </div>
      <!-- Buttons -->
      <div class="d-flex p-5 ps-5 gap-6">
        <div v-show="!showInvoice">
          <!-- Show Invoice Button -->
          <button @click="toggleInvoiceVisibility" class="btn btn-primary mt-3">Show Invoice</button>
        </div>
        <div v-show="showInvoice">
          <!-- Print Invoice Button -->
          <button @click="printInvoice" class="btn btn-primary mt-3">Print Invoice</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

const store = useStore();
const router = useRouter();
const Products = ref([]);
const orderProducts = ref([]);
const orders = ref([]);
const users = ref([]);
const showInvoice = ref(false);
const orderTotal = ref(0);

interface Orders {
  id: number;
  user_first_name: string;
  user_last_name: string;
  quantity: number;
  total_price: number;
  order_date: string;
  status: string;
}

const toggleInvoiceVisibility = () => {
  showInvoice.value = !showInvoice.value;
};

const printInvoice = () => {
  // Show all elements for printing
  const elementsToPrint = document.querySelectorAll('.container > div');
  elementsToPrint.forEach((element) => {
    element.style.display = 'block'; // Ensure element is visible during printing
  });
  // Trigger browser's print dialog
  window.print();
  // Reset display styles after printing
  elementsToPrint.forEach((element) => {
    element.style.display = ''; // Reset display to default
  });
};
const fetchOrdersProduct = async () => {
  try {
    console.log('Fetching ordersProduct...');
    const response = await axios.get('http://localhost:80/api/order-products', {
      headers: {
        Authorization: 'Bearer ' + store.state.token
      }
    });
    orders_product.value = response.data;
    console.log('OrdersProduct fetched:', response.data);
    if (orders_product.value.length > 0) {
      const orderId = orders.value[0].id;
      await fetchOrderProducts(orderId); // Fetch order products for the first order
    }
  } catch (error) {
    console.error('Failed to fetch orders Product:', error);
  }
};



const fetchOrders = async () => {
  try {
    console.log('Fetching orders...');
    const response = await axios.get('http://localhost:80/api/orders', {
      headers: {
        Authorization: 'Bearer ' + store.state.token
      }
    });
    orders.value = response.data;
    console.log('Orders fetched:', response.data);
    if (orders.value.length > 0) {
      const orderId = orders.value[0].id;
      await fetchOrderProducts(orderId); // Fetch order products for the first order
    }
  } catch (error) {
    console.error('Failed to fetch orders:', error);
  }
};

const fetchProducts = async () => {
  try {
    console.log('Fetching products...');
    const response = await axios.get('http://localhost:80/api/products');
    Products.value = response.data;
    console.log('Products fetched:', response.data);
  } catch (error) {
    console.error('Error fetching products:', error);
    throw error;
  }
};

const findProduct = (productId) => {
  return Products.value.find(product => product.id === productId) || {};
};

onMounted(async () => {
  await fetchProducts();
  await fetchOrders();
  await fetchOrdersProduct();
  
});
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
  background: #f6f6f6;
  border-color: #f6f6f6;
  border-style: solid;
  border-width: 2cm 3cm;
  font-size: 20pt;
  margin: 0 -3cm;
  position: absolute;
  width: 100%;
}
</style>
