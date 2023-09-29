<template>
    <p class="pricing">
        <span class="red">$228</span>
        <span class="delete">$290</span>
        <span class="disc">-10%</span>
    </p>

</template>

<script>

    export default{
        name: 'Pricing',
        data(){
            return{

            }
        }
    }
</script>

<style scoped>
 @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

 .pricing {
    margin: 40px;
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
       widows: 28px;
       height: 20px;
       font-family: 'Lato', sans-serif;
       font-weight: 400;
       font-size: 12px;
       line-height: 20px;
       color: rgba(255, 46, 0, 1);

    }
</style>