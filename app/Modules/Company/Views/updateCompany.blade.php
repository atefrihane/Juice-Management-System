@extends('General.layout')
@section('pageTitle', 'Modifier societé')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('editCompany') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Modifier societé</h3>

                    </div>


                    <form role="form" action="{{route('updateCompany', $company->id)}}" method="post"
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
                                        <input class="form-control" id="disabledInput" type="text"
                                            value="{{$company->id}}" disabled>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code</label>
                                        <input type="text" class="form-control code" value="{{$company->code}}" name="code"
                                            id="exampleInputEmail1" placeholder="Code..">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Statut</label>
                                        <select class="form-control" name="status">

                                            <option {{$company->status == 2 ? 'selected': ''}} value="2">Active</option>
                                            <option {{$company->status == 1 ? 'selected': ''}} value="1">En sommeil
                                            </option>
                                            <option {{$company->status == 0 ? 'selected': ''}} value="0">Fermé</option>
                                        </select>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Nom du groupe</label>
                                <input type="text" class="form-control" value="{{$company->name}}" name="name"
                                    id="exampleInputPassword1" placeholder="Nom du groupe">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Désignation</label>
                                <input type="text" class="form-control designation" name="designation"
                                    value="{{$company->designation}}" id="exampleInputPassword1"
                                    placeholder="Désignation" pattern=".{6,}" title="6 caractères minimum">
                            </div>


                            <div class="row">

                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Code Postal</label>
                                        <select class="form-control zipcodes" name="zipcode_id" required>
                                            @forelse($zipcodes as $zipcode)
                                            <option value="{{$zipcode->id}}"
                                                {{ $zipcode->id == $company->zipcode_id ? "selected" : "" }}>
                                                {{$zipcode->code}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pays</label>
                                        <select class="form-control country" name="country_id" required>

                                            @forelse($countries as $country)
                                            <option value="{{$country->id}}"
                                                {{ $country->id == $company->country_id ? "selected" : "" }}>
                                                {{$country->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ville</label>
                                        <select class="form-control cities" name="city_id" required>
                                            @forelse($cities as $city)
                                            <option value="{{$country->id}}"
                                                {{ $city->id == $company->city_id ? "selected" : "" }}>
                                                {{$city->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Addresse du siege</label>
                                <input type="text" name="address" value="{{$company->address}}" class="form-control"
                                    id="exampleInputPassword1" placeholder="Addresse du siege">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Complement addresse (optionnel)</label>
                                <input type="text" name="complement" value="{{$company->complement}}"
                                    class="form-control" id="exampleInputPassword1" placeholder="Complement addresse">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input type="email" name="email" value="{{$company->email}}" class="form-control"
                                    id="exampleInputPassword1" placeholder="Email">
                            </div>
                            <div class="row">



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Téléphone</label>
                                        <input type="text" name="tel" value="{{$company->tel}}" class="form-control"
                                            id="exampleInputEmail1" placeholder="Telephone">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Commentaires (optionnel)</label>
                                <textarea class="form-control" rows="3" name="comment"
                                    placeholder="Commentaires">{{$company->comment}}</textarea>
                            </div>
                            <div class="row">
                                <div class="container">

                                </div>
                            </div>
                            <div class="container center-block">
                                <div class="form-group">
                                    <label for="exampleInputFile">Logo du societé (optionnel)</label>
                                    <input type="file" name="logo" id="exampleInputFile">


                                </div>

                                <div class="row">
                                    <div class="container text-center">

                                        <a href="{{route('showHome')}}" class="btn btn-danger pl-1"
                                            style="margin: 1em">Annuler</a>
                                        <button type="submit" class="btn btn-success pl-1"
                                            style="margin: 1em">Modifier</button>

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
