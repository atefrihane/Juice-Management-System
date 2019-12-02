@extends('General.layout')
@section('pageTitle', 'Ajouter une societé')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('company') }}

    </section>


    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Ajouter une societé</h3>

                    </div>


                    <form role="form" action="{{route('handleAddCompany')}}" method="post"
                        enctype="multipart/form-data">
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
                                        <input required class="form-control" id="disabledInput" type="text"
                                            placeholder="{{$lastCompanyId}}" disabled>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code</label>
                                        <input required type="text" class="form-control code" name="code"
                                            id="exampleInputEmail1" placeholder="Code" value="{{old('code')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Statut</label>
                                        <select class="form-control" name="status" value="{{old('status')}}">
                                            <option value="2">Active</option>
                                            <option value="1">En sommeil</option>
                                            <option value="0">Fermé</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nom du groupe</label>
                                        <input required type="text" class="form-control" name="name"
                                            id="exampleInputPassword1" placeholder="Nom du groupe"
                                            value="{{old('name')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Désignation</label>
                                        <input required type="text" class="form-control designation" name="designation"
                                            id="exampleInputPassword1" placeholder="Désignation"
                                            value="{{old('designation')}}" pattern=".{6,}" title="6 caractères minimum">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Addresse du siege</label>
                                        <input required type="text" name="address" class="form-control"
                                            id="exampleInputPassword1" placeholder="Addresse du siege"
                                            value="{{old('address')}}">
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Complement addresse (optionnel)</label>
                                        <input type="text" name="complement" class="form-control"
                                            id="exampleInputPassword1" placeholder="Complement addresse"
                                            value="{{old('complement')}}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pays</label>
                                        <select class="form-control country" name="country_id"
                                            value="{{old('country_id')}}">
                                            <option value="" selected disabled>Séléctionner un pays</option>
                                            @forelse($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ville</label>
                                        <select class="form-control cities" name="city_id">
                                            <option value="" selected disabled>Séléctionner une ville</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Code Postal</label>
                                        <select class="form-control zipcodes" name="zipcode_id">
                                            <option value="" selected disabled>Séléctionner un code postal</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Email</label>
                                        <input required type="email" name="email" class="form-control"
                                            id="exampleInputPassword1" placeholder="Email" value="{{old('email')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Téléphone</label>
                                        <input required class="form-control cc" name="cc" type="text"
                                            placeholder="Code pays" value="" maxlength="4" value="{{old('cc')}}" required>

                                    </div>
                                </div>

                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" style="opacity: 0">Téléphone</label>
                                        <input required type="tel" name="tel" class="form-control"
                                            id="exampleInputEmail1" placeholder="Téléphone" value="{{old('tel')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Commentaires (optionnel)</label>
                                <textarea class="form-control" rows="3" name="comment"
                                    placeholder="Commentaires">{{old('comment')}}</textarea>
                            </div>
                            <div class="row">
                                <div class="container">

                                </div>
                            </div>
                            <div class="container center-block">
                                <div class="form-group">
                                    <label for="exampleInputFile">Logo du societé (optionnel)</label>
                                    <input type="file" name="logo" id="exampleInputFile" value="{{old('logo')}}">
                                </div>
                                <small>Les formats supportés pour l'importation du logo sont : PNG,JPEG,JPG,SVG</small>

                                <div class="row">
                                    <div class="container text-center">

                                        <a href="{{route('showHome')}}" class="btn btn-danger pl-1"
                                            style="margin: 1em">Annuler</a>
                                        <button type="submit" class="btn btn-success pl-1"
                                            style="margin: 1em">Confirmer</button>

                                    </div>
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
