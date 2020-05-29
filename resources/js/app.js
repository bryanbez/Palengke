
require('./bootstrap');
import VueRouter from 'vue-router';
import VueAxios from 'axios';
import RoutesFile from './routes.js';
import store from './store';

window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(VueAxios);

Vue.component('app', require('./components/layouts/base.vue').default);
Vue.component('app-header', require('./components/layouts/header.vue').default);


const router = new VueRouter({
    mode: 'history',
    routes: RoutesFile
});

const app = new Vue({
    store,
    router: router,
    el: '#app',
});
