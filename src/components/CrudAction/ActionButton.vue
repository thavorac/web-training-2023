<template>
    <td class="px-6 py-6 flex space-x-2">
        <IconEdit class="w-6 h-6 text-blue-500 cursor-pointer" @click="handleEdit" />
        <IconDelete class="w-6 h-6 text-red-500 cursor-pointer" @click="handleDelete" />
        <IconDetail class="w-6 h-6 text-green-500 cursor-pointer" @click="handleDetail" />
    </td>
</template>

<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';
import IconEdit from '../icons/IconEdit.vue';
import IconDelete from '../icons/IconDelete.vue';
import IconDetail from '../icons/IconDetail.vue';

interface Product {
    id: number;
    name: string;
    description: string;
    qty: number;
    date: string;
    revenue: number;
    netProfit: number;
    status: string;
}

const props = defineProps<{ product: Product }>();
const emits = defineEmits(['edit', 'delete', 'detail']);

const handleEdit = () => {
    emits('edit', props.product);
};

const handleDelete = () => {
    emits('delete', props.product);
};

const handleDetail = () => {
    emits('detail', props.product);
};
</script>
