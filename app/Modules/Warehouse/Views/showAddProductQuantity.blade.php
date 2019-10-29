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
                                        <option value="{{$product->id}}">{{$product->nom}}
                                        </option>
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
                                    <input type="text" name="productCode" value="{{old('productCode')}}"
                                        class="form-control" placeholder="Code produit" id="productCode" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Code à barre</label>
                                    <input type="text" name="productBarcode" value="{{old('productBarcode')}}"
                                        class="form-control" placeholder="Code à barre" id="barCode" disabled>
                                </div>

                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Colisage par défaut</label>
                                    <input type="number" name="productPacking" value="{{old('productPacking')}}"
                                        class="form-control" placeholder="Colisage" id="packing" disabled>
                                </div>


                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Colisage</label>
                                    <input type="number" name="packing" value="{{old('packing')}}" class="form-control"
                                        placeholder="Colisage" id="packing1" required>
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
                                            <input type="date" name="creation_date" value="{{old('creation_date')}})"
                                                class="form-control pull-right" id="datepicker" required>
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
                                        <label>Date prémption</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control pull-right" id="datepicker"
                                                name="expiration_date" value="{{old('expiration_date')}}" required>
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
                                    <input type="number" name="quantity" value="{{old('quantity')}}"
                                        class="form-control" placeholder="Quantité" required>
                                </div>

                            </div>
                        </div>




                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Entrepôt</label>
                                    <select class="form-control" name="warehouse_id" required>
                                        <option value="0">Selectionner un entrepôt </option>
                                        @forelse($warehouses as $warehouse)
                                        <option value="{{$warehouse->id}}"
                                            {{ old('warehouse_id',$warehouse->id) ? 'selected' : ''  }}>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $('document').ready(function () {

        $('.selected_product').on('change', function () {

            var id = this.value;
            console.log(id);
            var url = {!!json_encode(url('/')) !!}

            if (id == 0) {
                $('#productCode').val('');
                $('#barCode').val('');
                $('#packing').val('');

            } else {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: url + '/api/product/details/' + id,
                    dataType: 'json',
                    success: function (data) {
                        var response = JSON.parse(JSON.stringify(data));

                        $('#productCode').val(response.product.code);
                        $('#barCode').val(response.product.barcode);
                        $('#packing').val(response.product.packing);
                        $('#packing1').val(response.product.packing);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });

            }

        });
    });

</script>
@endsection
