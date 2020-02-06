<template>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Ajouter un pays </h3>

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
                        min="0" v-model="code" @change="checkCode()">
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
                    <tr v-for="(city,index) in cities">
                        <td>
                            <input type="text" class="form-control" placeholder="Ville" v-model="city.name"
                                @change="checkCity(city)">
                        </td>
                        <td style="width:60%;">

                            <input type="text" class="form-control" placeholder="Ajouter un code postal"
                                v-model="city.zipcode" @keyup.enter='send(city)'>

                            <div style="margin-top:20px;">

                                <div class="btn-group" v-for="(zipcode,j) in city.zipcodes" style="padding:10px;">
                                    <button type="button" class="btn btn-info"
                                        @click="updateCode($event,index,j,city)">{{zipcode}}</button>
                                    <button type="button" class="btn btn-info" @click="removeZipcode(zipcode,index,j)">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                            </div>
                        </td>
                        <td>

                            <button type="button" class="btn btn-default" style="margin-top:4px;"
                                @click="removeCity(city,index)" v-if="index > 0"><i class="fa fa-minus"></i></button>
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

                <button type="button" class="btn btn-success pl-1" style="margin: 1em" :disabled="disabled"
                    @click="submitRental()">
                    Confirmer</button>

            </div>
        </div>
        <!-- /.box-body -->
    </div>
</template>

<script>
    export default {

        mounted() {
            this.loadCity()
        },
        data() {
            return {
                name: '',
                code: '',
                cities: [],
                errors: [],
                disabled: false



            }


        },
        methods: {
            loadCity() {

                this.cities.push({
                    name: '',
                    zipcode: '',
                    zipcodes: [],



                })
            },
            removeCity(city, i) {


                this.cities.splice(this.cities.indexOf(city), 1);


            },
            removeZipcode(zipcode, i, j) {

                this.cities[i].zipcodes.splice(this.cities[i].zipcodes.indexOf(zipcode), 1);



            },
            send(city) {

                if (city.zipcode && (city.zipcode.replace(/\s/g, '').length)) {
                    city.zipcode = city.zipcode.replace(/\s/g, '');
                    let found = false;
                    city.zipcodes.forEach((zipcode, index) => {
                        if (city.zipcode == zipcode) {
                            swal.fire({
                                type: 'error',
                                title: 'Code postal déja renseigné !  ',
                                allowOutsideClick: false,
                                showConfirmButton: true,
                                confirmButtonText: 'Fermer'

                            });
                            city.zipcode = ''
                            found = true;
                        }

                    });
                    if (!found) {
                        city.zipcodes.push(city.zipcode)
                        city.zipcode = ''

                    }


                } else {

                    swal.fire({
                        type: 'error',
                        title: 'Veuillez entrer un code postal ',
                        showConfirmButton: true,
                        confirmButtonText: 'Fermer',
                        allowOutsideClick: false,

                    });
                }


            },

            checkCity(city) {
                let count = 0;

                if (city.name != '') {
                    if (this.cities.length > 1) {
                        this.cities.forEach((oldCity, index) => {
                            if (oldCity.name == city.name) {
                                count++;
                            }

                        });
                        if (count > 1) {
                            swal.fire({
                                type: 'error',
                                title: 'Nom de la ville déja existant !  ',
                                showConfirmButton: true,
                                confirmButtonText: 'Fermer',
                                allowOutsideClick: false,

                            });
                            city.name = ''
                        }


                    }


                }



            },
            updateCode(event, i, j, city) {

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
                        city.zipcodes.forEach((zipcode) => {
                            if (zipcode == code) {
                                swal.fire({
                                    type: 'error',
                                    title: 'Code postal déja renseigné !  ',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Fermer'

                                });
                                city.zipcode = ''
                                found = true;
                            }

                        });
                        if (!found) {
                            this.$set(this.cities[i].zipcodes, j, code);

                        }


                    } else {
                        swal.fire({
                            type: 'error',
                            title: 'Veuillez entrer une valeur non vide!  ',
                            allowOutsideClick: false,
                            showConfirmButton: true,
                            confirmButtonText: 'Fermer'

                        });

                    }
                })();



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
                    this.disabled = true

                    axios.post('/country/add', {
                            name: this.name,
                            code: this.code,
                            cities: this.cities
                        })
                        .then((response) => {
                            console.log(response);
                            if (response.data.status == 401) {
                                this.disabled = false
                                swal.fire({
                                    type: 'error',
                                    title: 'Nom déja existant! ',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Fermer',
                                    allowOutsideClick: false,

                                });

                            }

                            if (response.data.status == 402) {
                                this.disabled = false
                                swal.fire({
                                    type: 'error',
                                    title: 'Code déja existant! ',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Fermer'

                                });

                            }

                            if (response.data.status == 200) {
                                swal.fire({
                                    type: 'success',
                                    title: 'Le pays a été ajouté avec succés !',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Fermer'


                                }).then((result) => {
                                    if (result.value) {
                                        window.location = axios.defaults.baseURL + '/static';
                                    }
                                })


                            }
                        })
                        .catch((error) => {
                            console.log(error);
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

            },
            checkCode() {
                let number = Number(this.code)
                let checkNumber = Number.isInteger(number) && number <= 999999;
                if (isNaN(this.code) || !checkNumber) {
                    swal.fire({
                        type: 'error',
                        title: 'Le code saisi  est invalide ! ',
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        confirmButtonText: 'Fermer'
                    });
                    this.code =''
                }
            },
            cancelRental() {
                window.location = axios.defaults.baseURL + '/static'

            }


        }
    }

</script>
