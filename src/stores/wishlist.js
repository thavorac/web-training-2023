// src/stores/wishlist.js
import { createStore } from 'vuex';

const store = createStore({
    state: {
        wishlist: [],
    },
    mutations: {
        addToWishlist(state, product) {
            state.wishlist.push(product);
        },
        removeFromWishlist(state, productId) {
            state.wishlist = state.wishlist.filter(product => product.id !== productId);
        },
    },
    actions: {
        addToWishlist({ commit }, product) {
            commit('addToWishlist', product);
        },
        removeFromWishlist({ commit }, productId) {
            commit('removeFromWishlist', productId);
        },
    },
    getters: {
        wishlistItems: state => state.wishlist,
    },
});

export default store;
