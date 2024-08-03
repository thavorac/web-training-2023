// Store cart.js

import axios from 'axios'

const state = {
  cart: []
}

const getters = {
  cartProducts: (state) => state.cart,
  cartTotal: (state) => {
    return state.cart.reduce((total, product) => total + product.sub_total, 0)
  }
}

const actions = {
  async getProductsFromCart({ commit }) {
    try {
      const response = await axios.get('http://localhost/api/cart')
      commit('setCart', response.data)
    } catch (error) {
      console.error('Error fetching cart data:', error)
    }
  },

  async addToCart({ commit, dispatch }, product) {
    try {
      const response = await axios.post('http://localhost/api/cart', product)
      commit('addProductToCart', response.data)
      dispatch('getProductsFromCart') // Fetch updated cart data
    } catch (error) {
      console.error('Error adding product to cart:', error)
    }
  }
}

const mutations = {
  setCart: (state, cart) => (state.cart = cart),
  addProductToCart: (state, product) => state.cart.push(product)
}

export default {
  state,
  getters,
  actions,
  mutations
}
