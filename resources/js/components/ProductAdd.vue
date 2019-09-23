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
                            <option>disponible</option>
                            <option>indisponible</option>
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
                <label for="exampleInputEmail1">Prix publique</label>
                <input class="form-control" id="disabledInput" type="number" step="0.01" placeholder="Prix publique"
                    v-model="publicPrice">
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

            <div class="form-group">
                <label for="exampleInputFile">Possibilités de melange :</label>
            </div>
            <div class="box" style="border:1px solid rgb(228, 228, 228);background:rgb(228, 228, 228);"
                v-for="(mixture,index) in mixtures">
                <div class="box-body">
                    <a href="" class="pull-right btn btn-default" v-if="index>0"
                        @click.prevent="deleteMixture(mixture)"><i class="fa fa-minus"></i></a>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom du mélange</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="Nom du mélange"
                                    v-model="mixture.mixtureName">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantité de produit fini(en litre)</label>
                                <input class="form-control" id="disabledInput" type="number" step="0.01"
                                    placeholder="Quantité de produit fini.." v-model="mixture.endQuantityProduct">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Poids necessaire du produit (en kg)</label>
                                <input class="form-control" id="disabledInput" type="number" placeholder="Poids.."
                                    step="0.01" v-model="mixture.necessaryWeight">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantité d'eau (en litre)</label>
                                <input class="form-control" id="disabledInput" type="number" step="0.01"
                                    placeholder="Quantité eau..." v-model="mixture.waterQuantity">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantité de sucre (en kg)</label>
                                <input class="form-control" id="disabledInput" type="number" step="0.01"
                                    placeholder="Quantité sucre..." v-model="mixture.sugarQuantity">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Volume de verre (en cl)</label>
                                <input class="form-control" id="disabledInput" type="number" step="0.01"
                                    placeholder="Volume de verre..." v-model="mixture.glassVolume">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de verre obtenu </label>
                                <input class="form-control" id="disabledInput" type="number"
                                    placeholder="Nombre de verre.." v-model="mixture.glassNumber">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- box-footer -->
            </div>

            <button type="button" class="btn btn-default" @click="btnClick()"><i class="fa fa-plus"></i></button>

            <div class="box-body">
                <div class="row">
                    <div class="container text-center">

                        <button href="" class="btn btn-danger pl-1">Annuler</button>
                        <button class="btn btn-success pl-1" type="button"
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
                state: 'disponible',
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
                productId: product.productId,
                error: 0,

                mixtures: [{
                    endQuantityProduct: '',
                    necessaryWeight: '',
                    waterQuantity: '',
                    sugarQuantity: '',
                    glassVolume: '',
                    glassNumber: ''
                }],
                errors: []
            }
        },
        mounted() {

        },
        methods: {

            btnClick() {
                this.mixtures.push({
                    mixtureName: '',
                    endQuantityProduct: '',
                    necessaryWeight: '',
                    waterQuantity: '',
                    sugarQuantity: '',
                    glassVolume: '',
                    glassNumber: ''
                });


            },
            deleteMixture: function (mixture) {
                this.mixtures.splice(this.mixtures.indexOf(mixture), 1);
            },
            uploadImage(event) {

                this.photo = event.target.files[0];

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
                            comment: this.comment,
                            productId: this.productId,
                            mixtures: this.mixtures,
                            photo: this.photo

                        })
                        .then(function (response) {
                            if (response.data.status == 200) {
                                swal.fire({
                                    type: 'success',
                                    title: 'Le produit a été ajouté avec succés !',
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
                    this.errors.push('Le champs prix publique  est  requis.');
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

                this.mixtures.forEach((mixture) => {

                    if (!mixture.mixtureName) {
                        this.errors.push('Le champs nom du mélange est  requis.');
                        window.scrollTo(0, 0);
                        return false;
                    }
                    if (!mixture.endQuantityProduct) {
                        this.errors.push('Le champs quantité de produit fini(en litre)  est  requis.');
                        window.scrollTo(0, 0);
                        return false;
                    }

                    if (!mixture.necessaryWeight) {
                        this.errors.push('Le champs poids necessaire du produit (en kg) est  requis.');
                        window.scrollTo(0, 0);
                        return false;
                    }

                    if (!mixture.waterQuantity) {
                        this.errors.push('Le champs quantité eau (en litre) est  requis.');
                        window.scrollTo(0, 0);
                        return false;
                    }


                    if (!mixture.sugarQuantity) {
                        this.errors.push('Le champs quantité de sucre (en kg) est  requis.');
                        window.scrollTo(0, 0);
                        return false;
                    }

                    if (!mixture.glassVolume) {
                        this.errors.push('Le champs volume de verre (en cl) est  requis.');
                        window.scrollTo(0, 0);
                        return false;
                    }


                    if (!mixture.glassNumber) {
                        this.errors.push('Le champs nombre de verre obtenu est  requis.');
                        window.scrollTo(0, 0);
                        return false;
                    }

                });




            }


        }
    }

</script>
