require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue';
import router from './router'
import store from './store'

const app = new Vue({
    el: '#app',
    router: router,
    store: store,
    created () {
        
        const userInfo = localStorage.getItem('user');

        if ( userInfo ) {
            const userData = JSON.parse(userInfo);
            this.$store.commit('setUserData', userData);
            this.$router.push('/overview');
        }
        
        axios.interceptors.response.use(
            response => {
                return response;
            },
            error => {
                if ( error.response.status === 401 ) {
                    this.$store.dispatch('logout');
                }
   
                return Promise.reject(error)
            }
        );
    },
    render: h => h(App)
});
