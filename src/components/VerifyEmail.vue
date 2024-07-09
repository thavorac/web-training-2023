<template>
    <div class="container-fluid">
      <div class="bg-img">
        <div class="container position-absolute">
          <div class="row justify-content-end">
            <div class="col-6">
              <div class="shadow-lg px-3 bg-white rounded-4 float-end">
                <div class="container">
                  <!-- <h1>Verify Your Email</h1> -->
                  <p v-if="message">{{ message }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import Swal from 'sweetalert2';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
  const message = ref('');
  
  onMounted(async () => {
    const params = new URLSearchParams(window.location.search);
    const user_id = params.get('user_id');
    const otp = params.get('otp');
  
    if (user_id && otp) {
      try {
        const response = await axios.get(`http://localhost:80/api/verify_otp?user_id=${user_id}&otp=${otp}`);
        message.value = response.data.message;
        Swal.fire({
          icon: 'success',
          title: 'Email Verification Successful',
          text: response.data.message,
        }).then(() => {
          router.push('/sign-in');
        });
      } catch (error) {
        message.value = error.response.data.message;
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: error.response.data.message || 'Verification failed. Please try again.',
        });
      }
    } else {
      message.value = 'Invalid verification link.';
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Invalid verification link.',
      });
    }
  });
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
  </style>
  