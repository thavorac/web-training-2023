// router/index.js or router.js
import type { RouteRecordRaw } from 'vue-router'
import { useStore } from 'vuex'

const supplierRouter: Readonly<RouteRecordRaw[]> = [
  {
    path: '/supplier',
    name: 'SupplierLayout',
    component: () => import('../../components/SupplierDashborad/CreateSupplierDashborad.vue'),
    redirect: { name: 'SupplierOrderList' },
    beforeEnter: (to, from, next) => {
      const store = useStore()
      console.log('to', to, from, store.getters.getSupplier)
      if (store.getters.getSupplier) {
        next()
      } else {
        next({ name: 'supplierLogin' })
      }
    },
    children: [
      {
        path: 'product',
        name: 'SupplierProduct',
        component: () => import('../../components/ListMenu1.vue')
      },
      {
        path: 'dashboard',
        name: 'SupplierDashboard',
        component: () => import('../../components/SupplierDashborad/DashboardView.vue')
      },
      {
        path: '',
        name: 'SupplierOrderList',
        component: () => import('../../components/SupplierDashborad/OrderList.vue')
      },
      {
        path: 'total-order',
        name: 'SupplierTotalOrder',
        component: () => import('../../components/ListMenu2.vue')
      },
      {
        path: 'stock',
        name: 'SupplierStock',
        component: () => import('../../components/ListMenu3.vue')
      },
      {
        path: 'supplier-profile',
        name: 'SupplierProfile',
        component: () => import('../../components/SupplierDashborad/SupplierProfile.vue')
      }
    ]
  },
  {
    path: '/supplier-login',
    name: 'supplierLogin',
    component: () => import('../../components/SupplierDashborad/SupplierLogin.vue')
  },
  {
    path: '/supplier-logout',
    name: 'supplierLogout',
    component: () => import('../../components/SupplierDashborad/SupplierLogout.vue')
  }
]

export { supplierRouter }
