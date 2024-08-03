<script setup lang="ts">

</script>
<template>
    <div class="sidebar" ref="sidebar">
        <div class="logo-details gap-3">
            <!-- <i class="bx bxl-c-plus-plus"></i> -->
            <div class="ps-4">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-shop"
                    viewBox="0 0 16 16">
                    <path
                        d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z" />
                </svg>
            </div>
            <span class="logo_name">Supplier</span>
        </div>
        <ul class="nav-links">

            <li>
                <RouterLink to="/supplier/dasboard" class="gap-3">
                    <!-- <i class="bx bx-grid-alt"></i> -->
                    <div class="ps-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="white" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                    </div>

                    <span class="links_name">Dashboard</span>
                </RouterLink>
            </li>
            <li>
                <RouterLink to="/supplier/product" class="gap-3">
                    <!-- <i class="bx bx-box"></i> -->
                    <div class="ps-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="white" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>

                    </div>
                    <span class="links_name">Product</span>
                </RouterLink>
            </li>
            <li>
                <RouterLink to="/supplier/order" class="gap-3">

                    <div class="ps-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="white" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <span class="links_name">Order list</span>
                </RouterLink>
            </li>

            <li>
                <RouterLink to="/supplier/stock" class="gap-3">
                    <!-- <i class="bx bx-coin-stack"></i> -->
                    <div class="ps-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="white" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                        </svg>
                    </div>
                    <span class="links_name">Stock</span>
                </RouterLink>
            </li>
            <li>
                <RouterLink to="/supplier/total-order" class="gap-3">
                    <!-- <i class="bx bx-book-alt"></i> -->
                    <div class="ps-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="white" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                        </svg>
                    </div>
                    <span class="links_name">Total order</span>
                </RouterLink>
            </li>

            <li>
                <RouterLink to="/supplier/setting" class="gap-3">
                    <!-- <i class="bx bx-cog"></i> -->
                    <div class="ps-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="white" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                    <span class="links_name">Setting</span>
                </RouterLink>
            </li>
            <li class="log_out">
                <a href="#" class="gap-3">
                    <div class="ps-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="white" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>

                    </div>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button gap-3">
                <!-- <i class="bx bx-menu" ref="sidebarBtn"></i> -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8"
                    ref="sidebarBtn">
                    <path fill-rule="evenodd"
                        d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                        clip-rule="evenodd" />
                </svg>

                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search..." />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-5 bx-search">
                    <path fill-rule="evenodd"
                        d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                        clip-rule="evenodd" />
                </svg>

                <!-- <i class="bx bx-search"></i> -->
            </div>
            <div class="profile-details">
                <img src="https://th.bing.com/th/id/OIP.Ntwccxljc9Gmka_Y6InYMAHaHa?w=188&h=188&c=7&r=0&o=5&dpr=1.3&pid=1.7"
                    alt="" />
                <span class="admin_name">Prem Shahi</span>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>

                </div>
                <!-- <i class="bx bx-chevron-down"></i> -->
            </div>
        </nav>

        <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Order</div>
                        <div class="number">40,876</div>
                        <div class="indicator">
                            <i class="bx bx-up-arrow-alt"></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class="bx bx-cart-alt cart"></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Sales</div>
                        <div class="number">38,876</div>
                        <div class="indicator">
                            <i class="bx bx-up-arrow-alt"></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class="bx bxs-cart-add cart two"></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Profit</div>
                        <div class="number">$12,876</div>
                        <div class="indicator">
                            <i class="bx bx-up-arrow-alt"></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class="bx bx-cart cart three"></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Return</div>
                        <div class="number">11,086</div>
                        <div class="indicator">
                            <i class="bx bx-down-arrow-alt down"></i>
                            <span class="text">Down From Today</span>
                        </div>
                    </div>
                    <i class="bx bxs-cart-download cart four"></i>
                </div>
            </div>

            <div class="sales-boxes">
                <div class="recent-sales box">
                    <RouterView />
                </div>
            </div>

        </div>
    </section>

</template>

