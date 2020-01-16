@extends('General.layoutCompany')
@section('pageTitle', $company->name)
@section('content')
<style>
    .dots:after {
        content: '\f141';
        font-family: FontAwesome;
        font-size: 20px;
        color: black;


    }

    .edit {
        margin: 6px -20px 0 !important;
        min-width: 100px;
    }

</style>
<div class="content-wrapper">
    <section class="content-header">
        {{ Breadcrumbs::render('detail', $company) }}

    </section>

    <div class="container" style="margin-top:50px;">
        <section class="content-header">
            <h1>
                Informations de la societé
                <small> {{$company->name}}</small>
            </h1>
            @if(Auth::user()->primaryAdmin())
            <div class="btn-group breadcrumb1">
                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <ul class="dropdown-menu edit" role="menu">
                    <li><a href="{{route('editCompany', $company->id)}}">Modifier</a></li>
                    <li> <a data-toggle="modal" data-target="#modal-default{{$company->id}}">Supprimer</a></li>
                </ul>
            </div>
            @endif

            <div class="modal fade" id="modal-default{{$company->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title"> Voulez vous vraiment supprimer cette societé ?

                        </div>
                        <div class="modal-body">
                            <h5 class="modal-title"> <b>Attention  :</b> La suppression de cette entité est irreversible, procéder à la suppression? </h4>
                            </h5>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center">
                                <form action="{{ route('deleteCompany',$company->id) }}" method="post">
                                    {{csrf_field()}}
                                    <a href="#" class="btn btn-danger" data-dismiss="modal">Annuler</a>

                                    <button type="submit" class="btn btn-success">Confirmer</button>


                                </form>

                            </div>


                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>

                <!-- /.modal-dialog -->
            </div>

        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <img   src="{{ asset('img/'.$company->logo) }}" style="width:100%;padding:40px;">
                </div>
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code</label>
                                            <input type="text" class="form-control" value="{{$company->code}}" readonly
                                                aria-describedby="emailHelp" placeholder="Code..">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Statut</label>
                                            <input type="text" class="form-control"
                                                value="{{$company->status == 0 ? 'Fermé' :  $company->status == 1 ?'En sommeil': 'Active'   }}"
                                                readonly placeholder="Nom du groupe">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nom du groupe</label>
                                    <input type="text" class="form-control" value="{{$company->name}}" readonly
                                        placeholder="Nom du groupe">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Désignation</label>
                                    <input type="text" class="form-control" value="{{$company->designation}}" readonly
                                        placeholder="Désignation">
                                </div>


                             

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Adresse de siége</label>
                                    <input type="text" class="form-control" value="{{$company->address}}" readonly
                                        placeholder="Adresse de siége">
                                </div>



                                <div class="form-group">
                                    <label for="exampleInputPassword1">Complément addresse (optionnel )</label>
                                    <input type="text" class="form-control" value="{{$company->complement}}" readonly
                                        placeholder="Complément addresse">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pays</label>
                                            <input type="text" class="form-control" value="{{$company->country->name}}"
                                                readonly aria-describedby="emailHelp" placeholder="Pays">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ville</label>
                                            <input type="text" class="form-control" value="{{$company->city->name}}"
                                                readonly aria-describedby="emailHelp" placeholder="Ville">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Code Postal</label>
                                            <input type="text" class="form-control" value="{{$company->zipcode->code}}"
                                                readonly placeholder="Code Postal">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="text" class="form-control" value="{{$company->email}}" readonly
                                        placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Numéro de téléphone</label>
                                    <input type="text" class="form-control" value="{{$company->tel}}" readonly
                                        placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label>Commentaires (optionnel)</label>
                                    <textarea class="form-control" rows="3" readonly
                                        placeholder="Commentaires">{{$company->comment}}</textarea>
                                </div>





                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="content-header">
            <div class="box box-primary">
                <div class="box-body">
                    <h4>
                        Historique de la societé
                        <small> {{$company->name}}</small>
                    </h4>
                    <table class="table table-bordered table-hover example2">
                        <thead>
                            <tr>


                                <th> Date et heure</th>
                                <th>Utilisateur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($company->histories as $history)
                            <tr>
                                <td>@formatDate($history->created_at)</td>
                                <td>{{ucfirst($history->user->nom)}} {{ucfirst($history->user->prenom)}}</td>
                                <td>{{$history->action}}</td>


                            </tr>
                            @empty

                            @endforelse




                        </tbody>

                    </table>
                </div>

            </div>
        </section>


    </div>
</div>
@endsection
