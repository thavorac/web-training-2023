<template>
    <div class="signIn">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <span>{{text}}</span>
    </div>
  

</template>

<script>

    export default{
        name: 'MenuItem',
        props:["icon", "text"],
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
.signIn svg{
    width: 24px;
    height: 24px;
    color: white;
    
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