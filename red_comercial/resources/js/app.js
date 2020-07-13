/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require('vue');

//require('./bootstrap');

//import HomeComponent from './components/HomeComponent.vue';
import ExampleComponent from './components/ExampleComponent.vue';
import SidebarComponent from './components/SidebarComponent.vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './app.vue';
Vue.use(VueAxios, axios);

import LoadScript from 'vue-plugin-load-script';
Vue.use(LoadScript);

Vue.loadScript("/vendor/jquery/jquery.min.js").then(() => {
    Vue.loadScript("/vendor/bootstrap/js/bootstrap.bundle.min.js")
    Vue.loadScript("/vendor/jquery-easing/jquery.easing.min.js")
    Vue.loadScript("/js/sb-admin-2.min.js")
}).then(() => {
    Vue.loadScript("/vendor/chart.js/Chart.min.js").then(() => {
        //Vue.loadScript("/js/demo/chart-area-demo.js")
        //Vue.loadScript("/js/demo/chart-pie-demo.js")
    })
}).then(() => {
    Vue.loadScript("/vendor/datatables/jquery.dataTables.min.js").then(() => {

        Vue.loadScript("/vendor/datatables/dataTables.bootstrap4.min.js")
        Vue.loadScript("/js/demo/datatables-demo.js")
    })
})
    .catch(() => {
        // Failed to fetch script
    });

const routes = [
    {
        name: 'home',
        path: '/home',
        component: ExampleComponent
    },
    {
        name: 'sidebar',
        path: '/sidebar',
        component: SidebarComponent
    }
];

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 /*
const app = new Vue({
    el: '#app',
});
*/

// DECLARACION DEL MODULO ROUTER CON LAS RUTAS DECLARADAS
const router = new VueRouter({ mode: 'history', routes: routes});

// ESTA VARIABLE MONTA LA APLICACION Y HACE REFERENIA AL CONTENEDOR "APP"
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');