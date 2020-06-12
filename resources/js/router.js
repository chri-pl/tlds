import Vue from 'vue'
import VueRouter from 'vue-router'
import Default from './components/Default.vue';
import Overview from './components/Overview.vue';

Vue.use(VueRouter);

export const routes = [
    {
        name: 'default',
        path: '/',
        component: Default
    },
    {
        name: 'overview',
        path: '/overview',
        component: Overview,
        meta: {
            auth: true
        }
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

router.beforeEach((to, from, next) => {
    
    const loggedIn = localStorage.getItem('user');

    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        next('/');
        return;
    }

    next();
});

export default router;