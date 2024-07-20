<template>
    <div class="ButtonShipping">
        <slot></slot>
        {{ text }}
    </div>
</template>

<script>
export default {
    name: 'ButtonShipping',
    props: ["text"],
    data() {
        return {

        }
    }
}


</script>
<style scoped>
.ButtonShipping {
    display: flex;
    /* justify-content: center;
    align-items: center; */
    gap: 12px;
    font-weight: 500;
    color: #5E5873;
}
</style>
