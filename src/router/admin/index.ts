import { Components } from 'ant-design-vue/es/date-picker/generatePicker'
import type { RouteRecordRaw } from 'vue-router'

const adminRouter: Readonly<RouteRecordRaw[]> = [
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
        component: () => import('../../components/SettingPage/SettingItem.vue')
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
      }
    ]
  }
]

export { adminRouter }
