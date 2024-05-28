<template>
  <div class="container mt-5">
    <h2>Order List</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Order ID</th>
          <th scope="col">Customer Name</th>
          <th scope="col">Total Amount</th>
          <th scope="col">Status</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orders" :key="order.id">
          <th scope="row">{{ order.id }}</th>
          <td>{{ order.customerName }}</td>
          <td>{{ order.totalAmount }}</td>
          <td :class="statusClass(order.status)">
            <i :class="statusIcon(order.status)" aria-hidden="true"></i>
            {{ order.status }}
          </td>
          <td>{{ order.date }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'OrderTable',
  data() {
    return {
      orders: [
        {
          id: '001',
          customerName: 'John Doe',
          totalAmount: '$120.00',
          status: 'Shipped',
          date: '2024-05-25',
        },
        {
          id: '002',
          customerName: 'Jane Smith',
          totalAmount: '$80.00',
          status: 'Processing',
          date: '2024-05-26',
        },
        {
          id: '003',
          customerName: 'Alex Johnson',
          totalAmount: '$50.00',
          status: 'Cancelled',
          date: '2024-05-27',
        },
        // Add more orders as needed
      ],
    };
  },
  methods: {
    statusClass(status) {
      switch (status) {
        case 'Shipped':
          return 'text-success';
        case 'Processing':
          return 'text-warning';
        case 'Cancelled':
          return 'text-danger';
        default:
          return '';
      }
    },
    statusIcon(status) {
      switch (status) {
        case 'Shipped':
          return 'fas fa-check-circle';
        case 'Processing':
          return 'fas fa-hourglass-half';
        case 'Cancelled':
          return 'fas fa-times-circle';
        default:
          return '';
      }
    },
  },
};
</script>

<style scoped>
.table {
  margin-top: 20px;
}
</style>
