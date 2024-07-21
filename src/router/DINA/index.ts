import { Components } from 'ant-design-vue/es/date-picker/generatePicker'
import MainPageView from '../../views/MainPageView.vue'
import type { RouteRecordRaw } from 'vue-router'
import path from 'path'

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
        path: '/sign-in',
        name: 'signIn',
        component: () => import('../../components/SignInForm.vue')
      },
      {
        path: '/sign-up',
        name: 'signUp',
        component: ()=>import('../../components/SignUp.vue')
      },
      {
        path: '/user-profile',
        name: 'userProfile',
        component: () =>import('../../components/Authentication/UserProfile.vue')
      }
]

export { DINARouter }
