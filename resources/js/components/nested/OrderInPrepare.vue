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

        <div class="row" style="margin-top:40px;">

            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size:20px;">Produits commandés</label>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom Produit</th>
                                <th>Quantité commandée</th>
                                <th>Nombre de colis</th>
                                <th>Colisage</th>

                            </tr>

                        </thead>
                        <tbody>
                            <tr v-for="(ordered,index) in custom_ordered">
                                <td>
                                    {{ordered.name}}
                                </td>
                                <td> {{ordered.unit}}</td>
                                <td>{{ordered.package}}</td>
                                <td>{{ordered.product_packing}}</td>



                                <td>

                                </td>
                            </tr>




                        </tbody>
                    </table>
                </div>
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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom du produit</label>
                                    <select class="form-control" v-model="final.product_id"
                                        @change="($event, index) => getProductData($event,i)">
                                        <option value="" v-if="final.products.length > 0" disabled> Selectionner un
                                            produit
                                        </option>
                                        <option value="" v-else> Aucun produit </option>
                                        <option v-for="product in final.products" :value="product.id ">{{product.nom}}
                                        </option>
                                    </select>

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
                                            <h4 v-if="final.product_id == ''">Veuillez sélectionner un produit !</h4>
                                            <h4 v-else>Aucun produit trouvé !</h4>
                                        </td>
                                    </tr>
                                    <tr v-for="(prepared,index) in final.prepared_products">
                                        <td>{{prepared.name}} </td>
                                        <td>{{prepared.quantity}} </td>
                                        <td>{{prepared.packing}} </td>
                                        <td>{{prepared.warehouse_name}} </td>
                                        <td>{{prepared.creation_date}} </td>
                                        <td>{{prepared.expiration_date}} </td>
                                        <td><input type="number" min="1" class="form-control"
                                                placeholder="Quantité préparée"
                                                @change="updateTotalQuantity(prepared,index,i)"
                                                v-model.number="prepared.prepared_quantity">
                                        </td>


                                        </td>
                                    </tr>






                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-default" @click="loadPrepared()"><i class="fa fa-plus"></i></button>



        </div>

        <div class="row">
            <div class="container text-center">


                <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelOrder()">
                    Annuler</button>

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" @click="submitOrderInPrepare()">
                    Enregistrer</button>


            </div>
        </div>





    </div>



    </div>

</template>

