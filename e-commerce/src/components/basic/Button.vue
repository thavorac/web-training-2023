<template>
  <div>
    <div class="fill" v-if="color" :style="{ background: color } ">
      <img style="width: 24px; height: 24px;" src="../../assets/Icon.png" alt="">
      <span style="font-weight: 700;">{{ images }}</span>
      {{ text }}
    </div>
    <div v-else class="outline">
      <span style="margin-right: 10px; font-weight: 700;">{{ icon }}</span> 
      {{text}}
    </div>
  </div>
</template>

<script>
export default {
  name: 'Button',
  props:["color","icon"],
  data(){
    return { 
      text :"Shop Now",
    
    }
  }
};
</script>

<style scoped>
 @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

.outline{
  border: 1px solid #D9D9D9;
  width: 146px;
  height: 44px;
  padding-top:10px ;
  border-radius: 8px;
  text-align: center;
  font-family: Lato;
  font-size: 14px;
  font-weight: 700;
  background: #262626;
  color: #FFFFFF;
  font-family: 'Lato', sans-serif;
  gap: 8px;


}
.fill{
  width: 243px;
  height: 56px;
  padding:16px  ;
  border-radius: 4px;
  gap: 8px;
  font-size: 14px;
  font-weight: 500;
  line-height: 20px;
  color: rgba(255, 255, 255, 1);
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: 'Lato', sans-serif;
}


</style>
