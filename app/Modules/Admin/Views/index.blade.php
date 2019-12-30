@extends('General.layout')
@section('pageTitle', 'Acceuil')
@section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('admin') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des Admins</h3>
                        <a href="{{route('addAdmin')}}" class="btn btn-primary pull-right">Ajouter un admin</a>


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($admins as $admin)

                                <tr >
                                    <td>{{$admin->user->code}}</td>
                                    <td>{{$admin->user->nom}}</td>
                                    <td>{{$admin->user->prenom}}</td>
                                    <td>{{$admin->user->email}}</td>
                                    <td>
                                        @switch($admin->role->role_name)
                                        @case('DBO')
                                        DBO
                                        @break;
                                        @case('SUPERADMIN')
                                        Super Admin
                                        @break;
                                        @case('ADMIN')
                                        Admin
                                        @break
                                        @case('PREPARATOR')
                                        Préparateur
                                        @break
                                        @case('MAIN_DELIVERY')
                                        Livreur principale
                                        @break
                                        @case('SECOND_DELIVERY')
                                        Livreur
                                        @break

                                        @endswitch      


                                    </td>
                                    <td class="not-this text-center">

                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">
                                                <li><a href="{{route('editAdmin', $admin->id)}}">Modifier</a></li>
                                                <li><a data-toggle="modal" data-target="#modal-default{{$admin->id}}">
                                                        Supprimer</a></li>

                                            </ul>
                                        </div>

                                        <div class="modal fade" id="modal-default{{$admin->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title">Voulez vous vraiment supprimer cet
                                                            admin ?</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p> Ce processus ne peut pas être annulé.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="text-center">
                                                            <form action="{{route('deleteAdmin',$admin->id)}}"
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
                        <td colspan="6" class="text-center"><h4>Aucun Admin !</h4></td>
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
