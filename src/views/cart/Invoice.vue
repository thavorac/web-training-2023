<template>
  <div class="invoice">
    <h2>Invoice</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in cartItems" :key="index">
          <td>{{ item.product.name }}</td>
          <td>{{ item.quantity }}</td>
          <td>{{ item.product.pricing }}</td>
          <td>{{ (item.product.pricing * item.quantity).toFixed(2) }}</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3">Total</td>
          <td>{{ total }}</td>
        </tr>
      </tfoot>
    </table>
    <div class="p-5 ps-5 gap-6 print:hidden ">
      <div>
        <a href="/cart" class="btn btn-warning mt-3">
           <i class="fa fa-arrow-left"></i> Continue Shopping Cart
        </a>
      </div>
      <div>
        <!-- Print Invoice Button -->
        <button @click="printInvoice" class="btn btn-primary mt-3">Print Invoice</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'

const store = useStore()
const router = useRouter()

const cartItems = ref([])

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost:80/api/cart', {
      headers: {
        Authorization: 'Bearer ' + store.state.token
      }
    })
    cartItems.value = response.data
  } catch (error) {
    console.error('Failed to fetch cart data:', error)
  }
})

const total = computed(() => {
  return cartItems.value.reduce((sum, item) => {
    return sum + parseFloat(item.product.pricing) * item.quantity
  }, 0).toFixed(2)
})

const printInvoice = () => {
  const originalContent = document.body.innerHTML
  const invoiceContent = document.querySelector('.invoice').innerHTML
  document.body.innerHTML = invoiceContent
  window.print()
  document.body.innerHTML = originalContent
}
</script>

<style scoped>
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
h2 {
  color: #1ee494;
  font-family: Pacifico;
  font-size: 30pt;
  margin: 0 0 20px;
}

/* Table styling */
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
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
tfoot {
  font-weight: bold;
}
tfoot td {
  border-top: .2mm solid #a9a;
}

footer {
  content: '';
  display: block;
  height: 6cm;
}
table#total {
  /* background: #e6e5e5; */
  /* border-color: #f6f6f6; */
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
