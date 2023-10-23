<template>
    <br><br>
    <div class="container">
        <div class="row1">
           
         <div class="payment">
            <span class="logo1"><img src="../assets/image/Logo 1.png" alt=""></span>
            <span class="logo2"><img src="../assets/image/Logo 2.png" alt=""></span>
            <span class="logo3"><img src="../assets/image/Logo 3.png" alt=""></span>
        
            <div class="row1-right">
                <span class="text">
                    <select>
                        <option value="">English</option>
                        <option value="french">French</option>
                    </select>
                </span>
              

            </div>
            </div>

        </div>
        <div class="devider">
            <hr>
        </div>
        <div class="row2">
            <div class="address">
                <p>165-179 Forster Road City of Monash, Melbourne, Australia</p>
            </div>
            <div class="copyright">
                <p>©2023 Copyright in reserved for lumine shop</p>
            </div>
            <div class="social-media">
                <span class="instagram"><img src="../assets/image/instagram(1).png" alt=""></span>
                <span class="fb"><img src="../assets/image/facebook(1).png" alt=""></span>
                <span class="telegram"><img src="../assets/image/telegram(1).png" alt=""></span>

            </div>

        </div>

    </div>

</template>

<script>
    export default{
        name: 'Footer',
        data(){
            return{

            }
        },
    }

</script>

<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    .row1-right .text select,option{
        border: none;
        font-family: 'Lato', sans-serif;

    }
    .container{
        width: 1440px;
        height: 173px;
        padding: 24px 100px;
        gap: 12px;
        background-color: #FFFFFF;
        display: flex;
        flex-direction: column;
        /* justify-content: center; */
    }
    .container .row1{
        width: 1240px;
        height: 30px;
        gap: 46px;
        display: flex;
        flex-direction: row;

    }
    .container .row1 .row1-left{
        width: 1071px;
        height: 30px;
    }
    .container .row1 .row1-right{
        width: 123px;
        height: 20px;
        gap: 20px;
        text-align: right;
        float: right;
        margin-left: 908px;
    }
    .container .row1 .row1-right .text{
        width: 108px;
        height: 20px;
        font-size: 14px;
        font-weight: 400;
        color: #262626;
    }
    .container .row1 .payment{
        width: 221px;
        height: 30px;
        gap: 28px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .container .row1 .payment .logo1{
        width: 62px;
        height: 19px;
    }
    .container .row1 .payment .logo2{
        width: 38px;
        height: 30px;
    }
    .container .row1 .payment .logo3{
        width: 71px;
        height: 19px;
    }
    .container .devider{
        width: 1240px;
        height: 2px;
        color: #D9D9D9;
    }
    .container .row2{
        width: 1240px;
        height: 69px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .container .row2 .address{
        width: 560px;
        height: 20px;
        gap: 8px;
    }
    .container .row2 .address p{
        width: 367px;
        height: 20px;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        color: #262626;
        font-family: 'Lato', sans-serif;

    }
    .container .row2 .copyright{
        width: 560px;
        height: 20px;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        color: #9D9D9D;
        font-family: 'Lato', sans-serif;

    }
    .container .row2 .social-media{
        width: 120px;
        height: 24px;
        gap: 24px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .container .row2 .social-media .instagram{
        width: 24px;
        height: 24px;
    }
    .container .row2 .social-media .instagram img{
        width: 20px;
        height: 20px;
        border-radius: 4px;
    }
    .container .row2 .social-media .fb{
        width: 24px;
        height: 24px;

    }
    .container .row2 .social-media .fb img{
        width: 12px;
        height: 18px;

    }
    .container .row2 .social-media .telegram{
        width: 24px;
        height: 24px;
    }
    .container .row2 .social-media .telegram img{
        width: 17.39px;
        height: 15.28px;

    }


 


</style>