@extends('General.layoutCompany')
@section('pageTitle', 'Liste des contacts')
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
                            class="btn btn-primary pull-right">Ajouter un produit</a>


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th>Nom produit</th>
                                    <th>Code produit</th>
                                    <th>Type de produit</th>
                                    <th>Prix unitaire de base</th>
                                    <th>Prix unitaire pour societé</th>

                                </tr>

                            </thead>
                            <tbody>
                            @forelse($company->companyPrices as $companyPrice)
                                <tr>
                                    <td>{{$companyPrice->product->nom}}</td>
                                    <td>{{$companyPrice->product->code}}</td>
                                    <td>{{$companyPrice->product->type}}</td>
                                    <td>{{$companyPrice->product->public_price}}</td>
                                    <td>{{$companyPrice->price}}</td>
                                    <td class="not-this">

                                    <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">
                                                <li><a href="#">Modifier</a></li>
                                                <li><a href="#">Supprimer</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    </td>
                                    </tr>
                    @empty
                    <tr>
                    <td colspan="5" class="text-center">  <h4> Aucun tarif existant !</h4></td>
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
