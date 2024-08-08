import { defineStore } from 'pinia';
import axios from 'axios';

export const usePurchasesStore = defineStore('purchases', {
    state: () => ({
        purchases: [],
        totalAccepted: 0,
        totalRejected: 0,
    }),
    actions: {
        async fetchAllData() {
            try {
                const response = await axios.get('http://localhost/api/purchases');
                this.purchases = response.data;

                console.log('Fetched Purchases:', this.purchases); // Log the fetched data

                this.totalAccepted = this.purchases.filter(purchase => purchase.status === 'accepted').length;
                this.totalRejected = this.purchases.filter(purchase => purchase.status === 'rejected').length;
                this.totalPending = this.purchases.filter(purchase => purchase.status === 'pending').length;

                console.log('Total Accepted:', this.totalAccepted); // Log the total accepted value
                console.log('Total Rejected:', this.totalRejected); // Log the total rejected value
                console.log('Total Pending:', this.totalPending); // Log the total rejected value
            } catch (error) {
                console.error('Error fetching purchases:', error);
            }
        },
    },
});
