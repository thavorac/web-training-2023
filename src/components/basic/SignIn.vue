<script setup>
import IconPerson from "../icons/IconPerson.vue";
// Import the necessary components
import { defineProps } from 'vue';

// Define props for the icon and text
const props = defineProps({

    text: {
        type: String,
        default: "Sign in" // Default text
    }
});
</script>
<template>
    <div class="d-flex gap-1 text-white">
        <slot></slot>
        <span>{{ props.text }}</span>
    </div>
</template>