/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'
import ProductPrice from './components/ProductPrice.vue'
import ProductAdd from './components/ProductAdd.vue'
import swal from 'sweetalert2'
import VueColor from 'vue-color'
window.swal = swal;
window.VueColor = require('vue-color');

Vue.component('product-price', require('./components/ProductPrice.vue'));
Vue.component('product-add', require('./components/ProductAdd.vue'));

axios.defaults.baseURL = '/wizefresh/public/'
const app = new Vue({
    el: '#app',
    components: {
        ProductPrice,
        ProductAdd,
        VueColor
    },


});