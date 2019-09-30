<template>
    <div class="box box-primary">

        <div class="box-header">
            <h3 class="box-title">Commencer location machine </h3>

        </div>




        <div class="box-body">
            <div class="alert alert-danger" v-if="errors.length>0">
                <ul>

                    <li v-for="error in errors">{{error}}</li>

                </ul>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Code Machine</label>
                        <input type="text" class="form-control" v-model="code" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Désignation Machine</label>
                        <input type="text" class="form-control" v-model="designation" disabled>
                    </div>
                </div>



            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Societé</label>
                        <select class="form-control" @change="getCompanyData($event)" v-model="companySelected">
                            <option value="" v-if="companies.length && companies[0].length > 0">Selectionner une societé
                            </option>
                            <option value="" v-else> Aucune societé </option>
                            <option v-for="company in companies[0]" :value="company.id ">{{company.name}}</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Magasin</label>
                        <select class="form-control" v-model="storeId">
                            <option value="" v-if="stores.length > 0 && stores[0].length > 0">Selectionner un magasin
                            </option>
                            <option value="" v-else> Aucun magasin </option>
                            <option v-for="store in stores[0]" :value="store.id ">{{store.designation}}</option>
                        </select>
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
                        <input class="form-control" required name="designation" id="disabledInput" type="number"
                            step="0.01" placeholder="Prix" v-model="price">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Localisation</label>
                        <textarea class="form-control" required rows="2" name="location" placeholder="localisation"
                            v-model="localisation"></textarea>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Commentaires (optionnel)</label>
                        <textarea class="form-control" rows="3" name="comment" placeholder="Commentaires"
                            v-model="comment"></textarea>
                    </div>
                </div>
            </div>
            <label style="font-weight: bold; font-size: 16px; margin-top: 20px"> Configuration des bacs
            </label>

            <div class="container-fluid " style="background-color: #e4e4e4; margin: 16px; padding: 24px"
                v-for="(bac,index) in bacs[0]">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                            <label class="col-10">Numero du bac: </label>
                            <input type="text" class="form-control" :value="index+1" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group " style="display: flex; flex-direction: column">
                            <label>Etat : </label>

                            <select class="form-control" v-model="bac.status">
                                <option value="" v-if="bacs[0].length > 0"> Séléctionner un Etat</option>
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
                            <select class="form-control" @change="getProductData($event,index)" v-model="bac.product_id"
                                :disabled="bac.status == 'en panne' || bac.status == 'en sommeil'">

                                <option value="" v-if="products.length > 0 && products[0].length > 0">Selectionner un
                                    produit</option>
                                <option value="" v-else> Aucun Produit </option>
                                <option v-for="product in products[0]" :value="product.id ">{{product.nom}}</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group " style="display: flex; flex-direction: column">
                            <label class="col-12">Melange par defaut </label>
                            <select class="form-control" v-model="bac.mixture_id"
                                :disabled="bac.status == 'en panne' || bac.status == 'en sommeil'">
                                <option value="" v-if="bac.mixtures && bac.mixtures.length > 0">Selectionner un mélange
                                </option>
                                <option value="" v-else> Aucun mélange </option>
                                <option v-for="mixture in bac.mixtures" :value="mixture.id ">{{mixture.name}}</option>

                            </select>
                        </div>

                    </div>
                </div>

            </div>

        </div>



        <div class="row">
            <div class="container text-center">


                <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelRental()">
                    Annuler</button>

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" @click="submitRental()">
                    Confirmer</button>

            </div>
        </div>




    </div>

    </form>
    </div>

    <!-- /.col -->
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    export default {

        components: {
            Datepicker
        },

        mounted() {
            this.getCompanies()
            this.getProducts()
            this.loadBacs()
        },
        data() {
            return {
                code: data.machine.code,
                designation: data.machine.designation,
                machineId: data.machine.id,
                userId:data.user.id,
                companies: [],
                products: [],
                mixtures: [],
                stores: [],
                startDate: '',
                endDate: '',
                price: data.machine.price_month,
                localisation: '',
                comment: '',
                countBacs: data.machine.number_bacs,
                storeId: '',
                companySelected: '',
                localisation: '',
                bacs: [],
                errors: []






            }

        },
        methods: {

            getCompanies() {

                axios.get('/api/companies')
                    .then((response) => {
                        this.companies.push(response.data);
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
                        this.stores.push(response.data.stores);
                    })
                    .catch(function (error) {

                        console.log(error);
                    })

            },
            getProducts() {
                axios.get('/api/products/')
                    .then((response) => {
                        this.products.push(response.data);
                    })
                    .catch(function (error) {

                        console.log(error);
                    })


            },
            getProductData(event, index) {
                let id = event.target.value;

                axios.get('api/product/' + id)
                    .then((response) => {
                  Vue.set(this.bacs[0][index], 'mixtures', '')
                        //Display mixtures of a product ( if has a one)
                        console.log(response);
                        if (response.data.product.length > 0) {
                            Vue.set(this.bacs[0][index], 'mixtures', response.data.product)
                            // this.bacs[0][index].push(response.data.product);
                            // this.mixtureId = this.bacs[index]['mixtures'][0].id;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    })

            },
            loadBacs() {

                axios.get('api/machine/bacs/' + this.machineId)
                    .then((response) => {
                        console.log(response.data);
                        this.bacs.push(response.data.bacs);

                    })
                    .catch(function (error) {
                        console.log(error);
                    })




            },
            cancelRental() {
                window.location = '/wizefresh/public/machines';

            },
            validateForm() {

                this.errors = [];

                if (!this.companySelected) {
                    this.errors.push('Veuillez séléctionner une societé');
                    window.scrollTo(0, 0);
                    return false;
                }


                if (!this.storeId) {
                    this.errors.push(' Veuillez séléctionner un magasin');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.startDate) {
                    this.errors.push('Veuillez sélectionner une date de debut');
                    window.scrollTo(0, 0);
                    return false;
                }



                if (!this.endDate) {
                    this.errors.push('Veuillez sélectionner une date de fin');
                    window.scrollTo(0, 0);
                    return false;
                }


                if (!this.price) {
                    this.errors.push('Veuillez renseigner un prix');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.localisation) {
                    this.errors.push('Veuillez renseigner une localisation');
                    window.scrollTo(0, 0);
                    return false;
                }



                var x = true;
                this.bacs[0].forEach((bac, index) => {

                    if (!bac.status) {
                        this.errors.push('Veuillez sélectionner un etat pour le bac ' + (index + 1));
                        window.scrollTo(0, 0);
                        x = false;
                    }



                });

                return x;




            },

            submitRental() {
                var x = this.validateForm()

                if (x == true) {

                    axios.post('api/rentals', {
                            id: this.machineId,
                            startDate: this.startDate,
                            endDate: this.endDate,
                            price: this.price,
                            localisation: this.localisation,
                            comment: this.comment,
                            storeId: this.storeId,
                            active: 1,
                            bacs: this.bacs,
                            userId:this.userId

                        })
                        .then((response) => {
                            if (response.data.status == 200) {
                                swal.fire({
                                    type: 'success',
                                    title: 'La location a été ajoutée avec succés !',
                                    showConfirmButton: false,
                                    timer: 1500

                                });
                                setTimeout(() => window.location = '/wizefresh/public/machines', 2000);
                            }


                            if (response.data.status == 400) {
                                swal.fire({
                                    type: 'error',
                                    title: 'La machine a été déja louée !',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }


                            if (response.data.status == 404) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Machine introuvable! !',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }

                            if (response.data.status == 405) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Erreur date!',
                                    showConfirmButton: false,
                                    timer: 1500

                                });



                            }

                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                }

            }




        },

    }

</script>
