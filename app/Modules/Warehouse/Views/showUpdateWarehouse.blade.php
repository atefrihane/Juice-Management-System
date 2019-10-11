@extends('General.layout')
@section('pageTitle', 'Modifier un entrepôt')
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('updateWarhouse') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Modifier un entrepôt</h3>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data"
                        action="{{route('handleUpdateWarehouse',$checkWarehouse->id)}}">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">ID</label>
                                    <input type="text" name="id" class="form-control" value="{{$checkWarehouse->id}}"
                                        disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Code</label>
                                    <input type="text" name="code" class="form-control code" placeholder="Code..."
                                        value="{{$checkWarehouse->code}}" required>
                                </div>

                                <div class="col-md-4">
                                    <label>Résponsable</label>
                                    <select class="form-control country" name="user_id" value="{{old('country_id')}}"
                                        required>
                                        <option value="">Séléctionner un résponsable</option>
                                        @forelse($users as $user)
                                        <option value="{{$user->id}}"
                                            {{ $user->id == $checkWarehouse->user_id ? "selected" : "" }}>
                                            {{ucfirst($user->nom)}} {{ucfirst($user->prenom)}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Désignation</label>
                                    <input type="text" name="designation" class="form-control designation"
                                        placeholder="Désignation" value="{{$checkWarehouse->designation}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pays</label>
                                        <select class="form-control country" name="country_id" required>

                                            @forelse($countries as $country)
                                            <option value="{{$country->id}}"
                                                {{ $country->id == $checkWarehouse->country_id ? "selected" : "" }}>
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
                                                {{ $city->id == $checkWarehouse->city_id ? "selected" : "" }}>
                                                {{$city->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Code Postal</label>
                                        <select class="form-control zipcodes" name="zipcode_id" required>
                                            @forelse($zipcodes as $zipcode)
                                            <option value="{{$zipcode->id}}"
                                                {{ $zipcode->id == $checkWarehouse->zipcode_id ? "selected" : "" }}>
                                                {{$zipcode->code}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                </div>


                            </div>
                        </div>



                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Addresse</label>
                                    <input type="text" name="address" class="form-control" placeholder="Addresse"
                                        value="{{$checkWarehouse->address}}" required>
                                </div>
                            </div>
                        </div>


                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Complement d'addresse</label>
                                    <input type="text" name="complement_address" class="form-control"
                                        placeholder="Complement d'addresse"
                                        value="{{$checkWarehouse->complement_address}}">
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Surface ( en m²)</label>
                                    <input type="number" name="surface" class="form-control" placeholder="Surface"
                                        value="{{$checkWarehouse->surface}}" required>
                                </div>
                            </div>
                        </div>


                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Commentaire(optionnel)</label>
                                    <textarea class="form-control" rows="3" name="comment" placeholder="Commentaire"
                                        value="{{$checkWarehouse->comment}}">{{$checkWarehouse->comment}}</textarea>
                                </div>
                            </div>
                        </div>



                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Photo de l'entrepot (optionnelle)</label>
                                    <input type="file" class="form-control" name="photo">
                                </div>
                            </div>
                        </div>





                        <div class="row">
                            <div class="container text-center">

                                <a href="{{route('showWarehouses')}}" class="btn btn-danger pl-1"
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


@endsection
