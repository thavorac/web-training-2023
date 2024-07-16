import { Components } from 'ant-design-vue/es/date-picker/generatePicker'
import type { RouteRecordRaw } from 'vue-router'

const cosmeticsRouter: Readonly<RouteRecordRaw[]> = [
  {
    path: '/cosmetics',
    name: 'Cosmetics',
    component: () => import('../../views/cosmetics/cosmeticView.vue')
  }
]

export { cosmeticsRouter }
