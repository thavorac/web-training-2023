<template>
    <div class="card1"> 
        <div class="top">
            <p>DEAL OF THE DAY</p>
            <figure>
                <img src="../assets/image/date.png" alt="">
            </figure>

        </div>
        <div class="mid">
            <img src="../assets/image/mid.png" alt="">
        </div>
        <div class="down">
            <p>{{ productcard }}</p>
            <p class="text1">{{ ptag }}</p>
            <p class="icon">
                <img src="../assets/image/stars.png" alt="">
                <span>(54)</span>
            </p>
            <p class="pricing">
                <span class="red">$69.99</span>
                <span class="delete">$129.99</span>
                <span><button>-40%</button></span>
            </p>
        </div>    
    </div>
</template>

<script>
    export default {
        name: 'ProductCard',
        data(){
            return {
                productcard:'Tonny Black',
                ptag : 'Shoulder bag-White-Plain'
            }
        }

    };

</script>


<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    .card1{
        width:300px;
        height:380px;
        margin-top: 80px;
        padding-left: -461px;
        border-radius: 8px;
        /* background-color: black; */
        box-shadow: 0px 0px 12px 0px #0000001A;


    }
    .card1 .top{
        width: 300px;
        height:90px;
        padding: 16px, 0px, 16px, 0px;
        justify-content: space-between;
        /* background-color: green; */

    }
    .card1 .mid{
        /* background-color: yellow; */
        width: 300px;
        height: 130px;
        padding: 17px, 30px, 16px, 29px;
        gap: 10px;
    }
    .card1 .down{
        /* background-color: pink; */
        width: 300px;
        height: 128px;
        padding: 16px, 40px, 16px, 40px ;
    }
    .card1 .mid img{
        width: 241px;
        height: 129px;
        margin-left: 29px;

    }
    .down .red{
        font-family: 'Lato', sans-serif;
        color: red;
        font-weight: 700;
        line-height: 20px;
    }
    .down .delete{
        font-family: 'Lato', sans-serif;
        font-size: 12px;
        font-weight: 400;
        line-height: 20px;
        text-decoration: line-through;
    }
    .down button{
        font-family: 'Lato', sans-serif;
        width: 33px;
        height: 16px;
        border-radius: 2.06px;
        padding: 3px, 6px , 3px, 6px;
        gap: 4px;
        background: rgba(255, 46, 0, 1);
        border: none;
        font-size: 8px;
        color: white;
        font-weight: 600;
    }
    .down p{
        width: 151px;
        height: 25px;
        margin: 0px auto;
        line-height: 20px;  
        padding-left: 13px;
        padding-top: 10px;
    }

    .down p:first-child{
       font-size: 16px;
       font-weight: 700;
       line-height: 25px;
       font-family: 'Lato', sans-serif;
       
    }
    .down .text1{
        font-size: 12px;
        font-weight: 400;
        line-height: 25px;
        font-family: 'Lato', sans-serif;
    }
    .down .pricing{
        font-family: 'Lato', sans-serif;
        display: flex;
        justify-content:space-between;
        align-items: center;
       
    }
    .down .icon span{
        font-size: 12px;
        font-weight: 400;
        padding-left: 5px;


    }
    .top p{
        font-size: 14px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-align: center;
        color: rgba(157, 157, 157, 1);
        padding-top: 20px;
        font-family: 'Lato', sans-serif;

    }
    .top figure img{
        padding-left: 89px;
        padding-top: 2px;

    }



</style>