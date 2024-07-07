<template>
  <div class="container-fluid">
    <div class="bg-img">
      <div class="container position-absolute">
        <div class="row justify-content-end">
          <div class="col-6">
            <form class="shadow-lg px-3 bg-white rounded-4 float-end" @submit.prevent="register">
              <div class="imgcontainer">
                <h1>Register</h1>
              </div>
              <div class="container">
                <label>Email</label>
                <input type="email" v-model="email" placeholder="Enter Email" required>

                <label for="uname">Username</label>
                <input type="text" v-model="username" placeholder="Enter Username" required>

                <label for="phoneNumber">Phone Number</label>
                <input type="text" v-model="phoneNumber" placeholder="Enter Phone Number" required>

                <label for="psw">Password</label>
                <input type="password" v-model="password" placeholder="Enter Password" required>

                <label for="psw">Confirm Password</label>
                <input type="password" v-model="confirmPassword" placeholder="Enter Confirm Password" required>

                <span class="gender">Gender: </span>
                <input type="radio" id="gender1" v-model="gender" value="male">
                <label for="gender1">Male</label>
                <input type="radio" id="gender2" v-model="gender" value="female">
                <label for="gender2">Female</label>
                <input type="radio" id="gender3" v-model="gender" value="other">
                <label for="gender3">Other</label>
              </div>
              <div class="container d-flex justify-content-between align-items-center">
                <router-link to="/sign-in">
                  <button type="button" class="cancelbtn">Cancel</button>
                </router-link>
                <button class="btn btn-primary" type="submit">SignUp</button>
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
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2';

const username = ref('');
const email = ref('');
const phoneNumber = ref('');
const password = ref('');
const confirmPassword = ref('');
const gender = ref('');

const router = useRouter();

const register = () => {
  if (password.value !== confirmPassword.value) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Password and Confirm Password do not match',
    });
    return;
  }

  axios.post('http://localhost:80/api/register', {
    username: username.value,
    email: email.value,
    phone_number: phoneNumber.value,
    password: password.value,
    confirm_password: confirmPassword.value,
    gender: gender.value,
  })
    .then(response => {
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: response.data.message,
      }).then(() => {
        router.push('/sign-in');
      });
    })
    .catch(error => {
      console.error('Error during registration:', error);
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: error.response.data.message || 'Registration failed. Please try again.',
      });
    });
};
</script>

<style scoped lang="scss">
.container {
  width: 100%;
  height: 100%;
  margin-top: 10px;
}

.container-fluid {
  background-image: url("/src/assets/image/abstract-1264071_1920.png");
  min-height: 715px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: 100% 100%;
  position: relative;
}

h1 {
  text-align: center;
}

form {
  width: 75%;
}

.form-group .btn {
  width: 100%;
  margin-bottom: 10px;
}

.form-group {
  margin-top: 10px;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

input[type=text],
input[type=password],
input[type=email] {
  width: 100%;
  padding: 7px 20px;
  margin: 10px 0;
  display: inline-block;
  box-sizing: border-box;
  border-radius: 7px;
  border: 1px solid #4aafa3;
}

.gender {
  padding-right: 10px;
}

button {
  background-color: #779341;
  color: white;
  padding: 10px 20px;
  margin: 10px 0;
  margin-bottom: 10px;
  border: none;
  border-radius: 7px;
  float: right;
  cursor: pointer;
  width: 25%;
  margin-bottom: 20px;
}

input {
  padding-top: 10px;
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

img.avatar {
  width: 40%;
  border-radius: 50%;
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
