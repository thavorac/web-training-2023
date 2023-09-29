<template>
    <div class="signIn">
        <img src="../../assets/image/Sign in.png" alt="">
        <span>Sign in</span>
    </div>
  

</template>

<script>

    export default{
        name: 'MenuItem',
        data(){
            return{

            }
        }
    }
</script>

<style scoped>
 @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');


.signIn{   
    width: 243px;
    background-color: black;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 10px;
    border-radius: 8px;
}
.signIn img{
    width: 24px;
    height: 24px;
    
}
.signIn span{
    padding-left: 5px;
    font-family: 'Lato', sans-serif;
    font-weight: 400;
    font-size: 14px;
    line-height: 20px;
    color: rgba(255, 255, 255, 1);

}
</style>