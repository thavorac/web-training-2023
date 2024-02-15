<template>
    <div class="container1">
        <div v-if="isNew" class="parent">
            <div class="top_parent">
                <div class="text_parent">
                    <div class="name_parent">
                        <p>{{ advertisement.category }}</p>
                    </div>
                    <div class="dis_parent">
                        <p>{{ advertisement.discount }} off</p>
                    </div>
                </div>
            </div>
            <div class="bottom_parent">
                <div class="date">
                    {{advertisement.until}}
                </div>
            </div>
        </div>
        <div class="container">
        <div class="left">
            <img :src="advertisement.image" alt="Advertisement Image" />
        </div>
        <div class="right">
            <div class="name">
               <p>{{ advertisement.title }}</p>
            </div>
            <div class="cost">
                <p>{{advertisement.description}}</p>
            </div>
            <div>
                <Button style="margin-left: 340px;" color="#4172DC" text="Shop Now"></Button>
            </div>
        </div>

    </div>
    </div>
</template>

<script>
import Button from './basic/Button.vue';
import { mapState } from "pinia";
import { useGeneralStore } from "../stores/general";
    export default{
        name:'Advertising',
        props: ['isNew','discount'],
        data(){
            return{

            }
        },
        components:{
            Button,
        },
        computed: {
            ...mapState(useGeneralStore, ["advertisement"]),
        },
    }

</script>

<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    *{
        padding: 0px ;
        margin: 0px;
        box-sizing: border-box;
    }
    .container{
        /* width: 1440px; */
        width: 100%;
        height: 460px;
        display: flex;
    }
    .container .left{
        /* width: 547px; */
        width: 36%;
        height: 460px;
    }
    .container .right{
        /* width: 893px; */
        width: 64%;
        height: 460px;
        gap: 32px;
        background-color: #6386d1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        z-index:1;
    }
    .container .right .name{
        width: 893px;
        height: 50px;
        font-size: 32px;
        font-weight: 700;
        line-height: 50px;
        text-align: center;
        color: #FFFFFF;
        font-family: 'Lato', sans-serif;

    }
    .container .right .cost{
        width: 893px;
        height: 50px;
        top: 202px;
        font-size: 28px;
        font-weight: 500;
        line-height: 50px;
        text-align: center;
        color: #FFFFFF;
        font-family: 'Lato', sans-serif;

    }
    .container1 .parent{
        width: 228px;
        height: 163px;
        position: absolute;
        margin-top: 143px;
        margin-left:435px;
        z-index:100;
        
    }
    .container1 .parent .top_parent{
        width: 228px;
        height: 123px;
        padding: 36px 30px 36px 30px;
        background-color: #FFFFFF;
        
    }
    .container1 .parent .bottom_parent{
        width: 228px;
        height: 40px;
        padding: 10px 75px 10px 75px;
        background-color: #262626;
    }
    .container1 .parent .top_parent .text_parent{
        width: 168px;
        height: 51px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .container1 .parent .top_parent .text_parent .name_parent p{
        width: 166px;
        height: 20px;
        font-size: 20px;
        font-weight: 700;
        line-height: 20px;
        padding: 0px;
        text-align: center;
        color: #262626;
        font-family: 'Lato', sans-serif;

    }
    .container1 .parent .top_parent .text_parent .dis_parent p {
        width: 71px;
        height: 20px;
        font-size: 20px;
        font-weight: 700;
        line-height: 30px;
        text-align: right;
        color: #FF2E00;
        padding: 0px;
        margin: 0px auto;
        font-family: 'Lato', sans-serif;

       
    }

    .container1 .parent .bottom_parent .date{
        width: 78px;
        height: 20px;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        text-align: center;
        color: #FFFFFF;
    }
</style>
