/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require("vue");

import VueAxios from "vue-axios";
import axios from "axios";

Vue.use(VueAxios, axios);

const MAPS_API_KEY = "AIzaSyAP7WklFEn9_GJMHto9IGZucRegx9T_Jik";

import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
    load: {
        key: MAPS_API_KEY,
        libraries: "places" // necessary for places input
    }
});

import LoadScript from "vue-plugin-load-script";
Vue.use(LoadScript);

Vue.loadScript("/vendor/jquery/jquery.min.js")
    .then(() => {
        Vue.loadScript("/vendor/bootstrap/js/bootstrap.bundle.min.js");
        Vue.loadScript("/vendor/jquery-easing/jquery.easing.min.js");
        Vue.loadScript("/js/sb-admin-2.min.js");
    })
    .then(() => {
        Vue.loadScript("/vendor/chart.js/Chart.min.js").then(() => {
            //Vue.loadScript("/js/demo/chart-area-demo.js")
            //Vue.loadScript("/js/demo/chart-pie-demo.js")
        });
    })
    .then(() => {
        Vue.loadScript("/vendor/datatables/jquery.dataTables.min.js").then(
            () => {
                Vue.loadScript(
                    "/vendor/datatables/dataTables.bootstrap4.min.js"
                );
                Vue.loadScript("/js/demo/datatables-demo.js");
            }
        );
    })
    .then(() => {
        Vue.loadScript(
            "https://polyfill.io/v3/polyfill.min.js?features=default"
        );
    })
    .catch(() => {
        // Failed to fetch script
    });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context("./", true, /\.vue$/i);
files.keys().map(key =>
    Vue.component(
        key
            .split("/")
            .pop()
            .split(".")[0],
        files(key).default
    )
);

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

import { routes, routesAdmin } from "./routes.js";

import VueRouter from "vue-router";
Vue.use(VueRouter);

import App from "./app.vue";
import App2 from "./app2.vue";
import MicrositioComponent from "./components/micrositio/MicrositioComponent.vue";
//import MicrositioComponent from "./components/ExampleComponent.vue";

var rutas_micrositios = [];
var rutas = [];

function listMicrositios() {
    return axios.get("/api/micrositios").then(response => {
        return response.data;
    });
}

listMicrositios()
    .then(micrositios => {
        micrositios.forEach(micrositio => {
            rutas_micrositios.push({
                name: micrositio.nombre,
                path: "/micrositio/" + micrositio.url+"/",
                component: MicrositioComponent,
                props: { id: micrositio.id}
            });
        });
        rutas = routes.concat(rutas_micrositios);
        initApps();
    })
    .catch((e) => {
        {
            //console.log(e);
        }
    });

function initApps() {
    // DECLARACION DEL MODULO ROUTER CON LAS RUTAS DECLARADAS
    const router = new VueRouter({ mode: "history", routes: routesAdmin });
    // ESTA VARIABLE MONTA LA APLICACION Y HACE REFERENIA AL CONTENEDOR "APP"
    const app = new Vue(Vue.util.extend({ router }, App)).$mount("#app");

    const router2 = new VueRouter({ mode: "history", routes: rutas });
    //console.log(router2);

    const app2 = new Vue(Vue.util.extend({ router: router2 }, App2)).$mount(
        "#app2"
    );
    //console.log(app2);

}
