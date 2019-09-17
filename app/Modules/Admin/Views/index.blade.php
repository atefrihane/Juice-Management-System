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
                            <table  class="table table-bordered table-hover example2" style="width:100%;">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($admins as $admin)

                                    <tr class="table-tr">
                                        <td >{{$admin->user->code}}</td>
                                        <td >{{$admin->user->nom}}</td>
                                        <td >{{$admin->user->prenom}}</td>
                                        <td >{{$admin->user->email}}</td>
                                        <td >{{$admin->role->role_name}}</td>
                                        <td class="not-this text-center">

                                            <div class="btn-group">
                                                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                <ul class="dropdown-menu edit" role="menu">
                                                    <li><a href="{{route('editAdmin', $admin->id)}}">Modifier</a></li>
                                                    <li><a href="#">Annuler</a></li>
                                                    <li><a href="{{route('deleteAdmin', $admin->id)}}">Supprimer</a></li>

                                                </ul>
                                            </div>




                        </div>
                        </td>

                        </tr>

                        @empty
                            <tr>
                                <p>Aucune societé !</p>
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
