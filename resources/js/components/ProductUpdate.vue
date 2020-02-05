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
                            <option value="disponible">Disponible</option>
                            <option value="non disponible">Non disponible</option>
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
                <input class="form-control" id="disabledInput" type="text" placeholder="Nom Produit" v-model="type"
                    disabled>


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
                <div class="row">
                    <div class="container">

                        <img :src="url" alt="" class="img-thumbnail" style="width:100px;" v-if="url">
                    </div>
                </div>

                <input type="file" id="exampleInputFile" @change="uploadImage($event)" style="margin-top:20px;">
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
                <label for="exampleInputEmail1">TVA</label>
                <input class="form-control" id="disabledInput" type="number" placeholder="Colisage" v-model="tva">
            </div>



            <div class="box-body">
                <div class="row">
                    <div class="container text-center">

                        <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelRental()">
                            Annuler</button>
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

        mounted() {

        },

        data() {

            return {
                code: data.product.code,
                state: data.product.status,
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
                tva: data.product.tva,
                comment: data.product.comment,
                productId: data.product.id,
                error: 0,
                errors: [],
                userId: this.user_id,
                disabled: false,
                acceptedImage:true
            }
        },
        props: ['user_id'],
        computed: {
            url() {
                var isBase64 = require('is-base64');
              

                if (this.photo && (!isBase64(this.photo, {allowMime: true})) ) {
                    return axios.defaults.baseURL + '/img/' + this.photo
                }
                else{
                    return this.photo
                }

            }
        },

        methods: {


           uploadImage(event) {

                let file = event.target.files[0];
                if (file.type == 'image/jpeg' || file.type == 'image/jpg' || file.type == 'image/png') {
                    let reader = new FileReader();
                    let limit = 1024 * 1024 * 2;
                    if (file['size'] > limit) {
                      
                        this.acceptedImage=false
         

                    } else {
                        this.acceptedImage=true
                        this.errors = []
                        reader.onloadend = (file) => {
                            this.photo = reader.result;
                        }
                        reader.readAsDataURL(file);

                    }

                } else {
                      this.acceptedImage=false

                }


            },


            cancelRental() {
                window.location = axios.defaults.baseURL + '/products';

            },


            submitProduct() {
                var validation = this.validateForm(); // input front end validation returns false if error


                if (validation  && this.acceptedImage) {
                    this.disabled = true
                    this.$Progress.start()
                    axios.post('/api/product/update/' + this.productId, {

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
                            photo: this.photo,
                            userId: this.userId,
                            acceptedImage:true

                        })
                        .then((response) => {
                            this.$Progress.finish()

                            if (response.data.status == 200) {

                                swal.fire({
                                    title: 'Le produit a été modifié avec succés !',
                                    type: 'success',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Fermer',
                                    allowOutsideClick: false,
                                    allowOutsideClick: false,
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = axios.defaults.baseURL + '/products';
                                    }
                                })
                            }

                            if (response.data.status == 400) {

                                swal.fire({
                                    title: 'Code déja existant !',
                                    type: 'error',
                                    allowOutsideClick: false,
                                    showConfirmButton: true,
                                    confirmButtonText: 'Fermer'
                                });
                                       this.disabled = false
                            }
                        })
                        .catch((error) => {
                            this.$Progress.fail()
                             if (error.response.status == 422){
                                   this.errors=[]
                                    let errors = Object.values(error.response.data.errors);
                                    errors = errors.flat();
                                    this.errors=errors;
                                 
                                   this.disabled = false
                                    window.scrollTo(0, 0);
                             }
                        });

                }
                else{

                this.errors=[]    
                this.errors.push('Les formats supportés pour l\'importation de la photo sont : PNG,JPEG,JPG avec taille maximale 2M');
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

                if (!this.tva) {
                    this.errors.push('Le champs TVA est  requis.');
                    window.scrollTo(0, 0);
                    return false;
                }
                if (this.errors.length > 0) {
                    return false;

                }

                return true;




            }


        }
    }

</script>
