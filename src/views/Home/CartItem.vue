<template>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">Product Item</div>
            <div class="card-body">
              <table id="cart" class="table table-hover table-condensed">
                <thead>
                  <tr>
                    <th style="width: 50%">Product</th>
                    <th style="width: 10%">Price</th>
                    <th style="width: 8%">Quantity</th>
                    <th style="width: 22%" class="text-center">Subtotal</th>
                    <th style="width: 10%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product in products" :key="product.id">
                    <td data-th="Product">
                      <div class="row">
                        <div class="col-sm-3 hidden-xs">
                          <img :src="`http://localhost/storage/${product.image}`" width="100" height="100" class="img-responsive" />
                        </div>
                        <div class="col-sm-9">
                          <h4 class="nomargin">{{ product.name }}</h4>
                        </div>
                      </div>
                    </td>
                    <td data-th="Price">{{ formatCurrency(product.price) }}</td>
                    <td data-th="Quantity">
                      <input
                        type="number"
                        v-model="product.quantity"
                        class="form-control quantity cart_update"
                        min="1"
                        @change="updateCart(product)"
                      />
                    </td>
                    <td data-th="Subtotal" class="text-center">{{ formatCurrency(product.price * product.quantity) }}</td>
                    <td class="actions" data-th="">
                      <button class="btn btn-danger btn-sm cart_remove" @click="removeProduct(product.id)">
                        <i class="fa fa-trash-o"></i> Delete
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="5" style="text-align: right">
                      <h3>
                        <strong>Total {{ formatCurrency(total) }}</strong>
                      </h3>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="5" style="text-align: right">
                      <form @submit.prevent="checkout">
                        <a href="/" class="btn btn-danger">
                          <i class="fa fa-arrow-left"></i> Continue Shopping</a
                        >
                        <button class="btn btn-success" type="submit" id="checkout-live-button">
                          <i class="fa fa-money"></i> Checkout
                        </button>
                      </form>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed, onMounted } from 'vue'
  import axios from 'axios'
  
  const products = ref([])
  
  const fetchCartProducts = async () => {
    try {
      const response = await axios.get('http://localhost/api/cart/products')
      products.value = response.data.map(product => ({ ...product, quantity: 1 }))
    } catch (error) {
      console.error('Error fetching cart products:', error)
    }
  }
  
  onMounted(fetchCartProducts)
  
  const formatCurrency = (value) => {
    return `$${parseFloat(value).toFixed(2)}`
  }
  
  const total = computed(() => {
    return products.value.reduce((sum, product) => sum + product.price * product.quantity, 0)
  })
  
  const removeProduct = async (productId) => {
    try {
      await axios.post('http://localhost/api/cart/remove', { product_id: productId })
      products.value = products.value.filter(product => product.id !== productId)
    } catch (error) {
      console.error('Error removing product from cart:', error)
    }
  }
  
  const updateCart = async (product) => {
    try {
      await axios.post('http://localhost/api/cart/add', { product_id: product.id, quantity: product.quantity })
    } catch (error) {
      console.error('Error updating cart:', error)
    }
  }
  
  const checkout = () => {
    alert('Proceeding to checkout')
  }
  </script>
  
  <style>
  /* Add your custom styles here if needed */
  </style>
  