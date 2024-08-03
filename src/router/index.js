
import { createRouter, createWebHistory } from 'vue-router'
import RoutingView from '@/views/RoutingView.vue'
import MainPageView from '@/views/MainPageView.vue'
import { adminRouter } from './admin'
import { pharongRouter } from './pharong'
import { DINARouter } from './DINA'
import { PichRouter } from './Pich'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [...adminRouter, ...pharongRouter, ...DINARouter, ...PichRouter]
})

export default router