<style scoped>
/* Include your styles here */
/* Googlefont Poppins CDN Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

.sidebar {
    position: fixed;
    height: 100%;
    width: 240px;
    background: #0A2558;
    transition: all 0.5s ease;
}

.sidebar.active {
    width: 60px;
}

.sidebar .logo-details {
    height: 80px;
    display: flex;
    align-items: center;
}

.sidebar .logo-details i {
    font-size: 28px;
    font-weight: 500;
    color: #fff;
    min-width: 60px;
    text-align: center
}

.sidebar .logo-details .logo_name {
    color: #fff;
    font-size: 20px;
    font-weight: 500;
}

.sidebar .nav-links {
    margin-top: 10px;
}

.sidebar .nav-links li {
    position: relative;
    list-style: none;
    height: 50px;
}

.sidebar .nav-links li a {
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    text-decoration: none;
    transition: all 0.4s ease;
}

.sidebar .nav-links li a.active {
    background: #081D45;
}

.sidebar .nav-links li a:hover {
    background: #081D45;
}

.sidebar .nav-links li i {
    min-width: 60px;
    text-align: center;
    font-size: 18px;
    color: #fff;
}

.sidebar .nav-links li a .links_name {
    color: #fff;
    font-size: 15px;
    font-weight: 400;
    white-space: nowrap;
}

.sidebar .nav-links .log_out {
    position: absolute;
    bottom: 65px;
    width: 100%;
}

.home-section {
    position: relative;
    background: #f5f5f5;
    min-height: 100vh;
    width: calc(100% - 240px);
    left: 240px;
    transition: all 0.5s ease;
}

.sidebar.active~.home-section {
    width: calc(100% - 60px);
    left: 60px;
}

.home-section nav {
    display: flex;
    justify-content: space-between;
    height: 80px;
    background: #fff;
    display: flex;
    align-items: center;
    position: fixed;
    width: calc(100% - 240px);
    left: 240px;
    z-index: 100;
    padding: 0 20px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    transition: all 0.5s ease;
}

.sidebar.active~.home-section nav {
    left: 60px;
    width: calc(100% - 60px);
}

.home-section nav .sidebar-button {
    display: flex;
    align-items: center;
    font-size: 24px;
    font-weight: 500;
}

nav .sidebar-button i {
    font-size: 35px;
    margin-right: 10px;
}

.search-box {
    position: relative;
    height: 50px;
    max-width: 550px;
    width: 100%;
    margin: 0 20px;
}

.search-box input {
    height: 100%;
    width: 100%;
    outline: none;
    background: #F5F6FA;
    border: 2px solid #EFEEF1;
    border-radius: 6px;
    font-size: 18px;
    padding: 0 15px;
}

.bx-search {
    position: absolute;
    height: 40px;
    width: 40px;
    background: #2697FF;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    border-radius: 4px;
    line-height: 40px;
    text-align: center;
    color: #fff;
    font-size: 10px;
    transition: all 0.4 ease;
}

.home-section nav .profile-details {
    display: flex;
    align-items: center;
    background: #F5F6FA;
    border: 2px solid #EFEEF1;
    border-radius: 6px;
    height: 50px;
    min-width: 190px;
    padding: 0 15px 0 2px;
}

nav .profile-details img {
    height: 40px;
    width: 40px;
    border-radius: 6px;
    object-fit: cover;
}

nav .profile-details .admin_name {
    font-size: 15px;
    font-weight: 500;
    color: #333;
    margin: 0 10px;
    white-space: nowrap;
}

nav .profile-details i {
    font-size: 25px;
    color: #333;
}

.home-section .home-content {
    position: relative;
    padding-top: 104px;
}

.home-content .overview-boxes {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 0 20px;
    margin-bottom: 26px;
}

.overview-boxes .box {
    display: flex;
    align-items: center;
    justify-content: center;
    width: calc(100% / 4 - 15px);
    background: #fff;
    padding: 15px 14px;
    border-radius: 12px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

.overview-boxes .box-topic {
    font-size: 20px;
    font-weight: 500;
}

.home-content .box .number {
    display: inline-block;
    font-size: 35px;
    margin-top: -6px;
    font-weight: 500;
}

.home-content .box .indicator {
    display: flex;
    align-items: center;
}

.home-content .box .indicator i {
    height: 20px;
    width: 20px;
    background: #8FDACB;
    line-height: 20px;
    text-align: center;
    border-radius: 50%;
    color: #fff;
    font-size: 20px;
    margin-right: 5px;
}

.box .indicator i.down {
    background: #e87d88;
}

.home-content .box .indicator .text {
    font-size: 12px;
}

.home-content .box .cart {
    display: inline-block;
    font-size: 32px;
    height: 50px;
    width: 50px;
    background: #cce5ff;
    line-height: 50px;
    text-align: center;
    color: #66b0ff;
    border-radius: 12px;
    margin: -15px 0 0 6px;
}

.home-content .box .cart.two {
    color: #2BD47D;
    background: #C0F2D8;
}

.home-content .box .cart.three {
    color: #ffc233;
    background: #ffe8b3;
}

.home-content .box .cart.four {
    color: #e05260;
    background: #f7d4d7;
}

.home-content .total-order {
    font-size: 20px;
    font-weight: 500;
}

.sales-boxes {
    display: flex;
    justify-content: space-between;
    /* padding: 0 20px; */
}

