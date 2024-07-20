<template>
  <div class="container-fluid">
    <div class="bg-img">
      <div class="container position-absolute">
        <div class="row justify-content-end">
          <div class="col-9">
            <form class="shadow-lg px-3 bg-white rounded-4 float-end" @submit.prevent="register">
              <div class="imgcontainer">
                <h1>Register</h1>
              </div>
              <div class="container">
                <div class="row">
                  <div class="col-6">
                    <label for="fname">First name</label>
                    <input type="text" v-model="first_name" placeholder="Enter Frist name" required>
                  </div>
                  <div class="col-6">
                    <label for="lname">Last name</label>
                    <input type="text" v-model="last_name" placeholder="Enter Last name" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <label>Email</label>
                    <input type="email" v-model="email" placeholder="Enter Email" required>
                  </div>
                  <div class="col-6">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="text" v-model="phoneNumber" placeholder="Enter Phone Number" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <label for="dob">Date Of Birth</label>
                    <input type="date" v-model="date_of_birth" name="" id="" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <label for="address">Address: ( EX: #001, St192 , sangkat teuk la’ork 3 , khan Toul kork , Phnom Penh, Cambodia.)</label>
                   <input type="text" v-model="address" name="" id="" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <label for="psw">Password</label>
                    <input type="password" v-model="password" placeholder="Enter Password" required>
                  </div>
                  <div class="col-6">
                    <label for="psw">Confirm Password</label>
                    <input type="password" v-model="confirmPassword" placeholder="Enter Confirm Password" required>
                  </div>
                </div>
                <span class="gender">Gender: </span>
                <input type="radio" id="gender1" v-model="gender" value="male">
                <label for="gender1 mx-1">Male</label>
                <input type="radio" id="gender2" v-model="gender" value="female">
                <label for="gender2">Female</label>
              </div>
              <div class="container d-flex justify-content-end align-items-center">
              <router-link to="/sign-in" class="mr-2">
                <button type="button" class="cancelbtn btn btn-secondary">Cancel</button>
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
import axios from '../services/axios';
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2';

const first_name = ref('');
const last_name = ref('');
const date_of_birth = ref('');
const address = ref('');
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
    first_name: first_name.value,
    last_name: last_name.value,
    date_of_birth: date_of_birth.value,
    address: address.value,
    email: email.value,
    phone_number: phoneNumber.value,
    password: password.value,
    confirm_password: confirmPassword.value,
    gender: gender.value,
  })
    .then(response => {
      const { access_token } = response.data;
      localStorage.setItem('auth_token', access_token);
      axios.defaults.headers.common['Authorization'] = `Bearer ${access_token}`;
        router.push('/sign-in');
    })
    .catch(error => {
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
  width: 60%;
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
input[type=email],
input[type=date]
{
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
  padding: 10px 10px;
  margin: 10px 0;
  margin-bottom: 10px;
  border: none;
  border-radius: 7px;
  cursor: pointer;
  width: 20%;
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
  margin-right: 20px;
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
