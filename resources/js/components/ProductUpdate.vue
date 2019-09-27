<template>
    <div class="box box-primary">

        <div class="box-header">
            <h3 class="box-title"> Modifier un produit</h3>

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
                        <label for="exampleInputEmail1">ID</label>
                        <input class="form-control" id="disabledInput" type="text" v-model="this.productId" disabled>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Code </label>
                        <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                            v-model="code">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Etat</label>
                        <select class="form-control" v-model="state">
                            <option>Disponible</option>
                            <option>Non disponible</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Nom Produit</label>
                <input class="form-control" id="disabledInput" type="text" placeholder="Nom Produit" v-model="name">

            </div>



            <div class="form-group">
                <label for="exampleInputEmail1">Type de Produit</label>
                <select class="form-control" v-model="type" @change="getProductData($event)">
                    <option value="alimentaire">Alimentaire</option>
                    <option value="jettable">Jettable</option>
                    <option value="autre">Autre</option>

                </select>


            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Version de Produit</label>
                <input class="form-control" id="disabledInput" type="text" placeholder="Version.." v-model="version">

            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Code à barre</label>
                <input class="form-control" id="disabledInput" type="text" placeholder="Code à barre" v-model="barcode">

            </div>



            <div class="form-group">
                <label for="exampleInputEmail1">Désignation</label>
                <input class="form-control" id="disabledInput" type="text" placeholder="Désignation"
                    v-model="designation">

            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Composition</label>
                <input class="form-control" id="disabledInput" type="text" placeholder="Composition"
                    v-model="composition">

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Couleur du produit</label>
                        <input class="form-control" id="disabledInput" type="color" value="#ff0000" v-model="color">

                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Poids (en kg)</label>

                <input class="form-control" id="disabledInput" type="number" step="0.01" placeholder="Poids"
                    v-model="weight">


            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hauteur(cm)</label>
                        <input class="form-control" id="disabledInput" type="number" step="0.01" placeholder="hauteur"
                            v-model="height">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Largeur(cm)</label>
                        <input class="form-control" id="disabledInput" type="number" step="0.01" placeholder="Largeur"
                            v-model="width">
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Profondeur(cm)</label>
                        <input class="form-control" id="disabledInput" type="number" step="0.01"
                            placeholder="Profondeur" v-model="depth">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Prix unitaire de vente </label>
                <input class="form-control" id="disabledInput" type="number" step="0.01"
                    placeholder="Prix unitaire de vente " v-model="publicPrice">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Durée de validité de produit fermé ( en jours)</label>
                <input class="form-control" id="disabledInput" type="number"
                    placeholder="Durée de validité de produit fermé" v-model="validityClosed">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Durée de validité aprés ouverture ( en heures)</label>
                <input class="form-control" id="disabledInput" type="number"
                    placeholder="Duree de validité apres ouverture" v-model="validityOpened">
            </div>

            <div class="form-group">
                <label>Commentaires (optionnel)</label>
                <textarea class="form-control" rows="3" placeholder="Commentaires" v-model="comment"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputFile">Photo du produit (optionnel)</label>
                <input type="file" id="exampleInputFile" @change="uploadImage($event)">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre d'unitée par display</label>
                <input class="form-control" id="disabledInput" type="number" placeholder="Nombre d'unitée par display"
                    v-model="unityPerDisplay">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre de display par colis</label>
                <input class="form-control" id="disabledInput" type="number" placeholder="Nombre de display par colis"
                    v-model="unityPerPack">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Colisage</label>
                <input class="form-control" id="disabledInput" type="number" placeholder="Colisage" v-model="packing">
            </div>

            <div class="form-group" v-if="type != 'jettable' && mixtures.length > 0">
                <label for="exampleInputFile">Possibilités de melange :</label>
            </div>
            <div class="box" style="border:1px solid rgb(228, 228, 228);background:rgb(228, 228, 228);"
                v-for="(mixture,index) in mixtures" v-if="type != 'jettable' && mixtures.length > 0">
                <div class="box-body">
                    <a href="" class="pull-right btn btn-default" v-if="index>0"
                        @click.prevent="deleteMixture(mixture)"><i class="fa fa-minus"></i></a>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom du mélange</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="Nom du mélange"
                                    v-model="mixture.name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantité de produit fini(en litre)</label>
                                <input class="form-control" id="disabledInput" type="number" step="0.01"
                                    placeholder="Quantité de produit fini.." v-model="mixture.final_amount">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Poids necessaire du produit (en kg)</label>
                                <input class="form-control" id="disabledInput" type="number" placeholder="Poids.."
                                    step="0.01" v-model="mixture.needed_weight">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantité d'eau (en litre)</label>
                                <input class="form-control" id="disabledInput" type="number" step="0.01"
                                    placeholder="Quantité eau..." v-model="mixture.water_amount">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantité de sucre (en kg)</label>
                                <input class="form-control" id="disabledInput" type="number" step="0.01"
                                    placeholder="Quantité sucre..." v-model="mixture.sugar_amount">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Volume de verre (en cl)</label>
                                <input class="form-control" id="disabledInput" type="number" step="0.01"
                                    placeholder="Volume de verre..." v-model="mixture.glass_size">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de verre obtenu </label>
                                <input class="form-control" id="disabledInput" type="number"
                                    placeholder="Nombre de verre.." v-model="mixture.number_of_glasses">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- box-footer -->
            </div>

            <button type="button" class="btn btn-default" @click="btnClick()"
                v-if="type != 'jettable' && mixtures.length > 0"><i class="fa fa-plus"></i></button>

            <div class="box-body">
                <div class="row">
                    <div class="container text-center">

                            <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelRental()">
                    Annuler</button>
                        <button class="btn btn-success pl-1" type="button" @click="submitProduct()">Confirmer</button>

                    </div>
                </div>
            </div>







        </div>

        </form>
    </div>


