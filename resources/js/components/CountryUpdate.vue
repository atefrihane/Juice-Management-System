<template>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Modifier un pays </h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="alert alert-danger" v-if="errors.length>0">
                <ul>

                    <li v-for="error in errors">{{error}}</li>

                </ul>
            </div>



            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nom pays</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Nom pays" v-model="name">

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Code téléphonique</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Code téléphonique"
                        min="0" v-model="code">
                </div>


            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th>Villes</th>
                        <th>Codes Postaux</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="city in citiesZipCodes" v-if="citiesZipCodes">
                        <td>
                            <input type="text" class="form-control" placeholder="Ville" v-model="city.cityName"
                                style="height:42px;">
                        </td>
                        <td style="width:60%;">
                            <div class="box box-info">

                                <input-tag placeholder="Ajouter un code postal" v-model="city.zipCodes">
                                </input-tag>

                            </div>
                        </td>
                        <td>

                            <button type="button" class="btn btn-default" style="margin-top:4px;"
                                @click="removeCity(city)"><i class="fa fa-minus"></i></button>
                        </td>
                    </tr>


                </tbody>
            </table>

            <button type="button" class="btn btn-default" @click="loadCity()"><i class="fa fa-plus"></i></button>

        </div>

        <div class="row">
            <div class="container text-center">


                <button type="button" class="btn btn-danger pl-1" style="margin: 1em" @click="cancelRental()">
                    Annuler</button>

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" @click="submitRental()">
                    Confirmer</button>

            </div>
        </div>
        <!-- /.box-body -->
    </div>
</template>

<script>
    import InputTag from 'vue-input-tag'

    export default {
        components: {
            'input-tag': InputTag
        },
        mounted() {
            this.arrengeZipcodes()

        },
        data() {
            return {
                id: data.country.id,
                name: data.country.name,
                code: data.country.code,
                cities: data.zipcodes,
                errors: [],
                citiesZipCodes: [],
                deleted: [],

            }


        },
        methods: {
            loadCity() {

                this.citiesZipCodes.push({
                    cityID: '',
                    cityName: '',
                    zipCodes: []
                })
            },
            arrengeZipcodes() {
                if (this.cities) {

                    this.cities.map((city, i) => {
                        this.citiesZipCodes.push({
                            cityID: city.id,
                            cityName: city.name,
                            zipCodes: []
                        })

                        if (city.zipcodes) {
                            city.zipcodes.map(zipcode => {
                                this.citiesZipCodes[i].zipCodes.push(zipcode.code)
                            })
                        }
                    })

                }


            },

            removeCity(city) {
               this.deleted.push(city.cityID)
                this.citiesZipCodes.splice(this.citiesZipCodes.indexOf(city), 1);

            },
            validateForm() {

                this.errors = [];
                var x = true;

                if (!this.name) {
                    this.errors.push('Le nom du pays est requis');
                    window.scrollTo(0, 0);
                    x = false;
                }


                if (!this.code) {
                    this.errors.push(' Le code du pays est requis');
                    window.scrollTo(0, 0);
                    x = false;
                }

                this.cities.forEach((city, index) => {

                    if (!city.name && city.zipcodes.length > 0) {
                        this.errors.push('Veuillez sélectionner un nom pour la ville  ' + (index + 1));
                        window.scrollTo(0, 0);
                        x = false;
                    }



                });




                return x;

            },
            submitRental() {
                if (this.validateForm()) {

                    axios.post('/country/update/' + this.id, {
                            name: this.name,
                            code: this.code,
                            cities: this.citiesZipCodes,
                            deleted:this.deleted
                        })
                        .then((response) => {
                            console.log(response);
                            if (response.data.status == 401) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Nom déja existant! ',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Fermer'

                                });

                            }

                            if (response.data.status == 402) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Code déja existant! ',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Fermer'

                                });

                            }

                            if (response.data.status == 403) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Ville déja existante! ',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Fermer'

                                });

                            }

                               if (response.data.status == 403) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Pays introuvable! ',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Fermer'

                                });

                            }

                            if (response.data.status == 200) {
                                swal.fire({
                                    type: 'success',
                                    title: 'Pays modifié avec succés ! ',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Fermer'

                                });

                                setTimeout(() => window.location = '/wizefresh/public/static', 2000);

                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });

                }

            }


        }
    }

</script>
