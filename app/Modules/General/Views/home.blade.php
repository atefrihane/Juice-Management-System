@extends('General.layout')
@section('pageTitle', 'Acceuil')
@section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('home') }}
    </section>


    <section class="content">


        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des societés</h3>
                        <a href="{{route('showAddCompany')}}" class="btn btn-primary pull-right">Ajouter une societé</a>


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Nom societé</th>
                                    <th>Code</th>
                                    <th>Code Postal</th>
                                    <th>Nbr de Magasins</th>
                                    <th>Statut</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($companies as $company)
                                <tr class="table-tr">
                                    <td data-url="{{route('showStores',$company->id)}}" style="width: 150px"><img
                                            src="{{asset('/')}}{{$company->logo}}" height="50" alt=""></td>
                                    <td data-url="{{route('showStores',$company->id)}}">{{$company->name}}</td>
                                    <td data-url="{{route('showStores',$company->id)}}">{{$company->code}}</td>
                                    <td data-url="{{route('showStores',$company->id)}}">{{$company->zipcode->code}}</td>
                                    <td data-url="{{route('showStores',$company->id)}}">{{$company->getNbrStores()}}
                                    </td>
                                    <td data-url="{{route('showStores',$company->id)}}">{{$company->getStatus()}}</td>
                                    <td class="not-this text-center" data-url="javascript:void(0)">
                                        <div class="btn-group">
                                            <a class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">
                                                <li><a href="{{route('editCompany', $company->id)}}">Modifier</a></li>
                                                <li>
                                                    <a data-toggle="modal"
                                                        data-target="#modal-default{{$company->id}}">Supprimer</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                <div class="modal fade" id="modal-default{{$company->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title"> Voulez vous vraiment supprimer cette societé ?

                                            </div>
                                            <div class="modal-body">
                                                <h5 class="modal-title"> <b>Attention !</b> : Cette opération peut
                                                    affecter la suppression des éléments associés à cette societé !
                                                    </h4>
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <form action="{{ route('deleteCompany',$company->id) }}"
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
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Aucune societé !</td>

                                </tr>
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
