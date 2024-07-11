<template>
    <div>
        <div class="fill" v-if="color"
            :style="{ background: color, color: colorText, width: width, height: height, borderRadius: raduis, gap: gap, border: border }">
            <slot></slot>
            {{ text }}
        </div>
        <!-- <div v-else class="outline">
       <span style="margin-right: 10px; font-weight: 700;">  </span> 
       {{text}}
       </div> -->
    </div>

</template>

<script>
export default {
    name: 'AddToCardButton',
    props: ["color", "icon", "text", "colorText", "width", "height", "raduis", "gap", "border"],
    data() {
        return {

        }
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

.fill {
    width: 167px;
    height: 38px;
    padding: 16px;
    /* border-radius: 4px; */
    gap: 8px;
    font-size: 14px;
    letter-spacing: 1px;
    /* font-weight: 700; */
    line-height: 20px;
    color: rgba(255, 255, 255, 1);
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Lato', sans-serif;
}
</style>