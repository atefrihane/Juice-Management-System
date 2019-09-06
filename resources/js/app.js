/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'
import ProductPrice from './components/ProductPrice.vue'
import swal from 'sweetalert2'
window.swal = swal;

Vue.component('product-price', require('./components/ProductPrice.vue'));
axios.defaults.baseURL = 'http://localhost/wizefresh/public/'
const app = new Vue({
    el: '#app',
    components: {
        ProductPrice
    },


});