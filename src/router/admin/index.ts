import type { RouteRecordRaw } from 'vue-router'

const adminRouter: Readonly<RouteRecordRaw[]> = [
  {
    path: '/admin',
    name: 'AdminLayout',
    component: () => import('../../layout/AdminLayout.vue'),
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
            path: '/edit-category/:id',
            name: 'editFormCategory',
            component: () => import('../../components/Category/EditFormCategory.vue'),
            props: true
          }
          // {
          //   path: 'create',
          //   name: 'CreateCategory',
          //   component: () => import('../../components/Category/CreateFormCategory.vue')
          // }
        ]
      },
      {
        path: 'product',
        name: 'AdminProduct',
        component: () => import('../../components/Product/ProductItem.vue')
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
      },
      {
        path: 'promotion',
        name: 'Promotion',
        component: () => import('../../components/Promotion/PromotionItem.vue')
      }
    ]
  }
]
export { adminRouter }
