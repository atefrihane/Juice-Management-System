@extends('General.layout')
@section('pageTitle', 'Liste des entrepôts')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        {{ Breadcrumbs::render('warhouse',$warehouse->designation) }}

    </section>

    <div class="container-fluid" style="margin-top:50px;">
        <section class="content-header">
            <h1>
                Informations de l'entrepôt
                <small> {{$warehouse->designation}}</small>
                <small> </small>
            </h1>
            @if(Auth::user()->primaryAdmin())
            <div class="btn-group breadcrumb1">
                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <ul class="dropdown-menu edit" role="menu">
                    <li><a href="{{route('showUpdateWarehouse', $warehouse->id)}}">Modifier</a></li>
                    <li> <a data-toggle="modal" data-target="#modal-default{{$warehouse->id}}">Supprimer</a></li>
                </ul>
            </div>
            @endif

            <div class="modal fade" id="modal-default{{$warehouse->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title"> Voulez vous vraiment supprimer cet entrepôt ?

                        </div>
                        <div class="modal-body">
                            <h5 class="modal-title"> <b>Attention </b> : La suppression de cette entité est
                                irreversible, procéder à la suppression?

                            </h5>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center">
                                <form action="{{ route('handleDeleteWarehouse',$warehouse->id) }}" method="post">
                                    {{csrf_field()}}
                                    <a href="#" class="btn btn-danger" data-dismiss="modal">Annuler</a>
                                    <input type="submit" class="btn btn-success" value="Confirmer">
                      


                                </form>

                            </div>


                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>

                <!-- /.modal-dialog -->
            </div>

        </section>

        <section class="content">
            <div class="row">
                    <div class="container">
                            <div class="col-md-4">
                                    @if($warehouse->photo)
                                    <img class="img-responsive container" src="{{asset('/img')}}/{{$warehouse->photo}}"
                                        style="width:100%;padding:40px; alt=" Photo">
                                    @else
                                    <img class="img-responsive" src="{{asset('/img')}}/no-logo.png"
                                        style="width:100%;padding:40px; alt=" Photo">
                                    @endif
                                    <!-- <img src="{{ asset( $warehouse->logo) }}" style="width:100%;padding:40px;"> -->
                                </div>
                                <div class="col-md-8">
                                    <div class="box box-primary">
                                        <div class="box-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Code</label>
                                                            <input type="text" class="form-control" value="{{$warehouse->code}}"
                                                                readonly aria-describedby="emailHelp" placeholder="Code..">
                
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Désignation</label>
                                                            <input type="text" class="form-control" value="{{$warehouse->designation}}"
                                                                readonly placeholder="Nom du groupe">
                
                                                        </div>
                                                    </div>
                                                </div>
                
                
                
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Adresse de siége</label>
                                                    <input type="text" class="form-control" value="{{$warehouse->address}}" readonly
                                                        placeholder="Adresse de siége">
                                                </div>
                
                
                
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Complément addresse (optionnel )</label>
                                                    <input type="text" class="form-control" value="{{$warehouse->complement_address}}"
                                                        readonly placeholder="Complément addresse">
                                                </div>
                
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Pays</label>
                                                            <input type="text" class="form-control"
                                                                value="{{$warehouse->country->name}}" readonly
                                                                aria-describedby="emailHelp" placeholder="Pays">
                
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Ville</label>
                                                            <input type="text" class="form-control" value="{{$warehouse->city->name}}"
                                                                readonly aria-describedby="emailHelp" placeholder="Ville">
                
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Code Postal</label>
                                                            <input type="text" class="form-control"
                                                                value="{{$warehouse->zipcode->code}}" readonly
                                                                placeholder="Code Postal">
                                                        </div>
                                                    </div>
                                                </div>
                
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Résponsable</label>
                                                    <input type="text" class="form-control" value="{{$warehouse->user->formatName()}}" readonly
                                                        placeholder="surface">
                                                </div>
                
                
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Surface (m²)</label>
                                                    <input type="text" class="form-control" value="{{$warehouse->surface}}" readonly
                                                        placeholder="surface">
                                                </div>
                
                                                <div class="form-group">
                                                    <label>Commentaires (optionnel)</label>
                                                    <textarea class="form-control" rows="3" readonly
                                                        placeholder="Commentaires">{{$warehouse->comment}}</textarea>
                                                </div>
                
                
                
                
                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
               
             
            </div>
        </section>
        <div class="box box-primary">
            <div class="box-body scrollable-table">
                <div class="box-header" style="margin-bottom:25px;">
                    <h3 class="box-title">Liste des produits en stock</h3>
                    @if(Auth::user()->preparatorAdmin())
                    <a href="{{route('showAddWarehouseStock',$warehouse->id)}}"
                        class="btn btn-primary pull-right">Ajouter une
                        entrée</a>
                        @endif
                </div>

                <table class="table table-bordered table-hover example2 scrollable-table">
                    <thead>
                        <tr>

                            <th class="is-wrapped">Nom Produit</th>
                            <th class="is-wrapped">Quantité(nbr des unités)</th>
                            <th class="is-wrapped">Unités par diplay</th>
                            <th class="is-wrapped">Displays par colis</th>
                            <th class="is-wrapped">Colisage</th>
                            <th class="is-wrapped">Entrepôt</th>
                            <th class="is-wrapped">Date de fabrication</th>
                            <th class="is-wrapped">Date de péremption</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warehouse->products as $warehouseProduct)
                        <tr>
                            <td>{{$warehouseProduct->nom}}</td>
                            <td>{{$warehouseProduct->pivot->quantity}}</td>
                            <td>{{ $warehouseProduct->pivot->stock_display }}</td>
                            <td>{{ $warehouseProduct->pivot->packing_display }}</td>
                            <td>{{$warehouseProduct->packing}}</td>
                            <td>{{$warehouseProduct->designation}}</td>
                            <td> {{ Carbon\Carbon::parse($warehouseProduct->pivot->creation_date)->format('d-m-Y') }}</td>
                            <td> {{ Carbon\Carbon::parse($warehouseProduct->pivot->expiration_date)->format('d-m-Y') }}</td>
                            <td class="not-this text-center">
                                <div class="btn-group">
                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"></a>
                                        @if(Auth::user()->primaryAdmin())
                                    <ul class="dropdown-menu edit" role="menu">
                                        <li><a
                                                href="{{route('showEditProductQuantity',$warehouseProduct->pivot->id)}}">Modifier</a>
                                        </li>
                                        <li><a href="#" data-toggle="modal"
                                                data-target="#modal-default{{$warehouseProduct->id}}">Supprimer</a>
                                        </li>

                                    </ul>
                                    @endif
                                </div>
                            </td>


                            <div class="modal fade" id="modal-default{{$warehouseProduct->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title">Voulez vous vraiment supprimer ce
                                                produit ?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="modal-title"> <b>Attention !</b> : Cette opération peut affecter
                                                la
                                                suppression des éléments associés à ce produit !
                                            </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="text-center">
                                                <form
                                                    action="{{ route('handleDeleteProductQuantity',$warehouseProduct->id) }}"
                                                    method="post">
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
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <h4>Aucun produit en stock !</h4>
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>
                <div class="row">
                    <div class="container text-center">
                        <a href="{{url()->previous()}}" class="btn btn-danger pl-1">Fermer</a>
                    </div>
                </div>
            </div>
        </div>






    </div>
</div>



@endsection
