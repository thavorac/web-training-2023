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
                  <th style="width: 25%">Product</th>
                  <th style="width: 25%">Name</th>
                  <th style="width: 10%">Price</th>
                  <th style="width: 8%">Quantity</th>
                  <th style="width: 22%" class="text-center">Subtotal</th>
                  <th style="width: 10%"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in cartItems" :key="item.id">
                  <td data-th="Product">
                    <div class="row">
                      <div class="col-sm-3 hidden-xs">
                        <!-- Display image of the product in the cart -->
                        <img :src="`http://localhost/storage/${findProduct(item.product_id).image}`" width="100" height="100" class="img-responsive" />
                      </div>
                    </div>
                  </td>
                  <td data-th="Name">{{ findProduct(item.product_id).name }}</td>
                  <td data-th="Price">{{ item.product.pricing }}</td>
                  <td data-th="Quantity">
                    <input
                      type="number"
                      v-model="item.quantity"
                      class="form-control quantity cart_update"
                      min="1"
                    />
                  </td>
                  <td data-th="Subtotal" class="text-center">{{ `$${(parseFloat(item.product.pricing) * item.quantity).toFixed(2)}` }}</td>
                  <td class="actions" data-th="">
                    <button class="btn btn-danger btn-sm cart_remove" @click="removeProduct(item.id)">
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
                        <i class="fa fa-arrow-left"></i> Continue Shopping
                      </a>
                      <button class="btn btn-success">
                        <i class="fa fa-money"></i> Checkout
                      </button>
                    </form>
                    <button class="btn btn-warning" @click="showInvoicePage">
                      <i class="fa fa-file"></i> Invoice
                    </button>
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
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'
import { useStore } from 'vuex'
import Swal from 'sweetalert2'
import { loadStripe } from '@stripe/stripe-js'
import { useRouter } from 'vue-router'
import WishlistProduct from '../../components/WishlistProduct.vue'
import MenuHeader from '../../components/MenuHeader.vue'
import CategoriesHead from '../../components/CategoriesHead.vue'
import Footer from '../../components/Footer.vue'
import SubHeader from '../../components/SubHeader.vue'
import ChevronRight from '../../components/icons/ChevronRight.vue'
import SubFooter from '../../components/SubFooter.vue'
import Invoice from '../../views/Cart/Invoice.vue'

const store = useStore()
const router = useRouter()
const cartItems = ref([])
const Products = ref([])
const cartId = ref(null)
const publishableKey = 'pk_test_51P1JoBFkNe48oU2cId3sbBElDBn05m45HLaMDuTVLInhFA7u4Ul4147ZVCTOeDT1zm9Ighj15L387irOOTiVjckY00yDG70we6'

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost:80/api/cart', {
      headers: {
        Authorization: 'Bearer ' + store.state.token
      }
    })
    cartItems.value = response.data
    if (cartItems.value.length > 0) {
      cartId.value = cartItems.value[0].cart_id // Set the correct cart ID
    }
    await getProducts() // Fetch products after cart items
  } catch (error) {
    console.error('Failed to fetch cart data:', error)
  }
})

const getProducts = async () => {
  try {
    const response = await axios.get('http://localhost:80/api/products')
    Products.value = response.data
    console.log('get name of the product', response.data)
  } catch (error) {
    console.error('Error fetching products:', error)
    throw error
  }
}

const findProduct = (productId) => {
  return Products.value.find(product => product.id === productId) || {}
}

const total = computed(() => {
  return cartItems.value.reduce((sum, item) => {
    return sum + parseFloat(item.product.pricing) * item.quantity
  }, 0).toFixed(2)
})

const removeProduct = async (cartItemId) => {
  try {
    const response = await axios.delete(`http://localhost:80/api/cart-items/${cartItemId}`, {
      headers: {
        Authorization: 'Bearer ' + store.state.token,
        'Content-Type': 'application/json'
      }
    });
    cartItems.value = cartItems.value.filter(item => item.id !== cartItemId);
  } catch (error) {
    console.error('Failed to remove product from cart:', error.response?.data || error.message);
  }
}

const checkout = async () => {
  const result = await Swal.fire({
    title: 'Do you want to Pay by bank or Cash?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: 'Bank',
    denyButtonText: `Cash`,
  })
  
  if (result.isConfirmed) {
    Swal.fire('Proceeding to payment...', '', 'success')
    await handleStripePayment()
  } else if (result.isDenied) {
    try {
      const response = await axios.post('http://localhost:80/api/orders', { cart_id: cartId.value }, {
        headers: {
          Authorization: 'Bearer ' + store.state.token,
          'Content-Type': 'application/json'
        }
      })
      console.log('Order created successfully', response.data)
      Swal.fire('Order created successfully', '', 'success')
    } catch (error) {
      console.error('Order creation failed', error.response ? error.response.data : error.message)
      Swal.fire('Order creation failed', error.response ? error.response.data : error.message, 'error')
    }
  }
}

const handleStripePayment = async () => {
  const stripe = await loadStripe(publishableKey)
  
  try {
    const response = await axios.post('http://localhost:80/api/create-payment-intent', { amount: total.value}, {
      headers: {
        Authorization: 'Bearer ' + store.state.token,
        'Content-Type': 'application/json'
      }
    })
    console.log('Payment Intent Response:', response.data)
    const clientSecret = response.data.clientSecret

    const result = await stripe.confirmCardPayment(clientSecret, {
      payment_method: {
        card: {
          // Use a Card Element, you can also pass card details directly
        }
      }
    })
    console.log('Stripe Payment Result:', result)

    if (result.error) {
      Swal.fire('Payment failed', result.error.message, 'error')
    } else {
      if (result.paymentIntent.status === 'succeeded') {
        Swal.fire('Payment succeeded', 'Your payment was successful!', 'success')
      }
    }
  } catch (error) {
    console.error('Error during payment:', error.response ? error.response.data : error.message)
    Swal.fire('Payment failed', error.response ? error.response.data : error.message, 'error')
  }
}

const showInvoicePage = () => {
  router.push({ name: 'Invoice' });
}
</script>

<style>
/* Add your styles here */
</style>
