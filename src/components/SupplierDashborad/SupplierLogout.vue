<template>
    <div>
      <button @click="supplierLogout">Logout</button>
    </div>
  </template>
  
  <script setup>
  import { useStore } from 'vuex';
  import { useRouter } from 'vue-router';
  
  const store = useStore();
  const router = useRouter();
  
  const supplierLogout = async () => {
    try {
      const response = await axios.post('/supplier/logout');
      if (response.data.message === 'Logged out') {
        store.dispatch('supplierLogout');
        router.push('/supplier/login');
      }
    } catch (error) {
      console.error('Error while logging out:', error);
    }
  };
  </script>