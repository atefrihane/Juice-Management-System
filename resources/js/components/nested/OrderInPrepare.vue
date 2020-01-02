<template>
    <div>
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nouveau état</label>
                    <select class="form-control" v-model="new_status">
                        <option value="" disabled> Séléctionner un état</option>
                        <option value="4">Préparée</option>
                        <option value="12">Annulée</option>
                    </select>
                </div>
            </div>
        </div>
        <div v-if="new_status !=12">
            <div class="row" style="margin-top:40px;">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1" style="font-size:20px;">Produits commandés</label>
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
                                    @change="getProductData($event,index)" disabled>
                                    <option value="" v-if="ordered.products.length > 0 && ordered.products.length > 0"
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
                                    v-model="ordered.public_price" disabled></td>
                            <td><input type="text" class="form-control" disabled placeholder="TVA.."
                                    v-model="ordered.tva" disabled></td>
                            <td><input type="text" class="form-control" disabled placeholder="Total Produit.."
                                    v-model="ordered.total" disabled></td>
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
            </div>
            <div class="container-fluid">
                <div class="box" style="border:1px solid rgb(228, 228, 228);padding:20px;"
                    v-for="(final,i) in final_prepared">
                    <div class="box-body">
                        <div class="" v-if="i > 0">
                            <a href="" class="pull-right btn btn-default" @click.prevent="removePrepared(final)"><i
                                    class="fa fa-minus"></i></a>
                        </div>
                        <div class="container-fluid">
                            <div class="row" style="margin-top:35px;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nom du produit</label>
                                        <select class="form-control" v-model="final.product_id"
                                            @change="($event, index) => getProductData($event,i)">
                                            <option value="" v-if="products.length > 0" disabled> Selectionner un
                                                produit
                                            </option>
                                            <option value="" v-else> Aucun produit </option>
                                            <option v-for="product in products" :value="product.id ">{{product.nom}}
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Total des quantités restantes</label>
                                        <input type="text" class="form-control" v-model="final.total_rest" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Total des quantités préparés</label>
                                        <input type="text" class="form-control" v-model="final.total" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nom Produit</th>
                                            <th>Quantité</th>
                                            <th>Colisage</th>
                                            <th>Entrepôt</th>
                                            <th>Date de fabrication</th>
                                            <th>Date de préemption</th>
                                            <th>Quantité preparée</th>

                                        </tr>

                                    </thead>
                                    <tbody>

                                        <tr v-if="final.prepared_products.length == 0">
                                            <td colspan="6" class="text-center">
                                                <h4 v-if="final.product_id == ''">Veuillez sélectionner un produit !
                                                </h4>
                                                <h4 v-else>Aucun produit trouvé !</h4>
                                            </td>
                                        </tr>
                                        <loading :active.sync="final.isLoading" :is-full-page="false" :opacity="0.7"
                                            loader="dots" color="#3c8dbc"></loading>

                                        <tr v-for="(prepared,index) in final.prepared_products">
                                            <td>{{final.product_name}} </td>
                                            <td>{{prepared.quantity}} </td>
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
        </div>

        <div class="row">
            <div class="container text-center">
                <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelOrder()">
                    Annuler</button>

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" :disabled="disabled"
                    @click="submitOrderInPrepare()">
                    Enregistrer</button>

            </div>
        </div>

    </div>

    </div>

</template>

