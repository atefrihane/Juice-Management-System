<template>
    <div>
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nouveau état</label>
                    <select class="form-control" v-model="new_status">
                        <option value="" disabled> Séléctionner un état</option>
                        <option value="10">A envoyer en comptabilité</option>
              
                    </select>

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
              
                comment: ''


            }
        },
        methods: {
            validateForm() {

                if (!this.new_status) {
                    this.$emit('requiredValue', 'Veuillez séléctionner un état  ')
                    return false;
                }
              

                return true;


            },
            submitOrderToDeliver() {
                let validation = this.validateForm();
                console.log(validation)
                if (validation) {

                    axios.post(`/api/order/${this.order_id}/prepare/after`, {
                            new_status: this.new_status,
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
                                    title: 'La commande a été envoyée en comptabilité !',
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
