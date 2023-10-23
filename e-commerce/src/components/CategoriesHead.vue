<template>
    <div class="contain">
        <div class="left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
            </svg>
            <h4>Categories</h4>
            <div class="listDown">
                <select class="us">
                <option value="US">US</option>
                <option value="saab">Saab</option>
                </select>
                <select class="Eng">
                <option value="English">English</option>
                <option value="saab">Saab</option>
                </select>
            </div>
        </div>
        <div class="midle">
            <img src="../assets/image/category.jpg" alt="">
            <div class="TextCaption">
                <span class="text1">Weekly Men's Toiletries Coupons.</span>
                <span class="text2">We extend exclusive discounts to our male clientele</span>
            </div>
        </div>
        <div class="right">
            <!-- <div class="signIn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
               
            </div>
            <div class="signin">
                <span>Sign in</span>
            </div> -->
            <MenuItem text="Sign In"></MenuItem>
            <div class="Fav">
               
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </div>
            <div class="faverite">
            <span>Favorites</span>
            </div>
            <div class="card">
                <!-- <i class="fa-solid fa-cart-arrow-down"></i> -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
            </div>  
            <div class="card">
                <span>Card</span>
            </div>  
        </div>
    </div>
    </template>
    <script>
    import MenuItem from './basic/MenuItem.vue';
    export default {
        name: 'CategoriesHead',
        data(){
                return{
    
                }
        },
        components:{
          MenuItem,
        }
    };
    </script>
    <style>
    .contain{
        width: 1440px;
        height: 78px;
        display: flex;
        justify-content: space-between;
        padding: 8px;
        background-color: rgba(38, 38, 38, 1);
    }
    .contain .left{
        justify-content: center;
        width: 30%;
        display:flex;
        position: relative;
        top: 80%;
        transform: translateY(-50%);
        color: white;
    }
    .contain .left h4{
        font: lato;
        font-weight: 700;
        font-size: 20px;
        line-height: 20px
    }
    .contain .left .listDown{
        width: 144.75px;
        height: 20px;
        gap: 16px;
        color: white;
    }
    .midle{
        width: 341px;
        height: 62px;
        gap: 10px;
        display: flex;
        color: white;
    }
    .midle img{
        width: 63px;
        height: 62px;
    }
    .midle .TextCaption{
        padding: 8px;
    }
    .midle .TextCaption .text2{
        width: 268px;
        height: 20px;
        font: lato;
        font-weight: 400;
        font-size: 12px;
        line-height: 20px;
        padding-top: 10px;
    }
    .right{
        display: flex;
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        width: 340px;
        height: 24px;
        gap: 20px;
        color: white;
    }
    svg{
        width: 24px;
        height: 24px;
    }
    .right span{
        width: 72px;
        height: 20px;
        font: lato;
        font-weight: 400;
        font-size: 14px;
        line-height: 20px;
        top: 50px;
        padding-bottom: 20p;
    }
    
    </style>