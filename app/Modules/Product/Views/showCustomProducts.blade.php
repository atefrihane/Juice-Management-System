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
                        <a href="{{route('showAddCustomProduct',$company->id)}}"
                            class="btn btn-primary pull-right">Ajouter un produit au tarif</a>


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Nom produit</th>
                                    <th>Code produit</th>
                                    <th>Type de produit</th>
                                    <th>Prix unitaire de base</th>
                                    <th>Prix unitaire remisé</th>
                                    <th>Magasin</th>
                                   
                                    <th></th>

                                </tr>

                            </thead>
                            <tbody>
                                @forelse($company->companyPrices as $companyPrice)
                                <tr>
                                @if($companyPrice->product->photo_url)
                                    <td> <img src="{{asset('/img')}}/{{$companyPrice->product->photo_url}}" height="80"
                                            class="user-image" alt="User Image"> </td>
                                    @else
                                    <td> <img src="{{asset('/img')}}/no-logo.png" height="80" class="user-image"
                                            alt="User Image"> </td>
                                    @endif
                                    <td>{{$companyPrice->product->nom}}</td>
                                    <td>{{$companyPrice->product->code}}</td>
                                    <td>{{$companyPrice->product->type}}</td>
                                    <td>{{$companyPrice->product->public_price}}</td>
                                    <td>{{$companyPrice->price}}</td>
                                    <td>{{$companyPrice->store->designation}}</td>
                                  
                                    <td class="not-this text-center">

                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">
                                                <li><a
                                                        href="{{route('showUpdateCustomProducts',['company'=>$company->id,'price'=>$companyPrice->id])}}">Modifier</a>
                                                </li>
                                                <li><a href="" data-toggle="modal"
                                                        data-target="#modal-default{{$companyPrice->id}}">Supprimer</a>
                                                </li>
                                            </ul>
                                        </div>
                    </div>
                    </td>
                    </tr>
                    <div class="modal fade" id="modal-default{{$companyPrice->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Voulez cous vraiment supprimer ce produit du tarif?
                                    </h4>
                                </div>

                                <div class="modal-footer">
                                    <div class="text-center">
                                        <form action="{{ route('handleDeleteCustomProduct',$companyPrice->id) }}"
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
                    <tr>
                        <td colspan="5" class="text-center">
                            <h4> Aucun tarif existant !</h4>
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
