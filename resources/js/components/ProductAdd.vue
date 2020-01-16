<template>
    <div class="box box-primary">

        <div class="box-header">
            <h3 class="box-title"> Ajouter un produit</h3>

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
                        <label for="exampleInputEmail1">Code </label>
                        <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                            v-model="code">
                    </div>
                </div>
                <div class="col-md-6">
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
                <select class="form-control" v-model="type">
                    <option selected>Alimentaire</option>
                    <option>Jettable</option>
                    <option>Autre</option>

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
                    v-model="designation" @change="getCode($event)">

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
                <div class="row">
                    <div class="container">

                        <img :src="url" alt="" class="img-thumbnail" style="width:100px;" v-if="url">
                    </div>
                </div>
                <input type="file" id="exampleInputFile" @change="uploadImage($event)">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre d'unités par display</label>
                <input class="form-control" id="disabledInput" type="number" placeholder="Nombre d'unités par display"
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
            <div class="form-group">
                <label for="exampleInputEmail1">TVA (%)</label>
                <input class="form-control" id="disabledInput" type="number" placeholder="TVA" v-model="tva">
            </div>





            <div class="box-body">
                <div class="row">
                    <div class="container text-center">

                        <button href="" class="btn btn-danger pl-1" @click="cancelProduct()">Annuler</button>
                        <button class="btn btn-success pl-1" type="button" :disabled="disabled"
                            @click="submitProduct()">Confirmer</button>

                    </div>
                </div>
            </div>
        </div>

        </form>
    </div>


</template>

<script>
    export default {

        data() {

            return {
                code: '',
                state: 'Disponible',
                name: '',
                version: '',
                type: 'Alimentaire',
                barcode: '',
                designation: '',
                composition: '',
                color: '#ff0000',
                weight: '',
                height: '',
                width: '',
                depth: '',
                publicPrice: '',
                validityClosed: '',
                validityOpened: '',
                photo: '',
                unityPerDisplay: '',
                unityPerPack: '',
                packing: '',
                comment: '',
                tva: '',
                productId: product.productId,
                error: 0,
                userId: this.user_id,
                errors: [],
                disabled: false,
                acceptedImage:true
            }
        },
        props: ['user_id'],
        computed: {
            url() {
                var isBase64 = require('is-base64');


                if (this.photo && (!isBase64(this.photo, {
                        allowMime: true
                    }))) {
                    return axios.defaults.baseURL + '/img/' + this.photo
                } else {
                    return this.photo
                }

            }
        },
        mounted() {
            this.$Progress.finish()

        },
        methods: {
            getCode(event) {
                let value = event.target.value;
                let str = value.replace(/\s+/g, '');
                let res = str.substr(0, 6).toUpperCase();
                this.code = res;

            },


            uploadImage(event) {

                let file = event.target.files[0];
                if (file.type == 'image/jpeg' || file.type == 'image/jpg' || file.type == 'image/png') {
                    let reader = new FileReader();
                    let limit = 1024 * 1024 * 2;
                    if (file['size'] > limit) {
                      
                        this.acceptedImage=false
                             this.errors=[]    
                this.errors.push('La photo importée est volumineuse');
                    window.scrollTo(0, 0);

                    } else {
                        this.acceptedImage=true
                        this.errors = []
                        reader.onloadend = (file) => {
                            this.photo = reader.result;
                        }
                        reader.readAsDataURL(file);

                    }

                } else {
                    this.errors = []
                    this.errors.push('Les formats supportés pour l\'importation du logo sont : PNG,JPEG,JPG');
                    window.scrollTo(0, 0);
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
                    x = false;
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
                if (!this.tva) {
                    this.errors.push('Le champs TVA  est  requis.');
                    window.scrollTo(0, 0);
                    return false;

                }

               
                return true;







            },

            submitProduct() {
            
            let validation=this.validateForm()
                if (validation && this.acceptedImage) {
                    this.disabled = true
                    this.$Progress.start()
                    axios.post('/api/products', {

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
                            tva: this.tva,
                            comment: this.comment,
                            productId: this.productId,
                            userId: this.userId


                        })
                        .then((response) => {
                            if (response.data.status == 400) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Code déja utilisé  !',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'


                                });

                                this.disabled = false



                            }
                            if (response.data.status == 200) {

                                swal.fire({
                                    type: 'success',
                                    title: 'Le produit a été ajouté avec succés !',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = axios.defaults.baseURL + '/products';
                                    }
                                })



                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    this.$Progress.finish()

                }
                else{
                this.errors=[]    
                this.errors.push('La photo importée est volumineuse');
                    window.scrollTo(0, 0);
                }



            },


            cancelProduct() {
                window.location = axios.defaults.baseURL + '/products';

            }


        }
    }

</script>
