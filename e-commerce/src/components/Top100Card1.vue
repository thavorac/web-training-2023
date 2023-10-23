<template>
    <div class="container">
        <div class="pic">
            <img :src="top100Img1" alt="">
        </div>
        <div class="content">
            <div class="category">
                <div class="text">
                    <p class="f-text">{{  productName }}</p>
                    <p class="s-text">{{  productTitle }}</p>
                </div>
                <div class="icon">
                    <svg style="color: black;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                </div>
            </div>
            <div class="star">
                <span class="img"><img src="../assets/image/star.png" alt=""></span>
                <span style="padding-left: 20px; position:absolute; top: 1px;">{{  rate }}</span>
            </div>  
            <div>
                <!-- <PricingBtn style="margin-top: 5px; margin-left: -14px;" discountBtn="-10%" newPriceBtn="$228" fullPriceBtn="$290"></PricingBtn> -->
                <PricingBtn style="margin-top: 5px; margin-left: -14px;" :discountBtn="disPrice" :newPriceBtn="newPrice" :fullPriceBtn="fullPrice"></PricingBtn>
            </div>
        </div>
    </div>
</template>

<script>
import PricingBtn from './basic/PricingBtn.vue';
    export default{
        name: 'Top100Card1',
        props:['top100Img1' , 'productName','productTitle','rate','fullPrice','disPrice','newPrice'],
        data(){
            return {

            }
        },
        components:{
            PricingBtn,
        }

    }
</script>

<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    *{
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
    }
    .container{
        width: 300px;
        height: 480px;
        box-shadow: 0px 0px 12px 0px #0000001A;
    }
    .container .pic{
        width: 300px;
        height: 327px;
        border-radius: 8px 8px 0px 0px;
    }
    .container .content{
        width: 300px;
        height: 153px;
        padding: 20px;
        gap: 12px;
        color: #FFFFFF;
    }
    .container .content .category{
        width: 260px;
        height: 44px;
        gap: 80px;
        display: flex;
    }
    .container .content .category .text{
        width: 160px;
        height: 44px;
        gap: 4px;
    }
    .container .content .category .text .f-text{
        width: 38px;
        height: 20px;
        font-size: 12px;
        font-weight: 700;
        line-height: 20px;
        color: #262626;
        font-family: 'Lato', sans-serif;
    }
    .container .content .category .text .s-text{
        width: 160px;
        height: 20px;
        font-size: 10px;
        font-weight: 400;
        line-height: 25px;
        font-family: 'Lato', sans-serif;
        color: black;
    }
    .container .content .category .icon{
        width: 20px;
        height: 18px;
        border: 1.5px; 
        padding-top: 10px;  
    }
    .container .content .star{
        width: 260px;
        height: 25px;
        gap: 12px;
        position: relative;
        line-height: 25px;
    }
    .container .content .star .img{
        width: 120px;
        height: 24px;     
    }
    .container .content .star .img img{
        
    }
    .container .content .star span{
        width: 29px;
        height: 25px;
        font-size: 12px;
        font-weight: 400;
        line-height: 25px;
        text-align: center;
        color: #555555;
        
        
        
        /* padding-left: 5px; */
        /* padding-left: 30px; */
        
    }
</style>