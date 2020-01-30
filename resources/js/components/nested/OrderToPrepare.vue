<template>
    <div>
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nouveau état</label>
                    <select class="form-control" v-model="new_status">
                        <option value="" disabled> Séléctionner un état</option>
                        <option value="3">En cours de préparation</option>
                        <option value="12">Annulée</option>
                    </select>

                </div>
            </div>



        </div>
        <div class="row" v-if="new_status != 12">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Préparateur</label>
                    <select class="form-control" v-model="preparator_id" :disabled="is_preparator == 1">
                        <option value="" disabled> Séléctionner un préparateur</option>
                        <option :value="user.user.id" v-for="user in users"> {{user.user.nom}} {{user.user.prenom}}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Commentaire (optionnel)</label>
                    <textarea v-model="comment" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="container text-center">


                <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelOrder()">
                    Annuler</button>

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" :disabled="disabled" @click="saveNewOrderStatus()">
                    Enregistrer</button>


            </div>
        </div>

    </div>

</template>

<script>
    export default {
        mounted() {
            this.loadUsers()
        },
        props: ['order_id', 'user_id','is_preparator','history'],
        data() {
            return {
                errors: [],
                users: [],
                new_status: 3,
                new_status_text: 'En cours de préparation',
                preparator_id: this.user_id,
                comment: this.history ? this.history.comment : null,
                disabled:false

            }
        },
        methods: {
            loadUsers() {
                axios.get('/api/preparators/show')
                    .then((response) => {
                        // handle success
                        console.log(response);
                        this.users = response.data.preparators;
                    })
                    .catch((error) => {
                        // handle error
                        console.log(error);
                    })

            },
            validateForm() {
                let x = true;
                if (!this.preparator_id && this.new_status != 12) {
                    this.$emit('requiredValue', 'Veuillez séléctionner un préparateur')
                    x = false;
                       this.disabled=false;
                }
                if (!this.new_status) {
                    this.$emit('requiredValue', 'Veuillez séléctionner un état')
                    x = false;
                       this.disabled=false;
                }


                return x;



            },
            saveNewOrderStatus() {
                this.disabled=true;
                let validation = this.validateForm()
                console.log(validation)
                if (validation) {
                    if (this.new_status == 12) {
                        this.new_status_text = 'Annulée';
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
                                axios.post('/api/order/toprepare/' + this.order_id + '', {
                                        new_status: this.new_status,
                                        preparator_id: this.preparator_id,
                                        comment: this.comment,
                                        new_status_text: this.new_status_text,
                                        user_id: this.user_id
                                    })
                                    .then((response) => {
                                        if (response.data.status == 200) {
                                            swal.fire({
                                                type: 'success',
                                                title: 'La commande a été annulée  avec succés !',
                                                showConfirmButton: true,
                                                allowOutsideClick: false,
                                                confirmButtonText: 'Fermer'
                                            }).then((result) => {
                                                if (result.value) {
                                                    window.location = axios.defaults.baseURL+'/orders';
                                                }
                                            })
                                        }
                                        if (response.data.status == 400) {
                                            swal.fire({
                                                type: 'error',
                                                title: 'Echec !',
                                                showConfirmButton: true,
                                                allowOutsideClick: false,
                                                confirmButtonText: 'Fermer'
                                            })

                                        }
                                        if (response.data.status == 404) {
                                            swal.fire({
                                                type: 'error',
                                                title: 'Commande introuvable !',
                                                showConfirmButton: true,
                                                allowOutsideClick: false,
                                                confirmButtonText: 'Fermer'
                                            })
                                        }
                                    })
                                    .catch((error) => {
                                        console.log(error);
                                    });
                            }
                        });
                    } else {
                        axios.post('/api/order/toprepare/' + this.order_id + '', {
                                new_status: this.new_status,
                                preparator_id: this.preparator_id,
                                comment: this.comment,
                                new_status_text: this.new_status_text,
                                user_id: this.user_id
                            })
                            .then((response) => {
                                if (response.data.status == 200) {
                                    swal.fire({
                                        type: 'success',
                                        title: 'La commande a été mis à jour  avec succés !',
                                        showConfirmButton: true,
                                        allowOutsideClick: false,
                                        confirmButtonText: 'Fermer'
                                    }).then((result) => {
                                        if (result.value) {
                                            window.location = axios.defaults.baseURL+'/orders';
                                        }
                                    })
                                }
                                if (response.data.status == 400) {
                                    swal.fire({
                                        type: 'error',
                                        title: 'Echec !',
                                        showConfirmButton: true,
                                        allowOutsideClick: false,
                                        confirmButtonText: 'Fermer'
                                    })

                                }
                                if (response.data.status == 404) {
                                    swal.fire({
                                        type: 'error',
                                        title: 'Commande introuvable !',
                                        showConfirmButton: true,
                                        allowOutsideClick: false,
                                        confirmButtonText: 'Fermer'
                                    })
                                }
                            })
                            .catch((error) => {
                                console.log(error);
                            });

                    }



                }

            },
            cancelOrder() {
                window.location = axios.defaults.baseURL+"/orders"
            }

        }


    }

</script>
