<template>
    <div class="container">
        <div class="image">
            <img :src="image" alt="">
        </div>
        <div class="content">
            <div class="text">
                <p class="first-text">{{ category }}</p>
                <p class="second-text">{{ nameProduct }}</p>
            </div>
            <div class="button">
                <Button :color="blue" :icon="price" style="margin-top: 8px;"></Button>
            </div>
        </div>
    </div>

</template>

<script>
import Button from './basic/Button.vue';
export default {
    name: 'Trending(1)',
    props: ["isNew","image","price","nameProduct","category"],
    data(){
            return{

            }
    },
    components:{
        Button,
    }
};

</script>

<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    .container{
        width: 406.67px;
        height: 437px;
    }
    .image{
        width: 406.67px;
        height: 344px;
        border-radius: 8px 8px 0px 0px;
    }
    .content{
        background-color: yellow;
        width: 406.67px;
        height: 93px;
        border-radius: 0px 0px 8px 8px;
        padding: 20px;
        background-color: #262626;
        display: flex;
    }
    .text{
        width: 220.67px;
        height: 58px;     
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .text .first-text{
        width: 220.67px;
        height: 25px;
        font-size: 16px;
        font-weight: 700;
        line-height: 25px;
        color: #FFFFFF;
        font-family: 'Lato', sans-serif;

    }
    .text .second-text{
        width: 220.67px;
        height: 20px;
        opacity: 85%;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        color: #C4C4C4;
        font-family: 'Lato', sans-serif;

    }
    .button{
        width: 146px;
        height: 44px;
        border: 1px;
        /* background-color: white; */
    }

</style>