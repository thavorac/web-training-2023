import { createRouter, createWebHistory } from 'vue-router'
import RoutingView from '@/views/RoutingView.vue'
import MainPageView from '@/views/MainPageView.vue'
import { adminRouter } from './admin'
import { pharongRouter } from './pharong'
import { DINARouter} from './DINA'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [...adminRouter, ...pharongRouter,...DINARouter]
})

export default router