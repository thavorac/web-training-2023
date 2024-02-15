<template>
    
    <div class="container">
        <div class="logo">
            <div class="icon">
                <img src="../assets/image/Logo.png" alt="">
            </div>
            <div class="name">
                Luminae
            </div>

        </div>
        <form>
            <div class="searchIcon">
            <div class="inside">
                <input type="text" placeholder="Search Products">
                <aside class="categories">
                   <select>
                        <option value=""> All categories</option>
                        <option value="phone">Phone</option>
                   </select>
                    
                </aside>
                
            </div>
            <p class="search">
                <!-- <img src="../assets/image/Search.png" alt=""> -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>

            </p>

        </div>
        </form>
        <div class="menuList">
            <a href="#">About us</a>
            <a href="#">Blog</a>
            <a href="#">Contact us</a>
            <a href="#">Help&support</a>
        </div>
        <div class="social">
            <div class="item">
                <span class="instagram"><img src="../assets/image/Instagram.png" alt=""></span>
                <span class="fb"><img src="../assets/image/FB.png" alt=""></span>
                <span class="telegram"><img src="../assets/image/Telegram.png" alt=""></span>
            </div>

        </div>
    </div>

</template>


<script>
    export default{
        name: 'MenuHeader',
        data(){
            return{

            }
        }
    }

</script>


<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    .container .categories select, option{
        border: none;
    }
    .container{
        width: 1440px;
        height: 96px;
        padding: 28px 90px;
        gap: 147px;
        background-color: #FFFFFF;
        display: flex;
        flex-direction: row;
        justify-content: center;
    }
    .container .logo{
        width: 190px;
        height: 33px;
        gap: 6px;
        display: flex;
        flex-direction: row;
    }
    .container .logo .icon img{
        width: 49px;
        height: 33px;
       
    }
    .container .logo .name{
        width: 124px;
        height: 20px;
        font-size: 32px;
        font-weight: 700;
        line-height: 20px;
        color: #000000;
        font-family: 'Lato', sans-serif;

    }
    .container .searchIcon{
        width: 345px;
        height: 40px;
        border-radius: 4px;
        border: 1px solid #D9D9D9;
        padding: 8px 12px;
        color: #D9D9D9;
        display: flex;
    }
    .container .searchIcon .inside{
        width: 277px;
        height: 24px;
        gap: 16px;
        display: flex;  
    }
    .container .searchIcon .inside input[type=text]{
        width: 152px;
        height: 20px;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        color: #9D9D9D;
        border: none;
        outline: none;
        cursor: pointer;
        font-family: 'Lato', sans-serif;
    }
    .container .searchIcon .inside .categories{
        width: 109px;
        height: 24px;
        display: flex;
        flex-direction: row;
    }
    .container .searchIcon .inside .categories select ,option{
        width: 108px;
        height: 20px;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        color: #262626;
        font-family: 'Lato', sans-serif;
    }
    .container .searchIcon .inside .categories {
        width: 24px;
        height: 24px;
    }
    .container .searchIcon .search{
        width: 20px;
        height: 20px;
    }
    .container .searchIcon .search img{
        width: 17.54px;
        height: 17.54px;
        border: 1.5px;
        color: #262626;
    }
    .container .menuList{
        width: 420px;
        height: 20px;
        gap: 12px;
        display: flex;
    }
    .container .menuList a{
        width: 96px;
        height: 20px;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        color: #555555;
        font-family: 'Lato', sans-serif;
    }
    .container .menuList a:hover{
        color: red;
        background: white
        
    }
    .container .social{
        width: 127.5px;
        height: 24px;
        gap: 54px;
    }
    .container .social .item{
        width: 84px;
        height: 24px;
        gap: 12px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .container .social .item .instagram{
        width: 24px;
        height: 24px;
    }
    .container .social .item  .fb{
        width: 12px;
        height: 18px;
    }
    .container .social .item .telegram{
        width: 24px;
        height: 24px;
    }
</style>