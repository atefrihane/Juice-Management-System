@extends('General.layoutCompany')
@section('pageTitle', 'Liste des contacts')
@section('content')


    <div class="content-wrapper">

        <section class="content-header">

            {{ Breadcrumbs::render('contact', $company) }}
        </section>


        <section class="content" style="margin-top:20px;">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Liste des Contacts</h3>
                            <a href="{{route('showAddContact',$company->id)}}" class="btn btn-primary pull-right">Ajouter un contact</a>


                            <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table  class="table table-bordered table-hover example2">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Nom Et Prénom</th>
                                    <th>Type de compte</th>
                                    <th>Nbr de Magasins</th>
                                    <th></th>

                                </tr>

                                </thead>
                                <tbody>
                                @forelse($contacts as $contact)
                                    @if($contact != null)
                                    @switch($contact->user->getType())
                                        @case('directeur')
                                <tr>
                                    <td ><a href="{{route('detailClient',[$company->id, $contact->user->id])}}">{{$contact->user->code}}</a></td>
                                    <td>{{$contact->user->nom.' '. $contact->user->prenom}}</td>
                                    <td>{{ucfirst($contact->user->getType())}}</td>

                                    <td>
                                        {{$contact->company->stores->count()}}
                                    </td>
                                    <td class="not-this text-center">

                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">
                                                <li><a href="{{route('editClient', [$company->id, $contact->user->id])}}">Modifier</a></li>
                                                <li><a data-toggle="modal"
                                                        data-target="#modal-default{{$contact->user->id}}" href="{{route('deleteContact',  [$company->id, $contact->user->id])}}">Supprimer</a></li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-default{{$contact->user->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Vous voulez vraiment supprimer ce
                                                    contact ?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p> Ce processus ne peut pas être annulé.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="text-center">
                                                        <form
                                                            action="{{route('deleteContact',  [$company->id, $contact->user->id])}}"
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
                                    @case('superviseur')
                                        <tr>
                                            <td ><a href="{{route('detailClient',[$company->id, $contact->user->id])}}">{{$contact->user->code}}</a></td>
                                            <td >{{$contact->user->nom.' '. $contact->user->prenom}}</td>
                                            <td >{{ucfirst($contact->user->getType())}}</td>
                                            <td>{{$contact->stores->count()}}  </td>
                                             <td class="not-this text-center">

                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                    <ul class="dropdown-menu edit" role="menu">
                                                        <li><a href="{{route('editClient', [$company->id, $contact->user->id])}}">Modifier</a></li>
                                                        <li><a data-toggle="modal"
                                                        data-target="#modal-default{{$contact->user->id}}">Supprimer</a></li>

                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-default{{$contact->user->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Vous voulez vraiment supprimer ce
                                                    contact ?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p> Ce processus ne peut pas être annulé.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="text-center">
                                                        <form
                                                            action="{{route('deleteContact',  [$company->id, $contact->user->id])}}"
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
                                @case('responsable')
                                        <tr>
                                            <td ><a href="{{route('detailClient',[$company->id, $contact->user->id])}}">{{$contact->user->code}}</a></td>
                                            <td >{{$contact->user->nom.' '. $contact->user->prenom}}</td>
                                            <td >{{ucfirst($contact->user->getType())}}</td>

                                                <td>1</td>

                                            <td class="not-this text-center" >

                                                <div class="btn-group">
                                                    <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                    <ul class="dropdown-menu edit" role="menu">
                                                        <li><a href="{{route('editClient', [$company->id, $contact->user->id])}}">Modifier</a></li>
                                                        <li><a data-toggle="modal"
                                                        data-target="#modal-default{{$contact->user->id}}">Supprimer</a></li>

                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-default{{$contact->user->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Vous voulez vraiment supprimer ce
                                                    contact ?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p> Ce processus ne peut pas être annulé.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="text-center">
                                                        <form
                                                            action="{{route('deleteContact',  [$company->id, $contact->user->id])}}"
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
                                 @endswitch
                                    @endif
                                 @empty
                                <tr>Aucun contact</tr>
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
