<template>
  <div class="container-fluid">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6">
          <form class="shadow-lg p-3 bg-white rounded" @submit.prevent="resetPassword">
            <h1>Reset Password</h1>
            <div class="container">
              <label for="newPassword">New Password:</label>
              <input type="password" v-model="newPassword" id="newPassword" required>
              <label for="confirmPassword">Confirm Password:</label>
              <input type="password" v-model="confirmPassword" id="confirmPassword" required>
              <p v-if="successMessage" class="status-message">{{ successMessage }}</p>
            </div>
            <div class="container">
              <router-link to="/forgot-password">
                <button type="button" class="cancelbtn">Cancel</button>
              </router-link>
              <button type="submit" class="float-end">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { ref, watch } from 'vue';
import { useRouter, useRoute } from 'vue-router';

export default {
  setup() {
    const route = useRoute();
    const resetToken = ref(route.params.token);
    const newPassword = ref('');
    const confirmPassword = ref('');
    const successMessage = ref('');
    const router = useRouter();

    const resetPassword = async () => {
      try {
        if (newPassword.value !== confirmPassword.value) {
          throw new Error('Passwords do not match');
        }

        const response = await axios.post('http://localhost:80/api/reset-password', {
          token: resetToken.value,
          password: newPassword.value,
          confirm_password: confirmPassword.value
        });

        if (response.status === 200) {
          successMessage.value = response.data.message;
          setTimeout(() => {
            router.push('/sign-in');
          }, 2000);
        } else {
          throw new Error(response.data.message || 'Password reset failed');
        }
      } catch (error) {
        if (error.response && error.response.status === 400) {
          successMessage.value = 'Invalid or expired token';
        } else {
          successMessage.value = error.response?.data?.message || 'Password reset failed';
        }
      }
    };

    watch(() => route.params.token, (newValue, oldValue) => {
      resetToken.value = newValue;
    });

    return { newPassword, confirmPassword, successMessage, resetPassword };
  }
}
</script>


<style scoped lang="scss">
.container {
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
input[type=password] {
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

button {
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
</style>
