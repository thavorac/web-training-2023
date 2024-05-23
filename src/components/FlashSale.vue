<script setup>
import ChevronRight from '@/components/icons/ChevronRight.vue';
// Import the necessary components
import { defineProps } from 'vue';

// Define props for the icon and text
const props = defineProps({

    text: {
        type: String,
        default: "Flash Sales" // Default text
    }
});
</script>

<template>
    <div class="container-fluid">
        <div class="row pt-4 ps-4">
            <div class="col-sm-6">
                <p class="text-2xl font-medium">{{ text }}</p>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-2">
                <p class="absolute text-xs ms-24">View all
                    <ChevronRight width="4" color="black" class="float-end" />
                </p>
            </div>
        </div>
    </div>
</template>