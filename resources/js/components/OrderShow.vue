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
                            <label for="exampleInputEmail1">Magasin
                                <a href="#" data-toggle="modal" data-target="#exampleModal1"><i
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

                            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
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
                                            v-if="ordered.products.length > 0" disabled>
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
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Préparateur</label>
                                <input type="text" class="form-control" :value="preparator.nom+' '+preparator.prenom"
                                    v-if="preparator" disabled>
                                <input type="text" class="form-control" value="Non specifié" v-else disabled>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Code commande original</label>
                                <input type="text" class="form-control" :value="parent.code" v-if="parent" disabled>
                                <input type="text" class="form-control" value="Non specifié" v-else disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="box" style="border:1px solid rgb(228, 228, 228);padding:20px;"
                        v-for="(final,i) in final_prepared" v-if="final_prepared.length > 0">
                        <div class="box-body">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nom du produit</label>
                                            <input type="text" class="form-control" :value="final.product_name"
                                                disabled>

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
                                                    <h4 v-if="final.product_id == ''">Veuillez sélectionner un
                                                        produit !</h4>
                                                    <h4 v-else>Aucun produit trouvé !</h4>
                                                </td>
                                            </tr>
                                            <tr v-for="(prepared,index) in final.prepared_products" v-if="prepared.pivot.quantity">
                                                <td>{{final.product_name}} </td>
                                                <td>{{prepared.quantity}} </td>
                                                <td>{{prepared.packing}} </td>
                                                <td>{{prepared.warehouse.designation}} </td>
                                                <td>{{prepared.creation_date}} </td>
                                                <td>{{prepared.expiration_date}} </td>
                                                <td>{{prepared.pivot.quantity}}
                                                </td>


                                                </td>
                                            </tr>






                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box" style="border:1px solid rgb(228, 228, 228);padding:20px;"
                        v-if="final_prepared.length ==0">
                        <div class="box-body">

                            <div class="container-fluid">

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
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    <h4>Aucun produit déja préparé !</h4>
                                                </td>
                                            </tr>






                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>

                <div class="row" style="margin-top:20px;">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="font-size:20px;">Facturation</label>

                        </div>
                    </div>

                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom produit</th>
                                <th>Total quantité préparée</th>
                                <th>Prix unitaire</th>
                                <th>TVA ( % )</th>
                                <th>Total produit</th>


                            </tr>

                        </thead>
                        <tbody>
                            <tr v-for="billed in billed_products" v-if="billed_products.length > 0">
                                <td>{{billed.name}}</td>
                                <td>{{billed.sum}}</td>
                                <td>{{convertCurrency(billed.public_price)}}</td>
                                <td>{{billed.tva}}</td>
                                <td>{{convertCurrency(billed.total)}}</td>
                            </tr>
                            <tr v-if="billed_products.length == 0">
                                <td colspan="5" class="text-center">
                                    <h4>Aucune facture !</h4>
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
                        <h4 class="box-title"> {{convert_billed_total_ht}}€</h4>
                        <h4 class="box-title"> {{convert_billed_total_tva}}€</h4>

                        <h4 class="box-title"> <b>{{convert_billed_total_order}}€</b></h4>
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
                                <input type="text" class="form-control" value="Interne" v-if="delivery==1" disabled>
                                <input type="text" class="form-control" value="Externe" v-if="delivery==2" disabled>
                                <input type="text" class="form-control" value="Non specifié" v-if="delivery == null"
                                    disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Livreur</label>
                                <input type="text" class="form-control" :value="delivery_man.nom+' '+delivery_man.prenom"
                                    v-if="delivery_man" disabled>
                                <input type="text" class="form-control" value="Non specifié" v-else disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mode de livraison</label>
                                <input type="text" class="form-control" value="Voiture" v-if="delivery==0" disabled>
                                <input type="text" class="form-control" value="Camion" v-if="delivery==1" disabled>
                                <input type="text" class="form-control" value="Avion" v-if="delivery==2" disabled>
                                <input type="text" class="form-control" value="Bateau" v-if="delivery==3" disabled>
                                <input type="text" class="form-control" value="Non specifié" v-if="delivery==null"
                                    disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de cartons</label>
                                <input class="form-control" id="disabledInput" type="text" :value="carton_number"
                                    disabled v-if="carton_number">
                                <input type="text" class="form-control" value="Non specifié" v-else disabled>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de palette</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    :value="palet_number" disabled v-if="palet_number">
                                <input type="text" class="form-control" value="Non specifié" v-else disabled>
                            </div>
                        </div>



                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Volume(m² )</label>
                                <input class="form-control" id="disabledInput" type="text" v-if="volume" :value="volume"
                                    disabled>
                                <input class="form-control" id="disabledInput" type="text" v-else value="Non specifié"
                                    disabled>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Poids(kg)</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-if="weight" :value="weight" disabled>
                                <input class="form-control" id="disabledInput" type="text" v-else value="Non specifié"
                                    disabled>
                            </div>




                        </div>



                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date de livraison souhaitée</label>
                                <input class="form-control" id="disabledInput" v-if="arrival_date_wished" type="text"
                                    v-model="arrival_date_wished" disabled>
                                <input class="form-control" id="disabledInput" v-if="!arrival_date_wished" type="text"
                                    value="Non specifié" disabled>

                            </div>
                        </div>





                    </div>
                    <div class="row" style="margin-top:40px;">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date et heure de livraison estimé</label>
                                <input class="form-control" id="disabledInput" type="text" v-if="estimated_arrival_date"
                                    :value="estimated_arrival_date" disabled>
                                <input class="form-control" id="disabledInput" type="text" v-else value="Non specifié"
                                    disabled>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> <span style="opacity:0;">Code</span> </label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-if="estimated_arrival_time" :value="estimated_arrival_time" disabled>
                                <input class="form-control" id="disabledInput" type="text" v-else value="Non specifié"
                                    disabled>
                            </div>

                        </div>



                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date et heure de livraison effective</label>
                                <input class="form-control" id="disabledInput" type="text" v-if="arrival_date"
                                    :value="arrival_date" disabled>
                                <input class="form-control" id="disabledInput" type="text" v-else value="Non specifié"
                                    disabled>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> <span style="opacity:0;">Code</span> </label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-if="arrival_time" :value="arrival_time" disabled>
                                <input class="form-control" id="disabledInput" type="text" v-else value="Non specifié"
                                    disabled>
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
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal" @click="showModal(history)" v-if="primary_admin">
                                        Modifier
                                    </button>
                                </td>
                                <!-- Modal -->

                            </tr>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel">Modifier historique</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Commentaires (optionnel)</label>
                                                <textarea class="form-control" rows="3" name="comment"
                                                    placeholder="Commentaires" v-model="comment">{{comment}}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="text-center">
                                                <a href="#" data-dismiss="modal" class="btn btn-danger">Annuler</a>
                                                <a href="#" data-dismiss="modal" class="btn btn-success"
                                                    @click.prevent="updateModal()">Confirmer</a>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>




                        </tbody>
                    </table>
                </div>


            </div>





        </form>

        <div class="row">
            <div class="container text-center">


                <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelOrder()">
                    Fermer</button>



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



        },
        props: ['order_id', 'user_id','primary_admin'],
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
                billed_total_ht: 0.00,
                billed_total_tva: 0.00,
                billed_total_order: 0.00,
                comment: '',
                company_id: order.company_id,
                errors: [],
                final_prepared: [],
                estimated_arrival_time: '',
                estimated_arrival_date: '',
                arrival_time: '',
                arrival_date: '',
                delivery: '',
                delivery_man: '',
                delivery_mode: '',
                palet_number: '',
                carton_number: '',
                volume: '',
                weight: '',
                parent: '',
                preparator: '',
                comment: '',
                history_id: '',
                billed_products: [],
                arrival_date_wished: '',
                store: {
                    name: '',
                    address: '',
                    complement: '',
                    country: '',
                    city: '',
                    zipcode: ''
                },




            }

        },
        computed: {

            // a computed getter

            convert_billed_total_ht() {
                let val = (this.billed_total_ht / 1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
                // return this.billed_total_ht.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); // 12,345.67
            },
            convert_billed_total_tva() {
                let val = (this.billed_total_tva / 1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
                // return this.billed_total_tva.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); // 12,345.67

            },
            convert_billed_total_order() {
                let val = (this.billed_total_order / 1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
                // return this.billed_total_order.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); // 12,345.67
            },


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
            showModal(history) {
                this.history_id = history.id
                this.order_history.forEach(order => {
                    if (order.id == history.id) {
                        this.comment = order.comment
                    }
                });

                console.log(history)
            },
            updateModal() {
                if (this.comment != '') {
                    axios.post(`/api/order/history/${this.history_id}`, {
                            comment: this.comment
                        })
                        .then((response) => {
                            if (response.data.status == 200) {
                                this.order_history.forEach(order => {
                                    if (order.id == this.history_id) {
                                        order.comment = this.comment
                                    }
                                });

                            }
                            console.log(response);
                        })
                        .catch((error) => {
                            console.log(error);
                        });

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

                })


            },

            loadOrder() {

                axios.get('/api/order/' + this.order_id)
                    .then((response) => {
                        console.log(response)
                        this.billed_products = response.data.invoice
                        this.code = response.data.order.code
                        this.store_id = response.data.order.store_id
                        this.ordered_products = response.data.ordered_products
                        this.order_history = response.data.order_history
                        this.prepared_products = response.data.prepared_products
                        this.estimated_arrival_date = response.data.order.estimated_arrival_date
                        this.estimated_arrival_time = response.data.order.estimated_arrival_time
                        this.arrival_time = response.data.order.arrival_time
                        this.arrival_date = response.data.order.arrival_date
                        this.delivery = response.data.order.carrier
                        this.delivery_man = response.data.delivery_man
                        this.delivery_mode = response.data.order.delivery_mode
                        this.palet_number = response.data.order.pallets_number
                        this.carton_number = response.data.order.cartons_number
                        this.volume = response.data.order.volume
                        this.weight = response.data.order.weight
                        this.preparator = response.data.preparator
                        this.parent = response.data.parent
                        this.arrival_date_wished = response.data.order.arrival_date_wished


                        this.store.name = response.data.store.designation
                        this.store.address = response.data.store.address
                        this.store.complement = response.data.store.complement
                        this.store.country = response.data.store.country.name
                        this.store.city = response.data.store.city.name
                        this.store.zipcode = response.data.store.zipcode.code

                        this.ordered_products.forEach((ordered, index) => {
                            this.custom_ordered.push({
                                name: ordered.nom,
                                package: ordered.pivot.package,
                                unit: ordered.pivot.unit,
                                product_packing: ordered.packing,
                                public_price: ordered.pivot.custom_price,
                                tva: ordered.pivot.custom_tva,
                                products: this.products,
                                product_id: ordered.id,
                                total: ordered.pivot.custom_price *
                                    ordered.pivot.unit,
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

                        this.billed_products.forEach(billed => {
                            axios.post('/api/product/prices/' + billed.product_id, {
                                    store_id: this.store_id
                                })
                                .then((response) => {

                                  
                                        billed.public_price = billed.public_price
                                        billed.total = billed.public_price * billed.sum

                                    
                                    this.billed_total_ht += billed.total
                                    this.billed_total_tva += billed.total * billed.tva /
                                        100
                                    this.billed_total_order = this.billed_total_ht + this
                                        .billed_total_tva


                                })
                                .catch(function (error) {
                                    console.log(error);
                                })

                        })

                        if (this.prepared_products.length > 0) {
                            this.prepared_products.forEach(prepared => {
                                this.final_prepared.push({
                                    product_id: prepared[0].product.id,
                                    product_name: prepared[0].product.nom,
                                    total: '',
                                    prepared_products: prepared
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

                        }

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
                    if (this.custom_ordered[i].total != "") {
                        this.total_ht += parseFloat(this.custom_ordered[i].total);

                    }

                }


                // //  total des tax //

                for (let i in this.custom_ordered) {
                    if (this.custom_ordered[i].total != "") {
                        this.total_tva += this.custom_ordered[i].total * this.custom_ordered[i].tva / 100;

                    }

                }


                // //  cout total de la commande  //
                this.total_order += parseFloat(this.total_ht) + this.total_tva;
                // this.convertOrderedProducts(this.ordered_products)



            },
            cancelOrder() {
                window.location = axios.defaults.baseURL + '/orders';
            },
            convertCurrency(value) {
                let val = (value / 1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")

            },
            convertMoneyFormat(value) {

                return parseFloat(value.replace(',', '.'))

            },



        }
    }

</script>
