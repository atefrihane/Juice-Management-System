@extends('General.layout')
@section('pageTitle', 'Liste des produits')
@section('content')
<style>
    .edit {
        margin: 6px -20px 0 !important;
        min-width: 100px;
    }

</style>
<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('product') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des produits</h3>
                        @if(Auth::user()->primaryAdmin())
                        <a href="{{route('showAddProduct')}}" class="btn btn-primary pull-right" >Ajouter un
                            produit</a>
                            @endif


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="scrollable-table">
                                <table class="table table-bordered table-hover example2">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th class="is-wrapped">Code</th>
                                                <th class="is-wrapped">Nom Produit</th>
                                                <th class="is-wrapped">Type</th>
                                                <th class="is-wrapped">Désignation</th>
                                                <th class="is-wrapped">Prix unitaire de base (€)</th>
                                                <th class="is-wrapped">Etat</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($products as $product)
                                            <tr class="table-t">
                                                @if($product->photo_url)
                                                <td data-url="{{route('showProduct',$product->id)}}"> <img src="{{asset('/img')}}/{{$product->photo_url}}" width="100"
                                                        class="user-image" alt="User Image"> </td>
                                                @else
                                                <td data-url="{{route('showProduct',$product->id)}}"> <img src="{{asset('/img')}}/no-logo.png" width="100" class="user-image"
                                                        alt="User Image"> </td>
                                                @endif
                                                <td data-url="{{route('showProduct',$product->id)}}">{{$product->code}}</td>
                                                <td data-url="{{route('showProduct',$product->id)}}">{{$product->nom}}</td>
                                                <td data-url="{{route('showProduct',$product->id)}}">{{ucfirst($product->type)}}</td>
                                                <td data-url="{{route('showProduct',$product->id)}}">{{$product->designation}}</td>
            
                                                <td data-url="{{route('showProduct',$product->id)}}">@convert($product->public_price)</td>
                                                <td data-url="{{route('showProduct',$product->id)}}"> {{ucfirst($product->status)}}</td>
            
                                                <td class="not-this text-center">
                                                    <div class="btn-group">
                                                        <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"></a>
                                                        <ul class="dropdown-menu edit" role="menu">
                                                            <!-- @if($product->status == 'disponible')
                                                            <li><a data-toggle="modal"
                                                                    data-target="#modal-default-statut{{$product->id}}">Changer etat
                                                                    vers non disponible</a></li>
                                                                    @else
            
                                                                    <li><a data-toggle="modal"
                                                                    data-target="#modal-default-statut{{$product->id}}">Changer etat
                                                                    vers disponible</a></li>
            
                                                                    @endif -->
                                                                    <li><a href="{{route('showProduct', $product->id)}}">Voir détails</a></li>
                                                            <li>
                                                                    @if(Auth::user()->primaryAdmin())
                                                            <li><a href="{{route('editProduct', $product->id)}}">Modifier</a></li>
                                                            <li>
                                                                <a data-toggle="modal"
                                                                    data-target="#modal-default{{$product->id}}">Supprimer</a>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modal-default{{$product->id}}" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Voulez vous vraiment supprimer ce produit ?</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5 class="modal-title"> <b>Attention </b> : La suppression de cette entité est irreversible, procéder à la suppression?
                                                                
                                                            </h5>
                                                        </div>>
                                                        <div class="modal-footer">
                                                            <div class="text-center">
                                                                <form action="{{route('deleteProduct', $product->id)}}"
                                                                    method="post">
                                                                    {{csrf_field()}}
                                                                    <a href="#" class="btn btn-danger"
                                                                        data-dismiss="modal">Annuler</a>
                                                                    <button type="submit" class="btn btn-success">Confirmer</button>
                                                                   
                                                             </form>
            
                                                            </div>
            
            
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
            
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <div class="modal fade" id="modal-default-statut{{$product->id}}"
                                                style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            @if($product->status == 'disponible')
                                                            <h4 class="modal-title">Voulez vous rendre ce produit non disponible ?
                                                            </h4>
                                                            @else
                                                            <h4 class="modal-title">Voulez vous rendre ce produit disponible ?</h4>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="text-center">
                                                                <form action="{{route('handleUpdateStatus', $product->id)}}"
                                                                    method="post">
                                                                    {{csrf_field()}}
                                                                    <input type="hidden" value="{{$product->status}}" name="status">
                                                                    <a href="#" class="btn btn-danger"
                                                                        data-dismiss="modal">Annuler</a>
                                                                    <button type="submit" class="btn btn-success">Confirmer</button>
                                                                 
                                                             </form>
            
                                                            </div>
            
            
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
            
                                                <!-- /.modal-dialog -->
                                            </div>
                                            @empty
                                            <tr>
                                            <td colspan="6" class="text-center"> Aucun produit existant </td>  
                                            </tr>
                                            @endforelse
                                        </tbody>
            
                                    </table>

                        </div>
                    </div>

                </div>


            </div>

        </div>

    </section>

</div>

@endsection
