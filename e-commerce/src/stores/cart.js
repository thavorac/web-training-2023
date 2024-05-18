import { ref, computed } from "vue";
import { defineStore } from "pinia";
import api from "../apis/index";

export const useCartStore = defineStore("cart", {
  state: () => {
    return {
      cart: [],
      products: [],
    };
  },
  actions: {
    async getProducts() {
      const products = await api.fetchProducts();
      this.products = products;
    },
    async addProductToCart(product) {
      const productFound = this.cart.find((p) => p.id == product.id);
      if (productFound) {
        // Do nothing
      } else {
        // 1. Save product to cart at backend
        const result = await api.addProductToCart(product.id, 17);
        if (result) {
          // 2. After success, add product to cart in frontend: so we can render the interface correctly
          this.cart.push(product);
        }
      }
    },
    async removeProductFromCart(product) {
      const result = await api.removeProductFromCart(product.id, 17);
      if (result) {
        this.cart = this.cart.filter((p) => p.id != product.id);
      }
    },
    async getProductsFromCart() {
      const cart = await api.getProductsFromCart();
      for (const product of cart) {
        const productFound = this.products.find(
          (p) => p.id == product.product_id
        );
        this.cart.push(productFound);
      }
    },
  },
});
