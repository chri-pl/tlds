import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        user: null
    },
    mutations: {
        setUserData (state, userData) {
            state.user = userData;
            localStorage.setItem('user', JSON.stringify(userData));
            axios.defaults.headers.common.Authorization = `Bearer ${userData.access_token}`;
        },
        clearUserData () {
            localStorage.removeItem('user');
        }
    },
    actions: {
        signup ({ commit }, data ) {
            return axios.post('/api/signup', data);
        },
        login ({ commit }, credentials ) {
            return axios.post('/api/login', credentials)
                        .then(response => {
                            commit('setUserData', response.data);
                        });
        },
        logout ({ commit }) {
            commit('clearUserData');
        }
    }
})

export default store;