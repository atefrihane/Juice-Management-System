/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
// Load the full build.
var _ = require('lodash');
import Vue from 'vue'
import ProductAdd from './components/ProductAdd.vue'
import ProductUpdate from './components/ProductUpdate.vue'
import MachineRent from './components/MachineRent.vue'
import MachineRentUpdate from './components/MachineRentUpdate.vue'
import CountryAdd from './components/CountryAdd.vue'
import CountryUpdate from './components/CountryUpdate.vue'
import OrderAdd from './components/OrderAdd.vue'
import OrderUpdate from './components/OrderUpdate.vue'
import OrderShow from './components/OrderShow.vue'
import OrderStatusUpdate from './components/OrderStatusUpdate.vue'
import OrderPreparedProducts from './components/OrderPreparedProducts.vue'
import DeliveryUpdate from './components/DeliveryUpdate.vue'
import swal from 'sweetalert2'
// import swal from 'sweetalert';
window.swal = swal;
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: '#3c8dbc',
    failedColor: 'red',
    height: '2px'
})



Vue.component('product-add', require('./components/ProductAdd.vue'));
Vue.component('product-update', require('./components/ProductUpdate.vue'));
Vue.component('machine-rent', require('./components/MachineRent.vue'));
Vue.component('machine-rent-update', require('./components/MachineRentUpdate.vue'));
Vue.component('country-add', require('./components/CountryAdd.vue'));
Vue.component('country-update', require('./components/CountryUpdate.vue'));
Vue.component('order-add', require('./components/OrderAdd.vue'));
Vue.component('order-update', require('./components/OrderUpdate.vue'));
Vue.component('order-show', require('./components/OrderShow.vue'));
Vue.component('order-status-update', require('./components/OrderStatusUpdate.vue'));
Vue.component('order-prepared-products', require('./components/OrderPreparedProducts.vue'));
Vue.component('delivery-update', require('./components/DeliveryUpdate.vue'));
axios.defaults.baseURL = '/wizefresh/public/'
const app = new Vue({
    el: '#app',
    components: {

        'product-add': ProductAdd,
        'product-update': ProductUpdate,
        'machine-rent-update': MachineRentUpdate,
        'country-add': CountryAdd,
        'country-update': CountryUpdate,
        'machine-rent': MachineRent,
        'order-add': OrderAdd,
        'order-update': OrderUpdate,
        'order-show': OrderShow,
        'order-status-update': OrderStatusUpdate,
        'order-prepared-products': OrderPreparedProducts,
        'delivery-update': DeliveryUpdate





    },


});