<template>
    <div>
        <section class="content" style="margin-top:20px;">
            <div class="row">
                <div class="container">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title"> Ajouter un contact</h3>

                        </div>

                        <form role="form">

                            <div class="box-body">
                                <div class="alert alert-danger" v-if="errors.length>0">
                                    <ul>

                                        <li v-for="error in errors">{{error}}</li>

                                    </ul>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code</label>
                                            <input type="text" name="code" class="form-control" id="exampleInputEmail1"
                                                placeholder="Code.." v-model="code">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nom societé</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" readonly
                                                placeholder="Nom societé.." v-model="company_name">
                                        </div>
                                    </div>



                                </div>




                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nom</label>
                                            <input class="form-control" name="nom" id="disabledInput" type="text"
                                                placeholder="Nom" v-model="name" @change="setCode()">

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Prénom</label>
                                            <input class="form-control" name="prenom" id="disabledInput" type="text"
                                                placeholder="Prénom" v-model="surname">

                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Civilité</label>
                                    <select class="form-control" name="civilite" v-model="civility">
                                        <option value="">Séléctionner une civilité</option>
                                        <option value="MM">M.</option>
                                        <option value="MMe">Mme.</option>
                                        <option value="Mlle">Mlle.</option>
                                    </select>

                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input class="form-control" name="email" id="disabledInput" type="Email"
                                                placeholder="Email" v-model="email">

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Téléphone</label>
                                            <input class="form-control" name="telephone" id="disabledInput" type="phone"
                                                placeholder="Téléphone" v-model="phone">

                                        </div>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Type de contact</label>
                                    <select class="form-control" v-model="type">
                                        <option value="1">Directeur</option>
                                        <option value="2">Autre</option>

                                    </select>

                                </div>

                                <div class="form-group" v-if="type == 1">
                                    <label for="exampleInputEmail1">Magasin(s) de responsabilité(s)</label>

                                    <div class="form-group">
                                    <div class="scrollable">
                                    <div class="checkbox" v-for="(store,index) in stores">

                                            <label>
                                                <input type="radio" name="store" :value="store.id"
                                                    v-model="storeChecked">
                                                {{store.designation}}
                                            </label>


                                        </div>
                                    </div>
                                        
                                    </div>

                                </div>
                                <div class="form-group" v-if="type == 2">

                                    <label for="exampleInputEmail1">Magasin(s) de responsabilité(s)</label>
                                    <div class="form-check" style="margin: 10px 0px 20px;">
                                        <input type="checkbox" class="form-check-input" ref="selectChosen"
                                            @click="selectChosen()">
                                        Tout séléctionner
                                    </div>
                                    <div class="scrollable">

                                        <div class="form-group">
                                            <div class="checkbox" v-for="(store,index) in stores">
                                                <label>
                                                    <input type="checkbox" v-model="storesChosen" :value="store.id">
                                                    {{store.designation}}

                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="exampleInputEmail1">Code d'accés</label>
                                    <input class="form-control" name="accessCode" id="disabledInput" type="text"
                                        placeholder="Code d'accés" v-model="accessCode">

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mot de passe</label>
                                    <input class="form-control" name="passWord" id="disabledInput" type="text"
                                        placeholder="Mot de passe" v-model="passWord">

                                </div>


                                <div class="form-group">
                                    <label>Commentaire (optionnel)</label>
                                    <textarea class="form-control" rows="3" name="comment" placeholder="Commentaires"
                                        v-model="comment"></textarea>
                                </div>


                                <div class="row">
                                    <div class="container text-center">

                                        <a href="" class="btn btn-danger pl-1" style="margin: 1em"     @click.prevent="cancelContact()">Annuler</a>
                                        <button type="submit" class="btn btn-success pl-1" style="margin: 1em"
                                            @click.prevent="addContact()">Confirmer</button>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                    <!-- /.col -->
                </div>

            </div>

        </section>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getStores()
        },
        props: ['company'],
        data() {
            return {
                company_name: this.company.name,
                code: '',
                name: '',
                surname: '',
                civility: '',
                email: '',
                phone: '',
                type: 1,
                storeChecked: '',
                storesChosen: [],
                stores: [],
                accessCode: '',
                passWord: '',
                comment: '',
                selected: '',
                errors: []


            }
        },
        methods: {

            getStores() {
                axios.get(axios.defaults.baseURL + '/api/stores/')
                    .then((response) => {
                        this.stores = response.data.stores

                    })
                    .catch(function (error) {
                        console.log(error);
                    })

            },
            selectChosen() {

                if (this.$refs.selectChosen.checked) {
                    this.stores.forEach(store => {
                        this.storesChosen.push(store.id)

                    })
                } else {
                    this.storesChosen = []
                }



            },
            setCode() {
                if (!this.code) {
                    let value = this.name;
                    let str = value.replace(/\s+/g, '');
                    let res = str.substr(0, 6).toUpperCase();
                    this.code = res

                }

            },
            validateForm() {
                this.errors = [];

                if (!this.code) {
                    this.errors.push('Le code  est requis');
                    window.scrollTo(0, 0);
                    return false;
                }
                if (!this.name) {
                    this.errors.push('Le nom  est requis');
                    window.scrollTo(0, 0);
                    return false;
                }
                if (!this.surname) {
                    this.errors.push('Le prénom  est requis');
                    window.scrollTo(0, 0);
                    return false;
                }
                if (!this.civility) {
                    this.errors.push('Veuillez séléctionner une civilité');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.email) {
                    this.errors.push('L\'email est requis');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
                    this.errors.push('L\'email n\'est pas valide');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.phone) {
                    this.errors.push('Le téléphone est requis');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (this.storesChosen.length == 0 && !this.storeChecked) {
                    this.errors.push('Veuillez séléctionner au moins un magasin');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.accessCode) {
                    this.errors.push(' Le code d\'accés est requis');
                    window.scrollTo(0, 0);
                    return false;
                }

                if (!this.passWord) {
                    this.errors.push(' Le mot de passe est requis');
                    window.scrollTo(0, 0);
                    return false;
                }
                return true



            },

            addContact() {
                let validation = this.validateForm()

                if (validation) {
                    axios.post(`/api/contact/save/${this.company.id}`, {
                            code: this.code,
                            name: this.name,
                            surname: this.surname,
                            civility: this.civility,
                            email: this.email,
                            phone: this.phone,
                            type: this.type,
                            storeChecked: this.storeChecked,
                            storesChosen: this.storesChosen,
                            accessCode: this.accessCode,
                            passWord: this.passWord,
                            comment: this.comment,
                        })
                        .then((response) => {
                            console.log(response);
                            switch (response.data.status) {

                                case 400:
                                    swal.fire({
                                        type: 'error',
                                        title: 'Code déja existant !  ',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Fermer',
                                        allowOutsideClick: false,

                                    });
                                    break;
                                case 401:
                                    swal.fire({
                                        type: 'error',
                                        title: 'Le magasin séléctionné a déja un directeur !  ',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Fermer',
                                        allowOutsideClick: false,

                                    });
                                    break;
                                case 404:
                                    swal.fire({
                                        type: 'error',
                                        title: 'Le magasin n\'est plus disponible !  ',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Fermer',
                                        allowOutsideClick: false,

                                    });
                                    break;

                                case 200:
                                    swal.fire({
                                        type: 'success',
                                        title: 'La contact a été ajouté avec succés !',
                                        showConfirmButton: true,
                                        allowOutsideClick: false,
                                        confirmButtonText: 'Fermer'


                                    }).then((result) => {
                                        if (result.value) {
                                                window.location = axios.defaults.baseURL + '/contacts/'+this.company.id;
                                        }
                                    })
                                    break;
                            }

                        })
                        .catch((error) => {
                            console.log(error);
                        });

                }

            },
            cancelContact()
            {
                window.location = axios.defaults.baseURL + '/contacts/'+this.company.id;
            }


        }

    }

</script>
