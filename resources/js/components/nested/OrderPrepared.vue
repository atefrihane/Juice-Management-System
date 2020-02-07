<template>
    <div>
        <div class="row">



            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nouveau état</label>
                    <select class="form-control" v-model="new_status">
                        <option value="" disabled> Séléctionner un état</option>
                        <option value="5">A livrer</option>
                        <option value="12">Annulée</option>
                    </select>

                </div>
            </div>
        </div>
        <div v-if="new_status != 12">
            <div class="row" style="margin-top:40px;">
                <div class="col-md-4">
                    <label for="exampleInputEmail1">Transporteur</label>
                    <select class="form-control" v-model="carrier_mode">
                        <option :value="null" disabled> Séléctionner un type de transport</option>
                        <option value="1">Interne</option>
                        <option value="2">Externe</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="exampleInputEmail1">Livreur</label>
                    <select class="form-control" v-model="delivery_man_id">
                        <option :value="null" v-if="users.length > 0" disabled> Séléctionner un livreur</option>
                        <option v-for="user in users" v-if="users.length > 0" :value="user.user.id">{{user.user.nom}}
                            {{user.user.prenom}}
                        </option>
                        <option :value="null" v-if="users.length == 0"> Aucun livreur trouvé</option>

                    </select>
                </div>
                <div class="col-md-4">
                    <label for="exampleInputEmail1">Mode de livraison</label>
                    <select class="form-control" v-model="delivery_mode">
                        <option :value="null" disabled> Séléctionner un mode de livraison</option>
                        <option value="0">Voiture</option>
                        <option value="1">Camion</option>
                        <option value="2">Avion</option>
                        <option value="3">Bateau</option>
                    </select>
                </div>


            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-md-4">
                    <label for="">Nombre de cartons</label>
                    <input type="number" class="form-control" placeholder="Nombre de cartons" v-model="carton_number">
                </div>
                <div class="col-md-4">
                    <label for="">Nombre de palette</label>
                    <input type="number" class="form-control" placeholder="Nombre de palette" v-model="palet_number">
                </div>

            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-md-4">
                    <label for="">Volume(m²)</label>
                    <input type="number" class="form-control" placeholder="0.00" v-model="volume">
                </div>
                <div class="col-md-4">
                    <label for="">Poids(kg)</label>
                    <input type="number" class="form-control" placeholder="0.00" v-model="weight">
                </div>

            </div>
        </div>




        <div class="row" style="margin-top:20px;">
            <div class="col-md-12">
                <label>Commentaires (optionnel)</label>
                <textarea class="form-control" rows="3" placeholder="Commentaires" v-model="comment"></textarea>
            </div>
        </div>

        <div class="row" style="margin-top:20px;">
            <div class="container text-center">


                <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelOrder()">
                    Annuler</button>

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" :disabled="disabled"
                    @click="submitOrderPrepared()">
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
        props: ['order_id', 'user_id', 'order_full', 'history'],
        data() {
            return {
                new_status: 5,
                carrier_mode: this.order_full.carrier,
                delivery_man_id: this.order_full.delivery_man_id,
                delivery_mode: this.order_full.delivery_mode,
                carton_number: this.order_full.cartons_number,
                palet_number: this.order_full.pallets_number,
                weight: this.order_full.weight,
                volume: this.order_full.volume,
                comment: this.history ? this.history.comment : null,
                users: [],
                disabled: false,



            }
        },
        methods: {
            loadUsers() {
                axios.get('/api/deliveries/show')
                    .then((response) => {
                        // handle success
                        console.log(response);
                        this.users = response.data.deliveries;
                    })
                    .catch((error) => {
                        // handle error
                        console.log(error);
                    })

            },
            validateForm() {

                if (!this.new_status) {
                    this.$emit('requiredValue', 'Veuillez séléctionner un état  ')
                    this.disabled = false
                    return false;

                }
                if (this.new_status != 12) {
                    if (!this.carrier_mode) {
                        this.$emit('requiredValue', 'Veuillez séléctionner un transporteur  ')
                        this.disabled = false
                        return false;
                    }
                    if (!this.delivery_man_id) {
                        this.$emit('requiredValue', 'Veuillez séléctionner un livreur  ')
                        this.disabled = false
                        return false;
                    }
                    if (this.delivery_mode == null || this.deliver_mode < 0) {
                        this.$emit('requiredValue', 'Veuillez séléctionner un mode de livraison  ')
                        this.disabled = false
                        return false;
                    }
                    if (!this.carton_number) {
                        this.$emit('requiredValue', 'Veuillez renseigner un nombre de cartons  ')
                        this.disabled = false
                        return false;
                    }
                    if (!this.palet_number) {
                        this.$emit('requiredValue', 'Veuillez renseigner un nombre de palette  ')
                        this.disabled = false
                        return false;
                    }
                    if (!this.volume) {
                        this.$emit('requiredValue', 'Veuillez renseigner un volume  ')
                        this.disabled = false
                        return false;
                    }
                    if (!this.weight) {
                        this.$emit('requiredValue', 'Veuillez renseigner un  poids  ')
                        this.disabled = false
                        return false;
                    }

                }

                return true;


            },
            submitOrderPrepared() {
                this.disabled = true;
                let validation = this.validateForm();
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
                                axios.post(`/api/order/${this.order_id}/prepare/after`, {
                                        new_status: this.new_status,
                                        carrier_mode: this.carrier_mode,
                                        delivery_man_id: this.delivery_man_id,
                                        delivery_mode: this.delivery_mode,
                                        carton_number: this.carton_number,
                                        palet_number: this.palet_number,
                                        weight: this.weight,
                                        volume: this.volume,
                                        user_id: this.user_id,
                                        comment: this.comment
                                    })
                                    .then((response) => {

                                        console.log(response)
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
                                        alert('lolz')
                                        console.log(error);
                                    })

                            } else if (result.dismiss = 'cancel') {
                                this.disabled = false
                            }
                        });
                    } else {
                        axios.post(`/api/order/${this.order_id}/prepare/after`, {
                                new_status: this.new_status,
                                carrier_mode: this.carrier_mode,
                                delivery_man_id: this.delivery_man_id,
                                delivery_mode: this.delivery_mode,
                                carton_number: this.carton_number,
                                palet_number: this.palet_number,
                                weight: this.weight,
                                volume: this.volume,
                                user_id: this.user_id,
                                comment: this.comment
                            })
                            .then((response) => {

                                console.log(response)
                                if (response.data.status == 200) {
                                    swal.fire({
                                        type: 'success',
                                        title: 'La commande est maintenant à livrer !',
                                        showConfirmButton: true,
                                        allowOutsideClick: false,
                                        confirmButtonText: 'Fermer'
                                    }).then((result) => {
                                        if (result.value) {
                                            window.location = axios.defaults.baseURL + '/orders';
                                        }
                                    })

                                }




                            })
                            .catch((error) => {

                                console.log(error);
                                if (error.response.status == 422) {

                                    this.errors = []
                                    let errors = Object.values(error.response.data.errors);
                                    errors = _.flatMap(errors);
                                    console.log(errors)
                                    // this.errors = errors;
                                    errors.forEach(error => {
                                        this.$emit('requiredValue', error)
                                    })


                                    this.disabled = false
                                    window.scrollTo(0, 0);
                                }
                            })


                    }



                }
            },
            cancelOrder() {
                window.location = axios.defaults.baseURL + "/orders"
            }
        }
    }

</script>
