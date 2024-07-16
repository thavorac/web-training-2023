<template>
  <div class="customer-table">
    <table>
      <thead>
        <tr>
          <th>Customer ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Registration Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="customer in customers" :key="customer.id">
          <td>{{ customer.id }}</td>
          <td>{{ customer.name }}</td>
          <td>{{ customer.email }}</td>
          <td>{{ customer.phone }}</td>
          <td>{{ customer.registrationDate }}</td>
          <td>
            <router-link :to="`/customer/${customer.id}`">
              <button>View</button>
            </router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'CustomerTable',
  data() {
    return {
      customers: [
        {
          id: 1,
          name: 'John Doe',
          email: 'john.doe@example.com',
          phone: '123-456-7890',
          registrationDate: '2021-01-15',
        },
        {
          id: 2,
          name: 'Jane Smith',
          email: 'jane.smith@example.com',
          phone: '098-765-4321',
          registrationDate: '2021-02-20',
        },
      ],
    };
  },
  methods: {
    deleteCustomer(customerId) {
      alert(`Delete Customer ${customerId}`);
    },
  },
};
</script>

<style scoped>
.customer-table {
  width: 100%;
  margin: 20px 0;
}

.customer-table table {
  width: 100%;
  border-collapse: collapse;
  background-color: #f9f9f9;
}

.customer-table th, .customer-table td {
  padding: 12px 15px;
  text-align: left;
}

.customer-table th {
  background-color: #4CAF50;
  color: white;
}

.customer-table tr:nth-child(even) {
  background-color: #f2f2f2;
}

.customer-table tr:hover {
  background-color: #ddd;
}

.customer-table button {
  padding: 5px 10px;
  margin: 2px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

.customer-table button:hover {
  background-color: #45a049;
}
</style>
