@extends('General.layoutStore') @section('pageTitle', 'Modifier une produit en stock') @section('content')


<div class="content-wrapper">

    <section class="content-header">
        {{ Breadcrumbs::render('updateStoreStock', $store->company,$store->designation) }}

    </section>


    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Modifier un produit en stock</h3>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data"
                        action="{{route('handleUpdateStoreStock',['company_id'=>$store->company->id,'store_id'=>$store->id,'stock_id'=>$stock->id])}}">
                        {{csrf_field()}}

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Nom de produit</label>
                                    <input type="text" class="form-control" value="{{$stock->id}}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Nom de produit</label>
                                    <select class="form-control selected_product" name="product_id" required>
                                        <option value="0">Selectionner un produit </option>
                                        @forelse($products as $product)
                                        <option value="{{$product->id}}"
                                            {{ $stock->product_id == $product->id ? 'selected' : '' }}>{{$product->nom}}
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
                                    <input type="text" name="productCode" value="{{$stock->product->code}}"
                                        class="form-control" placeholder="Code produit" id="productCode" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Code à barre</label>
                                    <input type="text" name="productBarcode" value="{{$stock->product->barcode}}"
                                        class="form-control" placeholder="Code à barre" id="barCode" disabled>
                                </div>


                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Nombre d'unités par display par défaut</label>
                                    <input type="text" name="defaultDisplay"
                                        value="{{$stock->product->unit_by_display}}" class="form-control"
                                        placeholder="Code produit" id="defaultDisplay" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Nombre de display par colis par défaut</label>
                                    <input type="text" name="defaultPacking"
                                        value="{{$stock->product->unit_per_package}}" class="form-control"
                                        placeholder="Code à barre" id="defaultPacking" disabled>
                                </div>

                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Colisage par défaut</label>
                                    <input type="text" name="photo" class="form-control"
                                        value="{{$stock->product->packing}}" placeholder="Colisage" id="packing"
                                        disabled>
                                </div>




                            </div>
                        </div>



                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Nombre d'unités par display</label>
                                    <input type="number" name="stock_display" value="{{$stock->stock_display}}"
                                        class="form-control" placeholder="Nombre d'unités par display" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Nombre de display par colis</label>
                                    <input type="number" name="packing_display" value="{{$stock->packing_display}}"
                                        class="form-control" placeholder="Nombre de display par colis" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Colisage</label>
                                    <input type="number" name="packing" class="form-control" value="{{$stock->packing}}"
                                        placeholder="Colisage" required>
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
                                            <input type="date" name="creation_date" value="{{$stock->creation_date}}"
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
                                        <label>Date de péremption</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control pull-right expiration_date"
                                                id="datepicker" name="expiration_date"
                                                value="{{$stock->expiration_date}}" required>
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
                                    <input type="number" name="quantity" value="{{$stock->quantity}}"
                                        class="form-control" placeholder="Quantité" required>
                                </div>

                            </div>
                        </div>


                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Commentaires (optionnel)</label>
                                        <textarea class="form-control" rows="3" name="comment"
                                    placeholder="Commentaires"> {{$stock->comment}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="container text-center">

                                <a href="{{route('showStoreStock',['company_id'=>$store->company->id,'store_id'=>$store->id])}}"
                                    class="btn btn-danger pl-1" style="margin: 1em">Annuler</a>
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


@endsection
