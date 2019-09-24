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
                                <tr>
                                @if($machine->machine->photo_url)
                                    <td> <img src="{{asset('/')}}{{$machine->machine->photo_url}}" height="80"
                                            class="user-image" alt="User Image"> </td>
                                            @else
                                            <td> <img src="{{asset('/img')}}/no-logo.png" height="80"
                                            class="user-image" alt="User Image"> </td>
                                            @endif
                                    <td>{{$machine->machine->code}}</td>
                                    <td>{{$machine->machine->designation}}</td>
                                    <td>{{$machine->machine->number_bacs}}</td>

                                    <td>{{$machine->store->designation}}</td>
                                    <td>{{$machine->machine->status}}</td>
                                    <td class="not-this text-center">
                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu" role="menu" style="margin-left-175px !important;">
                                                <li><a
                                                        href="{{route('showRental', ['id' => $machine->id])}}">Voir
                                                        détails location</a></li>
                                                <li><a href="{{route('showEndRental', ['id' =>$machine->id])}}">Arreter
                                                        location</a></li>
                                                <li><a href="{{route('showListRental', $machine->machine->id).'?machine=true'}}">Voir
                                                        historique des locations</a></li>
                                                <li><a href="{{route('showListRental', $machine->machine->id).'?machine=true'}}">Voir
                                                        détail machine</a></li>
                                                <li><a href="{{route('machineStatusEdit', $machine->machine->id)}}">Mettre à jour
                                                        état</a></li>
                                                <li><a href="{{route('editMachine', $machine->machine->id)}}">Modifier</a></li>
                                                <li><a href="{{route('deleteMachine', $machine->machine->id)}}">Supprimer</a>
                                                </li>

                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                    <a href="{{route('showMachines')}}" class="btn btn-primary btn-lg">Commencer une location</a>
                                    </td>
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
