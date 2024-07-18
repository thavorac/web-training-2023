import { defineStore } from 'pinia';
import { useToast } from "vue-toastification";

const toast = useToast();

export const useCartStore = defineStore('cart', {
    state: () => ({
        products: [
            {
                id: 1,
                name: 'Apple Watch Series 5',
                description: 'alkfj',
                price: 800,
                image: new URL("../assets/image/left.png", import.meta.url)
            },
            {
                id: 2,
                name: 'Apple iPhone 11 (64GB, Black)',
                description: 'alkfj',
                price: 400,
                image: new URL("../assets/image/001.png", import.meta.url)
            },
            {
                id: 3,
                name: 'Apple iMac 27-inch',
                description: 'alkfj',
                price: 200,
                image: new URL("../assets/image/02.png", import.meta.url)
            },
            {
                id: 4,
                name: 'Vivo 12',
                description: 'alkfj',
                price: 900,
                image: new URL("../assets/image/03.png", import.meta.url)
            },
            {
                id: 5,
                name: 'Aplle 12',
                description: 'alkfj',
                price: 900,
                image: new URL("../assets/image/04.png", import.meta.url)
            },
            {
                id: 6,
                name: 'Samsung 12',
                description: 'alkfj',
                price: 900,
                image: new URL("../assets/image/005.png", import.meta.url)
            },
            {
                id: 7,
                name: 'Reno 12',
                description: 'alkfj',
                price: 900,
                image: new URL("../assets/image/007.png", import.meta.url)
            },
            {
                id: 8,
                name: 'GAlaxy 12',
                description: 'alkfj',
                price: 900,
                image: new URL("../assets/image/008.png", import.meta.url)
            },
            {
                id: 9,
                name: 'Desktop 12',
                description: 'alkfj',
                price: 900,
                image: new URL("../assets/image/009.png", import.meta.url)
            },
        ],
        cartItems: []
    }),
    getters: {
        countCartItems(state) {
            return state.cartItems.length;
        }
    },
    actions: {
        addToCart(item) {
            // Find the index of the item in the cartItems array
            let index = this.cartItems.findIndex(product => product.id === item.id);
            if (index !== -1) {
                // If the item is already in the cart, increase its quantity
                this.cartItems[index].quantity += 1;
                // Display a success message for updating the item
                toast.success("Your item has been updated", {
                    timeout: 2000
                });
            } else {
                // If the item is not in the cart, add it with a quantity of 1
                item.quantity = 1;
                this.cartItems.push(item);
                // Display a success message for adding the item
                toast.success("Your item has been saved", {
                    timeout: 2000
                });
            }
        },
        incrementQ(item) {
            let index = this.cartItems.findIndex(product => product.id === item.id);
            if (index !== -1) {
                // Increment the quantity
                this.cartItems[index].quantity += 1;

                // Trigger Vue reactivity by creating a new array
                this.cartItems = [...this.cartItems];

                // Show success message
                toast.success("Your item has been updated", {
                    timeout: 2000
                });
            }
        },
        decrementQ(item) {
            let index = this.cartItems.findIndex(product => product.id === item.id);
            if (index !== -1) {
                // If the item is already in the cart, increase its quantity
                this.cartItems[index].quantity -= 1;
                if (this.cartItems[index].quantity === 0) {
                    this.cartItems = this.cartItems.filter(product => product.id !== item.id)
                }
                // Display a success message for updating the item
                toast.success("Your item has been updated", {
                    timeout: 2000
                });
            }
        },
        removeFromCart(item) {
            this.cartItems = this.cartItems.filter(product => product.id !== item.id);
            toast.success("Your item has been removed", {
                timeout: 2000
            });
        }

    },
})