</template>

<script>
    export default {

        mounted() {
            this.fetchProduct();
        },

        data() {

            return {
                code: data.product.code,
                state: 'Disponible',
                name: data.product.nom,
                version: data.product.version,
                type: data.product.type,
                barcode: data.product.barcode,
                designation: data.product.designation,
                composition: data.product.composition,
                color: data.product.color,
                weight: data.product.weight,
                height: data.product.height,
                width: data.product.width,
                depth: data.product.depth,
                publicPrice: data.product.public_price,
                validityClosed: data.product.period_of_validity,
                validityOpened: data.product.validity_after_opening,
                photo: data.product.photo_url,
                unityPerDisplay: data.product.unit_by_display,
                unityPerPack: data.product.unit_per_package,
                packing: data.product.packing,
                comment: data.product.comment,
                productId: data.product.id,
                error: 0,
                mixtures: [],
                errors: []
            }
        },

        methods: {

            btnClick() {
                this.mixtures.push({
                    name: '',
                    final_amount: '',
                    needed_weight: '',
                    water_amount: '',
                    sugar_amount: '',
                    glass_size: '',
                    number_of_glasses: ''
                });


            },
            deleteMixture: function (mixture) {
                this.mixtures.splice(this.mixtures.indexOf(mixture), 1);
            },
            uploadImage(event) {

                this.photo = event.target.files[0];

            },
            getProductData(event) {
                let value = event.target.value;
                if (value == 'jettable') {
                    this.mixtures = [];
                } else {
                    if (this.mixtures.length == 0) {
                       this.fetchProduct();
                    }
                    return;


                }
            },
               cancelRental()
            {
        window.location = '/wizefresh/public/products';

            },
            fetchProduct() {
                axios.get('api/product/'+this.productId)
                    .then((response) => {
                        // handle success
                        if (response.data.product.length > 0)
                        {
                            this.mixtures=response.data.product;
                         }
                         else {

                             this.mixtures.push({
                            name:'',
                            final_amount:'',
                            needed_weight:'',
                            water_amount:'',
                            sugar_amount:'',
                            glass_size:'',
                            number_of_glasses:'',
                            product_id :''

                             });
                         }
                  
                        
                    })
                    .catch((error) => {
                        // handle error
                        console.log(error);
                    })
                  
            },

            submitProduct() {
                var form = this.validateForm(); // input front end validation returns false if error


                if (form != false) {
                    if (this.photo) {
                        let formData = new FormData();
                        formData.append('photo', this.photo);
                        axios.post('/api/image', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                            .then((response) => {

                                if (response.data.status == 200) {
                                    this.photo = response.data.path;

                                }

                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    }




                    axios.post('api/product/update/'+this.productId, {

                            code: this.code,
                            state: this.state,
                            name: this.name,
                            version: this.version,
                            type: this.type,
                            barcode: this.barcode,
                            designation: this.designation,
                            composition: this.composition,
                            color: this.color,
                            weight: this.weight,
                            height: this.height,
                            width: this.width,
                            depth: this.depth,
                            publicPrice: this.publicPrice,
                            validityClosed: this.validityClosed,
                            validityOpened: this.validityOpened,
                            photo: this.photo,
                            unityPerDisplay: this.unityPerDisplay,
                            unityPerPack: this.unityPerPack,
                            packing: this.packing,
                            comment: this.comment,
                            productId: this.productId,
                            mixtures: this.mixtures,
                            photo: this.photo

                        })
                        .then(function (response) {
                            console.log(response);
                            if (response.data.status == 200) {
                                swal.fire({
                                    type: 'success',
                                    title: 'Le produit a été modifié avec succés !',
                                    showConfirmButton: false,
                                    timer: 1500

                                });
                                setTimeout(() => window.location = '/wizefresh/public/products', 2000);


                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });




                }



            },

            validateForm() {

                this.errors = [];
             
                if (!this.code) {
                    this.errors.push('Le champs code est requis.');
                    window.scrollTo(0, 0);
                    return false;
                }


                if (!this.state) {
                    this.errors.push(' le champs etat est requis.');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.name) {
                    this.errors.push('le champs nom produit est requis.');
                    window.scrollTo(0, 0);
                    return false;
                }


                if (!this.type) {
                    this.errors.push('le champs type est requis.');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.version) {
                    this.errors.push('le champs version est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }


                if (!this.barcode) {
                    this.errors.push('les champs code à barres est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }


                if (!this.designation) {
                    this.errors.push('Le champs designation est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }
                if (!this.composition) {
                    this.errors.push('Le champs composition est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.color) {
                    this.errors.push('Le champs couleur est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.weight) {
                    this.errors.push('Le champs poids est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.height) {
                    this.errors.push('Le champs hauteur est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.width) {
                    this.errors.push('Le champs largeur est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.depth) {
                    this.errors.push('Le champs hauteur est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.publicPrice) {
                    this.errors.push('Le champs prix unitaire de vente  est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.validityClosed) {
                    this.errors.push('Le champs durée de validité de produit fermé  est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.validityOpened) {
                    this.errors.push('Le champs durée de validité aprés ouverture est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.unityPerDisplay) {
                    this.errors.push('Le Nombre d"unitée par display est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }


                if (!this.unityPerPack) {
                    this.errors.push('Le champs nombre de display par colis est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }


                if (!this.packing) {
                    this.errors.push('Le champs colisage est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }
                if (this.type != 'jettable') {
                        var x=true;
                    this.mixtures.forEach((mixture) => {

                        if (!mixture.name) {
                            this.errors.push('Le champs nom du mélange est  requis.');
                            window.scrollTo(0, 0);
                           x=false;
                        }
                        if (!mixture.final_amount) {
                            this.errors.push('Le champs quantité de produit fini(en litre)  est  requis.');
                            window.scrollTo(0, 0);
                           x=false;
                        }

                        if (!mixture.needed_weight) {
                            this.errors.push('Le champs poids necessaire du produit (en kg) est  requis.');
                            window.scrollTo(0, 0);
                            x=false;
                        }

                        if (!mixture.water_amount) {
                            this.errors.push('Le champs quantité eau (en litre) est  requis.');
                            window.scrollTo(0, 0);
                             x=false;
                        }


                        if (!mixture.sugar_amount) {
                            this.errors.push('Le champs quantité de sucre (en kg) est  requis.');
                            window.scrollTo(0, 0);
                            x=false;
                        }

                        if (!mixture.glass_size) {
                            this.errors.push('Le champs volume de verre (en cl) est  requis.');
                            window.scrollTo(0, 0);
                             x=false;
                        }


                        if (!mixture.number_of_glasses) {
                            this.errors.push('Le champs nombre de verre obtenu est  requis.');
                            window.scrollTo(0, 0);
                             x=false;
                        }


                    });
                    return x;

                }





            }


        }
    }

</script>
