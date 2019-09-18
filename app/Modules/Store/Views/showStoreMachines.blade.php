@extends('General.layoutStore')
@section('pageTitle', 'Liste des entrepots')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
    {{ Breadcrumbs::render('detailStoreMachines',$store->company,$store->designation) }}

    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des machines en location </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Code</th>
                                    <th>Désignation</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rentals as $rental)
                                <tr>
                                @if($rental->machine->photo_url)
                                    <td> <img src="{{asset('/')}}{{$rental->machine->photo_url}}" height="80" class="user-image"
                                            alt="User Image"> </td>
                                    @else
                                    <td> <img src="{{asset('/img')}}/no-logo.png" height="80" class="user-image"
                                            alt="User Image"> </td>
                                            @endif
                                    <td>{{$rental->machine->code}}</td>
                                    <td>{{$rental->machine->designation}}</td>
                                    <td>{{ucfirst($rental->date_debut)}}</td>
                                    <td>{{$rental->date_fin}}</td>
                                    <td class="not-this text-center">
                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">


                                                <li><a
                                                        href="">Modifier</a>
                                                </li>
                                                <li><a data-toggle="modal"
                                                        data-target="#modal-default{{$rental->id}}">Supprimer</a>
                                                </li>

                                            </ul>

                                            <div class="modal fade" id="modal-default{{$rental->id}}">
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
                                                                    action=""
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
