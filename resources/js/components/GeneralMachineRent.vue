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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Machines</label>
                        <select class="form-control" @change="getMachineData($event)" v-model="machineId">
                            <option value="" v-if="machines.length && machines.length > 0" disabled>Selectionner une
                                machine
                            </option>
                            <option value="" v-else> Aucune machine </option>
                            <option v-for="machine in machines" :value="machine.id ">{{machine.designation}}</option>
                        </select>

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Code Machine</label>
                        <input type="text" class="form-control" placeholder="Code.." v-model="code" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Désignation Machine</label>
                        <input type="text" class="form-control" placeholder="Designation.." v-model="designation"
                            disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Societé</label>
                        <select class="form-control" @change="getCompanyData($event)" v-model="companySelected"
                            :disabled="disabledCompanyChoice">
                            <option value="" v-if="companies.length && companies[0].length > 0">Selectionner une societé
                            </option>
                            <option value="" v-else> Aucune societé </option>
                            <option v-for="company in companies[0]" :value="company.id ">{{company.name}}</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Magasin</label>
                        <select class="form-control" v-model="storeId" :disabled="disabledStoreChoice">
                            <option value="" v-if="stores.length > 0 && stores[0].length > 0">Selectionner un magasin
                            </option>
                            <option value="" v-else> Aucun magasin </option>
                            <option v-for="store in stores[0]" :value="store.id ">{{store.designation}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Date du début de location</label>

                        <Datepicker v-model="startDate" placeholder=""></Datepicker>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Date de fin de location</label>
                        <Datepicker v-model="endDate" placeholder=""></Datepicker>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
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

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" :disabled="disabled"
                    @click="submitRental()">
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
 import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {

        components: {
            Datepicker,
             Loading
        },

        mounted() {
            this.getCompanies()
            this.getProducts()
            this.checkLast()

        },
        data() {
            return {
                code: '',
                designation: '',
                machineId: '',
                userId: this.user,
                companies: [],
                products: [],
                mixtures: [],
                stores: [],
                startDate: '',
                endDate: '',
                price: '',
                localisation: '',
                comment: '',
                countBacs: '',
                storeId: '',
                companySelected: '',
                localisation: '',
                bacs: [],
                errors: [],
                disabled: false,
                disabledCompanyChoice: false,
                disabledStoreChoice:false,
                isLoading:false
            }

        },
        props: ['user', 'machines', 'last'],
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
            getMachineData(event) {
                let id = event.target.value;
                this.isLoading=true
                axios.get(`/api/machines/${id}`)
                    .then((response) => {
                             this.isLoading=false
                        if (response.data.machine) {
                            this.code = response.data.machine.code
                            this.designation = response.data.machine.designation;
                      
                        }
                        console.log(response)
                    })
                    .catch(function (error) {

                        console.log(error);
                    })

            },
            getProducts() {

                axios.get(axios.defaults.baseURL + '/api/products/')
                    .then((response) => {
                        this.products.push(response.data);

                    })
                    .catch(function (error) {

                        console.log(error);
                    })


            },
        
            cancelRental() {
                window.location = this.last;

            },
        

            validateForm() {

                this.errors = [];
                if (!this.machineId) {
                    this.errors.push('Veuillez séléctionner une machine');
                    window.scrollTo(0, 0);
                    return false;
                }

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

                if (x == true) {
                    this.disabled = true
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
                                        window.location = '/machines';
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
                                this.disabled = false

                            }

                            if (response.data.status == 405) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Erreur date!',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'


                                });
                                this.disabled = false



                            }

                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                }

            },
            getStores() {
                axios.get(axios.defaults.baseURL + '/api/stores/')
                    .then((response) => {
                        this.stores.push(response.data.stores)

                    })
                    .catch(function (error) {
                        console.log(error);
                    })

            },
            checkLast() {
                let storeId = ''
                let companyId = ''
                let extractUrl = this.last.slice(-7)
                console.log(extractUrl)
                if (extractUrl != '/rental') {
                    if (extractUrl == 'rentals') {
                        this.getStores()
                        storeId = this.last.charAt(this.last.length - 9)
                        companyId = this.last.charAt(this.last.length - 18)
                        this.companySelected = companyId
                        this.storeId = storeId
                        this.disabledCompanyChoice = true
                         this.disabledStoreChoice = true
                    }
                    else{
                   
                       companyId=this.last.charAt(this.last.length-1)
                       this.companySelected=companyId
                     
                axios.get('/api/companies/' + companyId)
                    .then((response) => {
                        this.stores.push(response.data.stores);
                        this.disabledCompanyChoice = true
                    })
                    .catch(function (error) {

                        console.log(error);
                    })

                    }

                }



            }






        },

    }

</script>
