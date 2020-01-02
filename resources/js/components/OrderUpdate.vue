<template>
    <div class="box box-primary">

        <div class="box-header">
            <h3 class="box-title"> Modifier une commande</h3>

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

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID</label>
                            <input class="form-control" id="disabledInput" type="text" v-model="order_id" disabled>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Code</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                v-model="code" disabled>
                        </div>
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
                            <select class="form-control" @change="getCompanyData($event)" v-model="company_id" disabled>
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
                            <select class="form-control" v-model="store_id" @change="getStoreData($event)" disabled>
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
                                                <input type="text" class="form-control" v-if="store.address" :value="store.address" disabled>
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
                                                <input type="text" class="form-control" v-if="store.zipcode" :value="store.zipcode" disabled>
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
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Nombre de colis</th>
                                <th>Nombre d'unités</th>
                                <th>Colisage</th>
                                <th>Prix unitaire</th>
                                <th>TVA ( % )</th>
                                <th>Total Produit</th>
                                <th></th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr v-for="(ordered,index) in custom_ordered">
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
                                        v-model="ordered.package" @change="setOrderdPacking(ordered,index)"
                                        :disabled="ordered.product_id == ''"></td>
                                <td> <input type="number" class="form-control" placeholder="Nombre d'unités"
                                        v-model="ordered.unit" @change="setOrderdUnit(ordered,index)"
                                        :disabled="ordered.product_id == ''"></td>
                                <td><input type="text" class="form-control" disabled placeholder="Colisage.."
                                        v-model="ordered.product_packing"></td>
                                <td><input type="text" class="form-control" disabled placeholder="Prix unitaire.."
                                        v-model="ordered.public_price"></td>
                                <td><input type="text" class="form-control" disabled placeholder="TVA.."
                                        v-model="ordered.tva"></td>
                                <td><input type="text" class="form-control" disabled placeholder="Total Produit.."
                                        v-model="ordered.total"></td>

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
                        <textarea class="form-control" rows="3" placeholder="Commentaires"
                            v-model="history.comment"></textarea>
                    </div>
                </div>

            </div>





        </form>

        <div class="row">
            <div class="container text-center">


                <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelOrder()">
                    Annuler</button>
                <button type="button" class="btn btn-warning pl-1" style="margin: 1em" :disabled="disabled"
                    @click="saveOrder()">
                    Enregistrer</button>
                <button type="button" class="btn btn-success pl-1" style="margin: 1em" :disabled="disabled"
                    @click="updateOrder()">
                    Enregistrer et confirmer</button>


            </div>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            this.getCompanies()
            this.getStores()
            this.loadProducts()
            this.loadOrder()
            // this.clearOrderedProducts()


        },
        props: ['order_id', 'user_id', 'history'],
        data() {
            return {

                companies: [],
                stores: [],
                ordered_products: [],
                custom_ordered: [],
                products: [],
                errors: [],
                store_id: '',
                code: '',
                total_ht: 0.00,
                total_tva: 0.00,
                total_order: 0.00,
                comment: '',
                company_id: order.company_id,
                errors: [],
                disabled: false,
                  store:{
                    name:'',
                    address:'',
                    complement:'',
                    country:'',
                    city:'',
                    zipcode:''
                },
                arrival_date_wished:''




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
            }

        },
        methods: {
            loadOrder() {
                let custom_ordered = []
                axios.get('/api/order/' + this.order_id)
                    .then((response) => {

                        this.code = response.data.order.code
                        this.store_id = response.data.order.store_id
                        this.arrival_date_wished=response.data.order.arrival_date_wished
                        this.ordered_products = response.data.ordered_products
                        this.ordered_products.forEach((ordered, index) => {
                            this.custom_ordered.push({
                                name: ordered.nom,
                                package: ordered.pivot.package,
                                unit: ordered.pivot.unit,
                                product_packing: ordered.packing,
                                public_price: this.convertCurrency(ordered.pivot.custom_price),
                                tva: ordered.pivot.custom_tva,
                                products: this.products,
                                product_id: ordered.id,
                                total: this.convertCurrency(parseFloat(ordered.pivot.custom_price) *
                                    ordered.pivot.unit),
                                product_total_tva: ordered.tva

                            });



                        });

                        this.store.name=response.data.store.designation
                        this.store.address=response.data.store.address
                        this.store.complement=response.data.store.complement
                        this.store.country=response.data.store.country.name
                        this.store.city=response.data.store.city.name
                        this.store.zipcode=response.data.store.zipcode.code

                        this.clearOrderedProducts()


                        // this.custom_ordered.forEach(custom => {
                        //     axios.post('api/product/prices/' + custom.product_id, {
                        //             store_id: this.store_id
                        //         })
                        //         .then((response) => {
                                   

                        //             if (response.data.custom_price) {
                                      
                        //                 custom.public_price = this.convertCurrency(response.data.custom_price.price)
                        //                 custom.total = this.convertCurrency(this.convertMoneyFormat(custom
                        //                     .public_price) * custom.unit)
                        //                 // this.clearOrderedProducts()
                        //             }
                        //              this.clearOrderedProducts()

                        //             // this.total_ht += (parseInt(custom.public_price) * parseInt(custom
                        //             //     .unit));
                        //             // this.total_tva += (parseInt(custom.total) * parseInt(custom.tva) /
                        //             //     100);
                        //             // this.total_order = this.total_ht + this.total_tva;


                        //         })
                        //         .catch(function (error) {
                        //             console.log(error);
                        //         })

                        // })


                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            getCompanies() {

                axios.get('/api/companies')
                    .then((response) => {
                        this.companies = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            getStores() {
                axios.get(axios.defaults.baseURL + '/api/stores/')
                    .then((response) => {
                        this.stores = response.data.stores

                    })
                    .catch(function (error) {
                        console.log(error);
                    })

            },
            loadProducts() {
                axios.get(axios.defaults.baseURL + '/api/products/')
                    .then((response) => {
                        this.products.push(...response.data)

                    })
                    .catch((error) => {
                        console.log(error);
                    })

            },
            getCompanyData(event) {


                axios.get('/api/companies/' + this.company_id)
                    .then((response) => {
                        this.store_id = '';
                        this.stores = response.data.stores;


                    })
                    .catch(function (error) {

                        console.log(error);
                    })

            },
            getStoreData(event) {
                let id = event.target.value;
                axios.get('/api/store/' + id)
                    .then((response) => {
                        this.code = response.data.store.code + '-' + this.order_id;

                        this.store.name=response.data.store.designation
                        this.store.address=response.data.store.address
                        this.store.complement=response.data.store.complement
                        this.store.country=response.data.store.country.name
                        this.store.city=response.data.store.city.name
                        this.store.zipcode=response.data.store.zipcode.code
                    })
                    .catch(function (error) {

                        console.log(error);
                    })

            },
            loadProduct() {
                this.custom_ordered.push({
                    name: '',
                    package: '',
                    unit: '',
                    product_packing: '',
                    public_price: '',
                    tva: '',
                    products: this.products,
                    product_id: '',
                    total: '',
                    product_total_tva: ''

                });



            },
            getProductData(event, index) {
                let id = event.target.value;
                let found = false;
                if (this.custom_ordered.length > 1) {
                    let count = 0;
                    this.custom_ordered.forEach((ordered) => {
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
                            this.custom_ordered[index].product_id = '';
                        }
                    });

                    if (!found) {
                        axios.post('/api/product/prices/' + id, {
                                store_id: this.store_id
                            })
                            .then((response) => {

                                
                                this.custom_ordered[index].unit = ''
                                this.custom_ordered[index].package = ''
                                this.custom_ordered[index].packing = ''
                                this.custom_ordered[index].total = ''
                                this.clearOrderedProducts()    

                                if (response.data.custom_price) {
                                      //update old price to the newest one
                                    // swal.fire({
                                    //     type: 'info',
                                    //     title: 'Rappel',
                                    //     html: "Ce magasin dispose déja d'un tarif à ce produit : <br><br>  Prix par défaut : <b>" +
                                    //         response.data.product.public_price +
                                    //         " € </b>  <br>" +
                                    //         "  Nouveau prix : <b>" + response.data.custom_price.price +
                                    //         " € </b>  <br>",
                                    //     showConfirmButton: true,
                                    //     allowOutsideClick: false,
                                    //     confirmButtonText: 'Fermer'
                                    // });
                                  
                                    this.custom_ordered[index].product_packing = response.data.product.packing;
                                    this.custom_ordered[index].public_price = this.convertCurrency(response.data.custom_price.price)
                                    this.custom_ordered[index].tva = response.data.product.tva;

                                } else {
                                    this.custom_ordered[index].product_packing = response.data.product.packing;

                                    this.custom_ordered[index].public_price = this.convertCurrency(response.data
                                        .product
                                        .public_price);



                                    this.custom_ordered[index].tva = response.data.product.tva;
                                }

                            })
                            .catch(function (error) {
                                console.log(error);
                            })

                    }

                }

                // if (!found) {
                //     axios.get('api/product/details/' + id)
                //         .then((response) => {

                //             this.custom_ordered[index].product_packing = response.data.product.packing;
                //             this.custom_ordered[index].public_price = response.data.product.public_price;
                //             this.custom_ordered[index].tva = response.data.product.tva;

                //         })
                //         .catch(function (error) {
                //             console.log(error);
                //         })

                // }


            },

            clearOrderedProducts() {
                //  total cout produit hors tax //
                this.total_ht = 0;
                this.total_tva = 0;
                this.total_order = 0;

                for (let i in this.custom_ordered) {
                    if (this.custom_ordered[i].total != "") {
                        this.total_ht += parseFloat(this.custom_ordered[i].total);

                    }

                }


                // //  total des tax //

                for (let i in this.custom_ordered) {
                    if (this.custom_ordered[i].total != "") {
                        this.total_tva += (this.convertMoneyFormat(this.custom_ordered[i].total) * this
                            .custom_ordered[i].tva / 100);

                    }

                }


                // //  cout total de la commande  //
                this.total_order += parseFloat(this.total_ht) + this.total_tva;
                // this.convertOrderedProducts(this.ordered_products)



            },
            removeOrdered(ordered) {

                swal.fire({
                    type: 'info',
                    title: 'Voulez vous retirer ce produit de la commande ? ',
                    showConfirmButton: true,
                    confirmButtonText: 'Confirmer',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    cancelButtonText: 'Fermer'
                }).then((result) => {
                    if (result.value) {
                        axios.post('/api/order/product/delete/' + this.order_id, {
                                product_id: ordered.product_id

                            })
                            .then((response) => {
                                this.custom_ordered.splice(this.custom_ordered.indexOf(ordered), 1);
                                this.clearOrderedProducts();

                            })
                            .catch((error) => {
                                console.log(error);
                            });
                    }
                })



            },
            setOrderdPacking(ordered, index) {

                if (ordered.package != '') {


                    ordered.unit = ordered.package * ordered.product_packing;
                    ordered.total = this.convertCurrency(this.convertMoneyFormat(ordered.public_price) * ordered.unit);
                    ordered.product_total_tva = this.convertMoneyFormat(ordered.total) + this.convertMoneyFormat(ordered.total) * ordered.tva /
                        100;
                    this.clearOrderedProducts();
                }
            },
            setOrderdUnit(ordered, index) {

                if (ordered.unit != '') {
                    ordered.product_total_tva = 0;
                    ordered.total = 0;
                    ordered.package = Math.ceil(ordered.unit / ordered.product_packing)
                    ordered.total = this.convertCurrency(this.convertMoneyFormat(ordered.public_price) * ordered.unit);
                    ordered.product_total_tva = this.convertMoneyFormat(ordered.total) + this.convertMoneyFormat(ordered.total) * ordered.tva /
                        100;
                    this.clearOrderedProducts();
                }


            },
              convertMoneyFormat(value) {

                return parseFloat(value.replace(',', '.'))

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



                if (!this.code) {
                    this.errors.push(' Le code du pays est requis');
                    window.scrollTo(0, 0);
                    x = false;
                    this.disabled = false;
                }

                this.custom_ordered.forEach((ordered, index) => {
                    if (!ordered.product_id) {
                        // this.errors.push('Veuillez séléctionner un produit');
                        // window.scrollTo(0, 0);
                        x = false;
                        this.disabled = false;
                    }
                    if (!ordered.package) {
                        // this.errors.push('Le champs nombre de colis est requis');
                        // window.scrollTo(0, 0);
                        x = false;
                        this.disabled = false;
                    }

                    if (!ordered.unit) {
                        // this.errors.push('Le champs nombre d\'unités est requis');
                        // window.scrollTo(0, 0);
                        x = false;
                        this.disabled = false;
                    }



                });

                    if(!x)
                {
                     this.errors.push('Veuillez remplir tout les champs nécessaires pour les produits à commander');
                        window.scrollTo(0, 0);

                }

                return x;

            },
            saveOrder() {
                this.disabled = true;
                if (this.validateForm()) {
                    axios.post('/api/order/product/update/' + this.order_id, {

                            company_id: this.company_id,
                            store_id: this.store_id,
                            custom_ordered: this.custom_ordered,
                            comment: this.comment,
                            total_order: this.total_order,
                            user_id: this.user_id,
                            arrival_date_wished:this.arrival_date_wished,
                            status: 0

                        })
                        .then((response) => {

                            if (response.data.status == 200) {

                                swal.fire({
                                    type: 'success',
                                    title: 'La commande a été modifiée avec succés !',
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

            updateOrder() {
                this.disabled = true;
                if (this.validateForm()) {
                    axios.post('/api/order/product/update/' + this.order_id, {

                            company_id: this.company_id,
                            store_id: this.store_id,
                            custom_ordered: this.custom_ordered,
                            comment: this.comment,
                            total_order: this.total_order,
                            user_id: this.user_id,
                            status: 2,
                            arrival_date_wished:this.arrival_date_wished

                        })
                        .then((response) => {

                            if (response.data.status == 200) {

                                swal.fire({
                                    type: 'success',
                                    title: 'La commande a été modifiée avec succés !',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
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
                let val = (value / 1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "")

            },



        }
    }

</script>
