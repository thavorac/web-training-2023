<template>
    <div class="container">
      <div class="time">
         <div class="get">
            <p>{{ currentHour }} 
                <span>:</span>
            </p> 
           <span>hour</span>
         </div>
         <div class="get">
            <p>{{ currentMinute }}
                <span>:</span>

            </p>
            <span>min</span>

         </div>
         <div class="get">
            <p> {{ currentSecond }}</p>
            <span>sec</span>
         </div>
        <!-- <p>Hour: {{ currentHour }}</p>
        <p>Minute: {{ currentMinute }}</p>
        <p>Second: {{ currentSecond }}</p> -->
      </div>
      <div class="title">

      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        currentHour: 0,
        currentMinute: 0,
        currentSecond: 0,
      };
    },
    created() {
      // Update the time every second
      this.updateTime();
      setInterval(this.updateTime, 1000);
    },
    methods: {
      updateTime() {
        const now = new Date();
        this.currentHour = now.getHours();
        this.currentMinute = now.getMinutes();
        this.currentSecond = now.getSeconds();
      },
    },
  };
  </script>

<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
.container{
  width: 117px;
}
.time{
    width: 117px;
    height: 45px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    /* background-color: pink; */
    
}
.time .get p{
    font-size: 18px;
    font-weight: 800;
    line-height: 30px;
    text-align: center;
    color: #262626;
    font-family: 'Lato', sans-serif;


}
.time .get p span{
    width: 2.8px;
    height: 12.6px;
    color: #C4C4C4;
    padding-left: 5px;
    font-family: 'Lato', sans-serif;

}
.time .get span {
    width: 25px;
    height: 15px;
    font-size: 12px;
    font-weight: 400;
    text-align: center;
    line-height: 15px;
    color: #9D9D9D;
    font-family: 'Lato', sans-serif;

}


 
</style>
  