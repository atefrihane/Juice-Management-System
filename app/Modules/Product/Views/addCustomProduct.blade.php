@extends('General.layoutCompany') @section('pageTitle', 'Ajouter une produit') @section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">

        <section class="content-header">

            {{ Breadcrumbs::render('addCustomProduct',$company) }}
        </section>

        <section class="content" style="margin-top:20px;" id="customprod">
            <div class="row">
                <div class="container">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title"> Ajouter un produit</h3>

                        </div>

                        <form role="form" method="post" enctype="multipart/form-data">





                            <div class="box-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom Produit</label>
                                    <select class="form-control" name="product_id" v-model="product">
                                        <option value="" v-for="prod in products" :value="prod">@{{ prod.nom }}</option>
                                    </select>

                                </div>
                                <div class="row">

                                    <div class="col-md-4" v-if="product">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code produit</label>
                                            <input class="form-control" id="disabledInput" type="text" v-model="product.code" placeholder="Code produit">

                                        </div>
                                    </div>

                                    <div class="col-md-4" v-if="product">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code à barre</label>
                                            <input class="form-control" id="disabledInput" :value="product.barcode" type="text" placeholder="Code à barre">

                                        </div>
                                    </div>

                                    <div class="col-md-4" v-if="product">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Prix unitaire de base (euro)</label>
                                            <input class="form-control" id="disabledInput" type="number" placeholder="Prix unitaire de base (euro)" :value="product.public_price">

                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Prix unitaire pour societé (euro)</label>
                                    <input class="form-control" id="disabledInput" type="number" placeholder="Prix unitaire pour societé (euro)" v-model="product.prix_societe">

                                </div>


                                <div class="row">
                                    <div class="container text-center">

                                        <a href="" class="btn btn-danger pl-1">Annuler</a>
                                        <a  class="btn btn-success pl-1" v-on:click="saveProduct">Confirmer</a>

                                    </div>
                                </div>


                        </form>
                    </div>

                    <!-- /.col -->
                </div>

            </div>

        </section>



    </div>

    <script>
        FORM = {
            companyId: {{ $company->id }},
        }
    </script>

    <script src="{{mix('js/product.js')}}">

@endsection

