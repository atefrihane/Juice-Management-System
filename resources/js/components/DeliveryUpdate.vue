<template>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Mise à jour de la livraison </h3>

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
                <div class="container-fluid">

                    <div class="row" style="margin-top:40px;">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Transporteur</label>
                            <select class="form-control" v-model="carrier">
                                <option :value="null" disabled> Séléctionner un type de transport</option>
                                <option value="1">Interne</option>
                                <option value="2">Externe</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Livreur</label>
                            <select class="form-control" v-model="delivery_man_id">
                                <option :value="null" v-if="users.length > 0" disabled> Séléctionner un livreur</option>
                                <option v-for="user in users" v-if="users.length > 0" :value="user.id">{{user.nom}}
                                    {{user.prenom}}
                                </option>
                                <option v-else> Aucun utilisateur trouvé !</option>

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
                            <input type="number" class="form-control" placeholder="Nombre de cartons"
                                v-model="carton_number">
                        </div>
                        <div class="col-md-4">
                            <label for="">Nombre de palette</label>
                            <input type="number" class="form-control" placeholder="Nombre de palette"
                                v-model="palet_number">
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
                    <div class="row" style="margin-top:20px;">
                        <div class="col-md-12">
                            <label>Commentaires (optionnel)</label>
                            <textarea class="form-control" rows="3" placeholder="Commentaires"
                                v-model="comment"></textarea>
                        </div>
                    </div>

                    <div class="row" style="margin-top:20px;">
                        <div class="container text-center">


                            <button type="button" class="btn btn-danger pl-1" style="margin: 1em"
                                @click="cancelOrder()">
                                Annuler</button>

                            <button type="button" class="btn btn-success pl-1" style="margin: 1em"
                                @click="submitOrderDelivery()">
                                Enregistrer</button>


                        </div>
                    </div>

                </div>
            </diV>


        </form>


    </div>

</template>

<script>
    export default {
        mounted() {
            this.loadUsers()
        },
        props: ['order', 'user_id','history'],
        data() {
            return {
                order_id: this.order.id,
                carrier: this.order.carrier,
                delivery_man_id: this.order.delivery_man_id,
                delivery_mode: this.order.delivery_mode,
                carton_number: this.order.cartons_number,
                palet_number: this.order.pallets_number,
                volume: this.order.volume,
                weight: this.order.weight,
                comment: this.history.comment,
                users: [],
                errors: []

            }
        },
        methods: {
            loadUsers() {
                axios.get('/users/show')
                    .then((response) => {
                        // handle success
                        console.log(response);
                        this.users = response.data.users;
                    })
                    .catch((error) => {
                        // handle error
                        console.log(error);
                    })

            },
            submitOrderDelivery() {
                if (this.carrier == null &&
                    this.delivery_man_id == null &&
                    this.delivery_mode == null &&
                    this.carton_number == null &&
                    this.palet_number == null &&
                    this.volume == null &&
                    this.weight == null &&
                    this.comment == ''
                ) {
                    this.errors.push('Veuillez renseigner au moins une valeur');




                } else {


                    axios.post(`/order/delivery/${this.order_id}`, {
                            carrier_mode: this.carrier,
                            delivery_man_id: this.delivery_man_id,
                            delivery_mode: this.delivery_mode,
                            carton_number: this.carton_number,
                            palet_number: this.palet_number,
                            volume: this.volume,
                            weight: this.weight,
                            user_id: this.user_id,
                            comment: this.comment
                        })
                        .then((response) => {
                            if (response.data.status == 200) {
                                swal.fire({
                                    type: 'success',
                                    title: 'La livraison a été modfiiée avec succés !',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location =axios.defaults.baseURL+'/orders';
                                    }
                                })
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }

            },
            cancelOrder() {
                window.location = axios.defaults.baseURL+"/orders"
            }
        }
    }

</script>
