
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../../../resources/js/bootstrap.js');

window.Vue = require('vue');

const BaseUrl = require('../../../../variables').api;

window.axios = require('axios');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const apep = new Vue({
    el: '#apep',
    data:{
        stores: [],
        machine: [],
        rental: {
            machine_id: parseInt(localStorage.machine_id),
            store_id: null,
            date_debut: null,
            date_fin: null,
            price: null,
            location: '',
            comment: ''


        },
        bacs: [{status: ''}, {status: ''},{ status: ''}],
        mixtures: [],
        products: []
    },
    methods: {
            getStores: (id)=>{

                axios.get(BaseUrl.url+'companies/'+id,  {
                    headers: {
                        Authorization: "Bearer "+ localStorage.token
                    }
                }).then(res => {
                    apep.rental.company_id = id;
                    apep.stores = res.data.stores;
                    console.log(res.data.stores);
                    console.log(this.stores);

                })
            },
        getMachine: (id)=> {
                apep.rental.machine_id = id;
                axios.get(BaseUrl.url + 'machines/' + id, {
                    headers: {
                        Authorization: localStorage.getItem('token')
                    }
                }).then(res => {
                    apep.rental.price = res.data.price_month
                    apep.machine = res.data;
                    console.log(res.data);
                    apep.initBacs();
                })
        },
        getMixtures: (id, numbac)=> {
                console.log(id);
                apep.mixtures.push({1 : {'hey' : numbac}});
                },
        getProducts: ()=> {
                axios.get(BaseUrl.url + 'products', {
                    headers: {
                        Authorization: localStorage.getItem('token')
                    }
                }).then(res => {
                    apep.products = res.data;
                })
        },
        initBacs: ()=> {
                apep.bacs = [];
                console.log(apep.machine.number_bacs);
                console.log(apep.machine.number_bacs);
            for (let i = 0 ; i < apep.machine.number_bacs; i++){
                apep.bacs.push({order: i +1 , status: 'fonctionnelle', product: null, mixture_id: null, machine_id: apep.machine.id});
            }
        },
        saveRental: ()=>{
                axios.post(BaseUrl.url+ 'rentals', apep.rental, {
                    headers: {
                        Authorization: localStorage.getItem('token')
                    }
                }).then(res => {
                    console.log(res);
                    for (let i = 0 ; i <apep.bacs.length; i++){
                        apep.bacs[i].product_id = apep.bacs[i].product.id;
                    }
                    axios.post(BaseUrl.url +'xbacs', apep.bacs, {
                    headers: {
                        Authorization: localStorage.getItem('token')
                    }
                }).then(res =>{
                        window.location=document.referrer;
                    });
                })
        },
        mounted () {
                console.log('im created');
                this.getMachine(apep.rental.machine_id);
        }
    }


});
apep.getMachine(apep.rental.machine_id);
apep.getProducts();

