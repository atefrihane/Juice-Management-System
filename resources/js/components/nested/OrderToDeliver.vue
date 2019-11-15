<template>
    <div>
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nouveau état</label>
                    <select class="form-control" v-model="new_status">
                        <option value="" disabled> Séléctionner un état</option>
                        <option value="6">En cours de livraison</option>
                        <option value="12">Annulée</option>
                    </select>

                </div>
            </div>
        </div>
        <div v-if="new_status != 12">

            <div class="row">

                <div class="box-body">
                    <label for="">Date et heure de livraison estimé</label>
                </div>

                <div class="col-md-2">
                    <div class="form-group">


                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control" v-model="date">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="time" class="form-control" v-model="time">
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

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" @click="submitOrderToDeliver()">
                    Enregistrer</button>


            </div>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['order_id', 'user_id'],
        data() {
            return {
                new_status: '',
                date: '',
                time: '',
                comment: ''


            }
        },
        methods: {
            validateForm() {

                if (!this.new_status) {
                    this.$emit('requiredValue', 'Veuillez séléctionner un état  ')
                    return false;
                }
                if (this.new_status != 12) {
                    if (!this.date) {
                        this.$emit('requiredValue', 'Veuillez séléctionner une date de livraison à estimer  ')
                        return false;
                    }
                    if (!this.time) {
                        this.$emit('requiredValue', 'Veuillez séléctionner une heure de livraison à estimer  ')
                        return false;
                    }


                }

                return true;


            },
            submitOrderToDeliver() {
                let validation = this.validateForm();
                console.log(validation)
                if (validation) {

                    axios.post(`/api/order/${this.order_id}/prepare/after`, {
                            new_status: this.new_status,
                            date: this.date,
                            time: this.time,
                            comment: this.comment,
                            user_id:this.user_id
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
                                    title: 'La commande est maintenant en cours de livraison !',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = '/wizefresh/public/orders';
                                    }
                                })
                            } else {
                                swal.fire({
                                    type: 'error',
                                    title: 'Echec!',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'
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
