@extends('General.layoutCompany')
@section('pageTitle', 'Liste des Magasins')
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

        {{ Breadcrumbs::render('store', $company) }}
    </section>


    <section class="content" style="margin-top:20px;">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des Magasins</h3>
                        <a href="{{route('showAddStore',$company->id)}}" class="btn btn-primary pull-right">Ajouter un
                            magasin</a>


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Code</th>
                                    <th>Désignation</th>

                                    <th>Ville</th>
                                    <th>Code Postal</th>
                                    <th>Etat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stores as $store)
                                <tr class="table-tr">
                                @if($store->photo)
                    <td data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$store->id])}}" style="width:150px;">    <img src="{{asset('/')}}/{{$store->photo}}" height="80" class="user-image" alt="User Image"> </td>
                    @else
                    <td data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$store->id])}}" style="width:150px;">    <img src="{{asset('/img')}}/no-logo.png" height="80" class="user-image" alt="User Image"> </td>
                    @endif
                                    <td data-url="{{route('showStoreRentals',['company_id'=>$company->id,'store_id'=>$store->id])}}">{{$store->code}}</td>
                                    <td data-url="{{route('showStoreRentals',['company_id'=>$company->id,'store_id'=>$store->id])}}">{{$store->designation}}</td>
                                    <td data-url="{{route('showStoreRentals',['company_id'=>$company->id,'store_id'=>$store->id])}}">{{$store->city->name}}</td>
                                    <td data-url="{{route('showStoreRentals',['company_id'=>$company->id,'store_id'=>$store->id])}}">{{$store->zipcode->code}}</td>
                                    <td data-url="{{route('showStoreRentals',['company_id'=>$company->id,'store_id'=>$store->id])}}"> {{ucfirst($store->status)}}</td>
                                    <td  class="not-this text-center">
                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">
                                            <li><a href="{{route('showStore',['company_id'=>$company->id,'store_id'=>$store->id])}}">Voir détails</a></li>
                                                <li><a href="{{route('editStore', $store->id)}}">Modifier</a></li>
                                                <li>
                                                    <a data-toggle="modal"
                                                        data-target="#modal-default{{$store->id}}">Supprimer</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>


                                <div class="modal fade" id="modal-default{{$store->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Voulez vous vraiment supprimer ce Magasin ?
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="modal-title"> <b>Attention </b> : La suppression de cette entité est irreversible, procéder à la suppression?
                                                    
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <form action="{{ route('deleteStore',$store->id) }}" method="post">
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
                                    <td colspan="5" class="text-center">
                                        <h4>Aucun Magasin !</h4>
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
