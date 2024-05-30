<script setup lang="ts">
defineProps({
    subtitle: String,
})
</script>
<template>
    <div class="p-4 w-full animate-fade">
        <div class="flex text-2xl space-x-2 font-semibold">
            <span class="text-[#58AB5D] ">
                Manage
            </span>
            <span class=" text-[#1C2A53] ">
                / {{ subtitle }}
            </span>


        </div>
        <slot></slot>
    </div>
</template>
