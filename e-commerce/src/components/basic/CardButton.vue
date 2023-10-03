<template>
    <div class="container">
        <div class="btn-green">
            <div class="text">
                <div class="icon">
                    <img :src="image" alt="">
                </div>
                <div class="right-text">
                    <p v-if="isNew">New Arivals</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default{
        props: ["isNew","image","price","nameProduct","category"],
        name: 'CardButton',
        data(){
            return{

            }
        },
        components:{

        }

    };

</script>

<style scoped>
    .container{
        width: 105px;
        height: 46px;
        padding: 10px;
        gap: 10px;
    }
    .btn-green{
        width: 85px;
        height: 26px;
        border-radius: 4px;
        padding: 3px 6px;
        gap: 10px;
        background-color: #00A95D;
    }
    .text{
        width: 73px;
        height: 20px;
        gap: 4px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        position: relative;
    }
    .icon{
        width: 16px;
        height: 16px;
    }
    .right-text{
        width: 53px;
        height: 20px;

    }
    .right-text p{
        font-size: 10px;
        font-weight: 400;
        line-height: 20px;
        color: #FFFFFF;
    }
    .icon img{
        width: 13.33px;
        height: 12px;
        /* border: 1px solid white; */
        position: absolute;
        left: 1px;
        top: 4px;
    }

</style>