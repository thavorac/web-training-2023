import { createRouter, createWebHistory } from 'vue-router'
import RoutingView from '@/views/RoutingView.vue'
import MainPageView from '@/views/MainPageView.vue'
import { adminRouter } from './admin'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/getImage',
      name: 'Image',
      component: () => import('../API/GetImages.vue')
    },
    {
      path: '/',
      name: 'home',
      component: MainPageView //RoutingView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/HomeView.vue')
    },
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

    // ========================== Product Detail call from component DetailView.vue in folder views =====================================
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
      path: '/reset-password/:token',
      name: 'reset-password',
      component: () => import('../components/ResetPassword.vue')
    },

    {
      path: '/sign-in',
      name: 'sigin',
      component: () => import('../components/SignInForm.vue')
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
      path: '/cart',
      name: 'cart',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/CartPage.vue')
    },
    // {
    //   path : '/report',
    //   name : 'report',
    //   component : () => import('../API/Student/ReportView.vue')
    // },
    // {
    //   path: '/reporte/create',
    //   name: 'reporteCreate',
    //   component: () => import('../API/Student/StudentCreate.vue')
    // },
    // ++++++++++++++++++++++++++++++++++++++++++ GET PRODUCT ++++++++++++++++++++++++++++++++++++++

    // {
    //   path:'/admin-layout',
    //   name : 'Admin-Layout',
    //   component: () => import('../views/LayoutSidebar.vue')
    // },

    // ++++++++++++++++++++++++++++++++++++++++++ END GET PRODUCT ++++++++++++++++++++++++++++++++++++++

    // ++++++++++++++++++++++++++++++++++++++++++ GET CATEGORY ++++++++++++++++++++++++++++++++++++++
    {
      path: '/form-category',
      name: 'createFormCategory',
      component: () => import('../API/Categories/CreateFormCategory.vue')
    },
    {
      path: '/getCategory',
      name: 'Category',
      component: () => import('../API/Categories/GetCategory.vue')
    },

    // =========================================== MainLayout for admin dashboard ============================================================
    {
      path: '/main-layout',
      name: 'MainLayout',
      component: () => import('../layout/MainLayout.vue'),
      children: [
        // {
        //   path: '/edit-category/:id',
        //   name: 'Edit-category',
        //   component: () => import('../API/Categories/EditCategory.vue'),
        //   props: true
        // },
        {
          path: '/product-form',
          name: 'product-form',
          component: () => import('../API/Products/ProductForm.vue')
        },
        {
          path: '/getCategory',
          name: 'Category',
          component: () => import('../API/Categories/GetCategory.vue')
        },
        {
          path: '/getProducts',
          name: 'get-product',
          component: () => import('../API/Products/GetProduct.vue')
        },
        {
          path: '/edit-product/:id',
          name: 'Edit-product',
          component: () => import('../API/Products/EditProduct.vue'),
          props: true
        },
        {
          path: '/form-category',
          name: 'createFormCategory',
          component: () => import('../API/Categories/CreateFormCategory.vue')
        }
      ]
    },

    // ++++++++++++++++++++++++++++++++++++++++++END GET CATEGORY ++++++++++++++++++++++++++++++++++++++

    {
      path: '/category-page',
      name: 'CategoryPage',
      component: () => import('../views/CategoryPage.vue')
    },
    {
      path: '/list-categories',
      name: 'listcategory',
      component: () => import('../components/Category/ListCategory.vue')
    },
    ...adminRouter,

    // {
    //   path: '/getCategories',
    //   name : 'Categories',
    //   component: () => import('../API/Categories/GetCategories.vue')
    // }
    // {
    //   path : '/reporte',
    //   name : 'report',
    //   component : () => import('../API/Student/ReportView.vue')
    // },
    // {
    //   path: '/edit-product/:id',
    //   name: 'reporteEdit',
    //   // route level code-splitting
    //   // this generates a separate chunk (About.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import('../API/Student/StudentEdit.vue'),
    //   props:true,
    // },
    // {
    //   path: '/reporte/create',
    //   name: 'reporteCreate',
    //   component: () => import('../API/Student/StudentCreate.vue')
    // },
    // {
    //   path: '/getProducts',
    //   name: 'Get-Product',
    //   component: () => import('../API/Products/GetProduct.vue')
    // } ,

    {
      path: '/testing',
      name: 'testing',
      component: () => import('../views/Testing/IndexView.vue')
    },
    {
      path: '/wishlist-page',
      name: 'wishlistPage',
      component: () => import('../views/Wishlist/WishListPage.vue')
    }

    // ==================================================== // Edit Form Category ==============================================
  ]
})

export default router
