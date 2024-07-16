// import './assets/main.css'
import './assets/index.css'
import '../node_modules/bootstrap/scss/bootstrap.scss'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
// import store from './stores/wishlist' // Import the store

import store from './stores'

// using antd to create an adminSideBar

import Antd from 'ant-design-vue'
import 'ant-design-vue/dist/reset.css'

import 'vue-toastification/dist/index.css'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'bootstrap-icons/font/bootstrap-icons.css'
import Toast from 'vue-toastification'

// import ElectronicView from './views/ElectronicView.vue'
// import DetailView from './views/DetailView.vue'
// import WishListView from './views/WishListView.vue'
// import MainPageView from './views/MainPageView.vue'

const app = createApp(App)

// app.component('ElectronicView', ElectronicView)
// app.component('DetailView', DetailView)
// app.component('WishListView', WishListView)
// app.component('MainPageView', MainPageView)

app.use(createPinia())
app.use(router)
app.use(Toast)

app.mount('#app')
