// import './assets/main.css'
import './assets/index.css'
import '../node_modules/bootstrap/scss/bootstrap.scss'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import store from './stores/wishlist' // Import the store

// using antd to create an adminSideBar

import Antd from 'ant-design-vue'
import 'ant-design-vue/dist/reset.css'

import 'vue-toastification/dist/index.css'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'bootstrap-icons/font/bootstrap-icons.css'
import Toast from 'vue-toastification'

const app = createApp(App)

app.use(createPinia())
app.use(router)
app.use(Toast)
app.use(Antd)
app.use(store) // Use the store

app.mount('#app')
