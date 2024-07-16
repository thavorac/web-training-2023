<template>
    <li class="flex mt-10">
        <RouterLink :to="{ path: `${link}` }"
            :class="` ${'text-black'} no-underline text-lg ps-4 w-full  duration-200 transition-all space-x-6 px-2 flex items-center ${isActive ? 'text-white' : ''}`">
            <div
                :class="` transition-all duration-200 ${isActive ? 'bg-[#58AB5D] shadow-md' : 'bg-[#3E60C9]'} p-2 rounded-md `">
                <slot></slot>
            </div>
            <span>{{ title }}</span>
        </RouterLink>
    </li>
</template>
<script setup lang="ts">
import { computed } from 'vue';
import type { RouteLocationNormalizedLoaded } from 'vue-router';

const props = defineProps<{ title?: string, link: string, route?: RouteLocationNormalizedLoaded }>()
const isActive = computed(() => props.route?.path.match(props.link));
</script>