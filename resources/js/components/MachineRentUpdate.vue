<template>
    <div class="box box-primary">

        <div class="box-header">
            <h3 class="box-title">Modifier location machine </h3>
            <!--
            <div class="btn-group breadcrumb1 pull-right">
                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <ul class="dropdown-menu" role="menu" x-placement="bottom-start"
                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 31px, 0px);">


                    <li><a href="" @click.prevent="stopRental()">Arrêter location</a></li>

                </ul>
            </div>
            -->

        </div>


        <div class="box-body">
            <div class="alert alert-danger" v-if="errors.length>0">
                <ul>

                    <li v-for="error in errors">{{error}}</li>

                </ul>
            </div>
        </div>

        <form role="form" method="post" enctype="multipart/form-data">

            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Code Machine</label>
                            <input type="text" class="form-control" value="" readonly v-model="code">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Désignation Machine</label>
                            <input type="text" class="form-control" value="" readonly v-model="designation">

                        </div>
                    </div>



                </div>
                <div class="row">



                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Societé</label>
                            <input type="text" class="form-control" readonly value="" v-model="company">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Magasin</label>
                            <input type="text" class="form-control" readonly value="" v-model="store">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Date du début de location</label>
                            <Datepicker v-model="startDate" placeholder=""></Datepicker>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Date de fin de location</label>
                             <Datepicker v-model="endDate" placeholder=""></Datepicker>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Prix location mensuel</label>
                            <input class="form-control" value="" name="designation" type="number" placeholder="Prix"
                                v-model="price">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Localisation</label>
                            <textarea class="form-control" rows="2" name="location" placeholder="localisation"
                                v-model="location">{{location}}</textarea>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Commentaires (optionnel)</label>
                            <textarea class="form-control" rows="3" name="comment" placeholder="Commentaires"
                                v-model="comment"> {{comment}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label>Configurations des bacs : </label>
                    </div>
                </div>

                <div style="background-color: #e4e4e4; margin: 16px; padding: 24px" v-for="(bac,index) in customBacs">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group d-flex">
                                <label class="col-10">Numero du bac: </label>
                                <input type="text" class="form-control" value="" disabled v-model="bac.order">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group " style="display: flex; flex-direction: column">
                                <label>Etat : </label>
                                <select class="form-control" v-model="bac.status"@change="onChangeStatus($event,bac)">
                                    <option :value="null" disabled> Séléctionner un etat</option>
                                    <option value="fonctionnelle">Fonctionnelle</option>
                                    <option value="en panne">En panne</option>
                                    <option value="en sommeil">En Sommeil</option>

                                </select>

                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group " style="display: flex; flex-direction: column">
                                <label>Produit en bac </label>
                                <select class="form-control" @change="getProductData($event,index)"
                                    v-model="bac.product_id"
                                    :disabled="bac.status == 'en panne' || bac.status == 'en sommeil'">
                            
                           <option :value="null"  v-if="products.length> 0"> Séléctionner un 
                                        produit
                                    </option>            
                     <option v-for="product in products" :value="product.id ">{{product.nom}}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group " style="display: flex; flex-direction: column">
                                <label class="col-12">Melange par defaut </label>
                                <select class="form-control" v-model="bac.mixture_id"
                                    :disabled="bac.status == 'en panne' || bac.status == 'en sommeil'">

                                    <option :value="null"  v-if="bac.mixtures.length == 0"> Aucun
                                        mélange
                                    </option>
                                       <option :value="null"  v-if="bac.mixtures.length > 0"> Séléctionner un 
                                        mélange
                                    </option>
                                    <option v-if="bac.mixtures.length > 0" v-for="(mixture,i) in bac.mixtures" :value="mixture.id">
                                        {{mixture.name}}
                                    </option>


                                </select>
                               
                            </div>

                        </div>
                    </div>



                </div>


                <div class="row">
                    <div class="container text-center">


                        <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelRental()">
                            Annuler</button>

                        <button type="button" class="btn btn-success pl-1" style="margin: 1em" :disabled="disabled"
                            @click.prevent="submitRental()">
                            Confirmer</button>

                    </div>
                </div>







            </div>

        </form>
    </div>
</template>

<script>
 import Datepicker from 'vuejs-datepicker';
    export default {

           components: {
            Datepicker
        },

        mounted() {
            this.getProducts()
            this.getBacs()
        },
        data() {
            return {
                code: data.machine.code,
                designation: data.machine.designation,
                company: data.company.name,
                store: data.store.designation,
                startDate: data.rental.date_debut,
                endDate: data.rental.date_fin,
                price: data.rental.price,
                location: data.rental.location,
                comment: data.rental.Comment,
                bacs: [],
                customBacs: [],
                rentalId: data.rental.id,
                userId: data.userId,
                products: [],
                disabled:false,

                errors: []

            }

        },
     
        methods: {
            getProducts() {
                axios.get(axios.defaults.baseURL+'/api/products/')
                    .then((response) => {
                        console.log(response.data)

                        this.products = response.data;
                    })
                    .catch(function (error) {

                        console.log(error);
                    })


            },

            getBacs() {
                axios.get('api/rental/' + this.rentalId)
                    .then((response) => {

                        console.log(response.data.bacs);
                        this.bacs = response.data.bacs;

                        this.bacs.map((bac, i) => {
                            if (bac.product) {
                                this.customBacs.push({
                                    id:bac.id,
                                    order: bac.order,
                                    status: bac.status,
                                    product_id: bac.product_id,
                                    mixture_id: bac.mixture_id,
                                    mixtures: bac.product.mixtures
                                })

                            } else {
                                this.customBacs.push({
                                    id:bac.id,
                                    order: bac.order,
                                    status: bac.status,
                                    product_id: bac.product_id,
                                    mixture_id: bac.mixture_id,
                                    mixtures: []
                                })

                            }

                        })
                    })
                    .catch(function (error) {

                        console.log(error);
                    })


            },
                 onChangeStatus(event, selectedBac) {

                let value = event.target.value;
                this.customBacs.map((bac, i) => {
                    if (bac.id == selectedBac.id) {
                        if (value == 'en panne' || value == 'en sommeil') {
                            bac.product_id = null;
                            bac.mixture_id = null;
                        }
                    }

                })


            },

            getProductData(event, index) {
                let id = event.target.value;

                axios.get('api/product/' + id)
                    .then((response) => {

                        console.log(response);
                            this.customBacs[index].mixtures=[]
                        if (response.data.product.length > 0) {
                        this.customBacs[index].mixtures=response.data.product;

                }

                    })
                    .catch(function (error) {
                        console.log(error);
                    })

            },
            validateForm() {

                this.errors = [];
                var x = true;
                if (!this.endDate) {
                    this.errors.push('Veuillez séléctionner une date de fin');
                    window.scrollTo(0, 0);
                    x = false;
                }

                if (!this.price) {
                    this.errors.push('Veuillez séléctionner un prix de location');
                    window.scrollTo(0, 0);
                    x = false;
                }
                return x;
            },

            submitRental() {
                if (this.validateForm()) {
                    this.disabled=true    
                    axios.post('api/rental/' + this.rentalId, {
                            startDate: this.startDate,
                            endDate: this.endDate,
                            price: this.price,
                            location: this.location,
                            comment: this.comment,
                            customBacs: this.customBacs,
                            userId: this.userId
                        })
                        .then((response) => {
                            console.log(response);
                            if (response.data.status == 400) {
                                 swal.fire({
                                    type: 'error',
                                    title: 'Erreur date!',
                                    showConfirmButton: true,
                                      allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'


                                });
                                  this.disabled=false  
                                return false;
                            }

                            if (response.data.status == 200) {
                                swal.fire({
                                    type: 'success',
                                    title: 'La location a été modifiée avec succés !',
                                      allowOutsideClick: false,
                                    showConfirmButton: true,


                                });
                                setTimeout(() => window.location = axios.defaults.baseURL+'/machines', 2000);
                            }

                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                }


            },
            cancelRental() {
                window.location = axios.defaults.baseURL+'/machines';

            },
            stopRental() {

                window.location = axios.defaults.baseURL+'/machine/rental/show/end/' + this.rentalId;


            }
        }
    }

</script>
