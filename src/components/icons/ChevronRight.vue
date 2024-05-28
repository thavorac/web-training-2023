<script setup lang="ts">
const props = defineProps({
    width: {
        type: Number,
        default: 30
    },
    height: {
        type: Number,
        default: 30
    },
    color: {
        type: String,
        default: 'currentColor'
    }
});
</script>

<template>
    <div :style="{
        color: 'red',
        width: '100px',
        height: '100px'
    }">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" :stroke="color"
            :class="[`h-${props.height ?? '5'} w-${props.width ?? '5'}`]">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
    </div>
</template>