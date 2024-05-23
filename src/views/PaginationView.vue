<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" @click="goToPrevious" :disabled="currentPage === 1">Previous</a>
            </li>
            <li v-for="page in totalPages" :key="page" :class="{ 'page-item': true, 'active': currentPage === page }">
                <a class="page-link" href="#" @click="goToPage(page)">{{ page }}</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" @click="goToNext" :disabled="currentPage === totalPages">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    totalPages: Number,
    currentPage: Number
});

const emits = defineEmits(['goToPage']);

const goToPage = (page) => {
    emits('goToPage', page); // Emitting the event using `emits` function
}

const goToPrevious = () => {
    if (props.currentPage > 1) {
        goToPage(props.currentPage - 1);
    }
}

const goToNext = () => {
    if (props.currentPage < props.totalPages) {
        goToPage(props.currentPage + 1);
    }
}
</script>

<style scoped>
/* Add your component-specific styles here */
.pagination {
    margin-top: 20px;
}

.pagination .page-link {
    cursor: pointer;
}
</style>
