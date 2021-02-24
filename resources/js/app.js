/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import Swal from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(Swal);

import VueHtmlToPaper from 'vue-html-to-paper';
const options = {
  styles: [
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
  ]
}
Vue.use(VueHtmlToPaper, options);

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


//Warehouse
Vue.component('dashboard-index', require('./components/almacen/dashboard/Dashboard.vue').default);
Vue.component('list-guides', require('./components/almacen/guide/ListGuides.vue').default);
Vue.component('new-guide', require('./components/almacen/guide/NewGuide.vue').default);


Vue.component('list-warehouse', require('./components/almacen/warehouse/ListWarehouse.vue').default);
Vue.component('insert-warehouse', require('./components/almacen/warehouse/InsertWarehouse.vue').default);
Vue.component('assign-warehouse', require('./components/almacen/warehouse/AssignWarehouse.vue').default);
Vue.component('give-warehouse', require('./components/almacen/warehouse/GiveWarehouse.vue').default);
Vue.component('print-warehouse', require('./components/almacen/warehouse/PrintWarehouse.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

export const eventBus = new Vue()

const app = new Vue({
    el: '#app',
});


