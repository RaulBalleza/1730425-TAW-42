/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require('vue');

//require('./bootstrap');
import Home from './components/ExampleComponent.vue';
import ExampleComponent from './components/ExampleComponent.vue';
import GoogleMap from './components/MapsComponent.vue';
//Vistas de clientes
import ClientesList from './components/clientes/Clientes-list.vue';
import ClientesEditar from './components/clientes/Clientes-single.vue';
//Vistas de micrositios
import MicrositiosList from './components/micrositios/Micrositios-list.vue';
import MicrositiosEditar from './components/micrositios/Micrositios-single.vue';
//Vistas de productos
import ProductosList from './components/productos/Products-list.vue';
import ProductosEditar from './components/productos/Products-single.vue';
//Vistas de servicios
import ServiciosList from './components/servicios/Servicios-list.vue';
import ServiciosEditar from './components/servicios/Servicios-single.vue';
//Vistas de usuarios
import UsersList from './components/users/Users-list.vue';
import UsersEditar from './components/users/Users-single.vue';
//Vistas de categorias
import CategoriasList from './components/categorias/Categorias-list.vue';
import CategoriasEditar from './components/categorias/Categorias-single.vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './app.vue';
Vue.use(VueAxios, axios);

import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyCfYR6KyWS8tA7cZQEa_c2FeamOUHG7j_s",
        libraries: "places" // necessary for places input
    }
});

import Vuetify from 'vuetify';
Vue.use(Vuetify);

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
})/*.then(() => {
    Vue.loadScript("https://polyfill.io/v3/polyfill.min.js?features=default")
    Vue.loadScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyCfYR6KyWS8tA7cZQEa_c2FeamOUHG7j_s&callback=initMap&libraries=&v=weekly")
})*/
    .catch(() => {
        // Failed to fetch script
    });

const routes = [
    {
        name: 'example',
        path: '/example',
        component: ExampleComponent
    },
    {
        name: 'home',
        path: '/home',
        component: Home
    },
    {
        name: 'clientes',
        path: '/clientes/', props: true,
        component: ClientesList
    },
    {
        name: 'clientesEditar',
        path: '/cliente/:id', props: true,
        component: ClientesEditar
    },
    {
        name: 'micrositios',
        path: '/micrositios/', props: true,
        component: MicrositiosList
    },
    {
        name: 'micrositiosEditar',
        path: '/micrositio/:id', props: true,
        component: MicrositiosEditar
    },
    {
        name: 'productos',
        path: '/:id/products/', props: true,
        component: ProductosList
    },
    {
        name: 'productosEditar',
        path: '/product/:id', props: true,
        component: ProductosEditar
    },
    {
        name: 'servicios',
        path: '/:id/servicios/', props: true,
        component: ServiciosList
    },
    {
        name: 'serviciosEditar',
        path: '/servicio/:id', props: true,
        component: ServiciosEditar
    },
    {
        name: 'users',
        path: '/users/', props: true,
        component: UsersList
    },
    {
        name: 'usersEditar',
        path: '/user/:id', props: true,
        component: UsersEditar
    },
    {
        name: 'categorias',
        path: '/:id/categorias/', props: true,
        component: CategoriasList
    },
    {
        name: 'categoriasEditar',
        path: '/categoria/:id', props: true,
        component: CategoriasEditar
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
const router = new VueRouter({ mode: 'history', routes: routes });

// ESTA VARIABLE MONTA LA APLICACION Y HACE REFERENIA AL CONTENEDOR "APP"
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');