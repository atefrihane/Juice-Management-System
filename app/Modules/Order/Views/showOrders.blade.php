@extends('General.layout')
@section('pageTitle', 'Liste des commandes')
@section('content')
<style>
    .edit {
        margin: 6px -120px 0 !important;
        min-width: 100px !important;
    }

</style>
<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('order') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des Commandes</h3>
                        <div class="box-body">
                            @if(Auth::user()->preparatorAdmin())
                            <a href="{{route('showArchives')}}" class="btn btn-default pull-left">Archives</a>

                            <a href="{{route('showAddOrder')}}" class="btn btn-primary pull-right">Ajouter une
                                commande</a>
                            @endif
                        </div>



                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="scrollable-table">
                                <table class="table table-bordered table-hover example2">
                                        <thead>
                                            <tr>
                                                <th class="is-wrapped">Code</th>
                                                <th class="date-create">Date et heure de création</th>
                                                <th class="is-wrapped">Saisie par</th>
                                                <th class="is-wrapped">Societé</th>
                                                <th class="is-wrapped">Magasin</th>
                                                <th class="is-wrapped">Code postal</th>
                                                <th class="is-wrapped">Montant (€)</th>
                                                <th class="is-wrapped">Commentaire</th>
            
                                                <th>Etat</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($orders as $order)
                                            <tr @if($order->status >=2) class="table-tr" @endif>
                                                <td data-url="{{route('showOrder',$order->id)}}">{{$order->code}}</td>
                                                <td data-url="{{route('showOrder',$order->id)}}">@formatDate($order->created_at)
                                                </td>
                                                <td data-url="{{route('showOrder',$order->id)}}">
                                                    @if($order->histories->first())
                                                    {{ $order->histories->first()->user->formatName() }}
                                                    @else
                                                    Aucun
                                                    @endif
                                                </td>
            
                                                <td data-url="{{route('showOrder',$order->id)}}">{{$order->store->company->name}}
                                                </td>
                                                <td data-url="{{route('showOrder',$order->id)}}">{{$order->store->designation}}</td>
                                                <td data-url="{{route('showOrder',$order->id)}}">{{$order->store->zipcode->code}}
                                                </td>
                                                <td data-url="{{route('showOrder',$order->id)}}">@convert($order->totalOrdered()->sum)</td>
            
                                                <td data-url="{{route('showOrder',$order->id)}}">
                                                    @if($order->lastComment())
                                                   
                                                        {{$order->lastComment()->comment }}
                                                 
                                                 
                                               
                                                  
                                                    @else Aucun
                                                    @endif
            
                                                </td>
            
                                                @switch($order->status)
            
            
            
            
                                                @case(0)
            
                                                <!--- En cours de saisie -->
                                                <td data-url="{{route('showOrder',$order->id)}}">En cours de saisie</td>
            
                                                <td class="not-this text-center">
            
                                                    <div class="btn-group">
                                                        <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"></a>
                                                        <ul class="dropdown-menu edit" role="menu">
                                                            @if(Auth::user()->preparatorAdmin())
                                                            <li><a href="{{route('showUpdateOrder',$order->id)}}">Modifier</a></li>
                                                            <li><a data-toggle="modal"
                                                                    data-target="#modal-default{{$order->id}}">Supprimer</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                </div>
                                </td>
                                <div class="modal fade" id="modal-default{{$order->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Voulez vous vraiment supprimer cette
                                                    commande ?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="modal-title"> <b>Attention !</b> : Cette opération peut affecter la
                                                    suppression des éléments associés à cette commande !
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <form action="{{route('handleDeleteOrder',$order->id)}}" method="post">
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
                                @break
            
                                @case(1)
                                <!--- En attente de validation -->
                                <td data-url="{{route('showOrder',$order->id)}}">En attente de validation</td>
                                <td class="not-this text-center">
            
                                    <div class="btn-group">
                                        <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"></a>
                                        <ul class="dropdown-menu edit" role="menu">
                                            @if(Auth::user()->preparatorAdmin())
                                            <li><a href="{{route('showUpdateOrder',$order->id)}}">Modifier</a></li>
                                            <li><a data-toggle="modal" data-target="#modal-default{{$order->id}}">Supprimer</a></li>
                                            @endif
                                        </ul>
                                    </div>
                            </div>
                            </td>
                            <div class="modal fade" id="modal-default{{$order->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title">Voulez vous vraiment supprimer cette
                                                commande ?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="modal-title"> <b>Attention !</b> : Cette opération peut affecter la
                                                suppression des éléments associés à cette commande !
                                            </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="text-center">
                                                <form action="{{route('handleDeleteOrder',$order->id)}}" method="post">
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
                            @break
            
            
                            @case(2)
                            <!--- A préparer -->
                            <td data-url="{{route('showOrder',$order->id)}}">A préparer</td>
                            <td class="not-this text-center">
            
                                <div class="btn-group">
                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu edit" role="menu">
                                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                        @if(Auth::user()->preparatorAdmin())
                                        <li><a href="{{route('showUpdateStatusOrder',$order->id)}}">Mettre à jour état</a></li>
                                        @endif
                                    </ul>
                                </div>
                        </div>
                        </td>
                        @break
            
            
            
            
                        @case(3)
                        <!--- En cours de préparation -->
                        <td data-url="{{route('showOrder',$order->id)}}">En cours de préparation</td>
                        <td class="not-this text-center">
            
                            <div class="btn-group">
                                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu edit" role="menu">
                                    <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                    @if(Auth::user()->preparatorAdmin())
                                    <li><a href="{{route('showOrderPreparedProducts',$order->id)}}"">Modifier la préparation</a></li>
                                                                    <li><a href="
                                            {{route('showUpdateStatusOrder',$order->id)}}">Mettre à jour état</a></li>
                                    @endif
                                </ul>
            
                            </div>
                    </div>
                    </td>
                    @break
            
            
            
                    @case(4)
                    <!--- Préparée -->
                    <td data-url="{{route('showOrder',$order->id)}}">Préparée</td>
                    <td class="not-this text-center">
            
                        <div class="btn-group">
                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu edit" role="menu">
                                <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                @if(Auth::user()->preparatorAdmin())
                                <li><a href="{{route('showOrderPreparedProducts',$order->id)}}"">Modifier la préparation</a></li>
                            <li><a href=" {{route('showUpdateDeliveryOrder',$order->id)}}"">Modifier la livraison</a></li>
                                <li><a href=" {{route('showUpdateStatusOrder',$order->id)}}">Mettre à jour état</a></li>
                                @endif
                            </ul>
                        </div>
            </div>
            </td>
            @break
            
            
            
            @case(5)
            <!--- A livrer -->
            <td data-url="{{route('showOrder',$order->id)}}">A livrer</td>
            <td class="not-this text-center">
            
                <div class="btn-group">
                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <ul class="dropdown-menu edit" role="menu">
                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                        @if(Auth::user()->preparatorAdmin())
                        <li><a href="{{route('showOrderPreparedProducts',$order->id)}}"">Modifier la préparation</a></li>
                        <li><a href=" {{route('showUpdateDeliveryOrder',$order->id)}}"">Modifier la livraison</a></li>
                        @endif
                        @if(Auth::user()->preparatorAdmin() || $order->delivery_man_id == Auth::id() ||
                        Auth::user()->mainDelivery())
                        <li><a href=" {{route('showUpdateStatusOrder',$order->id)}}">Mettre à jour état</a></li>
                        @endif
                    </ul>
                </div>
                </div>
            </td>
            @break
            
            
            
            
            @case(6)
            <!--- En cours de livraison -->
            <td data-url="{{route('showOrder',$order->id)}}">En cours de livraison</td>
            <td class="not-this text-center">
            
                <div class="btn-group">
                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <ul class="dropdown-menu edit" role="menu">
                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                        @if(Auth::user()->preparatorAdmin())
                        <li><a href="{{route('showOrderPreparedProducts',$order->id)}}"">Modifier la préparation</a></li>
                        <li><a href=" {{route('showUpdateDeliveryOrder',$order->id)}}"">Modifier la livraison</a></li>
                        @endif
                        @if(Auth::user()->preparatorAdmin() || $order->delivery_man_id == Auth::id() ||
                        Auth::user()->mainDelivery())
                        <li><a href=" {{route('showUpdateStatusOrder',$order->id)}}">Mettre à jour état</a></li>
                        @endif
                    </ul>
                </div>
                </div>
            </td>
            @break
            
            
            @case(7)
            <!--- Livrée -->
            <td data-url="{{route('showOrder',$order->id)}}">Livrée</td>
            <td class="not-this text-center">
            
                <div class="btn-group">
                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <ul class="dropdown-menu edit" role="menu">
                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                        @if(Auth::user()->preparatorAdmin())
                        <li><a href="{{route('showOrderPreparedProducts',$order->id)}}"">Modifier la préparation</a></li>
                        <li><a href=" {{route('showUpdateDeliveryOrder',$order->id)}}"">Modifier la livraison</a></li>
                        <li><a href=" {{route('showUpdateStatusOrder',$order->id)}}">Mettre à jour état</a></li>
                        @endif
            
                    </ul>
                </div>
                </div>
            </td>
            @break
            
            
            
            
            
            @case(8)
            <!--- A facturer -->
            <td data-url="{{route('showOrder',$order->id)}}">A facturer</td>
            <td class="not-this text-center">
            
                <div class="btn-group">
                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <ul class="dropdown-menu edit" role="menu">
                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                        @if(Auth::user()->preparatorAdmin())
                        <li><a href="{{route('showUpdateStatusOrder',$order->id)}}">Mettre à jour état</a></li>
                        @endif
                    </ul>
                </div>
                </div>
            </td>
            @break
            
            
            
            
            @case(9)
            <!--- Facturée -->
            <td data-url="{{route('showOrder',$order->id)}}">Facturée</td>
            <td class="not-this text-center">
            
                <div class="btn-group">
                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <ul class="dropdown-menu edit" role="menu">
                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                        @if(Auth::user()->preparatorAdmin())
                        <li><a href="{{route('showUpdateStatusOrder',$order->id)}}">Mettre à jour état</a></li>
                        @endif
                    </ul>
                </div>
                </div>
            </td>
            @break
            
            
            
            @case(10)
            <!--- A envoyer en comptabilité -->
            <td data-url="{{route('showOrder',$order->id)}}">A envoyer en comptabilité</td>
            <td class="not-this text-center">
            
                <div class="btn-group">
                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <ul class="dropdown-menu edit" role="menu">
                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                        @if(Auth::user()->preparatorAdmin())
                        <li><a href="{{route('showUpdateStatusOrder',$order->id)}}">Mettre à jour état</a></li>
                        @endif
                    </ul>
                </div>
                </div>
            </td>
            @break
            
            
            
            @case(11)
            <!--- Comptabilisée -->
            <td data-url="{{route('showOrder',$order->id)}}">Comptabilisée</td>
            <td class="not-this text-center">
            
                <div class="btn-group">
                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <ul class="dropdown-menu edit" role="menu">
                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                        @if(Auth::user()->preparatorAdmin())
                        <li> <a data-toggle="modal" data-target="#modal-default{{$order->id}}">Archiver</a></li>
                        @endif
                    </ul>
                </div>
                </div>
            </td>
            
            <div class="modal fade" id="modal-default{{$order->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title"> Voulez vous vraiment archiver cette commande ?
            
                        </div>
                        <!-- <div class="modal-body">
                            <h5 class="modal-title"> <b>Attention !</b> : Cette opération peut affecter la suppression
                                des éléments associés à cette societé ! </h4>
                            </h5>
                        </div> -->
                        <div class="modal-footer">
                            <div class="text-center">
                                <form action="{{ route('handleArchiveOrder',$order->id) }}" method="post">
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
            @break
            
            
            
            
            @case(12)
            <!--- Annulée -->
            <td data-url="{{route('showOrder',$order->id)}}">Annulée</td>
            <td class="not-this text-center">
            
                <div class="btn-group">
                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <ul class="dropdown-menu edit" role="menu">
                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                        @if(Auth::user()->preparatorAdmin())
                        <li><a data-toggle="modal" data-target="#modal-default{{$order->id}}">Supprimer</a></li>
                        @endif
                    </ul>
                </div>
                </div>
            </td>
            <div class="modal fade" id="modal-default{{$order->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Voulez vous vraiment supprimer cette
                                commande ?</h4>
                        </div>
                        <div class="modal-body">
                            <h5 class="modal-title"> <b>Attention !</b> : Cette opération peut affecter la
                                suppression des éléments associés à cette commande !
                            </h5>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center">
                                <form action="{{route('handleDeleteOrder',$order->id)}}" method="post">
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
            @break
            
            @endswitch
            
            
            
            
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center"> <h4> Aucune commande existante !</h4> </td>
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
