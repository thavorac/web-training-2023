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
                <tr>
                  <td data-th="Product">
                    <div class="row">
                      <div class="col-sm-3 hidden-xs">
                        <img :src="product.image" width="100" height="100" class="img-responsive" />
                      </div>
                      <div class="col-sm-9">
                        <h4 class="nomargin">{{ product.name }}</h4>
                      </div>
                    </div>
                  </td>
                  <td data-th="Price">{{ product.price }}</td>
                  <td data-th="Quantity">
                    <input
                      type="number"
                      v-model="quantity"
                      class="form-control quantity cart_update"
                      min="1"
                    />
                  </td>
                  <td data-th="Subtotal" class="text-center">{{ subtotal }}</td>
                  <td class="actions" data-th="">
                    <button class="btn btn-danger btn-sm cart_remove" @click="removeProduct">
                      <i class="fa fa-trash-o"></i> Delete
                    </button>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="5" style="text-align: right">
                    <h3>
                      <strong>Total {{ total }}</strong>
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
import { ref, computed } from 'vue'

const product = {
  name: 'Asus Vivobook 17 Laptop - Intel Core 10th',
  price: '$6',
  image: '/img/1.jpg'
}

const quantity = ref(1)

const subtotal = computed(() => {
  return `$${(parseFloat(product.price.replace('$', '')) * quantity.value).toFixed(2)}`
})

const total = computed(() => {
  return `$${(parseFloat(product.price.replace('$', '')) * quantity.value).toFixed(2)}`
})

const removeProduct = () => {
  quantity.value = 0
}

const checkout = () => {
  // Implement your checkout logic here
  alert('Proceeding to checkout')
}
</script>

<style>
/* Add your custom styles here if needed */
</style>
