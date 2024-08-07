import { Components } from 'ant-design-vue/es/date-picker/generatePicker'
import type { RouteRecordRaw } from 'vue-router'

const adminRouter: Readonly<RouteRecordRaw[]> = [
  {
    path: '/login',
    name: 'login',
    component: () => import('../../components/AdminLogin.vue')
} ,
  {
    path: '/logout',
    name: 'logout',
    component: () => import('../../components/AdminLogout.vue')
  },
  {
      path: '/admin-profile',
      name: 'profile',
      component: () => import('../../components/AdminProfile/Profile.vue')
   },

  {
    path: '/admin',
    name: 'AdminLayout',
    component: () => import('../../layout/AdminLayout.vue'),
    redirect: (to) => {
      return { name: 'ListProduct' }
    },
    children: [
      {
        path: 'category',
        name: 'AdminCategory',
        component: () => import('../../components/Category/CategoryItem.vue'),
        children: [
          {
            path: '',
            name: 'ListCategory',
            component: () => import('../../components/Category/ListCategory.vue')
          },

          {
            path: 'create',
            name: 'CreateCategory',
            component: () => import('../../components/Category/CreateFormCategory.vue')
          },
          {
            path: 'delete',
            name: 'DeleteCategory',
            component: () => import('../../components/Category/DeleteCategory.vue')
          },
          {
            path: '/edit-category/:id',
            name: 'CategoryEdit',
            component: () => import('../../components/Category/EditFormCategory.vue'),
            props: true
          }
        ]
      },
      {
        path: 'product',
        name: 'AdminProduct',
        component: () => import('../../components/Product/ProductItem.vue'),
        children: [
          {
            path: '',
            name: 'ListProduct',
            component: () => import('../../components/Product/ListProduct.vue')
          },
          {
            path: 'create',
            name: 'CreateProduct',
            component: () => import('../../components/Product/CreateFormProduct.vue')
          },
          {
            path: ':productId/edit',
            name: 'ProductEdit',
            component: () => import('../../components/Product/EditProduct.vue'),
            props: true
          }
        ]
      },
      {
        path: 'setting',
        name: 'AdminProfile',
        component: () => import('../../components/AdminProfile/Profile.vue')
      },
      {
        path: 'sub-category',
        name: 'SubCategory',
        component: () => import('../../components/Category/SubCategoryItem.vue')
      },
      {
        path: 'banner',
        name: 'Banner',
        component: () => import('../../components/Banner/BannerItem.vue')
      },
      {
        path: 'promotion',
        name: 'promotion',
        component: () => import('../../components/Promotion/PromotionItem.vue'),
        children: [
          {
            path: '',
            name: 'ListPromotion',
            component: () => import('../../components/Promotion/ListPromotion.vue')
          },
          {
            path: 'create-promotion',
            name: 'CreatePromotion',
            component: () => import('../../components/Promotion/CreatePromotion.vue')
          },
          {
            path: ':promotionId/edit',
            name: 'promotionEdit',
            component: () => import('../../components/Promotion/EditPromotion.vue'),
            props: true
          },
          {
            path: 'history',
            name: 'historyPromotion',
            component: () => import('../../components/Promotion/HistoryPromotion.vue'),
          },
        ]
      },
      {
        path: 'accounts',
        name: 'accountant',
        component: () => import('../../components/Accountant/AccountItem.vue'),
        children: [
          {
            path: '',
            name: 'ListAccount',
            component: () => import('../../components/Accountant/ListAccount.vue')
          },
          {
            path: 'create-account',
            name: 'CreateAccount',
            component: () => import('../../components/Accountant/CreateAccount.vue')
          },
          {
            path: ':accountsId/edit',
            name: 'accountEdit',
            component: () => import('../../components/Accountant/EditAccount.vue'),
            props: true
          },
          {
            path: 'detail/:accountId',
            name: 'accountDetail',
            component: () => import('../../components/Accountant/AccountDetail.vue'),
            props: true
          },
          {
            path: 'transfer',
            name: 'TransferBalance',
            component: () => import('../../components/Accountant/TransferFrom.vue'),
            props: true
          },        
          {
            path: 'History',
            name: 'HistoryPromotion',
            component: () => import('../../components/Accountant/HistoryTransection.vue'),
            props: true
          },
        ]
      },

    ]
  }
]

export { adminRouter }
