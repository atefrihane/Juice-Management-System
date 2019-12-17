@extends('General.layout')
@section('pageTitle', 'Modifier  une Entrée en stock')
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('productQuantityEdit') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Modifier une entrée</h3>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data"
                        action="{{route('handleEditProductQuantity',$productQuantity->id)}}">
                        {{csrf_field()}}

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Nom de produit</label>
                                    <select class="form-control selected_product" name="product_id" required>
                                        <option value="0">Selectionner un produit </option>
                                        @forelse($products as $product)
                                        <option value="{{$product->id}}"
                                                {{ $product->id == $productQuantity->product->id ? "selected" : "" }}>
                                                {{$product->nom}}</option>
                                    
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
                                    <input type="text" name="photo" class="form-control" value="{{$productQuantity->product->code}}" placeholder="Code produit"
                                        id="productCode" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Code à barre</label>
                                    <input type="text" name="photo" class="form-control" value="{{$productQuantity->product->barcode}}" placeholder="Code à barre"
                                        id="barCode" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Colisage produit</label>
                                    <input type="text" name="photo" class="form-control" value="{{$productQuantity->product->packing}}" placeholder="Colisage"
                                        id="packingProduct" disabled>
                                </div>


                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Nombre d'unitée par display par défaut</label>
                                    <input type="text" name="defaultDisplay" value="{{$productQuantity->product->unit_by_display}}"
                                        class="form-control" placeholder="Code produit" id="defaultDisplay" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Nombre d'unitée par colis par défaut</label>
                                    <input type="text" name="defaultPacking" value="{{$productQuantity->product->unit_per_package}}"
                                        class="form-control" placeholder="Code à barre" id="defaultPacking" disabled>
                                </div>




                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Nombre d'unitée par display</label>
                                    <input type="number" name="stock_display" value="{{$productQuantity->stock_display}}"
                                        class="form-control" placeholder="Nombre d'unitée par display" required>
                                </div>
                         </div>
                        </div>


                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Nombre d'unitée par colis</label>
                                    <input type="number" name="packing_display" value="{{$productQuantity->packing_display}}"
                                        class="form-control" placeholder="Nombre d'unitée par colis" required>
                                </div>
                         </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Colisage</label>
                                    <input type="number" name="packing" class="form-control" value="{{$productQuantity->packing}}"  placeholder="Colisage" required>
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
                                                name="expiration_date" value="{{$productQuantity->expiration_date}}"  required>
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
                                            <input type="date" name="creation_date" value="{{$productQuantity->creation_date}}" class="form-control pull-right"
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
                                    <input type="number" name="quantity" value="{{$productQuantity->quantity}}"  class="form-control" placeholder="Quantité"
                                        required>
                                </div>

                            </div>
                        </div>




                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Entrepôt</label>
                                    <select class="form-control" name="warehouse_id" required>
                                        <option disabled >Selectionner un entrepôt </option>
                                        @forelse($warehouses as $warehouse)
                                        <option value="{{$warehouse->id}}"
                                                {{ $warehouse->id == $productQuantity->warehouse->id ? "selected" : "" }}>
                                                {{$warehouse->designation}}</option>
                                        @empty
                                        <option value=""> Aucun entrepôt !</option>
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

                                <a href="{{route('showWarehouseProducts')}}" class="btn btn-danger pl-1"
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
   

            }
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: url + '/api/product/details/' + id,
                dataType: 'json',
                success: function (data) {
                    var response = JSON.parse(JSON.stringify(data));
           
                    $('#productCode').val(response.product.code);
                    $('#barCode').val(response.product.barcode);
                    $('#packingProduct').val(response.product.packing);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
    });

</script>
@endsection
