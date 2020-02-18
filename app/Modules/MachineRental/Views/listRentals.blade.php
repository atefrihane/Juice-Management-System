@extends('General.layout')
@section('pageTitle', 'Historique des machines')
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('historyMachine',$machine->code) }}
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Historique des Locations : <b>{{$machine->designation}}</b></h3>
                        <a href="{{route('startRental', $machine->id).'?machine=true'}}"
                            class="btn btn-primary pull-right">Commencer une location</a>



                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="scrollable-table">
                            <table class="table table-bordered table-hover example2">
                                <thead>
                                    <tr>

                                        <th class="is-wrapped">Date debut</th>
                                        <th class="is-wrapped">Date fin</th>
                                        <th class="is-wrapped">Societé </th>
                                        <th class="is-wrapped">Désignation magasin</th>
                                        <th class="is-wrapped">Prix</th>
                                        <th class="is-wrapped">Raison d'arrêt</th>
                                        <th class="is-wrapped">Commentaire</th>
                                        <th class="is-wrapped">Status</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rentals as $rental)
                                    <tr>
                                        <td data-url="{{route('showRental', $rental->id)}}">{{$rental->date_debut}}</td>
                                        <td data-url="{{route('showRental', $rental->id)}}">{{$rental->date_fin}}</td>
                                        <td data-url="{{route('showRental', $rental->id)}}">
                                            {{$rental->store->company->name}}</td>
                                        <td data-url="{{route('showRental', $rental->id)}}">
                                            {{$rental->store->designation}}
                                        </td>
                                        <td data-url="{{route('showRental', $rental->id)}}">@convert($rental->price)
                                        </td>
                                        @if($rental->end_reason)
                                        <td>{{$rental->end_reason}}</td>
                                        @else
                                        <td>Non renseigné</td>
                                        @endif
                                      

                                        @if($rental->Comment)
                                        <td style="">{{$rental->Comment}}</td>
                                        @else
                                        <td style="">Non renseigné</td>
                                        @endif
                                        <td>
                                            @switch($rental->active)
                                            @case(1)
                                            En cours

                                            @break
                                            @case(2)
                                            Réservée

                                            @break
                                            @case(3)
                                            Annulée

                                            @break
                                            @case(4)
                                            Terminée

                                            @break


                                            @endswitch


                                        </td>
                                        <td class="not-this text-center">

                                            <div class="btn-group">
                                                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"></a>
                                                <ul class="dropdown-menu edit" role="menu">
                                                    <li><a href="{{route('showRental',$rental->id)}}">Voir détails</a>
                                                    </li>
                                                    @if(Auth::user()->primaryAdmin())
                                                    <li><a href="{{route('showEditRental',$rental->id)}}">Modifier
                                                            location</a></li>
                                                    @if($rental->active == 1)
                                                    <li><a href="{{route('showEndRental',$rental->id)}}">Arrêter
                                                            location</a></li>
                                                    @endif
                                                    @endif
                                                </ul>
                                            </div>
                        </div>
                        </td>


                        </tr>
                        <div class="modal fade" id="modal-default{{$rental->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title">Modifier l'historique de la location "
                                            {{$rental->store->designation}} "
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{route('handleEditRental',$rental->id)}}">
                                            {{csrf_field()}}
                                            <div class="form-group">

                                                <div class="form-group">
                                                    <label>Raison fin de location</label>
                                                    <select class="form-control" name="end_reason">
                                                        <option value="Fin du contrat de location">Fin du
                                                            contrat de location</option>
                                                        <option value="Machine non rentable">Machine non
                                                            rentable</option>
                                                        <option value="Machine en panne">Machine en panne
                                                        </option>
                                                        <option value="Autre">Autre</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">

                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">
                                                            Commentaire</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                                            name="Comment" rows="3">{{$rental->Comment}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="text-center">

                                                    <button type="submit" class="btn btn-danger" data-dismiss="modal"
                                                        aria-label="Close">Annuler</button>
                                                    <button type="submit" class="btn btn-success">Confirmer</button>

                                                </div>

                                        </form>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>

                            <!-- /.modal-dialog -->
                        </div>
                        @empty
                        <tr>
                            <td colspan="7">
                                <h4 colspan="7" class="text-center">Aucune location trouvée !</h4>
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
