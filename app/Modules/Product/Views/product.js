//
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */
//
// require('../../../../resources/js/bootstrap.js');
//
// window.Vue = require('vue');
//
//
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
// const app = new Vue({
//     el: '#productapp',
//     data:{
//         p:"dd",
//         product: {
//             code: '',
//             status: '',
//             type:'',
//             nom:'',
//             designation:'',
//             barcode:'',
//             version:'',
//             composition:'',
//             color:'',
//             weight:'',
//             height:'',
//             depth:'',
//             public_price:'',
//             period_of_validity:'',
//             validity_after_opening:'',
//             comment: '',
//             photo_url: null,
//             unit_by_display: 0,
//             unit_per_package:0,
//             packing: this.product.unit_by_display * this.product.unit_per_package
//         }
//     }
//
//
// });

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('../../../../resources/js/bootstrap.js');
const BaseUrl = require('../../../../variables').api;
window.Vue = require('vue');
console.log(BaseUrl);

window.axios = require('axios');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
var mixture = new Vue({
    data() {
        return {
            name: '',
            final_amount: null,
            needed_weight: null,
            water_amount:null,
            sugar_amount:null,
            glass_size:null,
            number_of_glasses:null,
            product_id: null

        };
    }
});
const apep = new Vue({
    el: '#prod',
    data() {
       return { body:'dddo',
           mixtures:[
              {name: null, final_amount: 15,needed_weight: null, water_amount: null, glass_size: null, number_of_glasses: null, product_id:null}
           ],
            product: {


            code: 'aaa',
            status: '',
            type:'',
            nom:'',
            designation:'',
            barcode:'',
            version:'',
            composition:'',
            color:'',
            weight:'',
            height:'',
            width:0,
            depth:'',
            public_price:0,
            period_of_validity:0,
            validity_after_opening:0,
            comment: '',
            photo_url: null,
            unit_by_display: 0,
            unit_per_package:0,
            packing: this.unit_by_display * this.unit_per_package

    }}

    },
    methods:{
    save: function(){
        axios.post(BaseUrl.url + 'products', this.product, {
            headers: {
                Authorization: localStorage.getItem('token')
            }
        }).then(res => {
            console.log(res);
            for(let i = 0 ; i<this.mixtures.length; i++){
                this.mixtures[i].product_id = res.data.id;
            }
            console.log(this.mixtures);
            axios.post(BaseUrl.url + 'mixtures', this.mixtures).then(rs => window.location.replace( "/products"));

        })
    },
        pushMixture(){
        this.mixtures.push(   {name: null, final_amount: null,needed_weight: null, water_amount: null, glass_size: null, number_of_glasses: null, product_id:null});
        }
    }

});


