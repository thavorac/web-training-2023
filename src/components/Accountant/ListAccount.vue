<script setup lang="ts">
import { ref, computed } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import Datepicker from 'vue3-datepicker';
import IconCategories from '../icons/IconCategories.vue';
import IconsCirclePlus from '../icons/IconCirclePlus.vue';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import { RouterLink } from 'vue-router';
import IconEdit from '../icons/IconEdit.vue';
import IconDelete from '../icons/IconDelete.vue';
import IconDetail from '../icons/IconDetail.vue';
import EyeICon from '../icons/EyeICon.vue';

// Define reactive variables
const accounts = ref<Account[]>([]);
const loading = ref(false);
const startDate = ref<Date | null>(null);
const endDate = ref<Date | null>(null);
const searchQuery = ref('');
const currentPage = ref(1);
const itemsPerPage = ref(10);

interface Account {
  id: number;
  name: string;
  card_number: string;
  type: string;
  balance: number;
  date: string;
}

// Function to fetch accounts
const fetchAccounts = () => {
  loading.value = true;
  axios.get<Account[]>('http://localhost:80/api/accounts')
    .then((response) => {
      accounts.value = response.data; // Directly assign the array to accounts.value
      console.log(response.data);
    })
    .catch((error) => {
      console.error('Error fetching accounts:', error);
    })
    .finally(() => {
      loading.value = false;
    });
};

// Format date
const formatDate = (dateString: string) => {
  const options = {
    year: 'numeric', month: 'short', day: 'numeric',
  };
  const date = new Date(dateString);
  return date.toLocaleDateString(undefined, options);
};

// Computed property for filtered accounts
const filteredAccounts = computed(() => {
  return accounts.value.filter((account) => {
    const accountDate = new Date(account.date);
    const isAfterStartDate = !startDate.value || accountDate >= startDate.value;
    const isBeforeEndDate = !endDate.value || accountDate <= endDate.value;
    const matchesSearchQuery = account.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
                               account.card_number.includes(searchQuery.value) ||
                               account.type.toLowerCase().includes(searchQuery.value.toLowerCase());
    return isAfterStartDate && isBeforeEndDate && matchesSearchQuery;
  });
});

// Computed property for paginated accounts
const paginatedAccounts = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  const end = start + itemsPerPage.value;
  return filteredAccounts.value.slice(start, end);
});

// Function to change page
const changePage = (page: number) => {
  currentPage.value = page;
};

// Function to confirm account deletion
const confirmDelete = (accountId: number) => {
  Swal.fire({
    title: 'Are you sure?',
    text: 'You won\'t be able to revert this!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      deleteAccount(accountId);
    }
  });
};

// Function to delete an account
const deleteAccount = (accountId: number) => {
  axios.delete(`http://localhost:80/api/accounts/${accountId}`)
    .then(() => {
      Swal.fire('Deleted!', 'Your account has been deleted.', 'success');
      fetchAccounts();
    })
    .catch((error) => {
      console.error('Error deleting account:', error);
    });
};

// Fetch accounts on component mount
fetchAccounts();
</script>

<template>
  <div class="container mx-auto">
    <!-- Header Section -->
    <div class="bg-gray-100 flex items-center py-3 px-3 space-x-4 rounded-md">
      <!-- Icon for Accounts -->
      <IconCategories :w="'12'" :h="'12'" class="text-[#F66603]" />
      <!-- Loading Indicator -->
      <template v-if="loading">
        <IconSkLoading class="w-6 h-6" />
      </template>
      <!-- Total Accounts Display -->
      <template v-else>
        <div class="flex flex-col">
          <span class="text-sm font-semibold">Total</span>
          <span class="font-sans font-semibold text-2xl">{{ filteredAccounts.length }}</span>
        </div>
      </template>
      <!-- Router Link to Create Account Page -->
      <RouterLink to="/admin/accounts/create-account"
        class="bg-[#7367F0] no-underline px-4 py-2 space-x-2 text-white flex items-center hover:bg-[#7367F0]/90 cursor-pointer rounded-md">
        <IconsCirclePlus class="w-10 h-10" stroke="2.0" />
        <span class="text-xl font-semibold">Add Account</span>
      </RouterLink>
    </div>
    
    <!-- Search Input -->
    <div class="row">
        <div class="col-3 mt-4">
              <input v-model="searchQuery" type="text" placeholder="Search accounts..." class="w-full p-2 border rounded-md">
        </div>
    </div>

    <!-- Accounts Table -->
    <div class="relative overflow-auto shadow-md sm:rounded-lg mt-4">
      <table class="w-full overflow-auto text-sm text-left rtl:text-right text-gray-500">
        <!-- Table Headers -->
        <thead class="text-xs text-gray-700 bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-lg font-sans">ID</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Account Name</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Account Number</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Type</th>
            <th scope="col" class="px-6 py-3 text-lg font-sans">Balance</th>
            <th scope="col" class="px-6 py-3 text-lg">Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Loading State -->
          <tr v-if="loading">
            <td colspan="7">Loading...</td>
          </tr>
          <!-- No Data State -->
          <template v-if="filteredAccounts.length === 0">
            <tr>
              <td colspan="7" class="px-6 py-6 text-center text-gray-500">No accounts found</td>
            </tr>
          </template>
          <!-- Data Rows -->
          <template v-else>
            <tr v-for="(account, index) in paginatedAccounts" :key="index"
              :class="`bg-white ${index === paginatedAccounts.length - 1 ? '' : 'border-b'} border-gray-200 cursor-pointer hover:bg-gray-100 ${account.type === 'income' ? 'bg-green-100' : account.type === 'outcome' ? 'bg-red-100' : ''}`">
              <td class="px-6 py-6">{{ account.id }}</td>
              <td class="px-6 py-6">{{ account.name }}</td>
              <td class="px-6 py-6">{{ account.card_number }}</td>
              <td class="px-6 py-6">{{ account.type }}</td>
              <!-- <td v-else class="px-6 py-6 text-red-600">{{ account.type }}</td> -->

              <!-- <td v-if="account.type === 'outcome'"  class="px-6 py-6 text-red-600">{{ account.balance }}$</td>
              <td v-else-if="account.type === 'income'" class="px-6 py-6 text-success">{{ account.balance }}$</td> -->
              <td class="px-6 py-6 text-success">{{ account.balance }}$</td>
              
              <td class="px-6 py-6 flex space-x-2">
                <RouterLink :to="`/admin/accounts/${account.id}/edit`">
                  <IconEdit class="w-6 h-6 text-blue-500 cursor-pointer" />
                </RouterLink>
                <IconDelete @click="confirmDelete(account.id)" class="w-6 h-6 text-red-500 cursor-pointer" />
                <RouterLink :to="`/admin/accounts/detail/${account.id}`">
                  <!-- <IconDetail class="w-6 h-6 text-green-500 cursor-pointer" /> -->
                  <EyeICon class="w-6 h-6 text-green-500 cursor-pointer" />
                </RouterLink>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
    
    <!-- Pagination Controls -->
    <div class="mt-4 flex justify-center space-x-2">
      <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">Previous</button>
      <span class="pt-2">{{ currentPage }}</span>
      <button @click="changePage(currentPage + 1)" :disabled="currentPage === Math.ceil(filteredAccounts.length / itemsPerPage)" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">Next</button>
    </div>
  </div>
</template>

<style scoped>
/* Add custom styles if needed */
</style>
