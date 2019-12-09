@extends('General.layoutCompany') @section('pageTitle', 'Ajouter une contact') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addContact',$company) }}
    </section>

    <section class="content" style="margin-top:20px;">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Ajouter un contact</h3>

                    </div>

                    <form role="form" action="{{route('storeClient', $company->id)}}" method="post">
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
                                        <label for="exampleInputEmail1">Code</label>
                                        <input type="text" name="code" class="form-control" id="exampleInputEmail1"
                                            placeholder="Code.." value="{{ old('code') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                        <input class="form-control" name="nom" id="disabledInput" type="text"
                                            placeholder="Nom" value="{{old('nom')}}">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Prénomm</label>
                                        <input class="form-control" name="prenom" id="disabledInput" type="text"
                                            placeholder="Prénom" value="{{old('prenom')}}">

                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Civilité</label>
                                <select class="form-control" name="civilite" value="{{old('civilite')}}">
                                    <option value="MM">M.</option>
                                    <option value="MMe">Mme.</option>
                                    <option value="Mlle">Mlle.</option>
                                </select>

                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input class="form-control" name="email" id="disabledInput" type="Email"
                                            placeholder="Email" value="{{old('email')}}">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Téléphone</label>
                                        <input class="form-control" name="telephone" id="disabledInput" type="phone"
                                            placeholder="Téléphone" value="{{old('telephone')}}">

                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Type de contact</label>
                                <select class="form-control" onchange="changeInputs(this)" name="type"
                                    value="{{old('type')}}">
                                    <option value="responsable">Responsable</option>
                                    <option value="supervisor">Superviseur/Autre</option>

                                </select>

                            </div>

                            <div class="form-group magasins responsable">
                                <label for="exampleInputEmail1">Magasins de responsabilités</label>
                                @foreach ($company->stores as $store)
                                <div class="form-group">
                                    <div class="checkbox">

                                        <label>
                                            <input type="radio" value="{{$store->id}}" name="store">
                                            {{$store->designation}}
                                        </label>


                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group magasins supervisor" hidden>

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
                                            <input type="checkbox" class="willCheck" name="stores[]"
                                                value="{{$store->id}}">
                                            {{$store->designation}}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            </div>
                            <div class="form-group magasins director" hidden>
                                <label for="exampleInputEmail1">Magasins </label>
                                @foreach($company->stores as $store)
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input checked disabled type="checkbox" name="stores[]"
                                                value="{{$store->id}}">
                                            {{$store->designation}}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Code d'accés</label>
                                <input class="form-control" name="accessCode" id="disabledInput" type="text"
                                    placeholder="Code d'accés" value="{{old('accessCode')}}">

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Mot de passe</label>
                                <input class="form-control" name="passWord" id="disabledInput" type="text"
                                    placeholder="Mot de passe" value="{{old('passWord')}}">

                            </div>


                            <div class="form-group">
                                <label>Commentaire (optionnel)</label>
                                <textarea class="form-control" rows="3" name="comment"
                                    placeholder="Commentaires">{{old('comment')}}</textarea>
                            </div>


                            <div class="row">
                                <div class="container text-center">

                                    <a href="{{route('showContacts', $company->id)}}" class="btn btn-danger pl-1"
                                        style="margin: 1em">Annuler</a>
                                    <button type="submit" class="btn btn-success pl-1"
                                        style="margin: 1em">Confirmer</button>

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
<script>
    function changeInputs(x) {
        let elements = document.getElementsByClassName('magasins');

        for (let i = 0; i < elements.length; i++)
            if (!elements[i].classList.contains(x.value))
                elements[i].hidden = true;
            else
                elements[i].hidden = false;

    }

</script>


@endsection


