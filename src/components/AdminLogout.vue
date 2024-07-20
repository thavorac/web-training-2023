<template>
    <div>
      <button @click="adminLogout">Logout</button>
    </div>
  </template>
  
  <script setup>
  import { useStore } from 'vuex';
  import axios from '../services/axios';
  import { useRouter } from 'vue-router';
  
  const store = useStore();
  const router = useRouter();
  
  const adminLogout = async () => {
    try {
      const response = await axios.post('/admin/logout');
      if (response.data.message === 'Logged out') {
        store.dispatch('adminLogout');
        router.push('/admin/login');
      }
    } catch (error) {
      console.error('Error while logging out:', error);
    }
  };
  </script>
  