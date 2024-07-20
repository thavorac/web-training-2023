import { Components } from 'ant-design-vue/es/date-picker/generatePicker'
import MainPageView from '../../views/MainPageView.vue'
import type { RouteRecordRaw } from 'vue-router'

const DINARouter: Readonly<RouteRecordRaw[]> = [
    {
        path: '/forgot-password',
        name: 'forgot-password',
        component: () => import('../../components/Forgotpassword.vue')
      },
      {
        path: '/reset-password/:token',
        name: 'reset-password',
        component: () => import('../../components/ResetPassword.vue')
      },
      {
        path: '/signIn',
        name: 'signIn',
        component: () => import('../../components/SignInForm.vue')
      },
]

export { DINARouter }
