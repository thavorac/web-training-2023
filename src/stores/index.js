
import { createStore } from 'vuex';



export default createStore({
  state: {
    user: JSON.parse(localStorage.getItem('user')) || null,
    admin: JSON.parse(localStorage.getItem('admin')) || null,
    supplier: JSON.parse(localStorage.getItem('supplier')) || null,
    token: localStorage.getItem('auth_token') || '',
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
      localStorage.setItem('user', JSON.stringify(user));
    },
    setAdmin(state, admin) {
      state.admin = admin;
      localStorage.setItem('admin', JSON.stringify(admin));
    },
    setSupplier(state, supplier) {
      state.supplier = supplier;
      localStorage.setItem('supplier', JSON.stringify(supplier));
    },
    setToken(state, token) {
      state.token = token;
      localStorage.setItem('auth_token', token);
    },
    logout(state) {
      state.user = null;
      state.admin = null;
      state.supplier = null;
      state.token = '';
      localStorage.removeItem('auth_token');
      localStorage.removeItem('user');
      localStorage.removeItem('admin');
      localStorage.removeItem('supplier');
    },
  },
  actions: {
    login({ commit }, { user, admin, supplier, token }) {
      if (user) {
        commit('setUser', user);
      }
      if (admin) {
        commit('setAdmin', admin);
      }
      if (supplier) {
        commit('setSupplier', supplier);
      }
      commit('setToken', token);
    },
    logout({ commit }) {
      commit('logout');
    },
  },
  getters: {
    isAuthenticated: state => !!state.token,
    getUser: state => state.user,
    getAdmin: state => state.admin,
    getSupplier: state => state.supplier,
  },

});