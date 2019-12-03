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
                                        <input class="form-control" id="disabledInput" value="{{$user->id}}" type="text"
                                            disabled>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code</label>
                                        <input type="text" name="code" value="{{$user->code}}" class="form-control"
                                            id="exampleInputEmail1" placeholder="Code..">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nom societé</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" readonly
                                            value="{{$company->name}}" placeholder="nom societé..">
                                    </div>
                                </div>



                            </div>




                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nom</label>
                                        <input class="form-control" value="{{$user->nom}}" name="nom" id="disabledInput"
                                            type="text" placeholder="Nom">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Prénom</label>
                                        <input class="form-control" value="{{$user->prenom}}" name="prenom"
                                            id="disabledInput" type="text" placeholder="Prénom">

                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label>Sexe</label>
                                <select class="form-control" name="civilite">
                                    <option value="Homme" @if($user->civilite == 'Homme')
                                        selected
                                        @endif
                                        >Homme</option>
                                    <option value="Femme" @if($user->civilite == 'Femme')
                                        selected
                                        @endif
                                        >Femme</option>
                                </select>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input class="form-control" value="{{$user->email}}" name="email"
                                            id="disabledInput" type="email" placeholder="Nom">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Téléphone</label>
                                        <input class="form-control" value="{{$user->telephone}}" name="telephone"
                                            id="disabledInput" type="phone" placeholder="Téléphone">

                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Code d'accés</label>
                                <input class="form-control" value="{{$user->accessCode}}" name="accessCode"
                                    id="disabledInput" type="text" placeholder="Code d'accés">

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Mot de passe</label>
                                <input class="form-control" name="password" id="disabledInput" type="text"
                                    placeholder="Mot de passe" value="{{$user->password}}" required>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type de contact</label>
                                <select class="form-control type" name="type" value="{{old('type')}}">
                                    <option value="responsable" @if($user->getType() == 'responsable') selected
                                        @endif>Responsable</option>
                                    <option value="supervisor" @if($user->getType() == 'superviseur') selected
                                        @endif>Superviseur/Autre</option>

                                </select>

                            </div>

                            <div class="form-group responsable_hidden" style="display:none;">
                                <label for="exampleInputEmail1">Magasins de responsabilités</label>
                                @foreach ($company->stores as $store)
                                <div class="form-group">
                                    <div class="checkbox">

                                        <label>
                                            <input type="radio" value="{{$store->id}}" name="responsableHidden">
                                            {{$store->designation}}
                                        </label>


                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="form-group magasins supervisor_hidden" style="display:none;">

                                <label for="exampleInputEmail1">Magasins à superviser </label>
                                <div class="form-check" style="margin: 10px 0px 20px;">
                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                    Tout séléctionner
                                </div>
                                <div class="scrollable">

                                    @foreach($company->stores as $store)
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="willCheck" name="storesHidden[]"
                                                    value="{{$store->id}}">
                                                {{$store->designation}}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            @if($user->getType() == 'responsable')

                            <div class="form-group magasins responsable">
                                <label for="exampleInputEmail1">Magasins de responsabilités</label>
                                @foreach ($company->stores as $store)
                                <div class="form-group">
                                    <div class="checkbox">

                                        <label>
                                            <input type="radio" value="{{$store->id}}" name="store"
                                                @if($user->child->store_id == $store->id) checked @endif>
                                            {{$store->designation}}
                                        </label>


                                    </div>
                                </div>
                                @endforeach
                            </div>

                            @else
                            <div class="form-group magasins supervisor">
                                @if($user->child->stores->count() > 0)

                                <label for="exampleInputEmail1">Magasins supervisés </label>
                                <div class="form-check" style="margin: 10px 0px 20px;">
                                    <div class="form-check" style="margin: 10px 0px 20px;">

                                        @foreach($user->child->stores as $key => $store)
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="" name="stores[]"
                                                        value="{{$store->id}}" checked>
                                                    {{$store->designation}}
                                                </label>
                                            </div>
                                        </div>



                                        @endforeach

                                        @else
                                        <div class="box-body">
                                            <p>Aucun magasin trouvé !</p>
                                        </div>
                                        @endif
                                        @endif

                                        @if(count($freeStores) > 0)


                                        <label for="exampleInputEmail1">Autres magasins </label>
                                        <div class="form-check" style="margin: 10px 0px 20px;">
                                            <input type="checkbox" class="form-check-input" id="selectAll">
                                            Tout séléctionner
                                        </div>
                                        <div class="scrollable">
                                            @foreach($freeStores as $store)
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="willCheck" name="newStores[]"
                                                            value="{{$store->id}}">
                                                        {{$store->designation}}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>


                                    @endif


                                </div>

                                <div class="row">
                                    <div class="container text-center">

                                        <a href="{{route('showContacts', $company->id)}}" class="btn btn-danger pl-1"
                                            style="margin: 1em">Annuler</a>
                                        <button type="submit" class="btn btn-success pl-1"
                                            style="margin: 1em">Confirmer</button>

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
@section('custom')

<script>
    $('document').ready(function () {
        // $('.responsable_hidden').hide()
        $('.type').change(function () {
            switch ($(this).val()) {
                case 'responsable':

                    if ($(".supervisor")[0]) {
                        $('.supervisor').css('display', 'none')
                    } else {
                        $('.supervisor_hidden').css('display', 'none')
                    }


                    if ($(".responsable")[0]) {
                        $('.responsable').show()
                    } else {
                        $('.responsable_hidden').css('display', 'block')
                    }


                    break;
                case 'supervisor':
                    // $('.responsable').css('display', 'none')
                    if ($(".responsable")[0]) {
                        $('.responsable').css('display', 'none')
                    } else {
                        $('.responsable_hidden').css('display', 'none')
                    }
                    if ($(".supervisor")[0]) {
                        $('.supervisor').show()
                    } else {
                        $('.supervisor_hidden').css('display', 'block')
                        
                    }


                    break;
            }

        })


    })

</script>
@endsection