/* left box */
.sales-boxes .recent-sales {
    width: 100%;
    background: #fff;
    padding: 20px 30px;
    margin: 0 20px;
    border-radius: 12px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

.sales-boxes .sales-details {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.sales-boxes .box .title {
    font-size: 24px;
    font-weight: 500;
    /* margin-bottom: 10px; */
}

.sales-boxes .sales-details li.topic {
    font-size: 20px;
    font-weight: 500;
}

.sales-boxes .sales-details li {
    list-style: none;
    margin: 8px 0;
}

.sales-boxes .sales-details li a {
    font-size: 18px;
    color: #333;
    font-size: 400;
    text-decoration: none;
}

.sales-boxes .box .button {
    width: 100%;
    display: flex;
    justify-content: flex-end;
}

.sales-boxes .box .button a {
    color: #fff;
    background: #0A2558;
    padding: 4px 12px;
    font-size: 15px;
    font-weight: 400;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.sales-boxes .box .button a:hover {
    background: #0d3073;
}

/* Right box */
.home-content .sales-boxes .top-sales {
    width: 35%;
    background: #fff;
    padding: 20px 30px;
    margin: 0 20px 0 0;
    border-radius: 12px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

.sales-boxes .top-sales li {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 10px 0;
}

.sales-boxes .top-sales li a img {
    height: 40px;
    width: 40px;
    object-fit: cover;
    border-radius: 12px;
    margin-right: 10px;
    background: #333;
}

.sales-boxes .top-sales li a {
    display: flex;
    align-items: center;
    text-decoration: none;
}

.sales-boxes .top-sales li .product,
.price {
    font-size: 17px;
    font-weight: 400;
    color: #333;
}

/* Responsive Media Query */
@media (max-width: 1240px) {
    .sidebar {
        width: 60px;
    }

    .sidebar.active {
        width: 220px;
    }

    .home-section {
        width: calc(100% - 60px);
        left: 60px;
    }

    .sidebar.active~.home-section {
        /* width: calc(100% - 220px); */
        overflow: hidden;
        left: 220px;
    }

    .home-section nav {
        width: calc(100% - 60px);
        left: 60px;
    }

    .sidebar.active~.home-section nav {
        width: calc(100% - 220px);
        left: 220px;
    }
}

@media (max-width: 1150px) {
    .home-content .sales-boxes {
        flex-direction: column;
    }

    .home-content .sales-boxes .box {
        width: 100%;
        overflow-x: scroll;
        margin-bottom: 30px;
    }

    .home-content .sales-boxes .top-sales {
        margin: 0;
    }
}

@media (max-width: 1000px) {
    .overview-boxes .box {
        width: calc(100% / 2 - 15px);
        margin-bottom: 15px;
    }
}

@media (max-width: 700px) {

    nav .sidebar-button .dashboard,
    nav .profile-details .admin_name,
    nav .profile-details i {
        display: none;
    }

    .home-section nav .profile-details {
        height: 50px;
        min-width: 40px;
    }

    .home-content .sales-boxes .sales-details {
        width: 560px;
    }
}

@media (max-width: 550px) {
    .overview-boxes .box {
        width: 100%;
        margin-bottom: 15px;
    }

    .sidebar.active~.home-section nav .profile-details {
        display: none;
    }
}

@media (max-width: 400px) {
    .sidebar {
        width: 0;
    }

    .sidebar.active {
        width: 60px;
    }

    .home-section {
        width: 100%;
        left: 0;
    }

    .sidebar.active~.home-section {
        left: 60px;
        width: calc(100% - 60px);
    }

    .home-section nav {
        width: 100%;
        left: 0;
    }

    .sidebar.active~.home-section nav {
        left: 60px;
        width: calc(100% - 60px);
    }
}
</style>