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
                        @if(Auth::user()->primaryAdmin())
                        <a href="{{route('showAddMachine')}}" class="btn btn-primary pull-right">Ajouter une machine</a>
                        @endif


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div>
                            <div class="scrollable-table">
                                    <table class="table table-bordered table-hover example2">
                                            <thead>
                                                <tr>
                                                    <th>Photo</th>
                                                    <th class="is-wrapped" >Code</th>
                                                    <th class="is-wrapped" >Codes à barres </th>
                                                    <th class="is-wrapped" >Désignation</th>
                                                    <th class="is-wrapped" >Nbr de bacs</th>
                                                    <th class="is-wrapped" >Prix loc mens (€)</th>
                                                    <th>Statut</th>
                                                    <th class="is-wrapped" >Etat</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($machines as $machine)
                                                <tr class="table-t">
                                                    @if($machine->photo_url)
                                                    <td data-url="{{route('showHistoryMachine',$machine->id)}}"> <img
                                                            src="{{ asset('img/'.$machine->photo_url) }}" width="100"
                                                            class="user-image" alt="User Image"> </td>
                                                    @else
                                                    <td data-url="{{route('showHistoryMachine',$machine->id)}}"> <img
                                                            src="{{asset('/img')}}/no-logo.png" width="100" class="user-image"
                                                            alt="User Image"> </td>
                                                    @endif
                                                    <td data-url="{{route('showHistoryMachine',$machine->id)}}">{{$machine->code}}
                                                    </td>
                                                    <td data-url="{{route('showHistoryMachine',$machine->id)}}">
                                                        {{$machine->barcode}}</td>
                                                    <td data-url="{{route('showHistoryMachine',$machine->id)}}">
                                                        {{$machine->designation}}</td>
                                                    <td data-url="{{route('showHistoryMachine',$machine->id)}}">
                                                        {{count($machine->bacs)}}</td>
                                                    <td data-url="{{route('showHistoryMachine',$machine->id)}}">
                                                        @convert($machine->price_month)</td>
                                                    @if($machine->currentLocation())
                                                    <td data-url="{{route('showHistoryMachine',$machine->id)}}">En location <br>
                                                        <br>
                         
                                                        <b>{{ $machine->currentLocation()->store->designation }}
                                                            ({{$machine->currentLocation()->store->city->name }}) </b>
                                                    </td>
                                                    @else
                                                    <td data-url="{{route('showHistoryMachine',$machine->id)}}">Pas de location en cours</td>
                                                    @endif
                                                    <td data-url="{{route('showHistoryMachine',$machine->id)}}">{{$machine->status}}
                                                    </td>
                                                    <td class="not-this text-center">
                                                        <div class="btn-group">
                                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"></a>
                                                            <ul class="dropdown-menu edit" role="menu"
                                                                style="margin-left:-175px !important;">
                                                                @if($machine->rented==false)
                                                                @if(Auth::user()->primaryAdmin())
                                                                <li><a
                                                                        href="{{route('startRental', $machine->id).'?machine=true'}}">Commencer
                                                                        location</a></li>
                                                                @endif
            
                                                                <li><a
                                                                        href="{{route('showListRental', $machine->id).'?machine=true'}}">Voir
                                                                        liste des locations</a></li>
                                                                <li><a href="{{route('showHistoryMachine',$machine->id)}}">Voir
                                                                        détails machine</a></li>
                                                                @else
            
                                                                @forelse($machine->machineRentals as $rental)
                                                                @if($rental->active == 1)
                                                                <li><a href="{{route('showRental',$rental->id)}}">Voir détails
                                                                        location</a></li>
                                                                @break;
                                                                @endif
            
            
                                                                @empty
                                                                @endforelse
                                                                @foreach($machine->machineRentals as $rental)
                                                                @if($rental->active == 1 && Auth::user()->primaryAdmin())
                                                                <li><a href="{{route('showEndRental', ['id' =>$rental->id])}}">Arrêter
                                                                        location</a></li>
                                                                @break;
                                                                @endif
                                                                @endforeach
            
            
                                                                <li><a
                                                                        href="{{route('showListRental', $machine->id).'?machine=true'}}">Voir
                                                                        liste des locations</a></li>
                                                                <li><a href="{{route('showHistoryMachine',$machine->id)}}">Voir
                                                                        détails
                                                                        machine</a></li>
                                                                @endif
                                                                @if(Auth::user()->primaryAdmin())
                                                                <li><a href="{{route('machineStatusEdit', $machine->id)}}">Mettre à
                                                                        jour
                                                                        état</a></li>
            
                                                                <li><a href="{{route('editMachine', $machine->id)}}">Modifier</a>
                                                                </li>
                                                                <li><a href="" data-toggle="modal"
                                                                        data-target="#modal-default{{$machine->id}}">Supprimer</a>
                                                                </li>
                                                                @endif
            
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
                                                                <h4 class="modal-title">Voulez vous vraiment supprimer cette machine
                                                                    ?
                                                                </h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="modal-title"> <b>Attention </b> : La suppression de cette
                                                                    entité est irreversible, procéder à la suppression?
            
                                                                </h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="text-center">
                                                                    <form action="{{route('deleteMachine', $machine->id)}}"
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
                                                @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">
                                                        <h4> Aucune machine ! </h4>
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

        </div>

    </section>

</div>
@endsection
