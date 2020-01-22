@extends('General.layoutCompany')
@section('pageTitle', 'Tarifs')
@section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('customProduct', $company) }}
    </section>


    <section class="content" style="margin-top:20px;">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Tarif Societé - Liste des produits</h3>
                        @if(Auth::user()->primaryAdmin())
                        <a href="{{route('showAddCustomProduct',$company->id)}}"
                            class="btn btn-primary pull-right">Ajouter un produit au tarif</a>
                        @endif


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="scrollable-table">
                                <table class="table table-bordered table-hover example2">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Nom produit</th>
                                                <th>Code produit</th>
                                                <th>Type de produit</th>
                                                <th>Prix unitaire de base (€)</th>
                                                <th>Prix unitaire remisé (€)</th>
                                                <th>Nombre de magasins</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($prices as $price)
                                            <tr>
                                                @if($price->product->photo_url)
                                                <td> <img src="{{asset('/img')}}/{{$price->product->photo_url}}" height="80"
                                                        class="user-image" alt="User Image"> </td>
                                                @else
                                                <td> <img src="{{asset('/img')}}/no-logo.png" height="80" class="user-image"
                                                        alt="User Image"> </td>
                                                @endif
                                                <td>{{$price->product->nom}}</td>
                                                <td>{{$price->product->code}}</td>
                                                <td>{{$price->product->type}}</td>
                                                <td>@convert($price->product->public_price)</td>
                                                <td>@convert($price->price)</td>
                                                <td>{{$price->stores()->count()}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"></a>
                                                        @if(Auth::user()->primaryAdmin())
                                                        <ul class="dropdown-menu edit" role="menu">
                                                            <li><a
                                                                    href="{{route('showUpdateCustomProducts',['company'=>$company->id,'price'=>$price->id])}}">Modifier</a>
                                                            </li>
                                                            <li><a href="" data-toggle="modal"
                                                                    data-target="#modal-default{{$price->id}}">Supprimer</a>
                                                            </li>
                                                        </ul>
                                                        @endif
                                                    </div>
            
                                </div>
                                </td>
                                </tr>
            
                                <div class="modal fade" id="modal-default{{$price->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Voulez cous vraiment supprimer ce produit du tarif?
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="modal-title"> <b>Attention </b> : La suppression de cette entité est
                                                    irreversible, procéder à la suppression?
            
                                                </h5>
                                            </div>
            
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <form action="{{ route('handleDeleteCustomProduct',$price->id) }}"
                                                        method="post">
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
                                @empty
                                @endforelse
            
            
                                </tbody>
            
                                </table>

                        </div>
                     
                </div>

            </div>


        </div>

</div>

</section>

</div>

@endsection
