/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue'

import Swal from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(Swal);

import VueHtmlToPaper from 'vue-html-to-paper';
const options = {
    name: '_blank',
    specs: [
      'fullscreen=yes',
      'titlebar=yes',
      'scrollbars=yes'
    ],
    styles: [
      'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
      'https://unpkg.com/kidlat-css/css/kidlat.css'
    ]
  }

Vue.use(VueHtmlToPaper, options);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//Almacen
Vue.component('dashboard-index', require('./components/almacen/dashboard/DashboardIndex.vue').default);
Vue.component('list-guides', require('./components/almacen/guide/ListGuides.vue').default);
Vue.component('new-guide', require('./components/almacen/guide/NewGuide.vue').default);
Vue.component('insert-warehouse', require('./components/almacen/warehouse/InsertWarehouse.vue').default);
Vue.component('give-warehouse', require('./components/almacen/warehouse/GiveWarehouse.vue').default);
Vue.component('warehouse-asign', require('./components/almacen/warehouse/AssignWarehouse.vue').default);
Vue.component('warehouse-print', require('./components/almacen/warehouse/printWarehouse.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('pagination', require('laravel-vue-pagination'));
export const eventBus = new Vue()
const app = new Vue({
    el: '#app',
});
