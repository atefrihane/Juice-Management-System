<template>
    <div class="box box-primary">

        <div class="box-header">
            <h3 class="box-title">Modifier location machine </h3>
            <div class="btn-group breadcrumb1 pull-right">
                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <ul class="dropdown-menu" role="menu" x-placement="bottom-start"
                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 31px, 0px);">


                    <li><a href="">Arrêter location</a></li>

                </ul>
            </div>

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
                            <input class="form-control" readonly value="" id="disabledInput" type="date"
                                v-model="startDate">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Date de fin de location</label>
                            <input class="form-control" id="disabledInput" value="" type="date" v-model="endDate">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Prix location mensuel</label>
                            <input class="form-control" value="" name="designation" type="number" placeholder="Prix"
                                v-model="price">

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

                <div class="row">
                    <div class="col-md-12">
                        <label>Configurations des bacs : </label>
                    </div>
                </div>


                <div style="background-color: #e4e4e4; margin: 16px; padding: 24px" v-for="(bac,index) in bacs">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group d-flex">
                                <label class="col-10">Numero du bac: </label>
                                <input type="text" class="form-control" value="" disabled v-model="bac.order">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group " style="display: flex; flex-direction: column">
                                <label>Etat : </label>
                                <select class="form-control" v-model="bac.status">
                                    <option :value="null" disabled> Séléctionner un etat</option>
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
                                <select class="form-control" @change="getProductData($event,index)"
                                    v-model="bac.product_id"
                                    :disabled="bac.status == 'en panne' || bac.status == 'en sommeil'">

                                    <option :value="bac.product_id" disabled>Selectionner un
                                        produit</option>

                                    <option v-for="product in products[0]" :value="product.id ">{{product.nom}}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group " style="display: flex; flex-direction: column">
                                <label class="col-12">Melange par defaut </label>
                                <select class="form-control" v-model="bac.mixture_id"
                                    :disabled="bac.status == 'en panne' || bac.status == 'en sommeil'">
                                    <option :value="bac.mixture_id" v-if="bac.mixture_id" disabled>Selectionner un mélange
                                    </option>

                                    <option v-for="mixture in bac.mixtures" :value="mixture.id ">{{mixture.name}}
                                    </option>

                                </select>
                            </div>

                        </div>
                    </div>



                </div>

                <div class="row">
                    <div class="container text-center">


                        <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelRental()">
                            Annuler</button>

                        <button type="button" class="btn btn-success pl-1" style="margin: 1em"
                            @click.prevent="submitRental()">
                            Confirmer</button>

                    </div>
                </div>







            </div>

        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getProducts()
        },
        data() {
            return {
                code: data.machine.code,
                designation: data.machine.designation,
                company: data.company.name,
                store: data.store.designation,
                startDate: data.rental.date_debut,
                endDate: '',
                price: data.rental.price,
                location: data.rental.location,
                comment: data.rental.comment,
                bacs: data.bacs,
                rentalId: data.rental.id,
                userId: data.userId,
                products: [],
                errors: []

            }

        },
        methods: {

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
                        Vue.set(this.bacs[index], 'mixtures', '')
                        //Display mixtures of a product ( if has a one)
                        console.log(response);
                        if (response.data.product.length > 0) {
                            Vue.set(this.bacs[index], 'mixtures', response.data.product)
                            // this.bacs[0][index].push(response.data.product);
                            // this.mixtureId = this.bacs[index]['mixtures'][0].id;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    })

            },
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

                    axios.post('api/rental/' + this.rentalId, {
                            endDate: this.endDate,
                            price: this.price,
                            location: this.location,
                            comment: this.comment,
                            bacs: this.bacs,
                            userId:this.userId
                        })
                        .then((response) => {
                            console.log(response);
                            if (response.data.status == 400) {
                                this.errors.push('Erreur date de fin !');
                                window.scrollTo(0, 0);
                               return false;
                            }

                              if (response.data.status == 200) {
                                swal.fire({
                                    type: 'success',
                                    title: 'La location a été modifiée avec succés !',
                                    showConfirmButton: true,
                               

                                });
                                setTimeout(() => window.location = '/wizefresh/public/machines', 2000);
                            }

                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                }


            },
               cancelRental() {
                window.location = '/wizefresh/public/machines';

            }
        }
    }

</script>
