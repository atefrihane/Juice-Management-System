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
                        <h3 class="box-title"> Ajouter un produit</h3>
                    </div>

                    <form role="form" method="post" action="{{route('handleStoreCustomPrice',$company->id)}}">
                    {{csrf_field()}}
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom Produit</label>
                                <select class="form-control selected_product" name="product_id" required>
                                <option value="">Séléctionner un produit</option>
                                    @forelse($products as $product)
                                    <option value="{{$product->id}}"> {{$product->nom}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code produit</label>
                                        <input class="form-control"   type="text"
                                            placeholder="Code produit" id="productCode" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code à barre</label>
                                        <input class="form-control"  type="text"
                                            placeholder="Code à barre" id="barCode" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Prix unitaire de base (euro)</label>
                                        <input class="form-control" type="text"
                                            placeholder="Prix unitaire de base (euro)" id="productPrice" disabled>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Prix unitaire pour societé (euro)</label>
                                <input class="form-control" id="disabledInput" name="price"  type="number"
                                    placeholder="Prix unitaire pour societé (euro)" min="0"
                                    required>
                            </div>


                            <div class="row">
                                <div class="container text-center">

                                    <a href="" class="btn btn-danger pl-1">Annuler</a>
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
            var url = {!!json_encode(url('/')) !!}


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
