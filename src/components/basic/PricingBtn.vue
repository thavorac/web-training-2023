<template>
    <p class="pricing_btn">
        <span class="red_btn">{{ newPriceBtn }}</span>
        <span class="delete_btn">{{ fullPriceBtn}}</span>
        <span class="disc_btn">{{ discountBtn }}</span>
    </p>

</template>

<script>

    export default{
        name: 'PricingBtn',
        props:['newPriceBtn', 'fullPriceBtn','discountBtn'],
        data(){
            return{

            }
        }
    }
</script>

<style scoped>
 @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

 .pricing_btn {
    margin: 40px;
 }
 .pricing_btn span{
    padding-left: 15px;  
      
}
.pricing_btn .red_btn{
    color: rgba(255, 46, 0, 1);
    font-weight: 800;
    font-size: 14px;
    line-height: 20px;
    font-family: 'Lato', sans-serif;
    }
.pricing_btn .delete_btn{
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
    text-decoration: line-through;
    color: rgba(157, 157, 157, 1);
    font-family: 'Lato', sans-serif;
    }
    .pricing_btn .disc_btn{
       widows: 28px;
       height: 20px;
       font-family: 'Lato', sans-serif;
       font-weight: 400;
       font-size: 12px;
       line-height: 20px;
       color: rgba(255, 46, 0, 1);

    }
</style>