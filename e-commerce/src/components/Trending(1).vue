<template>
    <div class="container">
        <div v-if="isNew" class="container1">
        <div class="btn-green">
            <div class="text1">
                <div class="icon1">
                    <img src="../assets/image/Vector.png" alt="">
                </div>
                <div class="right-text1">
                    <p>New Arivals</p>
                </div>
            </div>
        </div>
    </div>
        <div class="image">
            <img :src="image" alt="">
        </div>
        <div class="content">
            <div class="text">
                <p class="first-text">{{ category }}</p>
                <p class="second-text">{{ nameProduct }}</p>
            </div>
            <div class="button">
                <Button :color="blue" :icon="price" style="margin-top: 2px;" text="Shop Now"></Button>
            </div>
        </div>
    </div>

</template>

<script>
import Button from './basic/Button.vue';
export default {
    name: 'Trending(1)',
    props: ["isNew","image","price","nameProduct","category","isNew"],
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
    .image {
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
    .container1{
        width: 105px;
        height: 46px;
        /* padding: 10px; */
        gap: 10px;
        position: absolute;
        padding-top: 10px;
        padding-left: 15px;
       
        
    }
    .btn-green{
        width: 85px;
        height: 26px;
        border-radius: 4px;
        padding: 3px 6px;
        gap: 10px;
        background-color: #00A95D;
    }
    .text1{
        width: 73px;
        height: 20px;
        gap: 4px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        position: relative;
    }
    .icon1{
        width: 16px;
        height: 16px;
    }
    .right-text1{
        width: 53px;
        height: 20px;

    }
    .right-text1 p{
        font-size: 10px;
        font-weight: 400;
        line-height: 20px;
        color: #FFFFFF;
    }
    .icon1 img{
        width: 13.33px;
        height: 12px;
        /* border: 1px solid white; */
        position: absolute;
        left: 1px;
        top: 4px;
    }


</style>