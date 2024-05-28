<template>
    <li class=" px-14 w-full ">
        <RouterLink :to="{ path: `${link}` }"
            :class="` ${'text-black'} no-underline text-lg ps-4 w-full  duration-200 transition-all space-x-6 px-2 flex items-center ${isActive ? 'text-white' : ''}`">
            <div :class="`px-2 py-2 w-full  ${className}`">
                <span class=" text-left  ps-2 pr-10 font-semibold font-sans">{{ title }}</span>
            </div>
        </RouterLink>
    </li>
</template>
<script setup lang="ts">
import { computed } from 'vue';
import type { RouteLocationNormalizedLoaded } from 'vue-router';

const props = defineProps<{ title?: string, link: string, route?: RouteLocationNormalizedLoaded, className?: string }>()
const isActive = computed(() => props.route?.path.match(props.link));
</script>