@extends('General.layoutStore')
@section('pageTitle', $store->designation)
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

        {{ Breadcrumbs::render('detailStore',$store->company,$store->designation) }}
    </section>

    <div class="container" style="margin-top:50px;">
        <section class="content-header">
            <h1>
                Informations du magasin
                <small> {{$store->designation}}</small>
            </h1>
            @if(Auth::user()->primaryAdmin())
            <div class="btn-group breadcrumb1">
                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <ul class="dropdown-menu edit" role="menu">
                    <li><a href="{{route('editStore',$store->id)}}">Modifier</a></li>

                    <li><a href="" data-toggle="modal" data-target="#modal-default{{$store->id}}">Supprimer</a></li>

                </ul>
            </div>
            @endif

        </section>

        <div class="modal fade" id="modal-default{{$store->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Voulez vous vraiment supprimer ce magasin ?
                        </h4>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title"> <b>Attention </b> : La suppression de cette entité est irreversible,
                            procéder à la suppression?

                        </h5>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <form action="{{ route('deleteStore',$store->id) }}" method="post">
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

        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{asset('/')}}{{$store->photo}}" style="width:100%;padding:40px;">
                </div>
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code</label>
                                            <input type="text" class="form-control" value="{{$store->code}}" readonly
                                                aria-describedby="emailHelp" placeholder="Code..">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Statut</label>
                                            <input type="text" class="form-control" value="{{ucfirst($store->status)}}"
                                                readonly placeholder="Nom du groupe">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Désignation</label>
                                    <input type="text" class="form-control" value="{{$store->designation}}" readonly
                                        placeholder="Nom du groupe">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nom de la société</label>
                                    <input type="text" class="form-control" value="{{ucfirst($store->company->name)}}"
                                        readonly placeholder="Nom du groupe">
                                </div>
                                <div class="form-group">
                                        <label for="exampleInputPassword1">Type de la commande </label>
                                        @if($store->order_type  == 1)
                                        <input type="text" class="form-control" value="Seulement en colis" readonly
                                        placeholder="Adresse de siége">
                                        @else
                                        <input type="text" class="form-control" value="Colis et nombre d'unités" readonly
                                        placeholder="Adresse de siége">
                                        @endif 
                                    
                                    </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Adresse de siége</label>
                                    <input type="text" class="form-control" value="{{$store->address}}" readonly
                                        placeholder="Adresse de siége">
                                </div>

                              
    


                                <div class="form-group">
                                    <label for="exampleInputPassword1">Complément addresse</label>
                                    <input type="text" class="form-control" value="{{$store->complement}}" readonly
                                        placeholder="Complément addresse">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pays</label>
                                            <input type="text" class="form-control" value="{{$store->country->name}}"
                                                readonly aria-describedby="emailHelp" placeholder="Ville">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ville</label>
                                            <input type="text" class="form-control" value="{{$store->city->name}}"
                                                readonly aria-describedby="emailHelp" placeholder="Ville">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Code Postal</label>
                                            <input type="text" class="form-control" value="{{$store->zipcode->code}}"
                                                readonly placeholder="Code Postal">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="text" class="form-control" value="{{$store->email}}" readonly
                                        placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Numéro de téléphone</label>
                                    <input type="text" class="form-control" value="{{$store->tel}}" readonly
                                        placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Type d'envoi des factures</label>
                                    <input type="text" class="form-control" value="{{$store->bill_type}}" disabled>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Facture addressée vers</label>
                                    <input type="text" class="form-control" value="{{$store->bill_to}}" disabled>

                                </div>
                                <div class="form-group">
                                    <label>Recommandation pour livreur </label>
                                    @if($store->deliveryRec)
                                    <textarea class="form-control" rows="3"
                                        placeholder="Recommendation pour livereur ..."
                                        disabled>{{$store->deliveryRec}}</textarea>
                                    @else
                                    <textarea class="form-control" rows="3"
                                        placeholder="Recommendation pour livereur ..." disabled>Aucun</textarea>

                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Commentaires</label>
                                    <textarea class="form-control" rows="3" readonly
                                        placeholder="Commentaires">{{$store->comment}}</textarea>
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
                        Horaire du magasin

                    </h4>
                    <table class="tables">
                        <thead>
                            <tr>
                                <th class="no-sort">Jour</th>
                                <th>Ouverture Matin</th>
                                <th> Clôture Matin</th>
                                <th>Ouverture Aprés midi</th>
                                <th> Clôture Aprés midi</th>
                                <th>Fermé</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($store->schedules as $schedule)
                            <tr>
                                <td>
                                    @switch($schedule->day)
                                    @case(1)
                                    Lundi
                                    @break
                                    @case(2)
                                    Mardi
                                    @break
                                    @case(3)
                                    Mercredi
                                    @break
                                    @case(4)
                                    Jeudi
                                    @break
                                    @case(5)
                                    Vendredi
                                    @break
                                    @case(6)
                                    Samedi
                                    @break
                                    @case(7)
                                    Dimanche
                                    @break
                                    @endswitch


                                </td>
                                <td>{{$schedule->start_day_time}}</td>
                                <td>{{$schedule->end_day_time}}</td>
                                <td>{{$schedule->start_night_time}}</td>
                                <td>{{$schedule->end_night_time}}</td>
                                <td>{{$schedule->closed == 1 ? 'Oui' : 'Non' }}</td>

                            </tr>
                            @empty

                            @endforelse




                        </tbody>

                    </table>
                </div>

            </div>
        </section>
        <section class="content-header">
            <div class="box box-primary">
                <div class="box-body">
                    <h4>
                        Historique du magasin

                    </h4>
                    <table class="tables">
                        <thead>
                            <tr>
                                <th> Date et heure</th>
                                <th>Utilisateur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($store->histories as $history)
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
@section('scripts-custom')
<script>
    var oTable = $('.tables').DataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/a5734b29083/i18n/French.json"
        },
        "bLengthChange": false,
        "aaSorting": [],

        "bPaginate": false,
        "info": false,
        "bFilter": false
    });

</script>
@endsection
@endsection
