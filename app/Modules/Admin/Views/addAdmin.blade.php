@extends('General.layout')
@section('pageTitle', 'Ajouter un compte')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            {{ Breadcrumbs::render('addAdmin') }}

        </section>


        <section class="content">
            <div class="row">
                <div class="container">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title"> Ajouter un compte</h3>

                        </div>


                        <form role="form" action="{{route('adminStore')}}" method="post">
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

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Role</label>
                                            <select class="form-control" name="role" required>
                                                @foreach($roles as $role)
                                                    @if($role->id != 1)
                                                    <option value="{{$role->id}}" {{old('role') ==$role->id ? 'selected' : ''}}>
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
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="exampleInputEmail1">Code</label>
                                            <input type="text" class="form-control" name="code" id="exampleInputEmail1" placeholder="Code.." value="{{old('code')}}" required>
                                        </div>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nom</label>
                                            <input type="text" class="form-control" name="nom" id="exampleInputPassword1" placeholder="Nom" value="{{old('nom')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Prenom</label>
                                            <input type="text" class="form-control" name="prenom" id="exampleInputPassword1" placeholder="Prenom" value="{{old('prenom')}}" required>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Civilité</label>
                                            <select class="form-control" name="sexe" value="{{old('sexe')}}" required>
                                                <option value="M">M</option>
                                                <option value="Mme">Mme</option>
                                                
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email</label>
                                            <input type="email" class="form-control" name="email" id="exampleInputPassword1" placeholder="Email" value="{{old('email')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Telephone</label>
                                            <input type="text" class="form-control" name="telephone" id="exampleInputPassword1" placeholder="Telephone" value="{{old('telephone')}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Code d'accés</label>
                                            <input type="text" class="form-control" name="accessCode" id="exampleInputPassword1" placeholder="Code d'accés" value="{{old('accessCode')}}" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Mot de passe</label>
                                            <input type="text" class="form-control" name="passWord" id="exampleInputPassword1" placeholder="Mot de passe" value="{{old('password')}}" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="container center-block">


                                    <div class="row">
                                        <div class="container text-center">

                                            <a href="{{route('admin')}}" class="btn btn-danger pl-1" style="margin: 1em">Annuler</a>
                                            <button type="submit" href="" class="btn btn-success pl-1" style="margin: 1em">Ajouter </button>

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
