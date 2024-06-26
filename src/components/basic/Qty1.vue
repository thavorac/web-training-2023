<template>
    <div class="wrapper">
      <span class="qty" style="padding-right: 10px;"> Qty : </span>
      <span class="minus" @click="decrement">-</span>
      <span class="num">{{ quantity }}</span>
      <span class="plus" @click="increment">+</span>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Qty1',
    data() {
      return {
        quantity: 1
      };
    },
    methods: {
      increment() {
        if (this.quantity < 10) {
          this.quantity++;
        }
      },
      decrement() {
        if (this.quantity > 0) {
          this.quantity--;
        }
      }
    }
  }
  </script>
  
  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
  *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
  }
  /* body{
      display: flex;
      align-items: center;
      justify-content: center;
      background: #343F4F;
  } */
  .wrapper{
      width: 180px;
      height: 35px;
      display: flex;
      /* align-items: center;
      justify-content: center; */
      /* background: #F8F8F8; */
      border-radius: 12px;
      /* box-shadow: 0 5px 10px rgba(0,0,0,0.2); */
  }
  .wrapper span{
      text-align: center;
      font-size: 15px;
      font-weight: 300;
      cursor: pointer;
      /* width: 20px; */
      /* background: #ddd; */
  }
  .wrapper span.num{
      font-size: 20px;
      /* border-right: 2px solid rgba(0,0,0,0.2);
      border-left: 2px solid rgba(0,0,0,0.2); */
      padding: 0 18px; /* Added padding */
      pointer-events: none;
  }
  .minus,.plus{
    background: rgb(115, 103, 240);
    width: 25px;
    height: 25px;
    /* height: 45px; */
    border-radius: 5px;
  }
  .qty{
    font-size: 20px;
  }
  </style>
  