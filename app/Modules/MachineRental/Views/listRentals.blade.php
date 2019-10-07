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



                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>

                                    <th>Date debut</th>
                                    <th>Date fin</th>
                                    <th>Societé </th>
                                    <th>Désignation magasin</th>
                                    <th>Prix</th>
                                    <th>Raison d'arrêt</th>
                                    <th>Commentaire</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rentals as $rental)
                                <tr class="table-tr">
                                    <td data-url="{{route('showRental', $rental->id)}}">{{$rental->date_debut}}</td>
                                    <td data-url="{{route('showRental', $rental->id)}}">{{$rental->date_fin}}</td>
                                    <td data-url="{{route('showRental', $rental->id)}}">
                                        {{$rental->store->company->name}}</td>
                                    <td data-url="{{route('showRental', $rental->id)}}">{{$rental->store->designation}}
                                    </td>
                                    <td data-url="{{route('showRental', $rental->id)}}">{{$rental->price }}</td>
                                    <td>{{$rental->end_reason}}</td>
                                    <td style="width:30%;">{{$rental->Comment}}</td>
                                    <td> <a href="#" data-toggle="modal" data-target="#modal-default{{$rental->id}}"
                                            class="btn btn-success">Modifier</a></td>

                                </tr>
                                <div class="modal fade" id="modal-default{{$rental->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Modifier l'historique de la location " {{$rental->store->designation}} "
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{route('handleEditRental',$rental->id)}}">
                                                {{csrf_field()}}
                                                    <div class="form-group">
                                                     
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Raison d'arrêt
                                                                </label>
                                                            <textarea class="form-control"
                                                                id="exampleFormControlTextarea1" name="end_reason" rows="3">{{$rental->end_reason}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">
                                                                Commentaire</label>
                                                            <textarea class="form-control"
                                                                id="exampleFormControlTextarea1" name="Comment" rows="3">{{$rental->comment}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">

                                                    <button type="submit" class="btn btn-danger" data-dismiss="modal"
                                                    aria-label="Close" >Annuler</button>
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

    </section>

</div>
@endsection
