<template>
    <div class="card1"> 
        <div class="top"> </div>
        <div class="mid">
            <img :src="top100Card" alt="">
        </div>
        <div class="down">
            <img src="../assets/img/Vector.png" alt="">
            <p class="Mago">{{ brandName }}</p>
            <p class="text1">{{ detail }}</p>
            <p class="icon">
                <img src="../assets/img/star.png" alt="">
                <span>(289)</span>
            </p>
            <p class="last">
                <span class="red">$228</span>
                <span class="delete">$290</span>
                <span class="discound">-10%</span>
            </p>
        </div>    
    </div>
</template>

<script>
    export default {
        name: 'ProductCard',
        props:['brandName', 'detail','top100Card'],
        data(){
            return {
               
            }
        }

    };

</script>


<style scoped>
    .card1{
        width:300px;
        height:480px;
        top: 793px;
        left: -461px;
        border-radius: 8px;
        /* background-color: black; */
        box-shadow: 0px 0px 12px 0px #0000001A;


    }
    .card1 .down{
        /* background-color: pink; */
        width: 300px;
        height: 153px;
        padding: 20px;
    }
    .down img{
        float: right;

    }
    .down .red{
        color: red;
        font-weight: 800;
        font-size: 14px;
        line-height: 20px;
    }
    .down .delete{
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        text-decoration: line-through;
    }
    .down .discound{
        width: 28px;
        height: 20px;
        size: 12px;
        color: rgba(255, 46, 0, 1);
        font-weight: 400;
    }
    .down .icon{
        width: 260px;
        height: 25px;
        display: flex;
        gap: 3px;
    }
    .down .icon span{
        width: 29px;
        height: 25px;
        font-weight: 400;
        font-size: 12px;
        line-height: 25px;
        text-align: center;
    }
    .down .icon img{
        width: 120px;
        height: 24px;
    }
    .down .Mago{
        width: 38px;
        height: 20px;
        font-weight: 700;
        font-size: 12px;
        line-height: 20px;
    }
    .down .text1{
        width: 160px;
        height: 20px;
        font-weight: 400;
        font-size: 10px;
        line-height: 20px;
    }
    .down .icon span{
        width: 29px;
        height: 25px;
    }

    .down .last{
        width: 260px;
        height: 20px;

    }
    .down .last{
        display: flex;
        /* justify-content:space-between; */
        gap: 12px;
        /* align-tracks: center; */
       
    }
    
</style>