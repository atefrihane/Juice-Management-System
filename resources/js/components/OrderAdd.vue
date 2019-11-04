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

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID</label>
                            <input class="form-control" id="disabledInput" type="text" v-model="lastOrder" disabled>

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
                            <label for="exampleInputEmail1">Magasin</label>
                            <select class="form-control" v-model="store_id" @change="getStoreData($event)">
                                <option value="" v-if="stores.length > 0" disabled>Selectionner un
                                    magasin
                                </option>
                                <option value="" v-else>Aucun magasin</option>
                                <option v-for="store in stores" :value="store.id ">
                                    {{store.designation}}</option>

                            </select>



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
                            <tr v-for="(ordered,index) in ordered_products">
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
                        <h4 class="box-title"> {{total_ht}}€</h4>
                        <h4 class="box-title"> {{total_tva}}€</h4>

                        <h4 class="box-title"> <b>{{total_order}}€</b></h4>
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

                <button type="button" class="btn btn-warning pl-1" style="margin: 1em" @click="submitSaveOrder()">
                    Enregistrer</button>

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" @click="submitStoreOrder()">
                    Enregistrer et valider</button>

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
                status: ''


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
                let id = event.target.value;
                this.stores = []
                axios.get('/api/companies/' + id)
                    .then((response) => {
                        this.store_id = '';
                        this.stores = response.data.stores;

                        // if(this.stores.length == 0)
                        // {
                        //     this.store_id =null;
                        // }
                        // else{
                        //     this.store_id=this.stores[0].id;
                        // }
                    })
                    .catch(function (error) {

                        console.log(error);
                    })

            },
            getStoreData(event) {
                let id = event.target.value;
                axios.get('/api/store/' + id)
                    .then((response) => {
                        this.code = response.data.store.code + '-' + this.lastOrder;
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
                    axios.get('api/product/details/' + id)
                        .then((response) => {

                            this.ordered_products[index].product_packing = response.data.product.packing;
                            this.ordered_products[index].public_price = response.data.product.public_price;
                            this.ordered_products[index].tva = response.data.product.tva;

                        })
                        .catch(function (error) {
                            console.log(error);
                        })

                }


            },
            clearOrderedProducts() {
                //  total cout produit hors tax //
                this.total_ht = 0;
                this.total_tva = 0;
                this.total_order = 0;

                for (let i in this.ordered_products) {
                    this.total_ht += this.ordered_products[i].total;
                }


                // //  total cout produit avec  tax //

                for (let i in this.ordered_products) {
                    this.total_tva += (this.ordered_products[i].total * this
                        .ordered_products[i].tva / 100);
                }


                // //  cout total de la commande  //
                this.total_order += this.total_ht + this.total_tva;

            },
            removeOrdered(ordered) {

                this.ordered_products.splice(this.ordered_products.indexOf(ordered), 1);
                this.clearOrderedProducts();

            },
            setOrderdPacking(ordered, index) {

                if (ordered.packing != '' && ordered.packing > 0) {

                    ordered.unit = ordered.packing * ordered.product_packing;
                    ordered.total = ordered.public_price * ordered.unit;
                    ordered.product_total_tva = ordered.total + ordered.total * ordered.tva / 100;
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

                if (ordered.unit != '' && ordered.unit > 0) {
           
                    ordered.packing = Math.ceil(ordered.unit / ordered.product_packing)
                    ordered.total = ordered.public_price * ordered.unit;
                    ordered.product_total_tva = (ordered.total * ordered.tva / 100);
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
                }
                if (!this.store_id) {
                    this.errors.push('Veuillez séléctionner un magasin');
                    window.scrollTo(0, 0);
                    x = false;
                }



                if (!this.code) {
                    this.errors.push(' Le code du pays est requis');
                    window.scrollTo(0, 0);
                    x = false;
                }

                this.ordered_products.forEach((ordered, index) => {
                    if (!ordered.product_id) {
                        this.errors.push('Veuillez séléctionner un produit');
                        window.scrollTo(0, 0);
                        x = false;
                    }
                    if (!ordered.packing) {
                        this.errors.push('Le champs nombre de colis est requis');
                        window.scrollTo(0, 0);
                        x = false;
                    }

                    if (!ordered.unit) {
                        this.errors.push('Le champs nombre d\'unités est requis');
                        window.scrollTo(0, 0);
                        x = false;
                    }



                });




                return x;

            },
            submitSaveOrder() {
                if (this.validateForm()) {
                    axios.post('api/order/save', {
                            code: this.code,
                            company_id: this.company_id,
                            store_id: this.store_id,
                            ordered_products: this.ordered_products,
                            comment: this.comment,
                            total_order: this.total_order,
                            user_id: this.user_id,
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
                                        window.location = '/wizefresh/public/orders';
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
                if (this.validateForm()) {
                    axios.post('api/order/save', {
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
                                        window.location = '/wizefresh/public/orders';
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
                window.location = '/wizefresh/public/orders';
            }


        }
    }

</script>
