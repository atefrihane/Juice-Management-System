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
                        @if(Auth::user()->primaryAdmin())
                        <a href="{{route('showAddCompany')}}" class="btn btn-primary pull-right">Ajouter une societé</a>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="scrollable-table">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th class="is-wrapped">Nom societé</th>
                                    <th class="is-wrapped">Code</th>
                                    <th class="is-wrapped">Code Postal</th>
                                    <th class="is-wrapped">Nbr de Magasins</th>
                                    <th class="is-wrapped">Statut</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($companies as $company)
                                <tr class="table-tr">
                                    <td  style="width: 150px"><img
                                        src="{{ asset('img/'.$company->logo) }}" height="50" alt=""></td>
                                    <td>{{$company->name}}</td>
                                    <td>{{$company->code}}</td>
                                    <td>{{$company->zipcode->code}}</td>
                                    <td>{{$company->getNbrStores()}}
                                    </td>
                                    <td>{{$company->getStatus()}}</td>
                                    <td class="not-this text-center" data-url="javascript:void(0)">
                                        <div class="btn-group">
                                            <a class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{route('showCompany', $company->id)}}"> 
                                            <span class="dropdown-font"> Voir détails</span>  </li>  
                                                <li>
                                                        <li><a href="{{route('showStores', $company->id)}}"> <span class="dropdown-font"> Liste des magasins</span></a></li>
                                                        <li>
                                                        @if(Auth::user()->primaryAdmin())
                                                <li><a href="{{route('editCompany', $company->id)}}"><span class="dropdown-font"> Modifier societé</span></a></li>
                                                <li>
                                                    <a data-toggle="modal"
                                                        data-target="#modal-default{{$company->id}}"><span class="dropdown-font"> Supprimer societé</span></a>
                                                </li>
                                                @endif
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
                                                <h5 class="modal-title"> <b>Attention </b> : La suppression de cette entité est irreversible, procéder à la suppression?
                                                    
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
                </div>
                    <!-- /.box-body -->
                </div>


            </div>
            <!-- /.col -->
        </div>

    </section>

</div>


@endsection
