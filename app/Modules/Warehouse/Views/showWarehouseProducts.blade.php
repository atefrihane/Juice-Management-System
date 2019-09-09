@extends('General.layout')
@section('pageTitle', 'Liste des produits')
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('productWarehouse') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des produits</h3>
                        <a href="{{route('showAddProductQuantity')}}" class="btn btn-primary pull-right">Ajouter une quantité de produit</a>


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>

                                    <th>Nom Produit</th>
                                    <th>Quantité(nbr des unités)</th>
                                    <th>Entrepot</th>
                                    <th>Date de fabrication</th>
                                    <th>Date d'expiration</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Jus fraise</td>
                                    <td>250</td>
                                    <td>B</td>
                                    <td>02/10/2018</td>
                                    <td>02/10/2019</td>
                                    <td class="not-this">
                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">

                                                <li><a href="#">Voir detail produit</a></li>
                                                <li><a href="#">Modifier</a></li>
                                                <li><a href="#">Supprimer</a></li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Jus fraise</td>
                                    <td>350</td>
                                    <td>C</td>
                                    <td>03/10/2018</td>
                                    <td>03/10/2019</td>
                                    <td class="not-this">
                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">

                                                <li><a href="#">Voir detail produit</a></li>
                                                <li><a href="#">Modifier</a></li>
                                                <li><a href="#">Supprimer</a></li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>



                                <tr>
                                    <td>Jus fraise</td>
                                    <td>150</td>
                                    <td>A</td>
                                    <td>04/10/2018</td>
                                    <td>03/10/2019</td>
                                    <td class="not-this">
                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">

                                                <li><a href="#">Voir detail produit</a></li>
                                                <li><a href="#">Modifier</a></li>
                                                <li><a href="#">Supprimer</a></li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>

                        </table>
                    </div>

                </div>


            </div>

        </div>

    </section>

</div>

<script>
$('document').ready(function(){

  $('.treeview-menu').css('display','block');

});
</script>


@endsection
