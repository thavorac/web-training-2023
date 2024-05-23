<template>
  <div class="container-fluid">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6">
          <div v-if="!resetToken">
            <form class="shadow-lg p-3 bg-white rounded" @submit.prevent="requestReset">
              <h1>Forgot Password</h1>
              <p>Enter your email address to reset your password.</p>
              <!-- <p v-if="statusMessage" class="status-message">{{ statusMessage }}</p> -->
              <div class="container form-group">
                <label for="email"><b>Email</b></label>
                <input type="email" v-model="email" id="email" placeholder="Enter your email" required>
              </div>
              <div class="container form-group">
                <router-link to="/sign-in">
                  <button type="button" class="cancelbtn">Cancel</button>
                </router-link>
                <button type="submit" class="float-end">Submit</button>
              </div>
              <span class="psw">Don't have an account?<router-link to="/sign-up">Sign Up</router-link></span>
            </form>
          </div>
          <div v-if="resetToken && !passwordReset">
            <div class="container">
              <h2>Email</h2>
              <p>We sent an email to {{ email }} with a link to reset password</p>
            </div>
          </div>
            <div class="modal fade" ref="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="message">
                      <h2>Email</h2>
                      <p>Forgot email success! <br> Please check your email to confirm reset password.</p>
                      <div class="icon-container">
                        <!-- Use the CheckIcon component here -->
                        <CheckIcon class="icon" />
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import CheckIcon from "./icons/CheckIcon.vue";
import{Modal} from "bootstrap/dist/js/bootstrap";//

const email = ref('');
const statusMessage = ref('');
const showSuccessModal = ref(false);
const modal = ref(null)//
const newModal = ref(null)//

const requestReset = async () => {
  try {
    const response = await axios.post('http://localhost:80/api/forgot-password', { email: email.value });
    console.log(response.data); // Log response data for debugging
    statusMessage.value = response.data.message;
    showSuccessModal.value = true; // Show success modal
    newModal.value.show();
  } catch (error) {
    console.error('Request failed:', error);
    // Handle error
    statusMessage.value = 'Failed to send reset password email';
  }
};
onMounted(()=>{
  newModal.value= new Modal(modal.value)
})//
</script>

<style scoped lang="scss">
.container {
  width: 100%;
  height: 100%;
  margin-top: 20px;
  padding: 16px;
}

form {
  width: 85%;
}

.form-group .btn {
  width: 100%;
  margin-bottom: 10px;
}

.form-group {
  margin-top: 40px;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

input[type=text],
input[type=password],
input[type=email] {
  width: 100%;
  padding: 10px 20px;
  margin: 5px 0;
  display: inline-block;
  border: 1px solid #4aafa3;
  box-sizing: border-box;

}

h1,
p {
  text-align: center;
}

button[type=submit] {
  background-color: #04AA6D;
  color: white;
  width: auto;
  padding: 10px 18px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
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
  text-align: center;
  margin: 24px 0 12px 0;
}

span.psw {
  margin-left: 135px;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }

  .cancelbtn {
    width: 100%;
  }
}

.status-message {
  text-align: center;
  color: red;
}

.message {
  text-align: center;
}

.icon-container {
  display: flex;
  justify-content: center;
  margin-top: 20px;
  /* Adjust margin as needed */
  margin-bottom: 10px;
}

.icon {
  /* Add any styles specific to your icon */
  color: #11a7f2;
}
</style>
