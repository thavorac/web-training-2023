// src/store/index.js
// import { createStore } from 'vuex';

// export default createStore({
//   state: {
//     user: JSON.parse(localStorage.getItem('user')) || null,
//     token: localStorage.getItem('auth_token') || '',
//   },
//   mutations: {
//     setUser(state, user) {
//       state.user = user;
//     },
//     setToken(state, token) {
//       state.token = token;
//     },
//     logout(state) {
//       state.user = null;
//       state.token = '';
//       localStorage.removeItem('auth_token');
//       localStorage.removeItem('user');
//     },
//   },
//   actions: {
//     login({ commit }, { user, token }) {
//       commit('setUser', user);
//       commit('setToken', token);
//       localStorage.setItem('auth_token', token);
//       localStorage.setItem('user', JSON.stringify(user));
//     },
//     logout({ commit }) {
//       commit('logout');
//     },
//   },
//   getters: {
//     isAuthenticated: state => !!state.token,
//     getUser: state => state.user,
//   },
// });
// src/store/index.js
// src/store/index.js
import { createStore } from 'vuex';



export default createStore({
  state: {
    user: JSON.parse(localStorage.getItem('user')) || null,
    admin: JSON.parse(localStorage.getItem('admin')) || null,
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
    setToken(state, token) {
      state.token = token;
      localStorage.setItem('auth_token', token);
    },
    logout(state) {
      state.user = null;
      state.admin = null;
      state.token = '';
      localStorage.removeItem('auth_token');
      localStorage.removeItem('user');
      localStorage.removeItem('admin');
    },
  },
  actions: {
    login({ commit }, { user, admin, token }) {
      if (user) {
        commit('setUser', user);
      }
      if (admin) {
        commit('setAdmin', admin);
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
  },

});


