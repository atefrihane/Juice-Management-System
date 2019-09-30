<template>
    <div class="container">
        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title"> Ajouter un produit</h3>
            </div>

            <form role="form">
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom Produit</label>
                        <select class="form-control" @change="getProductData($event)">
                            <option value="">Séléctionner un produit</option>
                            <option v-for="product in products" :value="product.id">{{product.nom}}</option>

                        </select>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Code produit</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="Code produit"
                                    v-model="productCode" disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Code à barre</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="Code à barre"
                                    v-model="barCode" disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Prix unitaire de base (euro)</label>
                                <input class="form-control" id="disabledInput" type="text"
                                    placeholder="Prix unitaire de base (euro)" v-model="productPrice" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Prix unitaire pour societé (euro)</label>
                        <input class="form-control" id="disabledInput" type="number"
                            placeholder="Prix unitaire pour societé (euro)" min="0" v-model="companyPrice" required>
                    </div>


                    <div class="row">
                        <div class="container text-center">

                            <a href="" class="btn btn-danger pl-1">Annuler</a>
                            <a href="" class="btn btn-success pl-1" @click.prevent="submitProductPrice()">Confirmer</a>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

</template>

<script>
    export default {

        data() {

            return {
                products: [],
                productCode: '',
                barCode: '',
                productPrice: '',
                productId: '',
                companyId: company.companyId,
                companyPrice: ''

            }

        },
        mounted() {
            this.loadProducts();
        },
        methods: {

            loadProducts() {
                axios.get('/api/products/')
                    .then((response) => {
                        this.products = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });

            },
            getProductData(event) {
                let id = event.target.value;
                this.productId = id;
                if (id != '') {
                    axios.get('/api/product/' + id)
                        .then((response) => {
                        

                            this.productCode = response.data.product.code;
                            this.barCode = response.data.product.barcode;
                            this.productPrice = response.data.product.public_price;

                        })
                        .catch((error) => {
                            console.log(error);
                        });
                } else {
                    this.productCode = '';
                    this.barCode = '';
                    this.productPrice = '';

                }


            },
            submitProductPrice() {
                if (this.companyPrice == '') {
                    swal.fire({
                        type: 'error',
                        title: 'Veuillez selectionner un prix pour la societé!',
                        showConfirmButton: true,
     confirmButtonText:'Fermer'
                   
                    });

                }

                    if (this.productId != '') {
                    axios.post('api/product/custom/' + this.companyId, {
                            productId: this.productId,
                            companyId: this.companyId,
                            price: this.companyPrice

                        })
                        .then((response) => {
                          
                            if (response.data.status != 200) {
                                swal.fire({
                                    type: 'success',
                                    title: 'Le prix a été ajouté avec succés !',
                                    showConfirmButton: true,
     confirmButtonText:'Fermer'
                               

                                });
                                setTimeout(() => window.location = '/wizefresh/public/products/custom/' + this
                                    .companyId, 2000);

                            } else {
                                swal.fire({
                                    type: 'error',
                                    title: 'Echec !',
                                    showConfirmButton: true,
     confirmButtonText:'Fermer'
                               
                                });

                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });

                } else {

                    swal.fire({
                        type: 'error',
                        title: 'Veuillez selectionner un produit!',
                        showConfirmButton: true,
     confirmButtonText:'Fermer'
                   
                    });

                }





            }
        }
    }

</script>
