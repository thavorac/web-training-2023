<template>
    <div class="container">
            <p> Qty :</p>
            <button v-if="color" :style="{background: color}">-</button>
            <p class="bg">50</p>
            <button v-if="color" :style="{background: color}">+</button>
    </div>

</template>

<script>
export default {
    name : "Qty",
    props :["color"],
    data(){
        return {
            
        }
    }
}
</script>


<style scoped>
.container{
    width : 143.88px;
    height: 26px;
    display: flex;
    justify-content: space-between;
    background-color:#F8F8F8 ;
    border-radius: 3px;
    
    /* align-items: center; */
}
button{
    border: none;
    border-radius: 5px;
    width: 30px;
    font-weight: 700;
    /* font-size: 1rem; */
}


</style>