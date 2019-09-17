@extends('General.layout')
@section('pageTitle', 'Liste des machines')
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('machine') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des machines</h3>
                        <a href="{{route('showAddMachine')}}" class="btn btn-primary pull-right">Ajouter une machine</a>


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Code</th>
                                    <th>Codes à barres </th>
                                    <th>Désignation</th>
                                    <th>Nbr de bacs</th>
                                    <th>Prix loc mens</th>
                                    <th>Statut</th>
                                    <th>Etat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($machines as $machine)
                                <tr>
                                    @if($machine->photo_url)
                                    <td> <img src="{{$machine->photo_url}}" height="80" class="user-image"
                                            alt="User Image"> </td>
                                    @else
                                    <td> <img src="{{asset('/img')}}/no-logo.png" height="80" class="user-image"
                                            alt="User Image"> </td>
                                    @endif
                                    <td>{{$machine->code}}</td>
                                    <td>{{$machine->barcode}}</td>
                                    <td>{{$machine->designation}}</td>
                                    <td>{{$machine->number_bacs}}</td>
                                    <td>{{$machine->price_month}}</td>
                                    <td>{{$machine->rented ? 'En location' : 'Libre'}}</td>
                                    <td>{{$machine->status}}</td>
                                    <td class="not-this text-center">
                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu"
                                                style="margin-left:-175px !important;">
                                                @if($machine->rented==false)
                                                <li><a href="{{route('startRental', $machine->id).'?machine=true'}}">Commencer
                                                        location</a></li>

                                                <li><a href="{{route('showListRental', $machine->id).'?machine=true'}}">Voir
                                                        historique des locations</a></li>
                                                <li><a href="{{route('showHistoryMachine',$machine->id)}}">Voir
                                                        historique machine</a></li>
                                                @else

                                                <li><a
                                                        href="{{route('showEndRental', ['id' =>$machine->machine_rental_id])}}">Arreter
                                                        location</a></li>
                                                <li><a href="{{route('showListRental', $machine->id).'?machine=true'}}">Voir
                                                        historique des locations</a></li>
                                                <li><a href="{{route('showHistoryMachine',$machine->id)}}">Voir
                                                        historique machine</a></li>
                                                @endif

                                                <li><a href="{{route('machineStatusEdit', $machine->id)}}">Mettre à jour
                                                        état</a></li>
                                                <li><a href="{{route('editMachine', $machine->id)}}">Modifier</a></li>
                                                <li><a href="" data-toggle="modal"
                                                        data-target="#modal-default{{$machine->id}}">Supprimer</a></li>

                                            </ul>
                                        </div>

                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-default{{$machine->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Vous voulez vraiment supprimer cette machine ?
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p> Ce processus ne peut pas être annulé.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <form action="{{route('handleUpdateStatus', $machine->id)}}"
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
                                @empty
                                <tr>Aucune machine ! </tr>
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
