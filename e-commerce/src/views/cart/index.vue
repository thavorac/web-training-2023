<template>
  <div class="products-cart">
    <div class="products-list">
      <h3>Product List:</h3>
      <table width="100%">
        <tr v-for="product in products">
          <td>{{ product.id }}</td>
          <td>{{ product.name }}</td>
          <td>{{ product.pricing }}</td>
          <td>
            <button @click="addProductToCart(product)">Add To Cart</button>
          </td>
        </tr>
      </table>
    </div>
    <div class="cart">
      <h3>Item inside Cart:</h3>
      <table width="100%">
        <tr v-for="product in cart">
          <td width="50%">{{ product.name }}</td>
          <td>
            <button @click="removeProductFromCart(product)">Remove</button>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>
<script>
import { mapState } from "pinia";
import { useCartStore } from "../../stores/cart";

export default {
  setup() {
    const cartStore = useCartStore();
    return {
      cartStore,
    };
  },
  name: "ProductsCart",
  data() {
    return {};
  },
  computed: {
    ...mapState(useCartStore, ["cart", "products"]),
  },
  methods: {
    addProductToCart: function (product) {
      this.cartStore.addProductToCart(product);
    },
    removeProductFromCart: function (product) {
      this.cartStore.removeProductFromCart(product);
    },
  },
  async mounted() {
    await this.cartStore.getProducts();
    await this.cartStore.getProductsFromCart();
  },
};
</script>
<style>
.products-cart {
  display: flex;
  justify-content: space-between;
  width: 100%;
  gap: 10px;
}
.products-list {
  width: 600px;
}
.cart {
  width: 100%;
}
.products-cart td {
  border: 1px solid black;
  padding: 10px;
}
</style>
