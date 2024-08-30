import { defineStore } from 'pinia';
import axios from 'axios';
import Swal from 'sweetalert2';

export const usePurchasesStore = defineStore('purchases', {
    state: () => ({
        purchases: [],
        totalAccepted: 0,
        totalRejected: 0,
        updatedStatuses: JSON.parse(localStorage.getItem('updatedStatuses') || '{}'),
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
                console.log('Total Pending:', this.totalPending); // Log the total pending value
            } catch (error) {
                console.error('Error fetching purchases:', error);
            }
        },

        async updatePurchaseStatus(purchaseId, status) {
            try {
                await axios.patch(`http://localhost/api/purchase/${purchaseId}`, { status });
                Swal.fire("Updated!", `The purchase status has been updated to ${status}.`, "success");

                // Update the purchase status locally in the store
                const purchase = this.purchases.find(purchase => purchase.id === purchaseId);
                if (purchase) {
                    purchase.status = status;

                    // Update the counts
                    this.totalAccepted = this.purchases.filter(purchase => purchase.status === 'accepted').length;
                    this.totalRejected = this.purchases.filter(purchase => purchase.status === 'rejected').length;
                    this.totalPending = this.purchases.filter(purchase => purchase.status === 'pending').length;

                    // Update the `updatedStatuses` object to hide buttons after status update
                    this.updatedStatuses[purchaseId] = true;

                    // Save the updated statuses to local storage
                    localStorage.setItem('updatedStatuses', JSON.stringify(this.updatedStatuses));
                }
            } catch (error) {
                console.error('Error updating purchase status:', error);
                Swal.fire("Error!", "An error occurred while updating the purchase status.", "error");
            }
        },
    },
});
