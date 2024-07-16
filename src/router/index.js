import { createRouter, createWebHistory } from 'vue-router'
import RoutingView from '@/views/RoutingView.vue'
import MainPageView from '@/views/MainPageView.vue'
import ProductsCart from '../views/cart/index.vue'
import { adminRouter } from './admin'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: MainPageView //RoutingView
      // children: [
      //   {
      //     path: '/signIn',
      //     name: 'signIn',
      //     component: () => import('../views/SignIn.vue')
      //   }
      // ]
    },

    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/HomeView.vue')
    },
    ...adminRouter,
    {
      path: '/electronic',
      name: 'electronic',
      component: () => import('../views/ElectronicView.vue')
    },
    {
      path: '/product-detail',
      name: 'product-detail',
      component: () => import('../views/DetailView.vue')
    },
    // {
    //   path: '/main-page',
    //   name: 'main-page',
    //   component: () => import('../views/MainPageView.vue')
    // },
    {
      path: '/advertising',
      name: 'advertising',
      component: () => import('../components/AdvertiseSlide.vue')
    },
    {
      path: '/product-detail1',
      name: 'product-detail1',
      component: () => import('../components/ProductDetail1.vue')
    },
    {
      path: '/buttonshop',
      name: 'buttonshop',
      component: () => import('../components/basic/ButtonShop.vue')
    },
    // {
    //   path: '/admin',
    //   name: 'admin',
    //   component: () => import('../components/AdminLogin.vue')
    // },
    {
      path: '/forgot-password',
      name: 'forgot-password',
      component: () => import('../components/Forgotpassword.vue')
    },
    {
      path: '/sign-in',
      name: 'sigin',
      component: () => import('../components/Signin.vue')
    },
    {
      path: '/sign-up',
      name: 'signup',
      component: () => import('../components/SignUp.vue')
    },
    {
      path: '/signIn',
      name: 'signIn',
      component: () => import('../views/SignIn.vue')
    },
    {
      path: '/test-card',
      name: 'testCard',
      component: () => import('../views/TestCard.vue')
    },
    {
      // path: '/cart',
      // name: 'cart',
      // // route level code-splitting
      // // this generates a separate chunk (About.[hash].js) for this route
      // // which is lazy-loaded when the route is visited.
      // component: () => import('../views/CartPage.vue')
    },
    {
      path: '/products',
      name: 'fetch-data',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../components/FetchApi.vue')
    },
    {
      path: '/categories',
      name: 'categories',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../API/GetCategories.vue')
    },
    {
      path: '/getProducts',
      name: 'get-product',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../API/GetProduct.vue')
    },
    {
      path: '/reporte',
      name: 'reporte',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/ReportView.vue')
    },
    {
      path: '/reporte/create',
      name: 'reporteCreate',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/StudentCreate.vue')
    },
    {
      path: '/recipe',
      name: 'recipe',
      component: () => import('../views/RecipeView.vue')
    },
    {
      path: '/address',
      path: '/address',
      name: 'adress',
      component: () => import('../views/Address.vue')
    },
    {
      path: '/products-cart',
      name: 'products-cart',
      component: ProductsCart
    },
    {
      path: '/customerList',
      name: 'CustomerList',
      component: () => import('../views/CustomerList.vue')
    },
    {
      path: '/customer-detail',
      name: 'CustomerDitai',
      component: () => import('../views/CustomerDetail.vue')
    },
    {
      path: '/order-list',
      name: 'OrderList',
      component: () => import('../views/OrderList.vue')
    }
  ]
})

export default router
