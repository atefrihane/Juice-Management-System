@extends('General.layoutCompany')
@section('pageTitle', 'Liste des machines')
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('rentedMachine',$company) }}
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Machines en location pour la societé &nbsp;&nbsp; <small>
                                {{$company->name}}</small></h3>
                                @if(Auth::user()->primaryAdmin())
                        <a href="{{route('showStartRentalMachines')}}" class="btn btn-primary pull-right">Commencer location</a>
                        @endif

                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Code Machine</th>
                                    <th>Désignation</th>
                                    <th>Nbr de bacs</th>
                                    <th>Magasin</th>

                                    <th>Etat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($machines as $machine)
                                <tr class="table-t">
                                @if($machine->machine->photo_url)
                                    <td data-url="{{route('showRental', ['id' => $machine->id])}}""> <img src="{{asset('/')}}{{$machine->machine->photo_url}}" height="80"
                                            class="user-image" alt="User Image"> </td>
                                            @else
                                            <td data-url="{{route('showRental', ['id' => $machine->id])}}""> <img src="{{asset('/img')}}/no-logo.png" height="80"
                                            class="user-image" alt="User Image"> </td>
                                            @endif
                                    <td data-url="{{route('showRental', ['id' => $machine->id])}}"">{{$machine->machine->code}}</td>
                                    <td data-url="{{route('showRental', ['id' => $machine->id])}}"">{{$machine->machine->designation}}</td>
                                    <td data-url="{{route('showRental', ['id' => $machine->id])}}"">{{$machine->machine->number_bacs}}</td>

                                    <td data-url="{{route('showRental', ['id' => $machine->id])}}"">{{$machine->store->designation}}</td>
                                    <td data-url="{{route('showRental', ['id' => $machine->id])}}"">{{$machine->machine->status}}</td>
                                    <td class="not-this text-center">
                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu" role="menu" style="margin-left-175px !important;">
                                                <li><a
                                                        href="{{route('showRental', ['id' => $machine->id])}}">Voir
                                                        détails location</a></li>
                                                        @if(Auth::user()->primaryAdmin())
                                                <li><a href="{{route('showEndRental', ['id' =>$machine->id])}}">Arrêter
                                                        location</a></li>
                                                        @endif
                                                <li><a href="{{route('showListRental', $machine->machine->id).'?machine=true'}}">Voir
                                                        historique des locations</a></li>
                                                <li><a href="{{route('showHistoryMachine', $machine->machine->id).'?machine=true'}}">Voir
                                                        détail machine</a></li>
                                                        @if(Auth::user()->primaryAdmin())
                                                <li><a href="{{route('machineStatusEdit', $machine->machine->id)}}">Mettre à jour
                                                        état</a></li>
                                                <li><a href="{{route('editMachine', $machine->machine->id)}}">Modifier</a></li>
                                               <li><a data-toggle="modal"
                                                        data-target="#modal-default{{$machine->machine->id}}">Supprimer</a></li> 
                                            
                                                        @endif
                                            </ul>
                                        </div>

                                    </td>
                                    <div class="modal fade" id="modal-default{{$machine->machine->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Voulez vous vraiment supprimer cette machine ?
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="modal-title"> <b>Attention </b> : La suppression de cette entité est irreversible, procéder à la suppression?
                                                    
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <form action="{{ route('deleteMachine',$machine->machine->id) }}"
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
                                </tr>
                                @empty
                            
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
