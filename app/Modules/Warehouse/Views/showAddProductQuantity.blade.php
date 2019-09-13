@extends('General.layout')
@section('pageTitle', 'Ajouter une Entrée en stock')
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('productQuantity') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Ajouter une Entrée en stock</h3>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data"
                        action="{{route('handleAddProductQuantity')}}">
                        {{csrf_field()}}

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Nom de produit</label>
                                    <select class="form-control selected_product" name="product_id" required>
                                        <option value="0">Selectionner un produit </option>
                                        @forelse($products as $product)
                                        <option value="{{$product->id}}">{{$product->nom}} </option>
                                        @empty
                                        <option value="0">Aucun produit</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Code produit</label>
                                    <input type="text" name="photo" class="form-control" placeholder="Code produit"
                                        id="productCode" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Code à barre</label>
                                    <input type="text" name="photo" class="form-control" placeholder="Code à barre"
                                        id="barCode" disabled>
                                </div>

                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Colisage</label>
                                    <input type="number" name="" class="form-control" placeholder="Colisage"
                                        id="packing" disabled>
                                </div>


                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Colisage</label>
                                    <input type="number" name="packing" class="form-control" placeholder="Colisage"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Date prémption du produit fermé</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control pull-right" id="datepicker"
                                                name="expiration_date" required>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Date de fabrication</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" name="creation_date" class="form-control pull-right"
                                                id="datepicker" required>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Quantité (nombre des unités)</label>
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantité"
                                        required>
                                </div>

                            </div>
                        </div>




                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Entrepot</label>
                                    <select class="form-control" name="warehouse_id" required>
                                        <option value="0">Selectionner un entrepôt </option>
                                        @forelse($warehouses as $warehouse)
                                        <option value="{{$warehouse->id}}"> {{$warehouse->designation}}</option>
                                        @empty
                                        <option value=""> Aucun entrepot !</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Commentaires (optionnel)</label>
                                        <textarea class="form-control" rows="3" name="comment"
                                            placeholder="Commentaires"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <div class="container text-center">

                                <a href="{{route('showMachines')}}" class="btn btn-danger pl-1"
                                    style="margin: 1em">Annuler</a>
                                <button type="submit" class="btn btn-success pl-1"
                                    style="margin: 1em">Confirmer</button>

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





<script>
    $('document').ready(function () {

        $('.selected_product').on('change', function () {

            var id = this.value;
            var url = {!!json_encode(url('/')) !!}
               
            if (id == 0) {
                $('#productCode').val('');
                $('#barCode').val('');
                $('#packing').val('');

            }
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: url + '/api/product/' + id,
                dataType: 'json',
                success: function (data) {
                    var response = JSON.parse(JSON.stringify(data));
                    $('#productCode').val(response['code']);
                    $('#barCode').val(response['barcode']);
                    $('#packing').val(response['packing']);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
    });

</script>
@endsection
