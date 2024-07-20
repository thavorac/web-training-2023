<template>
  <div class="container-fluid">
    <div class="bg-img">
      <div class="container position-absolute">
        <div class="row justify-content-end">
          <div class="col-6">
            <form @submit.prevent="loginAdmin" class="shadow-lg p-3 bg-white rounded-4 float-end">
              <div class="imgcontainer">
                <h4>Welcome to <span style="color: #779341">Admin</span></h4>
                <h1>Sign in</h1>
              </div>
              <div class="container">
                <label for="email"><b>Email</b></label>
                <input
                  v-model="admin.email"
                  type="email"
                  placeholder="Enter Email"
                  name="email"
                  required
                />

                <label for="password"><b>Password</b></label>
                <input
                  v-model="admin.password"
                  type="password"
                  placeholder="Enter Password"
                  name="password"
                  required
                />

                <label> <input type="checkbox" name="remember" /> Remember me </label>
              </div>
              <div class="container">
                <button type="submit">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import axios from '../services/axios'
import Swal from 'sweetalert2'
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'

const admin = ref({
  email: '',
  password: ''
})

const router = useRouter()
const store = useStore()

const loginAdmin = () => {
  axios
    .post('/admin/login', admin.value)
    .then(({ data }) => {
      if (data.message === 'Login successful') {
        store.dispatch('login', { admin: data.admin, token: data.token })

        Swal.fire({
          icon: 'success',
          title: 'Login Successful',
          text: data.message
        }).then(() => {
          router.push('/admin') // Adjust path to admin profile page
        })
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Login Failed',
          text: data.message
        })
      }
    })
    .catch((error) => {
      console.error('Error while logging in:', error)
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Error, please try again'
      })
    })
}
</script>

<style scoped lang="scss">
.container {
  width: 100%;
  height: 100%;
  margin-top: 20px;
}

.container-fluid {
  background-image: url('/src/assets/image/abstract-1264071_1920.png');
  min-height: 715px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: 100% 100%;
  position: relative;
}

form {
  width: 75%;
}

.form-group .btn {
  width: 100%;
  margin-bottom: 10px;
}

input[type='email'],
input[type='password'] {
  width: 100%;
  padding: 10px 20px;
  margin: 10px 0;
  display: inline-block;
  border: 1px solid #41393f;
  box-sizing: border-box;
}

button {
  background-color: #779341;
  color: white;
  padding: 10px 20px;
  margin: 10px 0;
  margin-bottom: 30px;
  border: none;
  border-radius: 7px;
  float: right;
  cursor: pointer;
  width: 25%;
}

button:hover {
  opacity: 0.8;
}

.imgcontainer {
  padding-left: 10px;
  margin: 24px 0 12px 0;
}

.imgcontainer h1 {
  padding-top: 20px;
  padding-bottom: 10px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }

  .cancelbtn {
    width: 100%;
  }
}
</style>
