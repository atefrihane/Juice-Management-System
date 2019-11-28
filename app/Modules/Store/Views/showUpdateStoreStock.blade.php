@extends('General.layoutStore') @section('pageTitle', 'Ajouter une produit en stock') @section('content')


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

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Nom de produit</label>
                                    <select class="form-control selected_product" name="product_id" required>
                                        <option value="0">Selectionner un produit </option>
                                        @forelse($products as $product)
                                        <option value="{{$product->id}}" {{ $stock->product_id == $product->id ? 'selected' : '' }}>{{$product->nom}}
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
                                    <input type="text" name="productCode" value="{{$stock->product->code}}"
                                        class="form-control" placeholder="Code produit" id="productCode" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Code à barre</label>
                                    <input type="text" name="productBarcode" value="{{$stock->product->barcode}}"
                                        class="form-control" placeholder="Code à barre" id="barCode" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Colisage par défaut</label>
                                    <input type="number" name="productPacking"value="{{$stock->product->packing}}"
                                        class="form-control" placeholder="Colisage" id="packing" disabled>
                                </div>

                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Colisage</label>
                                    <input type="number" name="packing" value="{{$stock->packing}}" class="form-control"
                                        placeholder="Colisage" id="packing1" required>
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
                                        <label>Date de préemption</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control pull-right expiration_date" id="datepicker"
                                                name="expiration_date" value="{{$stock->expiration_date}}" required>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="container text-center">

                                <a href="{{route('showStoreStock',['company_id'=>$store->company->id,'store_id'=>$store->id])}}" class="btn btn-danger pl-1"
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


@endsection
