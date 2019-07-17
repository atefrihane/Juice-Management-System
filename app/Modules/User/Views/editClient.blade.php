@extends('General.layoutCompany') @section('pageTitle', 'Modifer un contact') @section('content')


    <div class="content-wrapper">

        <section class="content-header">

            {{ Breadcrumbs::render('addContact',$company) }}
        </section>

        <section class="content" style="margin-top:20px;">
            <div class="row">
                <div class="container">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title"> Modifier un contact</h3>

                        </div>

                        <form role="form" action="{{route('updateClient', [$company->id, $user->id])}}" method="post">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ID</label>
                                            <input class="form-control" id="disabledInput" value="{{$user->id}}" type="text" disabled>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code</label>
                                            <input type="text" name="code" value="{{$user->code}}" class="form-control" id="exampleInputEmail1" placeholder="Code..">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nom societé</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" readonly value="{{$company->name}}" placeholder="nom societé..">
                                        </div>
                                    </div>



                                </div>




                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nom</label>
                                            <input class="form-control"  value="{{$user->nom}}" name="nom" id="disabledInput" type="text" placeholder="Nom">

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Prénom</label>
                                            <input class="form-control"  value="{{$user->prenom}}" name="prenom" id="disabledInput" type="text" placeholder="Prénom">

                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>Sexe</label>
                                    <select class="form-control" name="civilite">
                                        <option value="Homme"
                                                @if($user->civilite == 'Homme')
                                                selected
                                            @endif
                                        >Homme</option>
                                        <option value="Femme"
                                                @if($user->civilite == 'Femme')
                                                selected
                                            @endif
                                        >Femme</option>
                                    </select>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input class="form-control" value="{{$user->email}}"  name="email" id="disabledInput" type="email" placeholder="Nom">

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Téléphone</label>
                                            <input class="form-control"  value="{{$user->telephone}}" name="telephone" id="disabledInput" type="phone" placeholder="Téléphone">

                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Code d'accés</label>
                                    <input class="form-control"  value="{{$user->accessCode}}" name="accessCode" id="disabledInput" type="text" placeholder="Code d'accés">

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mot de passe</label>
                                    <input class="form-control" name="password" id="disabledInput" type="password" placeholder="Mot de passe">

                                </div>


                                <div class="row">
                                    <div class="container text-center">

                                        <a href="" class="btn btn-danger pl-1">Annuler</a>
                                        <button type="submit" class="btn btn-success pl-1">Confirmer</button>

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
    {{--<script>--}}
        {{--function changeInputs(x){--}}
            {{--let elements = document.getElementsByClassName('magasins');--}}

            {{--for (let i =0 ; i<elements.length; i++)--}}
                {{--if(!elements[i].classList.contains(x.value))--}}
                    {{--elements[i].hidden = true;--}}
                {{--else--}}
                    {{--elements[i].hidden = false;--}}

        {{--}--}}
    {{--</script>--}}
@endsection
