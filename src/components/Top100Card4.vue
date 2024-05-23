<template>
    <div :style="{ height: height }" class="container">
        <div :style="{ backgroundColor: color }" class="text">
            <section>
                <p class="first-text">{{ category }}</p>
                <p class="second-text"> {{ nameProduct }}</p>
            </section>
            <p class="third-text"><a href="#">Exlopre all category</a></p>
        </div>

        <img :src="imageTopCard4" alt="">

    </div>

</template>

<script setup>


import { defineProps } from 'vue';
const props = defineProps({
    nameProduct: String,
    category: String,
    imageTopCard4: String,
    color: String,
    height: String
});

const data = {};
</script>



<style scoped>
.container {
    width: 620px;
    height: 383px;
    display: flex;
    margin: 0px;
}

.text {
    width: 310px;
    height: 383px;
    padding: 68px 20px;
    gap: 31px;
    background-color: #BF2E3B;
    display: flex;
    flex-direction: column;
    justify-content: center;

}

section {
    width: 270px;
    height: 180px;
    gap: 16px;
}

.image {
    width: 310px;
    height: 383px;
}

.first-text {
    width: 270px;
    height: 92px;
    font-size: 34px;
    font-weight: 800;
    line-height: 46px;
    font-family: 'Lato', sans-serif;
    color: #FFFFFF;
}

.second-text {
    margin-top: 16px;
    width: 270px;
    height: 72px;
    font-family: 'Lato', sans-serif;
    font-weight: 400;
    font-size: 28px;
    line-height: 36px;
    color: #FFFFFF;

}

.third-text {
    width: 270px;
    height: 36px;

}

.third-text a {
    font-family: 'Lato', sans-serif;
    font-size: 20px;
    font-weight: 400;
    line-height: 36px;
    color: #FFFFFF;
    text-decoration: underline;

}
</style>