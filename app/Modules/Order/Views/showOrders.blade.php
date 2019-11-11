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
                        <a href="{{route('showAddOrder')}}" class="btn btn-primary pull-right">Ajouter une commande</a>


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Date et heure de création</th>
                                    <th>Magasin</th>
                                    <th>Code postal</th>
                                    <th>Montant</th>
                                    <th>Etat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>{{$order->code}}</td>
                                    <td>{{ $order->created_at->format('d-m-Y')}} à
                                        {{ $order->created_at->timezone('Europe/Paris')->format('H:i:s')}}</td>
                                    <td>{{$order->store->designation}}</td>
                                    <td>{{$order->store->zipcode->code}}</td>
                                    <td> {{$order->total}}€</td>
                                   
                                        @switch($order->status)




                                        @case(0)
                                        
                                        <!--- En cours de saisie -->
                                        <td>En cours de saisie</td>

                                    <td class="not-this text-center">

                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">
                                                <li><a href="{{route('showUpdateOrder',$order->id)}}">Modifier</a></li>
                                                 <li><a data-toggle="modal" data-target="#modal-default{{$order->id}}">Supprimer</a></li>
                                            </ul>
                                        </div>
                                        </div>
                                        </td>
                                        <div class="modal fade" id="modal-default{{$order->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Voulez vous vraiment supprimer cette
                                                    commande ?</h4>
                                                </div>
                                                <div class="modal-body">
                                                <h5 class="modal-title">  <b>Attention !</b> : Cette opération peut affecter la suppression des éléments associés à cette commande  ! 
                                                </h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="text-center">
                                                        <form
                                                            action="{{route('handleDeleteOrder',$order->id)}}"
                                                            method="post">
                                                            {{csrf_field()}}
                                                            <a href="#" class="btn btn-danger"
                                                                data-dismiss="modal">Annuler</a>

                                                            <button type="submit"
                                                                class="btn btn-success">Confirmer</button>
                                                        

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
                                            <td>En attente de validation</td>
                                            <td class="not-this text-center">

                                            <div class="btn-group">
                                                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"></a>
                                                <ul class="dropdown-menu edit" role="menu">
                                                    <li><a href="{{route('showUpdateOrder',$order->id)}}">Modifier</a></li>
                                                    <li><a data-toggle="modal" data-target="#modal-default{{$order->id}}">Supprimer</a></li>
                                                </ul>
                                            </div>
                                            </div>
                                            </td>
                                            <div class="modal fade" id="modal-default{{$order->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title">Voulez vous vraiment supprimer cette
                                                        commande ?</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <h5 class="modal-title">  <b>Attention !</b> : Cette opération peut affecter la suppression des éléments associés à cette commande  ! 
                                                    </h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="text-center">
                                                            <form
                                                                action="{{route('handleDeleteOrder',$order->id)}}"
                                                                method="post">
                                                                {{csrf_field()}}
                                                                <a href="#" class="btn btn-danger"
                                                                    data-dismiss="modal">Annuler</a>

                                                                <button type="submit"
                                                                    class="btn btn-success">Confirmer</button>
                                                            

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
                                              <td>A préparer</td>
                                            <td class="not-this text-center">
                                            
                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"></a>
                                                    <ul class="dropdown-menu edit" role="menu">
                                                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                                        <li><a href="{{route('showUpdateStatusOrder',$order->id)}}">Mettre à jour état</a></li>
                                                    </ul>
                                                </div>
                                        </div>
                                        </td>
                                        @break




                                        @case(3)
                                             <!--- En cours de préparation -->
                                             <td>En cours de préparation</td>
                                            <td class="not-this text-center">
                                            
                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"></a>
                                                    <ul class="dropdown-menu edit" role="menu">
                                                    <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                                        <li><a href="{{route('showOrderPreparedProducts',$order->id)}}"">Modifier la préparation</a></li>
                                                        <li><a href="{{route('showUpdateStatusOrder',$order->id)}}">Mettre à jour état</a></li>
                                                    </ul>
                                                    
                                                </div>
                                        </div>
                                        </td>
                                        @break



                                        @case(4)
                                               <!--- Préparée -->
                                               <td>Préparée</td>
                                            <td class="not-this text-center">
                                            
                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"></a>
                                                        <ul class="dropdown-menu edit" role="menu">
                                                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                                        <li><a href="#">Modifier la préparation</a></li>
                                                        <li><a href="#">Mettre à jour état</a></li>
                                                    </ul>
                                                </div>
                                        </div>
                                        </td>
                                        @break



                                        @case(5)
                                           <!--- A livrer -->
                                           <td>A livrer</td>
                                            <td class="not-this text-center">
                                            
                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"></a>
                                                        <ul class="dropdown-menu edit" role="menu">
                                                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                                        <li><a href="#">Modifier la préparation</a></li>
                                                        <li><a href="#">Mettre à jour état</a></li>
                                                    </ul>
                                                </div>
                                        </div>
                                        </td>
                                        @break




                                        @case(6)
                                                <!--- En cours de livraison -->
                                                <td>En cours de livraison</td>
                                            <td class="not-this text-center">
                                            
                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"></a>
                                                        <ul class="dropdown-menu edit" role="menu">
                                                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                                        <li><a href="#">Modifier la préparation</a></li>
                                                        <li><a href="#">Mettre à jour état</a></li>
                                                    </ul>
                                                </div>
                                        </div>
                                        </td>
                                        @break


                                        @case(7)
                                           <!--- Livrée -->
                                           <td>Livrée</td>
                                            <td class="not-this text-center">
                                            
                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"></a>
                                                    <ul class="dropdown-menu edit" role="menu">
                                                    <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                                        <li><a href="#">Modifier la préparation</a></li>
                                                        <li><a href="#">Mettre à jour état</a></li>
                                                    </ul>
                                                </div>
                                        </div>
                                        </td>
                                        @break





                                        @case(8)
                                         <!--- A facturer -->
                                         <td>A facturer</td>
                                            <td class="not-this text-center">
                                            
                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"></a>
                                                    <ul class="dropdown-menu edit" role="menu">
                                                    <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                                        <li><a href="#">Mettre à jour état</a></li>
                                                    </ul>
                                                </div>
                                        </div>
                                        </td>
                                        @break




                                        @case(9)
                                        <!--- Facturée -->
                                         <td>Facturée</td>
                                            <td class="not-this text-center">
                                            
                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"></a>
                                                    <ul class="dropdown-menu edit" role="menu">
                                                    <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                                        <li><a href="#">Mettre à jour état</a></li>
                                                    </ul>
                                                </div>
                                        </div>
                                        </td>
                                        @break



                                        @case(10)
                                     <!--- A envoyer en comptabilité -->
                                         <td>A envoyer en comptabilité</td>
                                            <td class="not-this text-center">
                                            
                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"></a>
                                                    <ul class="dropdown-menu edit" role="menu">
                                                    <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                                        <li><a href="#">Mettre à jour état</a></li>
                                                    </ul>
                                                </div>
                                        </div>
                                        </td>
                                        @break



                                        @case(11)
                                               <!--- Comptabilisée -->
                                               <td>Comptabilité</td>
                                            <td class="not-this text-center">
                                            
                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"></a>
                                                     <ul class="dropdown-menu edit" role="menu">
                                                     <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                                     </ul>
                                                </div>
                                        </div>
                                        </td>
                                        @break




                                        @case(12)
                                         <!--- Annulée -->
                                        <td>Annulée</td>
                                            <td class="not-this text-center">
                                            
                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"></a>
                                                        <ul class="dropdown-menu edit" role="menu">
                                                        <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                                     </ul>
                                                </div>
                                        </div>
                                        </td>
                                        @break

                                        @endswitch
              

            

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Aucune commande existante ! </td>
                </tr>

                @endforelse








                </tbody>

                </table>
            </div>

        </div>


</div>

</div>

</section>

</div>

@endsection
