<script setup lang="ts">
import 'boxicons/css/boxicons.min.css';
import axios from 'axios';
import { ref, onMounted, watch, computed } from 'vue';
import { usePurchasesStore } from '../../stores/purchases';
import { useSearchStore } from '../../stores/search';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

const purchasesStore = usePurchasesStore();
const totalAccepted = ref(0);
const totalRejected = ref(0);
const totalPending = ref(0);
const searchStore = useSearchStore();
const search = computed(() => searchStore.search);
const route = useRoute();



// Computed property to safely access purchases length
const purchases = computed(() => purchasesStore.purchases || []);

// Function to fetch data from the store
const fetchData = async () => {
    try {
        await purchasesStore.fetchAllData(); // Ensure this method exists in the store
        totalAccepted.value = purchasesStore.totalAccepted;
        totalRejected.value = purchasesStore.totalRejected;
        totalPending.value = purchasesStore.totalPending;
    } catch (error) {
        console.error('Error in fetchData:', error);
    }
};

const store = useStore();
const supplier = computed(() => store.getters.getSupplier);
const router = useRouter();
const logoutHandler = () => {
    store.dispatch('logout');
    router.push('/supplier-login'); // Redirect to sign-in page after logout
};

if (!store.getters.isAuthenticated || !supplier.value) {
    router.push('/supplier-login'); // Redirect to login if not authenticated or admin not found
}

// Watch for changes in the store's totals
watch(() => purchasesStore.totalAccepted, (newValue) => {
    totalAccepted.value = newValue;
});
watch(() => purchasesStore.totalRejected, (newValue) => {
    totalRejected.value = newValue;
});
watch(() => purchasesStore.totalPending, (newValue) => {
    totalPending.value = newValue;
});

// On component mount, fetch data
onMounted(() => {
    fetchData();
});

const sidebarBtn = ref(null);
const sidebar = ref(null);

onMounted(() => {
    sidebarBtn.value.addEventListener('click', () => {
        sidebar.value.classList.toggle('active');
    });
});

// Computed property for filtered data
const filteredData = computed(() => {
    let filtered = purchases.value;

    if (search.value) {
        filtered = filtered.filter(purs => purs.name.toLowerCase().includes(search.value.toLowerCase()));
    }
    return filtered;
});

const isVisible = ref(false);

const toggleVisibility = () => {
    isVisible.value = !isVisible.value;
};

const listPurchase = ref([]);
const getPurchasesOfSupplier = async (supplierId: number) => {
    try {
        const response = await axios.get(`http://localhost/api/suppliers/${supplierId}/purchases`);
        listPurchase.value = response.data;
        console.log('all purchases of supplier: ', response.data);
    } catch (error) {
        console.log('Error fetching purchases of one supplier :', error);
    }
}

getPurchasesOfSupplier(supplier.value.id);
</script>

<template>
    <div class="sidebar" ref="sidebar">
        <div class="logo-details">
            <!-- <i class="bx bxl-c-plus-plus"></i> -->
            <i class='bx bxs-truck' style="font-size: 36px;"></i>
            <span class="logo_name">Supplier</span>
        </div>
        <ul class="nav-links">

            <li>
                <RouterLink to="/supplier/dashboard">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </RouterLink>
            </li>
            <li>
                <RouterLink to="/supplier/product">
                    <i class="bx bx-box"></i>
                    <span class="links_name">Product</span>
                </RouterLink>
            </li>
            <li>
                <RouterLink to="/supplier">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Order list</span>
                </RouterLink>
            </li>

            <li>
                <RouterLink to="/supplier/stock">
                    <i class="bx bx-coin-stack"></i>

                    <span class="links_name">Stock</span>
                </RouterLink>
            </li>
            <li>
                <RouterLink to="/supplier/total-order">
                    <i class="bx bx-book-alt"></i>

                    <span class="links_name">Total order</span>
                </RouterLink>
            </li>

            <li>
                <RouterLink to="/supplier/supplier-profile">
                    <i class="bx bx-cog"></i>

                    <span class="links_name">Setting</span>
                </RouterLink>
            </li>
            <li class="log_out">
                <a href="#" @click="logoutHandler">
                    <i class='bx bx-log-out'></i>

                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button gap-3">
                <i class="bx bx-menu" ref="sidebarBtn"></i>

                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
                <input type="text" v-model="searchStore.search" placeholder="Search..." />
                <i class='bx bx-search'></i>
            </div>

            <!-- notification alert  -->
            <div v-if="listPurchase" class="relative">
                <i class='bx bxs-bell-ring text-3xl text-green-500'></i>
                <span
                    class="absolute top-0 right-0  transform translate-x-1/2 -translate-y-1/2 bg-red-600 text-white text-xs rounded-full px-2 py-1">{{
                        listPurchase.length }}</span>
            </div>
            <div v-if="supplier" class="profile-details ">
                <img src="https://th.bing.com/th/id/OIP.Ntwccxljc9Gmka_Y6InYMAHaHa?w=188&h=188&c=7&r=0&o=5&dpr=1.3&pid=1.7"
                    alt="" />
                <span class="admin_name">{{ supplier.name }}</span>
                <i @click="toggleVisibility" class="bx bx-chevron-down"></i>

            </div>
            <!-- div profile  -->
            <div id="myDIV" v-show="isVisible" class="flex flex-col gap-y-2  rounded-sm bg-gray-300">
                <a href=""
                    class="no-underline text-black flex justify-start items-center gap-3 hover:bg-yellow-200 h-12 hover:text-white ps-3 mt-3">
                    <i class='bx bx-user-circle text-xl'></i>
                    Profile</a>
                <a href=""
                    class="no-underline text-black  flex justify-start items-center gap-3 hover:bg-yellow-200 h-12  ps-3">
                    <i class='bx bx-log-out text-xl'></i>
                    Log Out</a>
            </div>
        </nav>

        <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic ">Total Order</div>
                        <div class="number">0{{ purchases.length }}</div>
                        <div class="indicator">
                            <i class="bx bx-up-arrow-alt"></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class="bx bx-cart-alt cart"></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Accepted</div>
                        <div class="number">0{{ totalAccepted }}</div>
                        <div class="indicator">
                            <i class="bx bx-up-arrow-alt"></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class="bx bxs-cart-add cart two"></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Pending</div>
                        <div class="number">0{{ totalPending }}</div>
                        <div class="indicator">
                            <i class="bx bx-up-arrow-alt"></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class="bx bx-cart cart three"></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Rejected</div>
                        <div class="number">0{{ totalRejected }}</div>
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

}

/* .search-box {
    position: relative;
    height: 50px;
    max-width: 550px;
    width: 100%;
    margin: 0 20px;
} */

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
    font-size: 22px;
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

#myDIV {
    min-width: 190px;
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