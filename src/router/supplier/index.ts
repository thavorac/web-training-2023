// import { Components } from 'ant-design-vue/es/date-picker/generatePicker'
import type { RouteRecordRaw } from 'vue-router'

const supplierRouter: Readonly<RouteRecordRaw[]> = [
  {
    path: '/supplier',
    name: 'SupplierLayout',
    component: () => import('../../components/SupplierDashborad/CreateSupplierDashborad.vue'),
    children: [
      {
        path: 'product',
        name: 'SupplierProduct',
        component: () => import('../../components/ListMenu1.vue')
      },
      {
        path: 'dasboard',
        name: 'SupplierDashboard',
        component: () => import('../../components/ListMenu3.vue')
      },
      {
        path: 'order',
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
        path: 'setting',
        name: 'SupplierSetting',
        component: () => import('../../components/AdminProfile/AdminProfile.vue')
      }
    ]
  }
]

export { supplierRouter }
