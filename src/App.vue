<template>
  <!-- <div>
    <div class="product_card">
      <ProductCard new_price="$123" full_price="$131" discount_price="10%" rating="(54)" brandName="Tonny Black"
        detail="Shoulder bag-White-Plain" :productCardimage="productCardimage" />
      <ProductCard new_price="$113" full_price="$142" discount_price="13%" rating="(100)" brandName="Reebok"
        detail="Women's Powder sneaker" :productCardimage="shoesMid1" />
      <ProductCard new_price="$101" full_price="$321" discount_price="21%" rating="(83)" brandName="Patso"
        detail="Shoulder bag-Pink-Plain" :productCardimage="shoesMid2" />
      <ProductCard new_price="$141" full_price="$114" discount_price="25%" rating="(29)" brandName="Sketchers"
        detail="Sport-shoe 2102" :productCardimage="shoesMid3" />
    </div>
  </div> -->
  <div>
    <RouterView />
  </div>
  <!-- <PricingBtn newPriceBtn="231$" fullPriceBtn="500$" discountBtn="20%" /> -->
  <!-- <AddToCardButton /> -->
  <!-- <WishListView />
  <DetailView class="" /> -->
  <!-- <ElectronicView /> -->
  <recipe />
</template>

<script>
import { mapState } from 'pinia';
import { useGeneralStore } from '@/stores/general';

export default {
  name: 'App',
  computed: {
    ...mapState(useGeneralStore, ["categories"]),
    ...mapState(useGeneralStore, ["advertisement"]),
  },
  methods: {},
};
</script>

<style scoped>
header {
  line-height: 1.5;
  max-height: 100vh;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }

  nav {
    text-align: left;
    margin-left: -1rem;
    font-size: 1rem;
    padding: 1rem 0;
    margin-top: 1rem;
  }
}
</style>
