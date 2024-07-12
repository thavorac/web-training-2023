<template>
  <div class="container-fluid">
    <div class="bg-img">
      <div class="container position-absolute">
        <div class="row justify-content-end">
          <div class="col-6">
            <form @submit.prevent="loginData" class="shadow-lg p-3 bg-white rounded-4 float-end" action="" method="post">
              <div class="imgcontainer">
                <h4>Welcome</h4>
                <h1>Sign in</h1>
              </div>
              <div class="container">
                <label for="email"><b>Email</b></label>
                <input v-model="user.email" type="text" placeholder="Enter Email" name="email" required>
                <label for="password"><b>Password</b></label>
                <input v-model="user.password" type="password" placeholder="Enter Password" name="password" required>
                <label>
                  <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
              </div>
              <div class="container">
                <router-link to="/forgot-password">
                  <span class="psw"><a href="#">Forgot password?</a></span>
                </router-link>
              </div>
              <div class="container d-flex justify-content-between align-items-center">
                <router-link to="/">
                  <button type="button" class="cancelbtn">Cancel</button>
                </router-link>
                <button class="btn btn-primary" type="submit">Login</button>
              </div>
              <div class="container text-center">
                <span class="sp">Don't have an account? <router-link to="/sign-up">Sign Up</router-link></span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import { useRouter } from 'vue-router';

const user = ref({
  email: '',
  password: ''
});

const router = useRouter();

const loginData = () => {
  axios.post("http://localhost:80/api/login", user.value)
    .then(({ data }) => {
      console.log(data);
      if (data.message === "Login successful") {
        Swal.fire({
          icon: 'success',
          title: 'Login Successful',
          text: data.message
        }).then(() => {
          router.push('/Homepage');
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Login Failed',
          text: data.message
        });
      }
    })
    .catch(error => {
      console.error('Error while logging in:', error);
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Error, please try again'
      });
    });
}
</script>

<style scoped lang="scss">
.container {
  width: 100%;
  height: 100%;
  margin-top: 20px;
}

.container-fluid {
  background-image: url("/src/assets/image/abstract-1264071_1920.png");
  min-height: 715px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: 100%;
  position: relative;
}

form {
  width: 75%;
}

input[type=text],
input[type=password] {
  width: 100%;
  padding: 10px 20px;
  margin: 10px 0;
  display: inline-block;
  box-sizing: border-box;
  border-radius: 7px;
  border: 1px solid #4aafa3;
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

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  padding-left: 10px;
  margin: 24px 0 12px 0;
}

.imgcontainer h1 {
  padding-top: 20px;
  padding-bottom: 10px;
}

.container {
  padding: 10px;
}

span.psw {
  float: right;
  padding-top: 10px;
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
