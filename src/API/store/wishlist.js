// src/store/wishlist.js
const state = {
    wishlist: [],
};

const getters = {
    getWishlist: (state) => state.wishlist,
};

const mutations = {
    addToWishlist(state, product) {
        state.wishlist.push(product);
    },
    removeFromWishlist(state, productId) {
        state.wishlist = state.wishlist.filter((product) => product.id !== productId);
    },
};

const actions = {
    addToWishlist({ commit }, product) {
        commit('addToWishlist', product);
    },
    removeFromWishlist({ commit }, productId) {
        commit('removeFromWishlist', productId);
    },
};

export default {
    state,
    getters,
    mutations,
    actions,
};
