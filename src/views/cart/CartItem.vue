<template>
  <div>
    <h2>Your Cart</h2>
    <ul>
      <li v-for="item in cartProducts" :key="item.id">
        {{ item.product.name }} - {{ item.quantity }} x ${{ item.pricing }} = ${{ item.sub_total }}
      </li>
    </ul>
    <p>Total: ${{ cartTotal }}</p>
  </div>
  <div class="invoice pt-5" v-show="showInvoice">
    <h1>Invoice</h1>
    <aside>
      <address id="from">WeasyPrint Cambodia</address>
      <address id="to">To Adress: Tek Tla, Phnom Penh</address>
    </aside>
    <dl id="informations">
      <dt>Invoice number</dt>
      <dd>12345</dd>
      <dt>Date</dt>
      <dd>March 31, 2018</dd>
    </dl>
    <div>
      <table>
        <thead>
          <tr>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in cartItems" :key="item.id">
            <td>{{ findProduct(item.product_id).name }}</td>
            <td>{{ item.product.pricing }}</td>
            <td>{{ item.quantity }}</td>
            <td>{{ `$${(parseFloat(item.product.pricing) * item.quantity).toFixed(2)}` }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="footer-total">
      <footer>
        <table id="total">
          <thead>
            <tr>
              <th>Due by</th>
              <th>Account number</th>
              <th>Total due</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>May 10, 2024</td>
              <td>132 456 789 012</td>
              <td>${{ total }}</td>
            </tr>
          </tbody>
        </table>
      </footer>
    </div>
  </div>
</template>

<script setup>
import { computed, onMounted } from 'vue'
import { useStore } from 'vuex'

const store = useStore()
const cartItems = computed(() => store.state.cartItems)

const cartProducts = computed(() => store.getters.cartProducts)
const cartTotal = computed(() => store.getters.cartTotal)
const findProduct = (productId) => {
  return store.state.products.find(product => product.id === productId) || {}
}

const total = computed(() => {
  return cartItems.value.reduce((sum, item) => {
    return sum + parseFloat(item.product.pricing) * item.quantity
  }, 0).toFixed(2)
})

onMounted(() => {
  store.dispatch('getProductsFromCart')
})
</script>

<style scoped>
h2 {
  margin-bottom: 1rem;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  margin-bottom: 0.5rem;
}

p {
  font-weight: bold;
}
</style>
