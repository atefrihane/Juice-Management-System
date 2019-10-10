@extends('General.layout')
@section('pageTitle', 'Ajouter un entrepôt')
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addWarhouse') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Ajouter un entrepôt</h3>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data"
                        action="{{route('handleAddWarehouse')}}">
                        {{csrf_field()}}


                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">ID</label>
                                    <input type="text" name="id" class="form-control" value="{{$count}}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Code</label>
                                    <input type="text" name="code" class="form-control code" placeholder="Code" value=""
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Désignation</label>
                                    <input type="text" name="designation" class="form-control designation"
                                        placeholder="Désignation" required>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Code Postal</label>
                                        <select class="form-control zipcodes" name="zipcode_id"
                                            value="{{old('zipcode_id')}}" required>
                                            <option value="">Selectionner un code postal</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pays</label>
                                        <select class="form-control country" name="country_id"
                                            value="{{old('country_id')}}" required>
                                            <option value="">Séléctionner un pays</option>
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
                                        <select class="form-control cities" name="city_id" value="{{old('city_id')}}"
                                            required>
                                            <option value="">Selectionner une ville</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Surface ( en m²)</label>
                                    <input type="number" name="surface" class="form-control" placeholder="Surface"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Addresse</label>
                                    <input type="text" name="address" class="form-control" placeholder="Addresse"
                                        required>
                                </div>
                            </div>
                        </div>


                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Complement d'addresse</label>
                                    <input type="text" name="complement" class="form-control"
                                        placeholder="Complement d'addresse">
                                </div>
                            </div>
                        </div>


                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Commentaire(optionnel)</label>
                                    <textarea class="form-control" rows="3" name="comment"
                                        placeholder="Commentaire"></textarea>
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

                                <a href="{{route('showMachines')}}" class="btn btn-danger pl-1"
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
