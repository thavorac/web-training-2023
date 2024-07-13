// src/store/index.js
import { createStore } from 'vuex';

export default createStore({
  state: {
    user: JSON.parse(localStorage.getItem('user')) || null,
    token: localStorage.getItem('auth_token') || '',
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    setToken(state, token) {
      state.token = token;
    },
    logout(state) {
      state.user = null;
      state.token = '';
      localStorage.removeItem('auth_token');
      localStorage.removeItem('user');
    },
  },
  actions: {
    login({ commit }, { user, token }) {
      commit('setUser', user);
      commit('setToken', token);
      localStorage.setItem('auth_token', token);
      localStorage.setItem('user', JSON.stringify(user));
    },
    logout({ commit }) {
      commit('logout');
    },
  },
  getters: {
    isAuthenticated: state => !!state.token,
    getUser: state => state.user,
  },
});
