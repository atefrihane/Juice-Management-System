@extends('General.layoutStore') @section('pageTitle', 'Ajouter une produit en stock') @section('content')


<div class="content-wrapper">

    <section class="content-header">


    </section>


    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Ajouter un produit en stock</h3>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data"
                        action="{{route('handleAddStoreStock',['company_id'=>$store->company->id,'store_id'=>$store->id])}}">
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

                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Code produit</label>
                                    <input type="text" name="productCode" value="{{old('productCode')}}"
                                        class="form-control" placeholder="Code produit" id="productCode" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Code à barre</label>
                                    <input type="text" name="productBarcode" value="{{old('productBarcode')}}"
                                        class="form-control" placeholder="Code à barre" id="barCode" disabled>
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
                                <div class="col-md-6">
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



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date d'expiration</label>

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
