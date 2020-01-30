<template>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Préparation de la commande </h3>

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
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID</label>
                                <input class="form-control" id="disabledInput" type="text" v-model="order_id" disabled>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Code</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-model="code" disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Etat actuel</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-model="formated_status" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row" style="margin-top:40px;">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-size:20px;">Produits commandés</label>

                            </div>
                        </div>

                    </div>

                    <div class="box-body scrollable-table">
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
                                            @change="getProductData($event,index)" disabled>
                                            <option value=""
                                                v-if="ordered.products.length > 0 && ordered.products.length > 0"
                                                disabled>
                                                Selectionner un
                                                produit
                                            </option>
                                            <option value="" v-else> Aucun produit </option>
                                            <option v-for="product in ordered.products" :value="product.id ">
                                                {{product.nom}}
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="number" class="form-control" placeholder="Nombre de colis"
                                            v-model="ordered.package" @change="setOrderdPacking(ordered,index)"
                                            :disabled="ordered.product_id == ''" disabled></td>
                                    <td> <input type="number" class="form-control" placeholder="Nombre d'unités"
                                            v-model="ordered.unit" @change="setOrderdUnit(ordered,index)"
                                            :disabled="ordered.product_id == ''" disabled></td>
                                    <td><input type="text" class="form-control" disabled placeholder="Colisage.."
                                            v-model="ordered.product_packing" disabled></td>
                                    <td><input type="text" class="form-control" disabled placeholder="Prix unitaire.."
                                            :value="convertCurrency(ordered.public_price)" disabled></td>
                                    <td><input type="text" class="form-control" disabled placeholder="TVA.."
                                            v-model="ordered.tva" disabled></td>
                                    <td><input type="text" class="form-control" disabled placeholder="Total Produit.."
                                            :value="convertCurrency(ordered.total)" disabled></td>

                                    <td>

                                    </td>
                                </tr>




                            </tbody>
                        </table>
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

                    <div class="row" style="margin-top:40px;">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-size:20px;">Produits préparés</label>

                            </div>
                        </div>
                        <div class="container-fluid" style="margin-top:50px;">
                            <div class="box" style="border:1px solid rgb(228, 228, 228);padding:20px;"
                                v-for="(final,i) in final_prepared">
                                <div class="box-body">
                                    <div class="" v-if="i > 0">
                                        <a href="" class="pull-right btn btn-default"
                                            @click.prevent="removePrepared(final)"><i class="fa fa-minus"></i></a>
                                    </div>
                                   
                                    <div class="container-fluid">
                                        <div class="row" style="margin-top:35px;">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nom du produit</label>
                                                    <select class="form-control" v-model="final.product_id"
                                                        @change="($event, index) => getProductData($event,i)">
                                                        <option value="" v-if="products && products.length > 0"
                                                            disabled>
                                                            Selectionner un
                                                            produit
                                                        </option>
                                                        <option value="" v-else> Aucun produit </option>
                                                        <option v-for="product in products" :value="product.id ">
                                                            {{product.nom}}
                                                        </option>
                                                    </select>

                                                </div>
                                            </div>

                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Total des quantités restantes</label>
                                                    <input type="text" class="form-control" v-model="final.total_rest"
                                                        disabled>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Total des quantités préparés</label>
                                                    <input type="text" class="form-control" v-model="final.total"
                                                        disabled>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row scrollable-table">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nom Produit</th>
                                                        <th>Quantité</th>
                                                        <th>Unités par display</th>
                                                        <th>Displays par colis</th>
                                                        <th>Colisage</th>
                                                        <th>Entrepôt</th>
                                                        <th>Date de fabrication</th>
                                                        <th>Date de préemption</th>
                                                        <th>Quantité preparée</th>

                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <tr v-if="final.prepared_products.length == 0">
                                                        <td colspan="9" class="text-center">
                                                            <h4 v-if="final.product_id == ''">Veuillez sélectionner un
                                                                produit !</h4>
                                                            <h4 v-else>Aucun produit trouvé !</h4>
                                                        </td>
                                                    </tr>
                                                    <loading :active.sync="final.isLoading" :is-full-page="false"
                                                        :opacity="0.7" loader="dots" color="#3c8dbc"></loading>
                                                    <tr v-for="(prepared,index) in final.prepared_products">
                                                        <td>{{final.product_name}} </td>
                                                        <td>{{prepared.quantity}} </td>
                                                        <td>{{prepared.stock_display}}</td>
                                                        <td>{{prepared.packing_display}}</td>
                                                        <td>{{prepared.packing}} </td>
                                                        <td>{{prepared.warehouse.designation}} </td>
                                                        <td>{{prepared.creation_date}} </td>
                                                        <td>{{prepared.expiration_date}} </td>
                                                      
                                                        <td><input type="number" min="1" class="form-control"
                                                                placeholder="Quantité préparée"
                                                                @change="updateTotalQuantity(prepared,index,i)"
                                                                v-model.number="prepared.pivot.quantity">
                                                        </td>


                                                        </td>
                                                    </tr>






                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-default" @click="loadPrepared()"><i
                                    class="fa fa-plus"></i></button>



                        </div>

                        <div class="row">
                            <div class="container text-center">


                                <button type="button" class="btn btn-danger pl-1" style="margin: 1em"
                                    @click="cancelOrder()">
                                    Annuler</button>

                                <button type="button" class="btn btn-success pl-1" style="margin: 1em"
                                    :disabled="disabled" @click="submitOrderPreparedProducts()">
                                    Enregistrer</button>


                            </div>
                        </div>

                    </div>

                </div>




            </div>





        </form>


    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    export default {
        mounted() {
            this.formatStatus()
            this.loadProducts()
            this.loadOrder()

        },
        props: ['order_id', 'user_id', 'status', 'code'],

        data() {
            return {

                formated_status: '',
                products: [],
                ordered_products: [],
                final_prepared: [],
                custom_ordered: [],
                prepared_products: [],
                response_array: [],
                errors: [],
                warehouse_products: [],
                disabled: false,
                total_ht: 0.00,
                total_tva: 0.00,
                total_order: 0.00,

            }
        },
        components: {
            Loading
        },
        computed: {

            // a computed getter


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

            formatStatus() {
                let status = JSON.parse(this.status)
                switch (status) {
                    case 2:

                        this.formated_status = 'A préparer';
                        break;
                    case 3:
                        this.formated_status = 'En cours de préparation';
                        break;
                    case (4):
                        this.formated_status = 'Préparée';
                        break;
                    case (5):
                        this.formated_status = 'A préparer';
                        break;
                    case (6):
                        this.formated_status = 'A livrer';
                        break;
                    case (7):
                        this.formated_status = ' En cours de livraison';
                        break;
                    case (8):
                        this.formated_status = ' Livrée';
                        break;
                    case (9):
                        this.formated_status = 'A facturer';
                        break;
                    case (10):
                        this.formated_status = 'Facturée';
                        break;
                    case (11):
                        this.formated_status = 'A envoyer en comptabilité';
                        break;
                    case (12):
                        this.formated_status = 'Comptabilisée';
                        break;
                    case (13):
                        this.formated_status = 'Annulée';
                        break;

                }



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
            clearPreparedProducts() {
                this.custom_ordered.forEach(custom =>{
                    
                })    
                this.final_prepared.forEach(final => {
                    final.total = 0;
                    final.prepared_products.forEach(prepared => {
                        if (prepared.pivot.quantity != '') {
                            final.total += prepared.pivot.quantity;

                        }

                    })
                    // console.log('***')
                    // console.log(final.total)
                    final.total_rest=final.fullQuantity-final.total
                    if (final.total_rest < 0) {
                        final.total_rest=0;
                    }

                })


            },
            loadOrder() {
                axios.get('/api/order/' + this.order_id)
                    .then((response) => {
                        console.log(response)
                        this.code = response.data.order.code
                        this.store_id = response.data.order.store_id
                        this.ordered_products = response.data.ordered_products
                        this.order_history = response.data.order_history
                        this.prepared_products = response.data.prepared_products

                        this.ordered_products.forEach((ordered, index) => {
                            this.custom_ordered.push({
                                name: ordered.nom,
                                package: ordered.pivot.package,
                                unit: ordered.pivot.unit,
                                product_packing: ordered.packing,
                                public_price: ordered.pivot.custom_price,
                                tva: ordered.tva,
                                products: this.products,
                                product_id: ordered.id,
                                total: ordered.pivot.custom_price *
                                    ordered.pivot.unit,
                                product_total_tva: ordered.tva

                            });
                        });
                            this.clearOrderedProducts()

                        if (this.prepared_products.length > 0) {

                             this.prepared_products.forEach(prepared => {
                                this.final_prepared.push({
                                    product_id: prepared[0].product.id,
                                    product_name: prepared[0].product.nom,
                                    total: 0,
                                    total_rest: 0,
                                    fullQuantity: 0,
                                    prepared_products: prepared,
                                    isLoading: false
                                })
                            });

                              this.final_prepared.forEach(final => {
                                 this.custom_ordered.forEach(ordered => {
                                    if(ordered.product_id == final.product_id){
                                        final.total_rest=ordered.unit
                                        final.fullQuantity=ordered.unit
                                    }
                                })

                                axios.get(`/api/product/warehouses/${final.product_id}`)
                                    .then((response) => {

                                        this.warehouse_products = response.data.warehouse_products;
                                        if (this.warehouse_products.length > 0) {
                                             this.warehouse_products.forEach(warehouse_product => {
                                                let prepareIndex = final.prepared_products
                                                    .findIndex(preparedItem => preparedItem
                                                        .id == warehouse_product.pivot.id);
                                                if (prepareIndex == -1) {
                                                    // console.log(warehouse_product)
                                                    final.prepared_products.push({
                                                        id: warehouse_product.pivot.id,
                                                        comment: warehouse_product.pivot
                                                            .comment,
                                                        creation_date: warehouse_product
                                                            .pivot.creation_date,
                                                        expiration_date: warehouse_product
                                                            .pivot.expiration_date,
                                                        packing: warehouse_product.pivot
                                                            .packing,
                                                        quantity: warehouse_product
                                                            .pivot.quantity,
                                                        warehouse: {
                                                            designation: warehouse_product
                                                                .designation
                                                        },
                                                                stock_display:warehouse_product.pivot.stock_display,
                                                            packing_display:warehouse_product.pivot.packing_display,
                                                        pivot: {
                                                            quantity: '',
                                                    
                                                        }


                                                    })

                                                }
                                            })


                                        }


                                    })
                                    .catch((error) => {
                                        // handle error
                                        console.log(error);
                                    })

                            })

                            this.clearPreparedProducts()

                        } else {

                            this.custom_ordered.forEach(ordered => {
                                this.final_prepared.push({
                                    product_id: ordered.product_id,
                                    product_name: ordered.name,
                                    total: 0,
                                    total_rest:ordered.unit,
                                    fullQuantity:ordered.unit,
                                    prepared_products: [],
                                    isLoading: false
                                })
                            });

                            this.final_prepared.forEach(final => {

                                axios.get(`/api/product/warehouses/${final.product_id}`)
                                    .then((response) => {
                                        this.warehouse_products = response.data.warehouse_products;
                                        if (this.warehouse_products.length > 0) {

                                            this.warehouse_products.forEach(warehouse_product => {
                                                let prepareIndex = final.prepared_products
                                                    .findIndex(preparedItem => preparedItem
                                                        .id == warehouse_product.pivot.id);
                                                if (prepareIndex == -1) {
                                                    console.log(warehouse_product)
                                                    final.prepared_products.push({
                                                        id: warehouse_product.pivot.id,
                                                        comment: warehouse_product.pivot
                                                            .comment,
                                                        creation_date: warehouse_product
                                                            .pivot.creation_date,
                                                        expiration_date: warehouse_product
                                                            .pivot.expiration_date,
                                                        packing: warehouse_product.pivot
                                                            .packing,
                                                        quantity: warehouse_product
                                                            .pivot.quantity,
                                                        warehouse: {
                                                            designation: warehouse_product
                                                                .designation
                                                        },
                                                            stock_display:warehouse_product.pivot.stock_display,
                                                            packing_display:warehouse_product.pivot.packing_display,
                                                        pivot: {
                                                            quantity: '',
                                                          
                                                        }


                                                    })

                                                }
                                            })


                                        }


                                    })
                                    .catch((error) => {
                                        // handle error
                                        console.log(error);
                                    })

                            })
                            // this.loadPrepared()

                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            loadPrepared() {
                this.final_prepared.push({
                    products: this.products,
                    total: 0,
                    total_rest:0,
                    fullQuantity:0,
                    prepared_products: [],
                    product_id: '',
                    product_name: ''


                })
            },
            removePrepared(final) {

                swal.fire({
                    type: 'info',
                    title: 'Voulez vous retirer ce produit ? ',
                    showConfirmButton: true,
                    confirmButtonText: 'Confirmer',
                    showCancelButton: true,
                    cancelButtonText: 'Fermer'

                }).then((result) => {
                    if (result.value) {
                        axios.post(`/api/order/${this.order_id}/prepare/delete`, {
                                final_prepared: final,

                            })
                            .then((response) => {
                                if (response.data.status == 200) {
                                    this.final_prepared.splice(this.final_prepared.indexOf(final), 1);

                                }
                            })
                            .catch((error) => {
                                console.log(error);
                            });

                    }


                });




            },
            getProductData(event, i) {
                let id = event.target.value;
                let found = false;
                if (this.final_prepared.length > 1) {
                    let count = 0;
                    this.final_prepared.forEach((prepared) => {
                        if (prepared.product_id == id) {
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
                            this.final_prepared[i].product_id = '';
                        }
                    });

                }

                if (!found) {
                    this.final_prepared[i].isLoading = true

                        this.custom_ordered.forEach(custom => {
                         if(custom.product_id == this.final_prepared[i].product_id)
                         {
                             this.final_prepared[i].total_rest=custom.unit
                               this.final_prepared[i].fullQuantity=custom.unit
                         }   

                        })

                    axios.get('/api/product/warehouses/' + id)
                        .then((response) => {
                            this.final_prepared[i].isLoading = false
                            // this.response_array = response.data
                            this.response_array = response.data.warehouse_products
                            this.final_prepared[i].prepared_products = []
                            this.response_array.forEach((warehouse, index) => {
                                this.final_prepared[i].product_name = response.data.productName
                                this.final_prepared[i].prepared_products.push({
                                    id: warehouse.pivot.id,
                                    warehouse: {
                                        designation: warehouse.designation,
                                    },
                                    quantity: warehouse.pivot.quantity,
                                    packing: warehouse.pivot.packing,
                                    creation_date: warehouse.pivot.creation_date,
                                    expiration_date: warehouse.pivot.expiration_date,
                                       stock_display:warehouse.pivot.stock_display,
                                        packing_display:warehouse.pivot.packing_display,
                                    pivot: {
                                        quantity: '',
                                       
                                    }


                                });

                                // this.clearOrderedProducts()
                            });

                        }).catch((error) => {
                            console.log(error)
                        })

                }



            },
            clearPrepared() {



                this.final_prepared.forEach((final) => {
                    final.total = 0;
                    final.prepared_products.forEach((prepared) => {
                        if (prepared.prepared_quantity != "")
                            final.total += prepared.prepared_quantity
                    });

                });



            },
            updateTotalQuantity(prepared, index, i) {
                        this.errors = []
                         this.clearPreparedProducts()
                            if (prepared.pivot.quantity) {
                  
                                    if (prepared.pivot.quantity < 0) {
                                        swal.fire({
                                            type: 'error',
                                            title: 'La quantité préparée saisie  est invalide ! ',
                                            showConfirmButton: true,
                                            allowOutsideClick: false,
                                            confirmButtonText: 'Fermer'
                                        });
                                        prepared.pivot.quantity = "";
                                        this.clearPreparedProducts()
                                    } else {
                                     
                                        this.errors = []
                                        this.clearPreparedProducts()

                                    }

                }



            },
            validateForm() {
                this.errors = []
                let x = true;
                if (this.final_prepared.length > 0) {
                    this.final_prepared.forEach((prepared) => {

                        if (!prepared.product_id) {
                            this.errors.push('Veuillez séléctionner un produit ')
                                window.scrollTo(0, 0);

                            x = false;
                        }


                    });

                    // let count = 0;
                    // this.final_prepared.forEach((prepared) => {

                    //     count += prepared.total;
                    // });
                    // if (count <= 0) {
                    //     this.errors.push('Veuillez renseigner au moins une quantité à préparer  ')
                    //         window.scrollTo(0, 0);
                    //     x = false;
                    // }


                }

                return x;
            },
            submitOrderPreparedProducts() {
                let validation = this.validateForm();
                if (validation) {
                    this.disabled = true;

                    axios.post(`/api/order/${this.order_id}/prepare`, {
                            final_prepared: this.final_prepared,
                            user_id: this.user_id

                        })
                        .then( (response) =>  {
                                                if (response.data.status == 200) {
                                                    swal.fire({
                                                        type: 'success',
                                                        title: 'Les produits ont été ajoutés avec succés !',
                                                        showConfirmButton: true,
                                                        allowOutsideClick: false,
                                                        confirmButtonText: 'Fermer'
                                                    }).then((result) => {
                                                        if (result.value) {
                                                            window.location = axios.defaults.baseURL + '/orders';
                                                        }
                                                    })
                                                } 


                                             if (response.data.status == 400) {
                                                   
                                                    let unavailable_stock = response.data.unavailableStock;
                                                        swal.fire({
                                                            type: 'error',
                                                            title: 'Stock Insuffisant !',
                                                            showConfirmButton: true,
                                                            allowOutsideClick: false,
                                                            confirmButtonText: 'Fermer'
                                                        })
                                                    this.final_prepared.forEach(final => {
                                                    final.prepared_products.forEach( prepared => {
                                                    unavailable_stock.forEach(stock => {
                                                    if (prepared.id ==stock.id) {
                                                        prepared.quantity=stock.quantity
                                                        prepared.pivot.quantity = ''
                                                                     }
                                                                    });

                                                                });

                                                        });

                                                             this.disabled = false;


                                                    }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }


            },
            convertCurrency(value) {
                let val = (value / 1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")

            },
            convertMoneyFormat(value) {

                return parseFloat(value.replace(',', '.'))

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
                        this.total_tva += this.custom_ordered[i].total * this
                            .custom_ordered[i].tva / 100;

                    }

                }


                // //  cout total de la commande  //
                this.total_order += parseFloat(this.total_ht) + this.total_tva;
                // this.convertOrderedProducts(this.ordered_products)



            },
            cancelOrder() {
                window.location = axios.defaults.baseURL + "/orders"
            }
        }
    }

</script>
