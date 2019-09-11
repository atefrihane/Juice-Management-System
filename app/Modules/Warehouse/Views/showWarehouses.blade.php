@extends('General.layout')
@section('pageTitle', 'Liste des produits')
@section('content')

<div class="content-wrapper">

    <section class="content-header">


        {{ Breadcrumbs::render('warhouses') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des entrepôts</h3>
                        <a href="{{route('showAddWarehouse')}}" class="btn btn-primary pull-right">Ajouter un
                            entrepôt</a>


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>

                                    <th>Code</th>
                                    <th>Désignation</th>
                                    <th>Ville</th>
                                    <th>Code postal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($warehouses as $warehouse)
                                <tr>
                                    <td>{{$warehouse->code}}</td>
                                    <td>{{$warehouse->designation}}</td>
                                    <td>{{$warehouse->city}}</td>
                                    <td>{{$warehouse->postal_code}}</td>
                                    <td class="not-this">
                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">


                                                <li><a href="#">Modifier</a></li>
                                                <li><a href="#">Supprimer</a></li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <h4>Aucun entrepot existant !</h4>
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
<script>
    $('document').ready(function () {

        $('.treeview-menu').css('display', 'block');

    });

</script>


@endsection
