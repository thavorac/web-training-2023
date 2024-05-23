<template>
    <p class="pricing">
        <span class="red">{{ newPrice }}</span>
        <span class="delete">{{ fullPrice}}</span>
        <span class="disc"><button>{{ discount }}</button></span>
    </p>

</template>

<script>

    export default{
        name: 'Pricing',
        props:['newPrice', 'fullPrice','discount'],
        data(){
            return{

            }
        }
    }
</script>

<style scoped>
 @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

 .pricing {
    width: 151px;
    height: 20px;
    margin: 0px;
 }
 .pricing span{
    padding-left: 15px;  
      
}
.pricing .red{
    color: rgba(255, 46, 0, 1);
    font-weight: 800;
    font-size: 14px;
    line-height: 20px;
    font-family: 'Lato', sans-serif;
    }
.pricing .delete{
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
    text-decoration: line-through;
    color: rgba(157, 157, 157, 1);
    font-family: 'Lato', sans-serif;
    }
    .pricing .disc{
       width: 28px;
       height: 20px;
       font-family: 'Lato', sans-serif;
       font-weight: 400;
       font-size: 12px;
       line-height: 20px;
       color: rgba(255, 46, 0, 1);
       

    }
    .pricing button{
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
</style>