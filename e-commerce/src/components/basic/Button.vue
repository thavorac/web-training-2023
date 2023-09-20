<template>
  <div>
    <div v-if="color" :style="{ background: color }">
      {{ icon }} | {{ text }}
    </div>
    <div v-else class="outline">{{ icon }} | {{ text }}</div>
  </div>
</template>

<script>
export default {
  props: ["text", "icon", "color"],
};
</script>

<style>
.outline {
  border: 1px solid grey;
  border-radius: 5px;
}
</style>
