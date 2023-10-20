<template>

    <div class="container">
        <div class="arrow-left-right">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                 <path strokeLinecap="round" strokeLinejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>

        </div>
        <div class="txt">
            <p class="upper">MAGSAFE</p>
            <p class="lower">Snap on a magnetic case, wallet, or both. And get faster wireless charging.</p>
        </div>
        <div class="img">
            <img src="../assets/image/Iphone.png" alt="">
        </div>   
        <div class="arrow-left-right">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>

        </div>
    </div>

</template>

<script>
import '@fortawesome/fontawesome-free/css/all.css';
    export default{
        name: 'Banner',
        props:["title" , "detail","image"],
        data(){
            return{

            }
        }
    }

</script>

<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
    .container{
        width: 991px;
        height: 221px;
        padding: 0px 90px;
        gap: 70px;
        background-color: #F7DDD0;
        display: flex;
        flex-direction: row;
        justify-content: center;
    }
    .container .txt{
        width: 268.5px;
        height: 122px;
        gap: 16px;
        position: relative;
        top: 52px;
    }
    .container .txt .upper{
        width: 268.5px;
        height: 20px;
        font-size: 24px;
        font-weight: 700;
        letter-spacing: 0.5px;
        line-height: 20px;
        color: #465D6B;
        font-family: 'Lato', sans-serif;

       
    }
    .container .txt .lower{
        width: 268.5px;
        height: 84px;
        font-size: 20px;
        font-weight: 500;
        line-height: 28px;
        color: #555555;
        padding-top: 15px;
        font-family: 'Lato', sans-serif;

    }
    .container .img{
        width: 268.5px;
        height: 221px;
    }
    .container .arrow-left-right{
        width: 32px;
        height: 32px;
    }
    .container .arrow-left-right img{
        width: 12.33px;
        height: 20.33px;
        position: relative;
        top: 100.33px;
        left: 10.67px;
        color: #434343;
        right: 10px;
    }
    .container .arrow-left-right svg{
        margin-top: 91px;
    }


</style>