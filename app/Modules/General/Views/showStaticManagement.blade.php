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
                        @if(Auth::user()->primaryAdmin())
                        <a href="{{route('showAddCountry')}}" class="btn btn-primary pull-right">Ajouter un pays</a>
                        @endif


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <table class="table table-bordered table-hover example2 scrollable-table">
                            <thead>
                                <tr>
                                    <th class="is-wrapped">Pays</th>
                                    <th class="is-wrapped">Code téléphonique</th>
                                    <th class="is-wrapped">Nombre des villes</th>
                                    <th class="is-wrapped">Nombre des codes postaux</th>
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
                         
                 
                                                <button type="button"
                                                class="btn btn-block btn-primary style-button-dropdown"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="style-dropdown">Plus</span></button>
                                                @if(Auth::user()->primaryAdmin())
                                            <ul class="dropdown-menu edit" role="menu">
                                                <!-- <li>
                                                    <a data-toggle="modal"
                                                        data-target="#modal-default-detail{{$country->id}}">Détail</a>
                                                </li> -->
                                                <li><a href="{{route('showUpdateCountry',$country->id)}}"><span
                                                    class="dropdown-font">Modifier</span></a>
                                                </li>
                                                <li>
                                                    <a data-toggle="modal"
                                                        data-target="#modal-default{{$country->id}}"><span
                                                        class="dropdown-font">Supprimer</span></a>
                                                </li>

                                            </ul>
                                            @endif
                                  
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
                                                <h5 class="modal-title"> <b>Attention </b> : La suppression de cette entité est irreversible, procéder à la suppression?
                                                    
                                                </h5>
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

                                            <h4 > La liste ci dessous présente les élements liés à <b>
                                                        {{$country->name}}</b> </h4>


                                                @if($country->cities->count() > 0)

                                                <h4 style="margin-top:40px;"> <b> Les villes : </b></h4>
                                                
                                                <div class="box-body">
                                                    <ul class="list-group">
                                                        @foreach($country->cities as $city)
                                                        <li class="list-group-item">{{$city->name}}</li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                                @else

                                                <h5> <b>Aucune ville! </b>
                                                </h5>
                                                @endif



                                                @if($country->zipcodes->count() > 0)

                                                <h4 style="margin-top:40px;"> <b>Les codes postaux : </b></h4>
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


                                                @if($country->warehouses->count() > 0)
                                                <h4 style="margin-top:40px;"> <b> Les entrepôts : </b></h4>
                                                </h5>
                                                <div class="box-body">
                                                    <ul class="list-group">
                                                        @foreach($country->warehouses as $warehouse)
                                                        <li class="list-group-item">{{$warehouse->designation}}</li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                                @else

                                                <h4> <b>Aucun entrepôt  </b>
                                                </h4>
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
