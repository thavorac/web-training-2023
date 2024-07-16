import { defineStore } from 'pinia'
import api from '../apis/index'

export const useCartStore = defineStore('cart', {
  state: () => ({
    cart: [],
    products: []
  }),
  actions: {
    async getProducts() {
      const products = await api.fetchProducts()
      this.products = products
    },
    async addProductToCart(product) {
      const productFound = this.cart.find((p) => p.id === product.id)
      if (!productFound) {
        const result = await api.addProductToCart(product.id, 17)
        if (result) {
          this.cart.push(product)
        }
      }
    },
    async removeProductFromCart(product) {
      const result = await api.removeProductFromCart(product.id, 17)
      if (result) {
        this.cart = this.cart.filter((p) => p.id !== product.id)
      }
    },
    async getProductsFromCart() {
      const cart = await api.getProductsFromCart(17)
      for (const product of cart) {
        const productFound = this.products.find((p) => p.id === product.product_id)
        if (productFound) {
          this.cart.push(productFound)
        }
      }
    }
  }
})
