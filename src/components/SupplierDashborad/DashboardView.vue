<script setup>
import 'boxicons/css/boxicons.min.css';
</script>
<template>
    <div>
        <div class="sales-boxes">
            <div class="recent-sales box">
                <div class="title">Recent Sales</div>
                <div class="sales-details">
                    <ul class="details">
                        <li class="topic">Date</li>
                        <li><a href="#">02 Jan 2021</a></li>
                        <li><a href="#">02 Jan 2021</a></li>
                        <li><a href="#">02 Jan 2021</a></li>
                        <li><a href="#">02 Jan 2021</a></li>
                        <li><a href="#">02 Jan 2021</a></li>
                        <li><a href="#">02 Jan 2021</a></li>
                        <li><a href="#">02 Jan 2021</a></li>
                    </ul>
                    <ul class="details">
                        <li class="topic">Customer</li>
                        <li><a href="#">Alex Doe</a></li>
                        <li><a href="#">David Mart</a></li>
                        <li><a href="#">Roe Parter</a></li>
                        <li><a href="#">Diana Penty</a></li>
                        <li><a href="#">Martin Paw</a></li>
                        <li><a href="#">Doe Alex</a></li>
                        <li><a href="#">Aiana Lexa</a></li>
                        <li><a href="#">Rexel Mags</a></li>
                        <li><a href="#">Tiana Loths</a></li>
                    </ul>
                    <ul class="details">
                        <li class="topic">Sales</li>
                        <li><a href="#">Delivered</a></li>
                        <li><a href="#">Pending</a></li>
                        <li><a href="#">Returned</a></li>
                        <li><a href="#">Delivered</a></li>
                        <li><a href="#">Pending</a></li>
                        <li><a href="#">Returned</a></li>
                        <li><a href="#">Delivered</a></li>
                        <li><a href="#">Pending</a></li>
                        <li><a href="#">Delivered</a></li>
                    </ul>
                    <ul class="details">
                        <li class="topic">Total</li>
                        <li><a href="#">$204.98</a></li>
                        <li><a href="#">$24.55</a></li>
                        <li><a href="#">$25.88</a></li>
                        <li><a href="#">$170.66</a></li>
                        <li><a href="#">$56.56</a></li>
                        <li><a href="#">$44.95</a></li>
                        <li><a href="#">$67.33</a></li>
                        <li><a href="#">$23.53</a></li>
                        <li><a href="#">$46.52</a></li>
                    </ul>
                </div>
                <div class="button">
                    <a href="#">See All</a>
                </div>
            </div>
            <div class="top-sales box">
                <div class="title">Top Seling Product</div>
                <ul class="top-sales-details">
                    <li>
                        <a href="#">
                            <img src="https://static.vecteezy.com/system/resources/previews/018/765/757/original/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-sign-business-concept-vector.jpg" alt="">
                            <span class="product">Vuitton Sunglasses</span>
                        </a>
                        <span class="price">$1107</span>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://static.vecteezy.com/system/resources/previews/018/765/757/original/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-sign-business-concept-vector.jpg" alt="">
                            <span class="product">Hourglass Jeans </span>
                        </a>
                        <span class="price">$1567</span>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://static.vecteezy.com/system/resources/previews/018/765/757/original/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-sign-business-concept-vector.jpg" alt="">
                            <span class="product">Nike Sport Shoe</span>
                        </a>
                        <span class="price">$1234</span>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://static.vecteezy.com/system/resources/previews/018/765/757/original/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-sign-business-concept-vector.jpg" alt="">
                            <span class="product">Hermes Silk Scarves.</span>
                        </a>
                        <span class="price">$2312</span>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://static.vecteezy.com/system/resources/previews/018/765/757/original/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-sign-business-concept-vector.jpg" alt="">
                            <span class="product">Succi Ladies Bag</span>
                        </a>
                        <span class="price">$1456</span>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://static.vecteezy.com/system/resources/previews/018/765/757/original/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-sign-business-concept-vector.jpg" alt="">
                            <span class="product">Gucci Womens's Bags</span>
                        </a>
                        <span class="price">$2345</span>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://static.vecteezy.com/system/resources/previews/018/765/757/original/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-sign-business-concept-vector.jpg" alt="">
                            <span class="product">Addidas Running Shoe</span>
                        </a>
                        <span class="price">$2345</span>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://static.vecteezy.com/system/resources/previews/018/765/757/original/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-sign-business-concept-vector.jpg" alt="">
                            <span class="product">Bilack Wear's Shirt</span>
                        </a>
                        <span class="price">$1245</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<style scoped>
.sales-boxes {
    display: flex;
    justify-content: space-between;
    /* padding: 0 20px; */
}

/* left box */
.sales-boxes .recent-sales {
    width: 65%;
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
.sales-boxes .top-sales {
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

@media (max-width: 1150px) {
    .sales-boxes {
        flex-direction: column;
    }

    .sales-boxes .box {
        width: 100%;
        overflow-x: scroll;
        margin-bottom: 30px;
    }

    .sales-boxes .top-sales {
        margin: 0;
    }
}
</style>