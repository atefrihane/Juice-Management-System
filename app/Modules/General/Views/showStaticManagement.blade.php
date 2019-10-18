@extends('General.layout')
@section('pageTitle', 'Gestion des constantes')
@section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('static') }}
    </section>


    <section class="content">


        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Gestion des pays,villes et codes postaux </h3>
                        <a href="{{route('showAddCountry')}}" class="btn btn-primary pull-right">Ajouter un pays</a>


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th>Pays</th>
                                    <th>Code téléphonique</th>
                                    <th>Nombre des villes</th>
                                    <th>Nombre des codes postaux</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($countries as $country)
                                <tr>

                                    <td>{{$country->name}}</td>
                                    <td>{{$country->code}}</td>
                                    <td>{{$country->cities->count()}}</td>
                                    <td>{{$country->zipcodes->count()}}</td>

                                    <td class="not-this text-center" data-url="javascript:void(0)">
                                        <div class="btn-group">
                                            <a class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">
                                                <li>
                                                    <a data-toggle="modal"
                                                        data-target="#modal-default-detail{{$country->id}}">Détail</a>
                                                </li>
                                                <li><a href="#">Modifier</a>
                                                </li>
                                                <li>
                                                    <a data-toggle="modal"
                                                        data-target="#modal-default{{$country->id}}">Supprimer</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                <div class="modal fade" id="modal-default{{$country->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Voulez vous vraiment supprimer ce pays ?
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="modal-title"> <b>Attention !</b> : Cette opération peut
                                                    affecter la suppression des éléments associés à ce pays ! </h4>
                                                </h5>
                                                @if($country->companies->count() > 0)

                                                <h5> <b>La liste ci dessous présente les societés liés à ce pays : </b>
                                                </h5>
                                                <div class="box-body">
                                                    <ul class="list-group">
                                                        @foreach($country->companies as $company)
                                                        <li class="list-group-item">{{$company->name}}</li>
                                                        @endforeach

                                                    </ul>
                                                </div>


                                                @endif


                                            </div>
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <form action="{{ route('handleDeleteCountry',$country->id) }}"
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

                                <div class="modal fade" id="modal-default-detail{{$country->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">

                                                @if($country->zipcodes->count() > 0)

                                                <h5> La liste ci dessous présente les codes postaux liés à <b>
                                                        {{$country->name}}</b>
                                                </h5>
                                                <div class="box-body">
                                                    <ul class="list-group">
                                                        @foreach($country->zipcodes as $zipcode)
                                                        <li class="list-group-item">{{$zipcode->code}}</li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                                @else

                                                <h5> <b>Aucun code postal! </b>
                                                </h5>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <div class="text-center">

                                                    <a href="#" class="btn btn-success" data-dismiss="modal">Femer</a>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>

                                    <!-- /.modal-dialog -->
                                </div>

                                @empty
                                @endforelse




                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>


            </div>
            <!-- /.col -->
        </div>

    </section>

</div>


@endsection
