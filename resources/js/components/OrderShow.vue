<template>
    <div class="box box-primary">

        <div class="box-header">
            <h3 class="box-title"> Détails commande</h3>

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
                            <label for="exampleInputEmail1">Magasin</label>
                            <select class="form-control" v-model="store_id" @change="getStoreData($event)" disabled>
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

                <div class="row" style="margin-top:20px;">

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
                        <h4 class="box-title"> {{total_ht}}€</h4>
                        <h4 class="box-title"> {{total_tva}}€</h4>

                        <h4 class="box-title"> <b>{{total_order}}€</b></h4>
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
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Préparateur</label>
                                <input class="form-control" id="disabledInput" type="text" v-model="order_id" disabled>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Code commande du reliquat</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-model="code" disabled>
                            </div>
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
                        <h4 class="box-title"> {{total_ht}}€</h4>
                        <h4 class="box-title"> {{total_tva}}€</h4>

                        <h4 class="box-title"> <b>{{total_order}}€</b></h4>
                    </div>
                </div>


                <div class="row" style="margin-top:40px;">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="font-size:20px;"> Livraison</label>

                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Transporteur</label>
                                <input class="form-control" id="disabledInput" type="text" v-model="order_id" disabled>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Livreur</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-model="code" disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mode de livraison</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-model="code" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de cartons</label>
                                <input class="form-control" id="disabledInput" type="text" v-model="order_id" disabled>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de palette</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-model="code" disabled>
                            </div>
                        </div>



                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Volume(m² )</label>
                                <input class="form-control" id="disabledInput" type="text" v-model="order_id" disabled>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Poids(kg)</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-model="code" disabled>
                            </div>




                        </div>



                    </div>


                    <div class="row" style="margin-top:40px;">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date et heure de livraison estimé</label>
                                <input class="form-control" id="disabledInput" type="text" v-model="order_id" disabled>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> <span style="opacity:0;">Code</span> </label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-model="code" disabled>
                            </div>

                        </div>



                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date et heure de livraison effective</label>
                                <input class="form-control" id="disabledInput" type="text" v-model="order_id" disabled>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> <span style="opacity:0;">Code</span> </label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-model="code" disabled>
                            </div>

                        </div>



                    </div>


                </div>

                <div class="row" style="margin-top:40px;">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="font-size:20px;"> Historique</label>

                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date et heure</th>
                                <th>Utilisateur</th>
                                <th>Action</th>
                                <th>Commentaire</th>
                                <th></th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr v-for="(history,index) in order_history">
                             <td>{{history.created_at}}</td>
                             <td>{{history.user.nom}} {{history.user.prenom}}</td>
                             <td>{{history.action}}</td>
                             <td style="width:40%;">
                             <p v-if="history.comment != null"> {{history.comment}}</p>
                             <p v-else>Aucun commentaire</p>
                             
                             </td>
                             <td><input type="text"  class="btn btn-success" value="Modifier"></td>
                            </tr>




                        </tbody>
                    </table>
                </div>


            </div>





        </form>

        <div class="row">
            <div class="container text-center">


                <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelOrder()">
                    Quitter</button>



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
            this.clearOrderedProducts()


        },
        props: ['order_id', 'user_id'],
        data() {
            return {

                companies: [],
                stores: [],
                ordered_products: [],
                prepared_products: [],
                custom_ordered: [],
                order_history: [],
                products: [],
                errors: [],
                store_id: '',
                code: '',
                total_ht: 0.00,
                total_tva: 0.00,
                total_order: 0.00,
                comment: '',
                company_id: order.company_id,
                errors: []




            }

        },
        methods: {
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

                            this.total_ht += (ordered.public_price * ordered.pivot.unit);
                            this.total_tva += (this.total_ht * ordered.tva / 100);
                            this.total_order = this.total_ht + this.total_tva;



                        });

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
            clearOrderedProducts() {
                //  total cout produit hors tax //
                this.total_ht = 0;
                this.total_tva = 0;
                this.total_order = 0;

                for (let i in this.custom_ordered) {
                    this.total_ht += this.custom_ordered[i].total;
                }


                // //  total cout produit avec  tax //

                for (let i in this.custom_ordered) {
                    this.total_tva += (this.custom_ordered[i].total * this
                        .custom_ordered[i].tva / 100);
                }


                // //  cout total de la commande  //
                this.total_order += this.total_ht + this.total_tva;

            },
            cancelOrder() {
                window.location = '/wizefresh/public/orders';
            }


        }
    }

</script>
