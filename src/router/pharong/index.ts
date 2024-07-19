import { Components } from 'ant-design-vue/es/date-picker/generatePicker'
import MainPageView from '../../views/MainPageView.vue'
import type { RouteRecordRaw } from 'vue-router'

const pharongRouter: Readonly<RouteRecordRaw[]> = [
  {
    path: '/',
    name: 'home',
    component: MainPageView, //RoutingView,
    redirect: (to) => {
      return { name: 'Homepage' }
    },
    children: [
      {
        path: 'showProducts',
        name: 'show-product',
        component: () => import('../../views/Home/ListProductView.vue')
      },
      {
        path: 'categories/:categoryId/products',
        name: 'CategoryProducts',
        component: () => import('../../components/Category/CategoryProducts.vue')
      }
    ]
  },
  {
    path: '/Homepage',
    name: 'Homepage',
    component: () => import('../../views/Wishlist/ListMainPageView.vue')
  },

  {
    path: '/about',
    name: 'about',
    component: () => import('../../views/HomeView.vue')
  },
  {
    path: '/electronic',
    name: 'electronic',
    component: () => import('../../views/ElectronicView.vue')
  },
  {
    path: '/advertising',
    name: 'advertising',
    component: () => import('../../components/AdvertiseSlide.vue')
  },

  // ========================== Product Detail call from component DetailView.vue in folder views =====================================
  {
    path: '/product-detail1/:productId',
    name: 'product-detail1',
    component: () => import('../../components/ProductDetail1.vue')
  },
  {
    path: '/buttonshop',
    name: 'buttonshop',
    component: () => import('../../components/basic/ButtonShop.vue')
  },

  {
    path: '/forgot-password',
    name: 'forgot-password',
    component: () => import('../../components/Forgotpassword.vue')
  },
  {
    path: '/reset-password/:token',
    name: 'reset-password',
    component: () => import('../../components/ResetPassword.vue')
  },
  {
    path: '/signIn',
    name: 'signIn',
    component: () => import('../../views/SignIn.vue')
  },
  {
    path: '/test-card',
    name: 'testCard',
    component: () => import('../../views/TestCard.vue')
  },
  {
    path: '/cart',
    name: 'cart',
    component: () => import('../../views/CartPage.vue')
  },
  {
    path: '/category-page',
    name: 'CategoryPage',
    component: () => import('../../views/CategoryPage.vue')
  },
  {
    path: '/list-categories',
    name: 'listcategory',
    component: () => import('../../components/Category/ListCategory.vue')
  },
  {
    path: '/wishlist-page1',
    name: 'wishlistPage1',
    component: () => import('../../components/WishList1.vue')
  }
]

export { pharongRouter }
