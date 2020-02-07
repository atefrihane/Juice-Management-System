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
     

        </div>

        <div class="row">
            <div class="container text-center">


                <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelRental()">
                    Annuler</button>

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" :disabled="disabled" @click="submitRental()">
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

        },
        data() {
            return {
                code: data.machine.code,
                designation: data.machine.designation,
                machineId: data.machine.id,
                userId: data.user.id,
                companies: [],
                products: [],
                stores: [],
                startDate: '',
                endDate: '',
                price: data.machine.price_month,
                localisation: '',
                comment: '',
                storeId: '',
                companySelected: '',
                localisation: '',
                errors: [],
                disabled:false
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
              
                axios.get(axios.defaults.baseURL+'/api/products/')
                    .then((response) => {
                        this.products.push(response.data);
                        
                    })
                    .catch(function (error) {
                    
                        console.log(error);
                    })


            },
            getProductData(event, index) {
                let id = event.target.value;

                axios.get('/api/product/' + id)
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
         
            cancelRental() {
                window.location = axios.defaults.baseURL+'/machines';

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
                return true;






            },

            submitRental() {
                var x = this.validateForm()
                console.log(x)

                if (x == true) {
                    this.disabled=true
                    axios.post('/api/rentals', {
                            id: this.machineId,
                            startDate: this.startDate,
                            endDate: this.endDate,
                            price: this.price,
                            localisation: this.localisation,
                            comment: this.comment,
                            storeId: this.storeId,
                            active: 1,
                            bacs: this.bacs,
                            userId: this.userId

                        })
                        .then((response) => {
                            if (response.data.status == 200) {
                                swal.fire({
                                    type: 'success',
                                    title: 'La location a été ajoutée avec succés !',
                                    showConfirmButton: true,
                                      allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'


                                }).then((result) => {
                                    if (result.value) {
                                        window.location = axios.defaults.baseURL+'/machines';
                                    }
                                })
                                
                          
                            }


                            if (response.data.status == 400) {
                                swal.fire({
                                    type: 'error',
                                    title: 'La machine a été déja louée !',
                                    showConfirmButton: true,
                                      allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'

                                });
                            }

                                 if (response.data.status == 403) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Machine déja louée!',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'

                                });
                                this.disabled = false

                            }




                            if (response.data.status == 404) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Machine introuvable! !',
                                    showConfirmButton: true,
                                      allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'

                                });
                                  this.disabled=false

                            }

                            if (response.data.status == 405) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Erreur date!',
                                    showConfirmButton: true,
                                      allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'


                                });
                                this.disabled=false



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
