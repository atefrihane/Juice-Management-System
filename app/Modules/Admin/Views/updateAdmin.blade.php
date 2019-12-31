@extends('General.layout')
@section('pageTitle', 'Modifier un admin')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            {{ Breadcrumbs::render('editAdmin') }}

        </section>


        <section class="content">
            <div class="row">
                <div class="container">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title"> Modifier un admin</h3>

                        </div>


                        <form role="form" action="{{route('updateAdmin', $admin->id)}}" method="post">
                            {{csrf_field()}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ID</label>
                                            <input class="form-control" id="disabledInput" type="text" value="{{$admin->id}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Role</label>
                                            <select class="form-control" name="role" disabled>
                                                @foreach($roles as $role)
                                                @if($role->id != 1)
                                                <option value="{{$role->id}}" @if($role->id == $admin->role_id) selected @endif>
                                                    @switch($role->role_name)
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
                                              
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code</label>
                                            <input type="text" class="form-control" value="{{$admin->user->code}}" name="code" id="exampleInputEmail1" placeholder="Code..">
                                        </div>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nom</label>
                                            <input type="text" class="form-control" value="{{$admin->user->nom}}" name="nom" id="exampleInputPassword1" placeholder="Nom">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Prenom</label>
                                            <input type="text" class="form-control" name="prenom" value="{{$admin->user->prenom}}" id="exampleInputPassword1" placeholder="Prenom">
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Civilité</label>
                                            <select class="form-control" name="sexe">
                                                <option value="MM"
                                                        @if($admin->user->civilite == 'MM')
                                                        selected
                                                    @endif
                                                >MM</option>
                                                <option value="MME"
                                                        @if($admin->user->civilite == 'MME')
                                                        selected
                                                    @endif
                                                >MME</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{$admin->user->email}}" id="exampleInputPassword1" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Telephone</label>
                                            <input type="text" class="form-control" name="telephone" value="{{$admin->user->telephone}}" id="exampleInputPassword1" placeholder="Telephone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Code d'accés</label>
                                            <input type="text" class="form-control" name="accessCode" value="{{$admin->user->accessCode}}" id="exampleInputPassword1" placeholder="Code d'accés">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Mot de passe</label>
                                            <input type="text" class="form-control" name="passWord" value="{{$admin->user->password}}"  id="exampleInputPassword1" placeholder="Mot de passe">
                                        </div>
                                    </div>

                                </div>

                                <div class="container center-block">


                                    <div class="row">
                                        <div class="container text-center">

                                            <a href="{{route('admin')}}" class="btn btn-danger pl-1" style="margin: 1emr">Annuler</a>
                                            <button type="submit" href="" class="btn btn-success pl-1" style="margin: 1emr">Modifier</button>

                                        </div>
                                    </div>





                                </div>

                        </form>
                    </div>

                    <!-- /.col -->
                </div>

            </div>

        </section>

    </div>
@endsection