<script>
    export default {
        mounted() {

            this.loadProducts()
            this.loadOrder()
            this.loadPrepared()
        },
        props: ['order_id', 'user_id'],
        data() {
            return {
                new_status:4,
                products: [],
                ordered_products: [],
                final_prepared: [],
                custom_ordered: [],
                prepared_products: [],
                response_array: [],
                balance: [],
            


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
                        this.ordered_products.forEach((ordered, index) => {
                            this.custom_ordered.push({
                                name: ordered.nom,
                                package: ordered.pivot.package,
                                unit: ordered.pivot.unit,
                                product_packing: ordered.packing,
                                public_price: ordered.public_price,
                                tva: ordered.tva,
                                products: this.products,
                                product_id: ordered.id,
                                total: (ordered.public_price * ordered.pivot.unit),
                                product_total_tva: ''

                            });

                            // this.clearOrderedProducts()



                        });

                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            loadPrepared() {
                this.final_prepared.push({
                    products: this.products,
                    total: 0,
                    prepared_products: [],
                    product_id: ''


                })
            },
            removePrepared(final) {
                this.final_prepared.splice(this.final_prepared.indexOf(final), 1);

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
                    axios.get('api/product/warehouses/' + id)
                        .then((response) => {
                            // this.response_array = response.data
                            this.response_array = response.data.warehouse_products
                            this.final_prepared[i].prepared_products = []
                            this.response_array.forEach((warehouse, index) => {
                                this.final_prepared[i].prepared_products.push({
                                    id: warehouse.pivot.id,
                                    name: response.data.productName,
                                    warehouse_name: warehouse.designation,
                                    quantity: warehouse.pivot.quantity,
                                    packing: warehouse.pivot.packing,
                                    creation_date: warehouse.pivot.creation_date,
                                    expiration_date: warehouse.pivot.expiration_date,
                                    prepared_quantity: ''


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

                if (prepared.prepared_quantity == '' || prepared.prepared_quantity <= 0 || prepared.prepared_quantity >
                    prepared.quantity) {
                    swal.fire({
                        type: 'error',
                        title: 'La quantité préparée saisie  est invalide ! ',
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        confirmButtonText: 'Fermer'
                    });
                    prepared.prepared_quantity = "";
                    this.clearPrepared(i);
                } else {

                    this.clearPrepared(i);

                }

            },
            validateForm() {
                let x = true;
                if (this.final_prepared.length > 0) {


                    let count = 0;
                    this.final_prepared.forEach((prepared) => {

                        count += prepared.total;
                    });
                    if (count <= 0) {
                        this.$emit('requiredValue', 'Veuillez renseigner au moins une quantité à préparer  ')
                        x = false;
                    }


                    this.final_prepared.forEach((prepared) => {

                        if (!prepared.product_id) {
                            this.$emit('requiredValue', 'Veuillez séléctionner un produit ')

                            x = false;
                        }


                    });


                    if (this.new_status == '') {
                        this.$emit('requiredValue', 'Veuillez séléctionner un etat ')

                        x = false;

                    }



                }

                return x;
            },
            validateBalance() {
                //Only Allah knows how I did it :p ( هذا من فضل ربي )
                
                let balances = [];
                let rmvBalances = [];

                this.custom_ordered.map(custom => {
                    this.final_prepared.map(final => {
                        if (custom.product_id === final.product_id){
                            if (final.total < custom.unit){
                                let qty = custom.unit - final.total;

                                balances.push({product_id: custom.product_id, name: custom.name, qty})
                            }
                        }else{ //Item not found in custom
                            let balanceIndex = balances.findIndex(balance => balance.product_id === custom.product_id);

                            if (balanceIndex === -1){
                                balances.push({product_id: custom.product_id, name: custom.name, qty: custom.unit})
                            }
                        }
                    })
                })

                let newBalances = [];
                
                

                newBalances = _.sortBy(balances, ['qty']);
                newBalances = _.uniqBy(newBalances, 'product_id')
                newBalances = _.sortBy(newBalances, ['product_id']);
                console.log("newBalances")
                console.log(newBalances)

               
                
                this.custom_ordered.map(custom => {
                    this.final_prepared.map(final => {
                        newBalances.map(balance => {
                            if ((custom.product_id === balance.product_id && custom.unit <= balance.qty && final.product_id === custom.product_id && final.total > 0)){
                                rmvBalances.push(balance)
                            }
                        })
                    })
                })

        
    
                this.balance=_.differenceBy(newBalances, rmvBalances, "product_id")


            },
            submitOrderInPrepare() {
                let validation = this.validateForm();
                if (validation) {
                    this.validateBalance()
                    if (this.balance.length > 0) {

                        swal.fire({
                            type: 'info',
                            title: 'Attention !',
                            html: ` <h4> Les quantités préparées ne correspondent pas aux quantitées saisies dans la commande </h4> 
                           
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
                            confirmButtonText: 'Poursuivre',
                            showCancelButton: true,
                            allowOutsideClick: false,
                            cancelButtonText: 'Fermer',
                            reverseButtons: true

                        }).then((result) => {
                            if (result.value) {
                                swal.fire({
                                    type: 'info',
                                    title: 'Comment voulez vous procéder ? ',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ignorer',
                                    showCancelButton: true,
                                    cancelButtonText: 'Créer commande reliquat'

                                }).then((result) => {


                                });
                            }

                        })
                    } else {
                        console.log('done')
                    }

                }
            },
            cancelOrder() {
                window.location = "/wizefresh/public/orders"
            }
        }
    }

</script>
