<!-- Profile.vue -->
<script setup lang="ts">
import { computed } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

const store = useStore();
const user = computed(() => store.getters.getUser);
const router = useRouter();

if (!store.getters.isAuthenticated) {
  router.push('/login'); // Redirect to login if not authenticated
}
</script>

<template>
<div class="container-fluid profile-page">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
      <div v-if="user" class="card shadow-lg p-3 mb-5 bg-white rounded-4">
        <div class="card-body">
          <h1 class="card-title text-center mb-4">User Profile</h1>
          <p class="card-text"><strong>Name:</strong>{{ user.last_name }} {{ user.first_name }} </p>
          <p class="card-text"><strong>Email:</strong> {{ user.email }}</p>
          <p class="card-text"><strong>Date of Birth:</strong> {{ user.date_of_birth }}</p>
          <p class="card-text"><strong>Address:</strong> {{ user.address }}</p>
          <p class="card-text"><strong>Phone Number:</strong> {{ user.phone_number }}</p>
          <p class="card-text"><strong>Gender:</strong> {{ user.gender }}</p>
        </div>
      </div>
      <div v-else class="alert alert-warning" role="alert">
        No user profile found. Please log in.
      </div>
    </div>
  </div>
</div>
</template>
