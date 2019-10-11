@extends('General.layoutCompany') @section('pageTitle', 'Ajouter une produit') @section('content')

<style>
    .swal2-popup {
        font-size: 1.6rem !important;
    }

</style>
<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addCustomProduct',$company) }}
    </section>

    <section class="content" style="margin-top:20px;" id="app">
        <div class="row">
            <div class="container">
                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Modifier un produit</h3>
                    </div>

                    <form role="form" method="post" action="{{route('handleUpdateCustomProduct',$companyPrice->id)}}">
                        {{csrf_field()}}
                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nom Societé</label>
                                        <input type="text" class="form-control" value="{{$company->name}}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Magasins concernés par la remise </label>
                                        @forelse($company->stores as $store)
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="store_id[]"
                                                    id="exampleCheck1" value="{{$store->id}}"    {{ $store->id == $companyPrice->store_id ? "checked" : "" }}>
                                                <span>{{$store->designation}}</span>
                                            </div>
                                        </div>

                                        @empty
                                        <p>Aucun magasin trouvé!</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom Produit</label>
                                <select class="form-control selected_product" name="product_id" required>
                                    @forelse($products as $product)
                                    <option value="{{$product->id}}"
                                        {{ $product->id == $companyPrice->product_id ? "selected" : "" }}>
                                        {{$product->nom}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code produit</label>
                                        <input class="form-control" value="{{$companyPrice->product->code}}" type="text"
                                            placeholder="Code produit" id="productCode" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code à barre</label>
                                        <input class="form-control" value="{{$companyPrice->product->barcode}}"
                                            type="text" placeholder="Code à barre" id="barCode" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Prix unitaire de base (euro)</label>
                                        <input class="form-control" type="text"
                                            value="{{$companyPrice->product->public_price}}"
                                            placeholder="Prix unitaire de base (euro)" id="productPrice" disabled>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Prix unitaire pour societé (euro)</label>
                                <input class="form-control" id="disabledInput" name="price"
                                    value="{{$companyPrice->price}}" type="number"
                                    placeholder="Prix unitaire pour societé (euro)" min="0" required>
                            </div>


                            <div class="row">
                                <div class="container text-center">

                                    <a href="{{route('showCustomProducts',$company->id)}}"
                                        class="btn btn-danger pl-1">Annuler</a>
                                    <button type="submit" class="btn btn-success pl-1">Confirmer</button>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>


            </div>

    </section>

</div>

@section('customProducts')
<script>
    $('document').ready(function () {

        $('.selected_product').on('change', function () {

            var id = this.value;
            var url = {
                !!json_encode(url('/')) !!
            }


            if (id == 0) {
                $('#productCode').val('');
                $('#barCode').val('');


            }
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: url + '/api/product/details/' + id,
                dataType: 'json',
                success: function (data) {
                    var response = JSON.parse(JSON.stringify(data));
                    $('#productCode').val(response.product.code);
                    $('#barCode').val(response.product.barcode);
                    $('#productPrice').val(response.product.public_price);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
    });

</script>
@endsection
@endsection
