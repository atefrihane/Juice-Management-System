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
                        <a href="{{route('showAddContact',$company->id)}}" class="btn btn-primary pull-right">Ajouter un
                            contact</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                     
                        <table class="table table-bordered table-hover example2">
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
                            @if(count($contacts) >0)
                                @foreach($contacts as $contact)

                                @if($contact->user->getType() == 'Directeur')
                                <tr>
                                    <td>{{$contact->user->code}}</td>
                                    <td>{{$contact->user->formatName()}}</td>
                                    <td>{{$contact->user->getType()}}</td>
                                    <td>1</td>
                                    <td class="not-this text-center">

                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">
                                                <li><a
                                                        href="{{route('editClient', [$company->id, $contact->user->id])}}">Modifier</a>
                                                </li>
                                                <li><a data-toggle="modal"
                                                        data-target="#modal-default{{$contact->user->id}}">Supprimer</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td>{{$contact->user->code}}</td>
                                    <td>{{$contact->user->formatName()}}</td>
                                    <td>{{$contact->user->getType()}}</td>
                                    <td>{{count($contact->stores)}}</td>
                                    <td class="not-this text-center">

                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">
                                                <li><a
                                                        href="{{route('editClient', [$company->id, $contact->user->id])}}">Modifier</a>
                                                </li>
                                                <li><a data-toggle="modal"
                                                        data-target="#modal-default{{$contact->user->id}}">Supprimer</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                @endif
                                <div class="modal fade" id="modal-default{{$contact->user->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Voulez vous vraiment supprimer ce
                                                    contact ?</h4>
                                                </div>
                                                <div class="modal-body">
                                                <h5 class="modal-title"> <b>Attention </b> : La suppression de cette entité est irreversible, procéder à la suppression?
                                                    
                                                </h5>
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
                                        </div>
                                        <!-- /.modal-dialog -->
                                        @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <h4>Aucun contact trouvé !</h4>
                                    </td>
                                </tr>
                                @endif

                               



                            </tbody>

                        </table>
                    </div>

                </div>


            </div>

        </div>

    </section>

</div>

@endsection
