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
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Code téléphonique"
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
                    <tr v-for="(city,i) in citiesZipCodes" v-if="citiesZipCodes">
                        <td>
                            <input type="text" class="form-control" placeholder="Ville" v-model="city.cityName"
                                @change="checkCountry(city)">
                        </td>
                        <td style="width:60%;">

                            <input type="text" class="form-control" placeholder="Ajouter un code postal"
                                v-model="city.zipcode" @keyup.enter='send(city)'>

                            <div style="margin-top:20px;">

                                <div class="btn-group" v-for="(zipcode,j) in city.zipCodes" style="padding:10px;">
                                    <button type="button" class="btn btn-info"
                                        @click="updateCode(i,j,city,zipcode)">{{zipcode.code}}</button>
                                    <button type="button" class="btn btn-info" @click="removeZipcode(zipcode,i,j)">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

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
    export default {

        mounted() {
            this.$Progress.start()
            this.arrengeZipcodes()
            this.$Progress.finish()

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
                                this.citiesZipCodes[i].zipCodes.push({
                                    'id': zipcode.id,
                                    'code': zipcode.code
                                })

                            })
                        }
                    })

                }



            },

            removeCity(city) {

                if (city.cityID != "") {

                    axios.get('/city/companies/' + city.cityID)
                        .then((response) => {
                            console.log(response)
                            // handle success


                            if (response.data.countCompanies == 0 &&
                             response.data.countStores == 0 &&
                             response.data.countWarehouses == 0) {
                                axios.post('/city/delete/' + city.cityID, {

                                    })
                                    .then((response) => {
                                        if (response.data.status == 200) {
                                            this.citiesZipCodes.splice(this.citiesZipCodes
                                                .indexOf(city), 1);
                                        } else {
                                            swal.fire({
                                                type: 'error',
                                                title: 'Echec! ',
                                                showConfirmButton: true,
                                                confirmButtonText: 'Fermer',
                                                allowOutsideClick: false,
                                            });
                                        }
                                    })
                                    .catch((error) => {
                                        console.log(error);
                                    });

                            } else {
                                swal.fire({
                                    type: 'error',
                                    title: 'Oups !',
                                    html: "La ville  est déja affectée à : <br><br>  <b>" +
                                        response.data.countCompanies +
                                        " </b> Societés <br>" +
                                        "  <b>" + response.data.countStores +
                                        " </b> magasin(s) <br>" +
                                        "   <b>" + response.data.countWarehouses +
                                        " </b> entrepôts <br>",
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'
                                });


                            }
                        })
                        .catch((error) => {
                            // handle error
                            console.log(error);
                        })
                    } else {
                    this.citiesZipCodes.splice(this.citiesZipCodes.indexOf(city), 1);

                }




            },
            removeZipcode(zipcode, i, j) {
                console.log(zipcode)
                if (zipcode.id) {
                    axios.get('/zipcode/' + zipcode.id)
                        .then((response) => {
                            // handle success
                            console.log(response);

                            if (response.data.status == 200) {
                                if (response.data.countCompanies == 0 &&
                                 response.data.countStores == 0 &&
                                  response.data.countWarehouses == 0) {
                                    axios.post('/zipcode/delete/' + zipcode.id, {

                                        })
                                        .then((response) => {
                                            console.log(response)

                                            if (response.data.status == 200) {
                                                this.citiesZipCodes[i].zipCodes.splice(this
                                                    .citiesZipCodes[i]
                                                    .zipCodes
                                                    .indexOf(zipcode), 1);
                                            } else {
                                                swal.fire({
                                                    type: 'error',
                                                    title: 'Echec! ',
                                                    showConfirmButton: true,
                                                    confirmButtonText: 'Fermer',
                                                    allowOutsideClick: false,
                                                });
                                            }
                                        })
                                        .catch((error) => {
                                            console.log(error);
                                        });

                                } else {
                                    swal.fire({
                                        type: 'error',
                                        title: 'Oups !',
                                        html: "Ce code postal est déja affectée à : <br><br>  <b>" +
                                            response.data.countCompanies +
                                            " </b> Societés <br>" +
                                            "  <b>" + response.data.countStores +
                                            " </b> magasins <br>" +
                                            "   <b>" + response.data.countWarehouses +
                                            " </b> entrepôts <br>",
                                        showConfirmButton: true,
                                        allowOutsideClick: false,
                                        confirmButtonText: 'Fermer'
                                    });


                                }

                            }

                        })
                        .catch((error) => {

                            console.log(error);
                        })

                } else {
                    this.citiesZipCodes[i].zipCodes.splice(this.citiesZipCodes[i].zipCodes.indexOf(zipcode), 1);

                }

            },
            updateCode(i, j, city, zipcode) {

                (async () => {
                    const {
                        value: code
                    } = await swal.fire({
                        input: 'text',
                        inputPlaceholder: 'Modifier le code postal',
                        showConfirmButton: true,
                        confirmButtonText: 'Confirmer',
                        showCancelButton: true,
                        cancelButtonText: 'Fermer',

                    })
                    if (code == undefined) {

                        return;
                    }

                    if (code != '') {
                        let found = false;
                        city.zipCodes.forEach((zipcode) => {
                            if (zipcode.code == code) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Code postal déja renseigné !  ',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'

                                });
                                city.zipcode = ''
                                found = true;
                            }

                        });
                        if (!found) {

                            axios.post('/zipcode/update/' + zipcode.id, {
                                    'code': code
                                })
                                .then((response) => {
                                    console.log(response);
                                    if (response.data.status == 200) {
                                        this.$set(this.citiesZipCodes[i].zipCodes[j], 'code', code);

                                    } else {
                                        swal.fire({
                                            type: 'error',
                                            title: 'Echec !  ',
                                            showConfirmButton: true,
                                            allowOutsideClick: false,
                                            confirmButtonText: 'Fermer'

                                        });


                                    }
                                })
                                .catch((error) => {
                                    console.log(error);
                                });

                            // 

                        }


                    } else {
                        swal.fire({
                            type: 'error',
                            title: 'Veuillez entrer une valeur non vide!  ',
                            showConfirmButton: true,
                            allowOutsideClick: false,
                            confirmButtonText: 'Fermer'

                        });

                    }
                })();



            },

            send(city) {

                if (city.zipcode != '') {
                    let found = false;
                    city.zipCodes.forEach((zipcode, index) => {

                        if (city.zipcode == zipcode.code) {
                            swal.fire({
                                type: 'error',
                                title: 'Code postal déja renseigné !  ',
                                showConfirmButton: true,
                                allowOutsideClick: false,
                                confirmButtonText: 'Fermer'

                            });
                            city.zipcode = ''
                            found = true;
                        }

                    });
                    if (!found) {
                        city.zipCodes.push({
                                'id': '',
                                'code': city.zipcode
                            }

                        )
                        city.zipcode = ''

                    }


                } else {
                    swal.fire({
                        type: 'error',
                        title: 'Veuillez entrer un code postal ',
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        confirmButtonText: 'Fermer'

                    });
                }


            },
            checkCountry(city) {
                if (city.cityName != '') {
                    let count = 0;
                    this.citiesZipCodes.forEach((cityZipcode, index) => {
                        let formatedOldCity = cityZipcode.cityName.replace(/[\s\/]/g, '').toLowerCase();
                        let formatedNewCity = city.cityName.replace(/[\s\/]/g, '').toLowerCase();
                        if (formatedOldCity == formatedNewCity) {

                            count++;
                        }

                    });
                    if (count > 1) {
                        swal.fire({
                            type: 'error',
                            title: 'Nom de la ville déja existant !  ',
                            showConfirmButton: true,
                            allowOutsideClick: false,
                            confirmButtonText: 'Fermer'

                        });
                        city.cityName = ''
                    }

                }



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

                        })
                        .then((response) => {
                            console.log(response);
                            if (response.data.status == 401) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Nom déja existant! ',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'

                                });

                            }

                            if (response.data.status == 402) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Code déja existant! ',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'

                                });

                            }

                            if (response.data.status == 403) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Ville déja existante! ',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'

                                });

                            }

                         

                            if (response.data.status == 200) {
                                swal.fire({
                                    type: 'success',
                                    title: 'Pays modifié avec succés ! ',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'

                                });

                                setTimeout(() => window.location = axios.defaults.baseURL+'/static', 2000);

                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });

                }

            },
            cancelRental() {
                window.location = axios.defaults.baseURL+'/static'
            }


        }
    }

</script>
