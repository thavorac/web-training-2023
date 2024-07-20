<template>
    <div class="customer-details">
      <h2>Customer Details</h2>
      <div v-if="customer">
        <p><strong>ID:</strong> {{ customer.id }}</p>
        <p><strong>Name:</strong> {{ customer.name }}</p>
        <p><strong>Email:</strong> {{ customer.email }}</p>
        <p><strong>Phone:</strong> {{ customer.phone }}</p>
        <p><strong>Registration Date:</strong> {{ customer.registrationDate }}</p>
        <h3>Purchases</h3>
        <ul>
          <li v-for="purchase in customer.purchases" :key="purchase.id">
            <p><strong>Date:</strong> {{ purchase.date }}</p>
            <p><strong>Amount:</strong> {{ purchase.amount }}</p>
            <p><strong>Receipt:</strong> {{ purchase.receipt }}</p>
          </li>
        </ul>
      </div>
      <router-link to="/customerList">Back to Customer List</router-link>
    </div>
  </template>
  
  <script>
  export default {
    name: 'CustomerDetails',
    props: ['id'],
    data() {
      return {
        customer: null,
      };
    },
    created() {
      // Mock data; replace with real API call if necessary
      const customers = [
        {
          id: 1,
          name: 'John Doe',
          email: 'john.doe@example.com',
          phone: '123-456-7890',
          registrationDate: '2021-01-15',
          purchases: [
            {
              id: 1,
              date: '2023-05-01',
              amount: '$100',
              receipt: 'Receipt #1',
            },
            {
              id: 2,
              date: '2023-05-15',
              amount: '$200',
              receipt: 'Receipt #2',
            },
          ],
        },
        {
          id: 2,
          name: 'Jane Smith',
          email: 'jane.smith@example.com',
          phone: '098-765-4321',
          registrationDate: '2021-02-20',
          purchases: [
            {
              id: 3,
              date: '2023-04-10',
              amount: '$150',
              receipt: 'Receipt #3',
            },
          ],
        },
      ];
      this.customer = customers.find((customer) => customer.id === parseInt(this.id));
    },
  };
  </script>
  
  <style scoped>
  .customer-details {
    text-align: left;
    margin: 20px;
  }
  
  .customer-details h3 {
    margin-top: 20px;
  }
  </style>
  