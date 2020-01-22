@extends('General.layoutStore')
@section('pageTitle', 'Liste des stockes en magasin')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        {{ Breadcrumbs::render('storeStock', $store->company,$store->designation) }}

    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Stock magasin </h3>
                        @if(Auth::user()->primaryAdmin())
                        <a href="{{route('showAddStoreStock',['company_id'=>$store->company->id,'store_id'=>$store->id])}}"
                            class="btn btn-primary pull-right">Ajouter un produit en
                            stock</a>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="scrollable-table">
                                <table class="table table-bordered table-hover example2">
                                        <thead>
                                            <tr>
                                                <th>Nom du produit</th>
                                                <th>Désignation</th>
                                                <th>Nombre d'unité</th>
                                                <th>Date de fabrication</th>
                                                <th>Date de préemption</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($stocks as $stock)
                                                <td>{{$stock->product->nom}}</td>
                                                <td>{{$stock->product->designation}}</td>
                                                <td>{{$stock->quantity}}</td>
                                                <td>{{ Carbon\Carbon::parse($stock->creation_date)->format('d-m-Y') }}</td>
                                                <td>{{ Carbon\Carbon::parse($stock->expiration_date)->format('d-m-Y') }}</td>
            
                                                <td class="not-this text-center">
            
                                                    <div class="btn-group">
                                                        <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"></a>
                                                        @if(Auth::user()->primaryAdmin())
                                                        <ul class="dropdown-menu edit" role="menu">
            
                                                            <li><a
                                                                    href="{{route('showUpdateStoreStock',['company_id'=>$store->company->id,'store_id'=>$store->id,'stock_id'=>$stock->id])}}">Modifier</a>
                                                            </li>
                                                            <li><a data-toggle="modal" data-target="#modal-default{{$stock->id}}">
                                                                    Supprimer</a></li>
            
                                                        </ul>
                                                    </div>
                                                    @endif
            
                                </div>
                                </td>
                                </tr>
                                <div class="modal fade" id="modal-default{{$stock->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Voulez vous vraiment supprimer ce
                                                    stock ?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="modal-title"> <b>Attention </b> : La suppression de cette entité est
                                                    irreversible, procéder à la suppression?
            
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <form action="{{route('handleDeleteStock',$stock->id)}}" method="post">
                                                        {{csrf_field()}}
                                                        <a href="#" class="btn btn-danger" data-dismiss="modal">Annuler</a>
            
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
                                    <td colspan="5" class="text-center">
                                        <h5>Aucun stock existant!</h5>
                                    </td>
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
