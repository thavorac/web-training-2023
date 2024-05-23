<template>
    <div class="top100">
        <div class="text">
            <aside class="ftext">Flash Sales</aside>
            <aside class="view-all">
                <p class="all">View all</p>
                <p class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                         <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </p>
            </aside>
        </div>
    </div>
</template>

<script>
    export default{
        name:'Viewall',
        data(){
            return{

            }
        }
    }
</script>

<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    .top100{
        width: 1440px;
        height: 548px;
        padding: 0px 90px;
        gap: 48px;
    }
    .top100 .text{
        width: 1260px;
        height: 20px;
        display: flex;
    }
    .top100 .text .ftext{
        width: 332.47px;
        height: 20px;
        left: 90px;
        font-size: 28px;
        font-weight: 500;
        line-height: 20px;
        font-family: 'Lato', sans-serif;
        color: #000000;
    }
    .top100 .text .view-all{
        width: 58px;
        height: 20px;
        left: 1292px;
        display: flex;
        margin-left: 889px
    }
    .top100 .text .view-all .all{
        width: 42px;
        height: 20px;
        font-size: 12px;
        font-weight: 400;
        line-height: 20px;
        text-align: right;
        font-family: 'Lato', sans-serif;
        color: #262626;
    }
    .top100 .text .view-all .icon{
        width: 16px;
        height: 16px;
        rotate: 0;
    }
    svg {
        width: 21px;
        height: 14px;
        font-weight: 500;
    }
    /* .flash-sale .text .view-all .icon svg{
        width: 6.67px;
        height: 2.67px;
        top: 4.67px;
        left: 6.67px;
        position: relative;
        
    } */
</style>