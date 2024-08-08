import type { RouteRecordRaw } from 'vue-router'

const PichRouter: Readonly<RouteRecordRaw[]> = [
  {
    path: '/cart',
    name: 'cartPage',
    component: () => import('../../views/Cart/CartPage.vue')
  },
  {
    path: '/cart/item',
    name: 'cartItem',
    component: () => import('../../views/Cart/CartItem.vue')
  },
  {
    path: '/invoice',
    name: 'Invoice',
    component: () => import('../../views/Cart/Invoice.vue')
  },
  {
    path: '/receipt',
    name: 'Receipt',
    component: () => import('../../views/Cart/Receipt.vue')
  }
]
export { PichRouter }
