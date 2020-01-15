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
                            <input class="form-control" value="" name="designation" type="number" step="0.01"
                                placeholder="Prix" v-model="price">

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
                <div class="row" v-if="status == 0">
                    <div class="col-md-8">
                        <div class="form-group">
                              <label>Raison fin de location</label>
                        <select class="form-control" v-model="end_reason">
                            <option :value="null" disabled>Séléctionner une raison d'arrêt</option>
                            <option value="Fin du contrat de location">Fin du contrat de location</option>
                            <option value="Machine non rentable">Machine non rentable</option>
                            <option value="Machine en panne">Machine en panne</option>
                            <option value="Autre">Autre</option>
                        </select>
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
                rentalId: data.rental.id,
                userId: data.userId,
                status:data.rental.active,
                disabled: false,
                end_reason:data.rental.end_reason,
                errors: []

            }

        },
        props: ['last'],

        methods: {

     
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
                    this.disabled = true
                    axios.post('/api/rental/' + this.rentalId, {
                            startDate: this.startDate,
                            endDate: this.endDate,
                            price: this.price,
                            location: this.location,
                            comment: this.comment,
                            userId: this.userId,
                            end_reason:this.end_reason
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
                                this.disabled = false
                                return false;
                            }

                            if (response.data.status == 200) {

                                  swal.fire({
                                    type: 'success',
                                    title: 'La location a été modifiée avec succés !',
                                    showConfirmButton: true,
                                      allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'


                                }).then((result) => {
                                    if (result.value) {
                                        window.location = axios.defaults.baseURL+'/machines';
                                    }
                                })
                             
                            }

                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                }


            },
            cancelRental() {
                window.location = this.last;

            },
            stopRental() {

                window.location = axios.defaults.baseURL + '/machine/rental/show/end/' + this.rentalId;


            }
        }
    }

</script>
