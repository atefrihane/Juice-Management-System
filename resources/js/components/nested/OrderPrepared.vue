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
                        <option value="" disabled> Séléctionner un type de transport</option>
                        <option value="1">Interne</option>
                        <option value="2">Externe</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="exampleInputEmail1">Livreur</label>
                    <select class="form-control" v-model="delivery_man_id">
                        <option value="" v-if="users.length > 0" disabled> Séléctionner un livreur</option>
                        <option v-for="user in users" v-if="users.length > 0" :value="user.id">{{user.nom}}
                            {{user.prenom}}
                        </option>
                        <option v-else> Aucun utilisateur trouvé !</option>

                    </select>
                </div>
                <div class="col-md-4">
                    <label for="exampleInputEmail1">Mode de livraison</label>
                    <select class="form-control" v-model="delivery_mode">
                        <option value="" disabled> Séléctionner un mode de livraison</option>
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

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" @click="submitOrderPrepared()">
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
        props: ['order_id', 'user_id'],
        data() {
            return {
                new_status: '',
                carrier_mode: '',
                delivery_man_id: '',
                delivery_mode: '',
                carton_number: '',
                palet_number: '',
                weight: '',
                volume: '',
                comment: '',
                users: []

            }
        },
        methods: {
            loadUsers() {
                axios.get('/users/show')
                    .then((response) => {
                        this.users = response.data.users

                    })
                    .catch((error) => {
                        console.log(error);
                    })

            },
            validateForm() {

                if (!this.new_status) {
                    this.$emit('requiredValue', 'Veuillez séléctionner un état  ')
                    return false;
                }
                if (this.new_status != 12) {
                    if (!this.carrier_mode) {
                        this.$emit('requiredValue', 'Veuillez séléctionner un transporteur  ')
                        return false;
                    }
                    if (!this.delivery_man_id) {
                        this.$emit('requiredValue', 'Veuillez séléctionner un livreur  ')
                        return false;
                    }
                    if (!this.delivery_mode) {
                        this.$emit('requiredValue', 'Veuillez séléctionner un mode de livraison  ')
                        return false;
                    }
                    if (!this.carton_number) {
                        this.$emit('requiredValue', 'Veuillez renseigner un nombre de cartons  ')
                        return false;
                    }
                    if (!this.palet_number) {
                        this.$emit('requiredValue', 'Veuillez renseigner un nombre de palette  ')
                        return false;
                    }
                    if (!this.volume) {
                        this.$emit('requiredValue', 'Veuillez renseigner un volume  ')
                        return false;
                    }
                    if (!this.weight) {
                        this.$emit('requiredValue', 'Veuillez renseigner un  poids  ')
                        return false;
                    }

                }

                return true;


            },
            submitOrderPrepared() {
                let validation = this.validateForm();
                console.log(validation)
                if (validation) {

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
                            if (response.data.status == 200 && response.data.canceled) {
                                swal.fire({
                                    type: 'success',
                                    title: 'La commande a été annulée avec succés !',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = '/wizefresh/public/orders';
                                    }
                                })

                            } else if (response.data.status == 200 && !response.data.canceled) {

                                swal.fire({
                                    type: 'success',
                                    title: 'La commande est maintenant à livrer !',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = '/wizefresh/public/orders';
                                    }
                                })
                            }




                        })
                        .catch((error) => {
                            console.log(error);
                        })

                }
            },
            cancelOrder() {
                window.location = "/wizefresh/public/orders"
            }
        }
    }

</script>
