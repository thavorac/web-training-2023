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
    path: '/order/recipe',
    name: 'recipe',
    component: () => import('../../views/Cart/Recipe.vue')
  },
  {
    path: '/invoice',
    name: 'Invoice',
    component: () => import('../../views/Cart/Invoice.vue')
  },


]

export { PichRouter }
