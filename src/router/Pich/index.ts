import type { RouteRecordRaw } from 'vue-router'

const PichRouter: Readonly<RouteRecordRaw[]> = [
  {
    path: '/cart',
    name: 'cartPage',
    component: () => import('../../views/cart/CartPage.vue')
  },
  {
    path: '/cart/item',
    name: 'cartItem',
    component: () => import('../../views/cart/CartItem.vue')
  },
  {
    path: '/invoice',
    name: 'Invoice',
    component: () => import('../../views/cart/Invoice.vue')
  },
  {
    path: '/receipt/:id',
    name: 'Receipt',
    component: () => import('../../views/cart/Receipt.vue')
  }
]
export { PichRouter }
