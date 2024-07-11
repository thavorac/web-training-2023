// src/store/index.js
import { createStore } from 'vuex';
import wishlist from './wishlist';

export default createStore({
    modules: {
        wishlist,
    },
});
