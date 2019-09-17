@extends('General.layout')
@section('pageTitle', 'Liste des entrepots')
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
                                    <td>{{ucfirst($warehouse->city)}}</td>
                                    <td>{{$warehouse->postal_code}}</td>
                                    <td class="not-this text-center">
                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">


                                                <li><a
                                                        href="{{ route('showUpdateWarehouse',$warehouse->id) }}">Modifier</a>
                                                </li>
                                                <li><a data-toggle="modal"
                                                        data-target="#modal-default{{$warehouse->id}}">Supprimer</a>
                                                </li>

                                            </ul>

                                            <div class="modal fade" id="modal-default{{$warehouse->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Vous voulez vraiment supprimer cet
                                                            entrepôt ?</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> Ce processus ne peut pas être annulé.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="text-center">
                                                                <form
                                                                    action="{{ route('handleDeleteWarehouse',$warehouse->id) }}"
                                                                    method="post">
                                                                    {{csrf_field()}}
                                                                    <a href="#" class="btn btn-danger"
                                                                        data-dismiss="modal">Annuler</a>
                                                                    <button type="submit"
                                                                        class="btn btn-success">Confirmer</button>
                                                                  


                                                                </form>

                                                            </div>


                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
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
