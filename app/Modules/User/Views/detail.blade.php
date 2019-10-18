@extends('General.layoutCompany') @section('pageTitle', 'Detail contact') @section('content')

<div class="" style="height: 50px; background-color: #ecf0f5;">
</div>

<div class="content-wrapper">
    <section class="content-header">

        {{ Breadcrumbs::render('showContact',$company,$user) }}
    </section>
    <div class="row">
        <div class="container">

            <div class="box box-primary" style="margin-top:50px;">

                <div class="box-header">
                    <div class="box-title">
                        <h1>Détails du contact</h1>
                    </div>

                </div>


                <section class="content" style="margin-top:20px;">
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom & Prénom</label>
                                    <input type="text" class="form-control"
                                        value=" {{ucfirst($user->nom).' '. ucfirst($user->prenom)}}" readonly=""
                                        aria-describedby="emailHelp" placeholder="Code..">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Type</label>
                                    <input type="text" class="form-control" value="{{ucfirst($user->getType())}}"
                                        readonly="" placeholder="Nom du groupe">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="text" class="form-control" value="{{$user->email}}" readonly=""
                                        placeholder="Nom du groupe">
                                </div>

                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Téléphone</label>
                                    <input type="text" class="form-control" value="{{$user->telephone}}" readonly=""
                                        aria-describedby="emailHelp" placeholder="Ville">

                                </div>
                            </div>
                        </div>

                        @switch($user->getType())

                        @case('directeur')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Societé</label>
                                    <input type="text" class="form-control" value="Tout" readonly=""
                                        placeholder="Nom du groupe">
                                </div>

                            </div>

                        </div>
                        @break
                        @case('superviseur')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Superviseur chez</label>
                                    <input type="text" class="form-control" value="{{$store->designation}}" readonly=""
                                        placeholder="Nom du groupe">
                                </div>

                            </div>

                        </div>

                        @break
                        @case('responsable')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Résponsable chez</label>
                                    <input type="text" class="form-control" value="{{$store->designation}}" readonly=""
                                        placeholder="Nom du groupe">
                                </div>

                            </div>

                        </div>


                        @endswitch


                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
