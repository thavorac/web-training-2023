import { Components } from 'ant-design-vue/es/date-picker/generatePicker'
import type { RouteRecordRaw } from 'vue-router'

const adminRouter: Readonly<RouteRecordRaw[]> = [
  {
    path: '/login',
    name: 'login',
    component: () => import('../../components/AdminLogin.vue')
  },
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
          },
          // create puchase by product ID
          {
            path: ':productId/create-purchase',
            name: 'CreatePurchaseByProductId',
            component: () => import('../../components/Purchase/CreatePurchase.vue'),
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
        path: 'supplier',
        name: 'AdminSupplier',
        component: () => import('../../components/Supplier/SupplierItem.vue'),
        children: [
          {
            path: '',
            name: 'ListSupplier',
            component: () => import('../../components/Supplier/ListSupplier.vue')
          },
          {
            path: ':supplierId/edit',
            name: 'SupplierEdit',
            component: () => import('../../components/Supplier/EditSupplier.vue'),
            props: true
          },
        
          {
            path: 'create',
            name: 'CreateSupplier',
            component: () => import('../../components/Supplier/CreateSupplier.vue')
          },
        ]
      },
      {
        path: 'purchase',
        name: 'AdminPurchase',
        component: () => import('../../components/Purchase/PurchaseItem.vue'),
        children: [
          {
            path: '',
            name: 'ListPurchase',
            component: () => import('../../components/Purchase/ListPurchase.vue')
          },
          {
            path: '/admin/purchase/:id/edit',
            name: 'PurchaseEdit',
            component: () => import('../../components/Purchase/EditPurchase.vue'),
            props: true
          }
        ]
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
            path: 'HistoryPromotion',
            name: 'HistoryPromotion',
            component: () => import('../../components/Promotion/HistoryPromotion.vue'),
            props: true
          }
        ]
      }
    ]
  }
]

export { adminRouter }
