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
                        <input type="hidden" value="{{url()->previous()}}" name="url">

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Nom de produit</label>
                                    <select class="form-control selected_product" name="product_id" required>
                                        <option value="">Selectionner un produit </option>
                                        @forelse($products as $product)
                                        <option value="{{$product->id}}" {{ old('product_id') == $product->id ? "selected" : "" }}>{{$product->nom}}
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
                                        class="form-control" placeholder="Code produit" id="productCode" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Code à barre</label>
                                    <input type="text" name="productBarcode" value="{{old('productBarcode')}}"
                                        class="form-control" placeholder="Code à barre" id="barCode" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Nombre d'unités par display par défaut</label>
                                    <input type="text" name="defaultDisplay" value="{{old('defaultDisplay')}}"
                                        class="form-control" placeholder="Code produit" id="defaultDisplay" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Nombre de display par colis par défaut</label>
                                    <input type="text" name="defaultPacking" value="{{old('defaultPacking')}}"
                                        class="form-control" placeholder="Code à barre" id="defaultPacking" disabled>
                                </div>

                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Colisage par défaut</label>
                                    <input type="number" name="productPacking" value="{{old('productPacking')}}"
                                        class="form-control" placeholder="Colisage" id="packing" readonly>
                                </div>




                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Nombre d'unités par display</label>
                                    <input type="number" name="stock_display" value="{{old('stockDisplay')}}"
                                        class="form-control" placeholder="Nombre d'unités par display" required>
                                </div>
                         </div>
                        </div>


                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Nombre de display par colis</label>
                                    <input type="number" name="packing_display" value="{{old('packingDisplay')}}"
                                        class="form-control" placeholder="Nombre de display par colis" required>
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
                                            <input type="date" name="creation_date" data-url="{{$warehouse->id}}" value="{{old('creation_date')}}" 
                                                class="form-control pull-right creation_date" id="datepicker" required>
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
                                        <label>Date préemption</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control pull-right expiration_date" id="datepicker"
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
                                    <input type="hidden"  name="warehouse_id" class="form-control" value="{{$warehouse->id}}">
                                    <input type="text" class="form-control" value="{{$warehouse->designation}}" disabled>
                                    {{-- @if(count($warehouses) > 0)
                                    <select class="form-control" name="warehouse_id" readonly>
                             
                                     @foreach($warehouses as $warehouse)
                                    <option value="{{$warehouse->id}}"  {{ old('warehouse_id') == $warehouse->id ? "selected" : "" }}>{{$warehouse->designation}}</option>
                                    @endforeach
                                   </select>
                                   @else
                                   <select name="warehouse_id" class="form-control" required>
                                   <option value=""> Aucun entrepôt</option>
                                   </select>
                                   @endif --}}
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

                                <a href="{{url()->previous()}}" class="btn btn-danger pl-1"
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
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->

@endsection
