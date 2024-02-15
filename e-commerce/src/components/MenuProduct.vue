<template>
  <div class="menu">
    <a v-for="category in categories" href="#">{{ category.name }}</a>
  </div>
</template>
<script>
import { mapState } from "pinia";
import { useGeneralStore } from "../stores/general";
export default {
  name: "MenuProduct",
  data() {
    return {};
  },
  computed: {
    ...mapState(useGeneralStore, ["categories"]),
  },
};
</script>
<style>
.menu {
  /* width: 1440px; */
  width: 1518px;
  height: 52px;
  justify-content: space-evenly;
  padding: 16px;
  display: flex;
}
.menu a {
  color: black;
}
a:hover {
  color: rgba(255, 122, 0, 1);
  background: white;
}
</style>
