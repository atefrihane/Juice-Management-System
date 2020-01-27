@extends('General.layout') @section('pageTitle', 'Historique machine') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('machineHistory',$machine) }}
    </section>

    <section class="content">

        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Détails machine</h3>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data" action="{{route('storeMachine')}}">

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-2">
                                    @if($machine->photo_url)
                                    <img class="img-responsive" src="{{asset('/img/'.$machine->photo_url)}}"
                                        alt="Photo">
                                    @else
                                    <img class="img-responsive" src="{{asset('/img')}}/no-logo.png" alt="Photo">
                                    @endif
                                </div>

                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code</label>
                                        <input type="text" name="code" class="form-control" id="exampleInputEmail1"
                                            placeholder="Code" value="{{$machine->code}}" disabled>
                                    </div>

                                    <div class="form-group">


                                        <label for="exampleInputEmail1">Status</label>
                                        <input type="text" name="code" class="form-control" id="exampleInputEmail1"
                                            placeholder="Code" value=" {{ $machine->rented == 1 ? 'En location' : 'Libre' }}" disabled>

                                    </div>


                                    <div class="form-group">


                                        <label for="exampleInputEmail1">Etat</label>
                                        <input type="text" name="code" class="form-control" id="exampleInputEmail1"
                                            placeholder="Code" value="{{$machine->status}}" disabled>

                                    </div>



                                </div>



                            </div>

                            <div class="form-group" style="margin-top:40px;">
                                <label for="exampleInputEmail1">Code à barres</label>
                                <input class="form-control" name="barcode" id="disabledInput" type="text"
                                    placeholder="Code à barres" value="{{$machine->barcode}}" disabled>

                            </div>



                            <div class="form-group">
                                <label for="exampleInputEmail1">Désignation</label>
                                <input class="form-control" name="designation" id="disabledInput" type="text"
                                    placeholder="Désignation" value="{{$machine->designation}}" disabled>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type</label>
                                        <input class="form-control" name="type" id="disabledInput" type="text"
                                            placeholder="type" value="{{ucfirst($machine->type)}}" disabled>


                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombre de bacs</label>
                                        <input class="form-control" name="bacs" id="disabledInput" type="text"
                                            placeholder="type" value="{{count($machine->bacs)}}" disabled>


                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Affichage tablette</label>
                                <input class="form-control" name="tablet" id="disabledInput" type="text"
                                    placeholder="tablet" value="{{$machine->display_tablet == 1 ? 'Oui' : ' Non'}}"
                                    disabled>


                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Prix de location mensuelle ( en euros )</label>
                                <p class="form-control" style="background:#eee;">@convert($machine->price_month) </p>
                     

                            </div>


                            <div class="form-group">
                                <label>Commentaires (optionnel)</label>
                                <textarea class="form-control" rows="3" name="comment" placeholder="Commentaires"
                                    disabled>{{$machine->comment}}</textarea>
                            </div>






                        </div>

                    </form>
                </div>

                <div class="row" style="margin-top:50px;">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Historique</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body scrollable-table">
                                <table class="table table-bordered table-hover example2">
                                    <thead>
                                        <tr>
                                            <th>Date et Heure</th>
                                            <th>Utilisateur</th>
                                            <th>Action</th>
                                            <th>Commentaire</th>
                                            <th></th>




                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse($machine->histories as $machineHistory)
                                        <tr>

                                            <td>@formatDate($machine->created_at)</td>
                                            <td>{{$machineHistory->user->nom}}</td>
                                            <td>{{$machineHistory->event}}</td>

                                            <td style="width:50%">
                                                @if($machineHistory->comment){{$machineHistory->comment}} @else Aucun
                                                @endif</td>
                                            <td>
                                                <a href="#" data-toggle="modal"
                                                    data-target="#modal-default{{$machineHistory->id}}"
                                                    class="btn btn-success">Modifier</a>

                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-default{{$machineHistory->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title">Modifier l'historique de la
                                                            machine
                                                            <small>{{$machineHistory->machine->designation}}</small>

                                                        </h4>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                        <form method="post"
                                                            action="{{route('handleHistoryChange',$machineHistory->id)}}">
                                                            {{csrf_field()}}
                                                            <!-- <div class="form-group">
                                                                <label for="exampleInputEmail1">Etat</label>
                                                                <select class="form-control" name="event">
                                                                    <option value="Fonctionnelle" @if($machineHistory->
                                                                        event == 'Fonctionnelle') selected
                                                                        @endif>Fonctionnelle</option>
                                                                    <option value="Non utilisé" @if($machineHistory->
                                                                        event == 'Non utilisé') selected @endif>Non
                                                                        utilisé</option>
                                                                    <option value="En panne" @if($machineHistory->event
                                                                        == 'En panne') selected @endif>En panne</option>

                                                                </select>
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label for="">Commentaire</label>
                                                                @if($machineHistory->comment)
                                                                <textarea name="comment" id="" cols="30" rows="3"
                                                                    class="form-control">{{$machineHistory->comment}} </textarea>
                                                                @else
                                                                <textarea name="comment" id="" cols="30" rows="3"
                                                                    class="form-control">Aucun</textarea>
                                                                @endif
                                                            </div>
                                                            <div class="text-center">

                                                                <button type="submit" class="btn btn-danger"
                                                                    data-dismiss="modal"
                                                                    aria-label="Close">Annuler</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Confirmer</button>

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
                                            <td colspan="5" class="text-center">
                                                <h4>Aucune information existante !</h4>
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
                            <!-- /.box-body -->
                        </div>


                    </div>
                    <!-- /.col -->
                </div>


                <!-- /.col -->
            </div>

        </div>


    </section>

</div>

@endsection
