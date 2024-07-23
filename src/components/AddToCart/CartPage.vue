<template>
      <div class="container-fluid">
        <div>
            <RouterLink class="no-underline" to="/">
                <MenuHeader />
            </RouterLink>
        </div>
        <div class="categoryHead">
            <CategoriesHead />
        </div>
        <div class="mb-5">
            <SubHeader>
                <ChevronRight width="5" color="black" class="mt-1" />
            </SubHeader>
        </div>
    </div>
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
                <tr v-for="item in cartItems" :key="item.id">
                  <td data-th="Product">
                    <div class="row">
                      <div class="col-sm-3 hidden-xs">
                        <img :src="item.product.image" width="100" height="100" class="img-responsive" />
                      </div>
                      <div class="col-sm-9">
                        <h4 class="nomargin">{{ item.product.name }}</h4>
                      </div>
                    </div>
                  </td>
                  <td data-th="Price">{{ item.product.price }}</td>
                  <td data-th="Quantity">
                    <input
                      type="number"
                      v-model="item.quantity"
                      class="form-control quantity cart_update"
                      min="1"
                    />
                  </td>
                  <td data-th="Subtotal" class="text-center">{{ `$${(parseFloat(item.product.price.replace('$', '')) * item.quantity).toFixed(2)}` }}</td>
                  <td class="actions" data-th="">
                    <button class="btn btn-danger btn-sm cart_remove" @click="removeProduct(item.product.id)">
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
  <div>
        <SubFooter />
    </div>
    <div class="">
        <Footer></Footer>
    </div>
</template>

<script setup>
// import SearchButton from '@/components/basic/SearchButton.vue';
import WishlistProduct from '../../components/WishlistProduct.vue';
import MenuHeader from '../../components/MenuHeader.vue';
import CategoriesHead from '../../components/CategoriesHead.vue';
import Footer from '../../components/Footer.vue';
import SubHeader from '../../components/SubHeader.vue';
import ChevronRight from '../../components/icons/ChevronRight.vue';
import SubFooter from '../../components/SubFooter.vue';
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'

const cartItems = ref([])

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost:80/api/cart')
    cartItems.value = response.data
  } catch (error) {
    console.error('Failed to fetch cart data:', error)
  }
})

const total = computed(() => {
  return cartItems.value.reduce((sum, item) => {
    return sum + parseFloat(item.product.price.replace('$', '')) * item.quantity
  }, 0).toFixed(2)
})

const removeProduct = async (productId) => {
  try {
    await axios.post('http://localhost:80/api/cart/remove', { product_id: productId })
    cartItems.value = cartItems.value.filter(item => item.product.id !== productId)
  } catch (error) {
    console.error('Failed to remove product from cart:', error)
  }
}

const checkout = () => {
  // Implement your checkout logic here
  alert('Proceeding to checkout')
}
</script>

<style>
/* Add your custom styles here if needed */
</style>