<script>
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    export default {

        mounted() {

            this.loadProducts()
            this.loadOrder()

        },
        props: ['order_id', 'user_id'],
        data() {
            return {
                new_status: 4,
                products: [],
                ordered_products: [],
                final_prepared: [],
                custom_ordered: [],
                prepared_products: [],
                response_array: [],
                balance: [],
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
            loadProducts() {
                axios.get(axios.defaults.baseURL + '/api/products/')
                    .then((response) => {
                        this.products.push(...response.data)

                    })
                    .catch((error) => {
                        console.log(error);
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
                                public_price: this.convertCurrency(ordered.pivot.custom_price),
                                tva: ordered.pivot.custom_tva,
                                products: this.products,
                                product_id: ordered.id,
                                total: this.convertCurrency(parseFloat(ordered.public_price) *
                                    ordered.pivot.unit),
                                product_total_tva: ordered.tva

                            });
                        });

                        this.clearOrderedProducts()


                        // this.custom_ordered.forEach(custom => {
                        //     axios.post('/api/product/prices/' + custom.product_id, {
                        //             store_id: this.store_id
                        //         })
                        //         .then((response) => {


                        //             if (response.data.custom_price) {
                        //                 custom.public_price = this.convertCurrency(response.data
                        //                     .custom_price.price)
                        //                 custom.total = this.convertCurrency(this.convertMoneyFormat(
                        //                     custom
                        //                     .public_price) * custom.unit)

                        //             }
                        //             this.clearOrderedProducts()


                        //         })
                        //         .catch(function (error) {
                        //             console.log(error);
                        //         })

                        // })


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
                                    if (ordered.product_id == final.product_id) {
                                        final.total_rest = ordered.unit
                                        final.fullQuantity = ordered.unit
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
                                                        pivot: {
                                                            quantity: ''
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
                                    total_rest: 0,
                                    fullQuantity: 0,
                                    prepared_products: [],
                                    isLoading: false
                                })
                            });

                            this.final_prepared.forEach(final => {
                                this.custom_ordered.forEach(ordered => {
                                    if (ordered.product_id == final.product_id) {
                                        final.total_rest = ordered.unit
                                        final.fullQuantity = ordered.unit
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
                                                        pivot: {
                                                            quantity: ''
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
                    total_rest: 0,
                    fullQuantity: 0,
                    prepared_products: [],
                    product_id: '',
                    isLoading: false,
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
                        if (custom.product_id == this.final_prepared[i].product_id) {
                            this.final_prepared[i].total_rest = custom.unit
                            this.final_prepared[i].fullQuantity = custom.unit
                        }

                    })


                    axios.get('/api/product/warehouses/' + id)
                        .then((response) => {
                            this.final_prepared[i].isLoading = false
                            // this.response_array = response.data
                            this.response_array = response.data.warehouse_products
                            this.final_prepared[i].prepared_products = []
                            this.final_prepared[i].product_name = response.data.productName
                            this.response_array.forEach((warehouse, index) => {
                                this.final_prepared[i].prepared_products.push({
                                    id: warehouse.pivot.id,
                                    warehouse: {
                                        designation: warehouse.designation,
                                    },
                                    quantity: warehouse.pivot.quantity,
                                    packing: warehouse.pivot.packing,
                                    creation_date: warehouse.pivot.creation_date,
                                    expiration_date: warehouse.pivot.expiration_date,
                                    pivot: {
                                        quantity: ''
                                    }


                                });

                                // this.clearOrderedProducts()
                            });



                        }).catch((error) => {
                            console.log(error)

                        })

                }



            },
            clearPrepared(i) {

                this.final_prepared[i].total = 0;
                this.final_prepared[i].prepared_products.forEach((prepared) => {

                    if (prepared.prepared_quantity != "") {

                        this.final_prepared[i].total += prepared.prepared_quantity;
                    }

                });


            },
            updateTotalQuantity(prepared, index, i) {
            this.clearPreparedProducts()
             if (prepared.pivot.quantity < 0){
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

                    this.clearPreparedProducts()

                }

            },
            validateForm() {
                let x = true;
                if (this.new_status != 12) {        
                    if (this.final_prepared.length > 0) {
                        let count = 0;
                        this.final_prepared.forEach((prepared) => {

                            count += prepared.total;
                        });
                        if (count <= 0) {
                            this.$emit('requiredValue', 'Veuillez renseigner au moins une quantité à préparer  ')
                            x = false;
                            this.disabled = false;
                        }


                        this.final_prepared.forEach((prepared) => {

                            if (!prepared.product_id) {
                                this.$emit('requiredValue', 'Veuillez séléctionner un produit ')

                                x = false;
                                this.disabled = false;
                            }


                        });


                        if (this.new_status == '') {
                            this.$emit('requiredValue', 'Veuillez séléctionner un etat ')

                            x = false;
                            this.disabled = false;

                        }



                    }
                }

                return x;
            },
            validateBalance() {
                //Only Allah knows how I did it :p ( هذا من فضل ربي )
                this.balance = []
                let balances = [];
                let rmvBalances = [];

                this.custom_ordered.map(custom => {
                    this.final_prepared.map(final => {
                        if (custom.product_id === final.product_id) {
                            if (final.total < custom.unit) {
                                let qty = custom.unit - final.total;

                                balances.push({
                                    product_id: custom.product_id,
                                    name: custom.name,
                                    qty,
                                    packing: custom.product_packing,
                                      public_price:custom.public_price,
                                    tva:custom.tva
                                })
                            }
                        } else { //Item not found in custom
                            let balanceIndex = balances.findIndex(balance => balance.product_id ===
                                custom.product_id);

                            if (balanceIndex === -1) {
                                balances.push({
                                    product_id: custom.product_id,
                                    name: custom.name,
                                    qty: custom.unit,
                                    packing: custom.product_packing,
                                    public_price:custom.public_price,
                                    tva:custom.tva
                                })
                            }
                        }
                    })
                })

                let newBalances = [];
                newBalances = _.sortBy(balances, ['qty']);
                newBalances = _.uniqBy(newBalances, 'product_id')
                newBalances = _.sortBy(newBalances, ['product_id']);




                this.custom_ordered.map(custom => {
                    this.final_prepared.map(final => {
                        newBalances.map(balance => {
                            if ((custom.product_id === balance.product_id && custom.unit <=
                                    balance.qty && final.product_id === custom.product_id &&
                                    final.total > 0)) {
                                rmvBalances.push(balance)
                            }
                        })
                    })
                })



                this.balance = _.differenceBy(newBalances, rmvBalances, "product_id")


            },
            submitOrderInPrepare() {
                this.disabled = true;
                let validation = this.validateForm();
                if (validation) {
                    this.$emit('requiredValue', '')
                    this.validateBalance()

                    if (this.new_status == 12) {
                        swal.fire({
                            type: 'info',
                            title: 'Attention !',
                            text: "L'annulation d'une commande est une opération irréversible !",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Confirmer',
                            cancelButtonText: 'Annuler',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.value) {
                                axios.post(`/api/order/${this.order_id}/prepare/submit`, {
                                        final_prepared: this.final_prepared,
                                        new_status: this.new_status,
                                        user_id: this.user_id
                                    })
                                    .then((response) => {
                                        if (response.data.status == 200) {
                                            swal.fire({
                                                type: 'success',
                                                title: 'La commande a été annulée avec succés !',
                                                showConfirmButton: true,
                                                allowOutsideClick: false,
                                                confirmButtonText: 'Fermer'
                                            }).then((result) => {
                                                if (result.value) {
                                                    window.location = axios.defaults.baseURL +
                                                        '/orders';
                                                }

                                            })

                                        }
                                    })
                                    .catch((error) => {
                                        console.log(error);
                                    });
                            } else if (result.dismiss == 'cancel') {
                                this.disabled = false
                            }
                        });



                    } else {

                        if (this.balance.length > 0) {
                            swal.fire({
                                type: 'info',
                                title: 'Oups !',
                                html: ` <h4> Les quantités préparées ne correspondent pas aux quantitées saisies dans la commande </h4> `,
                                showConfirmButton: true,
                                confirmButtonText: 'Poursuivre',
                                showCancelButton: true,
                                allowOutsideClick: false,
                                cancelButtonText: 'Fermer',
                                reverseButtons: true

                            }).then((result) => {
                                if (result.value) {
                                    swal.fire({
                                        type: 'info',
                                        title: 'Attention... ',
                                        customClass: 'swal-btns',
                                        html: ` 
                           
                                    <p> <b> NB : </b> Le tableau ci dessous présente les quantités restantes à préparer pour chaque produit </p>
                                     <table class="table">
                                        <thead>
                                        <tr>
                                          <th>Nom Produit</th>
                                         <th>Quantité réstante</th>
                                        </tr>
                                         </thead>
                                         <tbody>
                                         ${this.balance.map(balance => ` <tr> <td class="text-left">${balance.name} </td><td class="text-left">${balance.qty} </td> </tr> `)}

                                        </tbody>
                                        </table>

                            `,
                                        showConfirmButton: true,
                                        confirmButtonText: ' Passer une commande du reliquat',
                                        showCancelButton: true,
                                        cancelButtonText: 'Ignorer le reliquat'

                                    }).then((result) => {
                                        // commande reliquat
                                        if (result.value) {
                                            axios.post(
                                                    `/api/order/${this.order_id}/prepare/submit`, {
                                                        final_prepared: this.final_prepared,
                                                        balance: this.balance,
                                                        new_status: this.new_status,
                                                        user_id: this.user_id
                                                    })
                                                .then((response) => {
                                                    if (response.data.status == 200) {
                                                        swal.fire({
                                                            type: 'success',
                                                            title: 'La commande a été préparée avec succés !',
                                                            showConfirmButton: true,
                                                            allowOutsideClick: false,
                                                            confirmButtonText: 'Fermer'
                                                        }).then((result) => {
                                                            if (result.value) {
                                                                window.location = window
                                                                    .location = axios
                                                                    .defaults.baseURL +
                                                                    '/orders';

                                                            }
                                                        })
                                                    }

                                                    if (response.data.status == 400) {
                                                        this.disabled = false;
                                                        let unavailable_stock = response.data.unavailableStock;
                                                        swal.fire({
                                                            type: 'error',
                                                            title: 'Stock Insuffisant !',
                                                            showConfirmButton: true,
                                                            allowOutsideClick: false,
                                                            confirmButtonText: 'Fermer'
                                                        })

                                                        this.final_prepared.forEach(final => {
                                                            final.prepared_products.forEach(
                                                                prepared => {

                                                        unavailable_stock.forEach(stock => {
                                                        if (prepared.id ==stock.id) {
                                                            prepared.quantity=stock.quantity
                                                            prepared.pivot.quantity = ''
                                                                                    
                                                                    }});

                                                                });

                                                        });


                                                    }


                                                })
                                                .catch((error) => {
                                                    console.log(error);
                                                });


                                        } else if (result.dismiss == 'cancel') {
                                            // commande normal
                                            axios.post(
                                                    `/api/order/${this.order_id}/prepare/submit`, {
                                                        final_prepared: this.final_prepared,
                                                        new_status: this.new_status,
                                                        user_id: this.user_id
                                                    })
                                                .then((response) => {
                                                    if (response.data.status == 200) {
                                                        swal.fire({
                                                            type: 'success',
                                                            title: 'La commande a été préparée avec succés !',
                                                            showConfirmButton: true,
                                                            allowOutsideClick: false,
                                                            confirmButtonText: 'Fermer'
                                                        }).then((result) => {
                                                            if (result.value) {
                                                                window.location = axios
                                                                    .defaults.baseURL +
                                                                    '/orders';
                                                            }
                                                        })
                                                    }

                                                    if (response.data.status == 400) {
                                                        this.disabled = false;
                                                        let unavailable_stock = response.data
                                                            .unavailableStock;
                                                        swal.fire({
                                                            type: 'error',
                                                            title: 'Stock Insuffisant !',
                                                            showConfirmButton: true,
                                                            allowOutsideClick: false,
                                                            confirmButtonText: 'Fermer'
                                                        })

                                                        this.final_prepared.forEach(final => {
                                                            final.prepared_products.forEach(
                                                                prepared => {

                                                                    unavailable_stock
                                                                        .forEach(
                                                                            stock => {
                                                                                if (prepared
                                                                                    .id ==
                                                                                    stock
                                                                                    .id
                                                                                    ) {
                                                                                    prepared
                                                                                        .quantity =
                                                                                        stock
                                                                                        .quantity
                                                                                    prepared
                                                                                        .pivot
                                                                                        .quantity =
                                                                                        ''

                                                                                }


                                                                            });

                                                                });

                                                        });


                                                    }
                                                })
                                                .catch((error) => {
                                                    console.log(error);
                                                });
                                            //


                                        } else {

                                            this.disabled = false
                                        }


                                    });
                                } else if (result.dismiss == 'cancel') {
                                    this.disabled = false
                                }

                            })

                        } else {
                            axios.post(`/api/order/${this.order_id}/prepare/submit`, {
                                    final_prepared: this.final_prepared,
                                    new_status: this.new_status,
                                    user_id: this.user_id
                                })
                                .then((response) => {
                                    if (response.data.status == 200) {
                                        swal.fire({
                                            type: 'success',
                                            title: 'La commande a été préparée avec succés !',
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
                                        this.disabled = false;
                                        let unavailable_stock = response.data
                                            .unavailableStock;
                                        swal.fire({
                                            type: 'error',
                                            title: 'Stock Insuffisant !',
                                            showConfirmButton: true,
                                            allowOutsideClick: false,
                                            confirmButtonText: 'Fermer'
                                        })

                                        this.final_prepared.forEach(final => {
                                            final.prepared_products.forEach(
                                                prepared => {

                                                    unavailable_stock
                                                        .forEach(
                                                            stock => {
                                                                if (prepared
                                                                    .id ==
                                                                    stock
                                                                    .id
                                                                ) {
                                                                    prepared
                                                                        .quantity =
                                                                        stock
                                                                        .quantity
                                                                    prepared
                                                                        .pivot
                                                                        .quantity =
                                                                        ''

                                                                }


                                                            });

                                                });

                                        });


                                    }
                                })
                                .catch((error) => {
                                    console.log(error);
                                });

                        }

                    }

                }
            },
            clearPreparedProducts() {

                this.final_prepared.forEach(final => {
                    final.total = 0;
                    final.prepared_products.forEach(prepared => {
                        if (prepared.pivot.quantity != '') {
                            final.total += prepared.pivot.quantity;

                        }

                    })
                    final.total_rest = final.fullQuantity - final.total
                    if (final.total_rest < 0) {
                        final.total_rest = 0;
                    }

                })


            },
            convertCurrency(value) {
                let val = (value / 1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "")

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
                        this.total_tva += (this.convertMoneyFormat(this.custom_ordered[i].total) * this
                            .custom_ordered[i].tva / 100);

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
