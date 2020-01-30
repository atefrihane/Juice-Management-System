<template>
    <div class="box box-primary">

        <div class="box-header">
            <h3 class="box-title"> Ajouter une commande</h3>

        </div>

        <form role="form">
            <div class="box-body">
                <div class="box-body">
                    <div class="alert alert-danger" v-if="errors.length>0">
                        <ul>

                            <li v-for="error in errors">{{error}}</li>

                        </ul>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bénéficiaire</label>

                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Societé</label>
                            <select class="form-control" @change="getCompanyData($event)" v-model="company_id">
                                <option value="" v-if="companies.length && companies.length > 0" disabled>
                                    Selectionner une
                                    societé
                                </option>
                                <option value="" v-else> Aucune societé </option>
                                <option v-for="company in companies" :value="company.id ">{{company.name}}</option>
                            </select>


                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                                Magasin <a href="#" data-toggle="modal" data-target="#exampleModal"><i
                                        class="fa fa-info-circle"></i></a>

                            </label>
                            <select class="form-control" v-model="store_id" @change="getStoreData($event)">
                                <option value="" v-if="stores.length > 0" disabled>Selectionner un
                                    magasin
                                </option>
                                <option value="" v-else>Aucun magasin</option>
                                <option v-for="store in stores" :value="store.id ">
                                    {{store.designation}}</option>

                            </select>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel">Information du magasin
                                                <small>{{store.name}}</small></h4>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Addresse</label>
                                                <input type="text" class="form-control" v-if="store.address"
                                                    :value="store.address" disabled>
                                                <input type="text" class="form-control" v-else value="Aucun" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label>Complément d'addresse</label>
                                                <input type="text" class="form-control" v-if="store.complement"
                                                    :value="store.complement" disabled>
                                                <input type="text" class="form-control" v-if="!store.complement"
                                                    value="Aucun" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label>Pays</label>
                                                <input type="text" class="form-control" v-if="store.country"
                                                    :value="store.country" disabled>
                                                <input type="text" class="form-control" v-else value="Aucun" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label>Ville</label>
                                                <input type="text" class="form-control" v-if="store.city"
                                                    :value="store.city" disabled>
                                                <input type="text" class="form-control" v-else value="Aucun" disabled>
                                            </div>


                                            <div class="form-group">
                                                <label>Code postal</label>
                                                <input type="text" class="form-control" v-if="store.zipcode"
                                                    :value="store.zipcode" disabled>
                                                <input type="text" class="form-control" v-else value="Aucun" disabled>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="text-center">
                                                <a href="#" data-dismiss="modal" class="btn btn-danger">Fermer</a>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Produits à commander</label>

                        </div>
                    </div>

                </div>
                <div class="box-body scrollable-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="no-sort">Produit</th>
                                <th class="no-sort">Nombre de colis</th>
                                <th class="no-sort">Nombre d'unités</th>
                                <th class="no-sort">Colisage</th>
                                <th class="no-sort">Prix unitaire</th>
                                <th class="no-sort">TVA ( % )</th>
                                <th class="no-sort">Total Produit</th>
                                <th class="no-sort"></th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr v-for="(ordered,index) in ordered_products" :items="formatOrdered"
                                v-if="ordered_products">
                                <td style="width:15%;">
                                    <select class="form-control" v-model="ordered.product_id"
                                        @change="getProductData($event,index)">
                                        <option value=""
                                            v-if="ordered.products.length > 0 && ordered.products.length > 0" disabled>
                                            Selectionner un
                                            produit
                                        </option>
                                        <option value="" v-else> Aucun produit </option>
                                        <option v-for="product in ordered.products" :value="product.id ">{{product.nom}}
                                        </option>
                                    </select>
                                </td>
                                <td><input type="number" class="form-control" placeholder="Nombre de colis"
                                        v-model="ordered.packing" @change="setOrderdPacking(ordered,index)"
                                        :disabled="ordered.product_id == ''" min="1"></td>
                                <td> <input type="number" class="form-control" placeholder="Nombre d'unités"
                                        v-model="ordered.unit" @change="setOrderdUnit(ordered,index)"
                                        :disabled="ordered.product_id == ''"></td>
                                <td><input type="text" class="form-control" disabled placeholder="Colisage.."
                                        v-model="ordered.product_packing"></td>
                                <td><input type="text" class="form-control" disabled placeholder="Prix unitaire.."
                                        :value="convertCurrency(ordered.public_price)"></td>
                                <td><input type="text" class="form-control" disabled placeholder="TVA.."
                                        v-model="ordered.tva"></td>
                                <td><input type="text" class="form-control" disabled placeholder="Total Produit.."
                                        :value="convertCurrency(ordered.total)"></td>

                                <td>

                                    <button type="button" class="btn btn-default" v-if="index > 0"
                                        @click="removeOrdered(ordered)"><i class="fa fa-minus"></i></button>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
                <div class="box-body">

                    <button type="button" class="btn btn-default" @click="loadProduct()"><i
                            class="fa fa-plus"></i></button>
                </div>

                <div class="box-body">
                    <div class="pull-left">
                        <h4 class="box-title"> Total HT</h4>
                        <h4 class="box-title"> TVA</h4>

                        <h4 class="box-title"> <b>TOTAL TTC</b></h4>


                    </div>
                    <div class="pull-right">
                        <h4 class="box-title"> {{convert_total_ht}}€</h4>
                        <h4 class="box-title"> {{convert_total_tva}}€</h4>

                        <h4 class="box-title"> <b>{{convert_total_order}}€</b></h4>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date d'arrivée souhaitée (optionnel)</label>
                                <input type="date" class="form-control" v-model="arrival_date_wished">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label>Commentaires (optionnel)</label>
                        <textarea class="form-control" rows="3" name="comment" placeholder="Commentaires"
                            v-model="comment"></textarea>
                    </div>
                </div>

            </div>





        </form>

        <div class="row">
            <div class="container text-center">


                <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelOrder()">
                    Annuler</button>

                <button type="button" class="btn btn-warning pl-1" style="margin: 1em" :disabled="disabled"
                    @click="submitSaveOrder()">
                    Enregistrer</button>

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" :disabled="disabled"
                    @click="submitStoreOrder()">
                    Enregistrer et envoyer</button>

            </div>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {

            this.getCompanies()
            this.loadProduct()
        },

        data() {
            return {
                companies: [],
                stores: [],
                ordered_products: [],
                errors: [],
                company_id: '',
                store_id: '',
                lastOrder: order.orderId,
                code: '',
                total_ht: 0.00,
                total_tva: 0.00,
                total_order: 0.00,
                comment: '',
                user_id: order.userId,
                status: '',
                disabled: false,
                oldIds: [],
                oldCompanyIds: [],
                store: {
                    name: '',
                    address: '',
                    complement: '',
                    country: '',
                    city: '',
                    zipcode: ''
                },
        
                arrival_date_wished: Vue.moment().add(2, 'day').format('YYYY-MM-DD')


            }

        },
        computed: {
            convert_total_ht() {
                let val = (this.total_ht / 1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
                // return this.total_ht.toFixed(2).replace(/\d(?=(\d{3})+\,)/g, '$&,'); // 12.345,67
            },
            convert_total_tva() {
                let val = (this.total_tva / 1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
                // return this.total_tva.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); // 12,345.67

            },
            convert_total_order() {
                let val = (this.total_order / 1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
                // return this.total_order.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); // 12,345.67
            },
            formatOrdered() {
                this.ordered_products.forEach(ordered => {
                    let val = (ordered.public_price / 1).toFixed(2).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
                })

            }
        },
        methods: {

            getCompanies() {

                axios.get('/api/companies')
                    .then((response) => {
                        this.companies = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            getCompanyData(event) {
                this.oldCompanyIds.push(event.target.value)
                let checkExistingProducts = this.checkExistingProduct();
                if (checkExistingProducts > -1) {
                    swal.fire({
                        type: 'info',
                        title: 'Oups !',
                        html: "<b> Attention : </b> Le changement du magasin aura recours à la  reinitialisation des champs déja saisis ",
                        showConfirmButton: true,
                        confirmButtonText: 'Confirmer',
                        showCancelButton: true,
                        cancelButtonText: 'Fermer',
                        allowOutsideClick: false,
                        allowOutsideClick: false,

                    }).then((result) => {
                        if (result.value) {
                            //if accepting to change the selected store(magasin) then reset oldIds array and add the newest one
                            this.total_ht = ''
                            this.total_tva = ''
                            this.total_order = ''
                            this.oldIds = []
                            this.oldCompanyIds = []
                            this.ordered_products.forEach(ordered => {
                                ordered.packing = '',
                                    ordered.unit = '',
                                    ordered.product_packing = '',
                                    ordered.total = '',
                                    ordered.public_price = '',
                                    ordered.product_total_tva = 0,
                                    ordered.tva = '',
                                    ordered.product_id = ''

                            })

                            let id = event.target.value;
                            this.stores = []
                            axios.get('/api/companies/' + id)
                                .then((response) => {
                                    this.store_id = '';
                                    this.stores = response.data.stores;
                                })
                                .catch(function (errdisor) {

                                    console.log(error);
                                })
                        }

                        if (result.dismiss == 'cancel') {
                            //get the first selected one since it's the oldest if canceling
                            this.company_id = this.oldCompanyIds[0]
                        }


                    })

                } else {

                    let id = event.target.value;
                    this.stores = []
                    axios.get('/api/companies/' + id)
                        .then((response) => {
                            this.store_id = '';
                            this.stores = response.data.stores;
                        })
                        .catch(function (errdisor) {

                            console.log(error);
                        })
                }


            },
            checkExistingProduct() {
                let productChosen = _.findIndex(this.ordered_products, function (o) {
                    return o.product_id != '';
                });

                return productChosen
            },
            getStoreData(event) {
                //reset old items
                //add every selected store  
                this.oldIds.push(event.target.value)
                let checkExistingProducts = this.checkExistingProduct();

                if (checkExistingProducts > -1) {
                    swal.fire({
                        type: 'info',
                        title: 'Oups !',
                        html: "<b> Attention : </b> Le changement du magasin aura recours à la  reinitialisation des champs déja saisis ",
                        showConfirmButton: true,
                        confirmButtonText: 'Confirmer',
                        showCancelButton: true,
                        cancelButtonText: 'Fermer',
                        allowOutsideClick: false,
                        allowOutsideClick: false,

                    }).then((result) => {
                        if (result.value) {
                            //if accepting to change the selected store(magasin) then reset oldIds array and add the newest one
                            this.total_ht = ''
                            this.total_tva = ''
                            this.total_order = ''
                            this.oldIds = []
                            this.oldIds.push(event.target.value)
                            this.ordered_products.forEach(ordered => {
                                ordered.packing = '',
                                    ordered.unit = '',
                                    ordered.product_packing = '',
                                    ordered.total = '',
                                    ordered.public_price = '',
                                    ordered.product_total_tva = 0,
                                    ordered.tva = '',
                                    ordered.product_id = ''

                            })
                        }

                        if (result.dismiss == 'cancel') {
                            //get the first selected one since it's the oldest if canceling
                            this.store_id = this.oldIds[0]
                        }
                    })

                } else {

                    this.ordered_products.forEach(ordered => {
                        ordered.packing = '',
                            ordered.unit = '',
                            ordered.product_packing = '',
                            ordered.total = '',
                            ordered.public_price = '',
                            ordered.product_total_tva = 0,
                            ordered.tva = '',
                            ordered.product_id = ''

                    })
                }


                let id = event.target.value;

                axios.get('/api/store/' + id)
                    .then((response) => {
                        console.log(response)
                        this.code = response.data.store.code;

                        this.store.name = response.data.store.designation
                        this.store.address = response.data.store.address
                        this.store.complement = response.data.store.complement
                        this.store.country = response.data.store.country.name
                        this.store.city = response.data.store.city.name
                        this.store.zipcode = response.data.store.zipcode.code

                    })
                    .catch(function (error) {

                        console.log(error);
                    })

            },
            loadProduct() {

                axios.get(axios.defaults.baseURL + '/api/products/')
                    .then((response) => {

                        this.ordered_products.push({
                            packing: '',
                            unit: '',
                            product_packing: '',
                            total: '',
                            public_price: '',
                            product_total_tva: 0,
                            tva: '',
                            products: response.data,
                            product_id: ''
                        })

                    })
                    .catch(function (error) {

                        console.log(error);
                    })


            },
            getProductData(event, index) {
                if (this.store_id) {
                    let id = event.target.value;
                    let found = false;
                    if (this.ordered_products.length > 1) {
                        let count = 0;
                        this.ordered_products.forEach((ordered) => {
                            if (ordered.product_id == id) {
                                count++;
                            }
                            if (count > 1) {
                                found = true;
                                swal.fire({
                                    type: 'error',
                                    title: 'Ce produit est déja selectionné !',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'
                                });
                                this.ordered_products[index].product_id = '';
                            }
                        });

                    }

                    if (!found) {
                        axios.post('/api/product/prices/' + id, {
                                store_id: this.store_id
                            })
                            .then((response) => {

                                this.ordered_products[index].unit = ''
                                this.ordered_products[index].package = ''
                                this.ordered_products[index].packing = ''
                                this.ordered_products[index].total = ''
                                this.clearOrderedProducts()

                                if (response.data.custom_price) {

                                    this.ordered_products[index].product_packing = response.data.product.packing;
                                    this.ordered_products[index].public_price = response.data.custom_price.price;
                                    this.ordered_products[index].tva = response.data.product.tva;
                                    this.ordered_products[index].public_price = this.ordered_products[index]
                                        .public_price

                                } else {
                                    this.ordered_products[index].product_packing = response.data.product.packing;

                                    this.ordered_products[index].public_price = response.data
                                        .product
                                        .public_price;



                                    this.ordered_products[index].tva = response.data.product.tva;
                                }

                            })
                            .catch(function (error) {
                                console.log(error);
                            })



                    }

                } else {
                    swal.fire({
                        type: 'error',
                        title: 'Veuillez séléctionner un magasin !',
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        confirmButtonText: 'Fermer'
                    }).then((result) => {
                        this.ordered_products.forEach(ordered => {
                            ordered.product_id = ""
                        })
                    })

                }



            },
            clearOrderedProducts() {
                //  total cout produit hors tax //
                this.total_ht = 0;
                this.total_tva = 0;
                this.total_order = 0;

                for (let i in this.ordered_products) {
                    if (this.ordered_products[i].total != "") {

                        this.total_ht += this.ordered_products[i].total;

                    }

                }


                // //  total des tax //

                for (let i in this.ordered_products) {
                    if (this.ordered_products[i].total != "") {

                        this.total_tva += (this.ordered_products[i].total * this
                            .ordered_products[i].tva / 100);

                    }

                }


                // //  cout total de la commande  //

                this.total_order += this.total_ht + this.total_tva;


            },
            removeOrdered(ordered) {

                this.ordered_products.splice(this.ordered_products.indexOf(ordered), 1);
                this.clearOrderedProducts();

            },
            convertMoneyFormat(value) {

                return parseFloat(value.replace(',', '.'))

            },
            setOrderdPacking(ordered, index) {


                if (ordered.packing != '' && ordered.packing > 0) {

                    ordered.unit = ordered.packing * ordered.product_packing;
                    ordered.total = ordered.public_price * ordered.unit;
                    ordered.product_total_tva = ordered.total + ordered
                        .total * ordered.tva /
                        100;
                    this.clearOrderedProducts();
                } else {

                    swal.fire({
                        type: 'error',
                        title: 'Le nombre de colis saisi est invalide ! ',
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        confirmButtonText: 'Fermer'


                    });
                    ordered.packing = ''
                    ordered.total = 0;
                    ordered.product_total_tva = 0;
                    this.total_ht = 0;
                    this.total_tva = 0;
                    this.total_order = 0;

                }
            },
            setOrderdUnit(ordered, index) {
                console.log(parseFloat(ordered.public_price))
                if (ordered.unit != '' && ordered.unit > 0) {

                    ordered.packing = Math.ceil(ordered.unit / ordered.product_packing)
                    ordered.total = ordered.public_price * ordered.unit;
                    ordered.product_total_tva = ordered.total * ordered.tva / 100;
                    this.clearOrderedProducts();
                } else {

                    swal.fire({
                        type: 'error',
                        title: 'Le nombre d\'unité saisi est invalide ! ',
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        confirmButtonText: 'Fermer'


                    });
                    ordered.unit = ''
                    ordered.total = 0;
                    ordered.product_total_tva = 0;
                    this.total_ht = 0;
                    this.total_tva = 0;
                    this.total_order = 0;

                }


            },
            validateForm() {

                this.errors = [];
                var x = true;

                if (!this.company_id) {
                    this.errors.push('Veuillez séléctionner une societé');
                    window.scrollTo(0, 0);
                    x = false;
                    this.disabled = false;
                }
                if (!this.store_id) {
                    this.errors.push('Veuillez séléctionner un magasin');
                    window.scrollTo(0, 0);
                    x = false;
                    this.disabled = false;
                }





                this.ordered_products.forEach((ordered, index) => {
                    if (!ordered.product_id) {
                        // this.errors.push('Veuillez séléctionner un produit');
                        // window.scrollTo(0, 0);
                        x = false;
                        this.disabled = false;
                    }
                    if (!ordered.packing) {
                        // this.errors.push('Le champs nombre de colis est requis');
                        // window.scrollTo(0, 0);
                        x = false;
                        this.disabled = false;
                    }

                    if (!ordered.unit) {

                        x = false;
                        this.disabled = false;
                    }



                });

                if (!x) {
                    this.errors.push('Veuillez remplir tout les champs nécessaires pour les produits à commander');
                    window.scrollTo(0, 0);

                }


                return x;

            },
            submitSaveOrder() {
                let that = this;
                this.disabled = true;
                if (this.validateForm()) {

                    // let filterOrdered=_.filter(this.ordered_products, function(o) { return that.convertMoneyFormat(public_price); });

                    axios.post('/api/order/save', {
                            code: this.code,
                            company_id: this.company_id,
                            store_id: this.store_id,
                            ordered_products: this.ordered_products,
                            comment: this.comment,
                            total_order: this.total_order,
                            user_id: this.user_id,
                            arrival_date_wished: this.arrival_date_wished,
                            status: 0

                        })
                        .then((response) => {
                            if (response.data.status == 400) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Code déja utilisé  !',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'


                                });
                                this.disabled = false;



                            }
                            if (response.data.status == 200) {

                                swal.fire({
                                    type: 'success',
                                    title: 'La commande a été sauvegardée avec succés !',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = axios.defaults.baseURL + '/orders';
                                    }
                                })




                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }

            },
            submitStoreOrder() {
                this.disabled = true;
                if (this.validateForm()) {
                    axios.post('/api/order/save', {
                            code: this.code,
                            company_id: this.company_id,
                            store_id: this.store_id,
                            ordered_products: this.ordered_products,
                            comment: this.comment,
                            total_order: this.total_order,
                            user_id: this.user_id,
                            status: 2

                        })
                        .then((response) => {
                            if (response.data.status == 400) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Code déja utilisé  !',
                                    allowOutsideClick: false,
                                    showConfirmButton: true,
                                    confirmButtonText: 'Fermer'


                                });
                                this.disabled = false;



                            }
                            if (response.data.status == 200) {

                                swal.fire({
                                    type: 'success',
                                    title: 'La commande a été ajoutée avec succés !',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = axios.defaults.baseURL + '/orders';
                                    }
                                })



                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }

            },
            cancelOrder() {
                window.location = axios.defaults.baseURL + '/orders';
            },
            convertCurrency(value) {

                if (value != '') {
                    let val = (value / 1).toFixed(2).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")

                }

                return '';



            }



        }
    }

</script>
