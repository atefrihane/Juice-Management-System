@extends('General.layoutCompany') @section('pageTitle', 'Ajouter un magasin') @section('content')


    <div class="content-wrapper">

        <section class="content-header">

            {{ Breadcrumbs::render('addStore',$company) }}
        </section>

        <section class="content" style="margin-top:20px;">
            <div class="row">
                <div class="container">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title"> Ajouter un magasin</h3>

                        </div>

                        <form role="form" action="{{route('addStore', $company->id)}}" method="post" enctype="multipart/form-data">
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
                                            <input required class="form-control" id="disabledInput" type="text" placeholder="ID" value="{{$lastStoreId}}" disabled>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code</label>
                                            <input required  required type="text" class="form-control" name="code" id="exampleInputEmail1" placeholder="Code..">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Etat</label>
                                            <select name="status" class="form-control">
                                                <option value="actif">Actif</option>
                                                <option value="non-actif">Non Actif</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom Societé</label>
                                    <input required class="form-control" id="disabledInput" readonly value="{{$company->name}}" type="text" placeholder="Groupe">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Désignation</label>
                                    <input required class="form-control" id="disabledInput" type="text" name="designation" placeholder="Nom Magasin">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Enseigne</label>
                                    <select class="form-control" name="sign">
                                        <option value="Franprix">Franprix</option>
                                        <option value="G20">G20</option>
                                        <option value="Shopi">Shopi</option>
                                        <option value="LECLERC">LECLERC</option>
                                        <option value="Restaurant">Restaurant</option>
                                        <option value="Stand">Stand</option>
                                    </select>


                                </div>



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pays</label>
                                            <select class="form-control" name="country">
                                                <option value="France">France</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ville</label>
                                            <select class="form-control" name="city">
                                                <option value="Paris">Paris</option>
                                                <option value="Lion">Lion</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code Postal</label>
                                            <input required class="form-control" name="zip_code" id="disabledInput" type="text" placeholder="Code Postal">

                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Adresse du magasin</label>
                                    <input required class="form-control" id="disabledInput" type="text" name="address" placeholder="Adresse du Magasin">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Complement(optionnel)</label>
                                    <input required class="form-control" id="disabledInput" type="text" name="complement" placeholder="Complement">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input required class="form-control" id="disabledInput" type="email" name="email" placeholder="Email">

                                </div>
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Telephone</label>
                                            <input required class="form-control" name="cc"  type="text" placeholder="Code pays" value="+33" maxlength="4">

                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" style="color: transparent">*</label>
                                            <input required type="text" name="tel" class="form-control" id="exampleInputEmail1" placeholder="Telephone">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Commentaires (optionnel)</label>
                                    <textarea class="form-control" rows="3" name="comment" placeholder="Commentaires"></textarea>
                                </div>



                                <div class="form-group">
                                    <label for="exampleInputFile"> Photo du magasion (optionnel)</label>
                                    <input  type="file" name="photo" id="exampleInputFile">
                                </div>
                                <label style="font-size: 24px; margin-top: 24px; font-weight: bold;" > Facturation</label>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Type d'envoi des factures</label>
                                            <select class="form-control" name="bill_type">
                                                <option value="Email">Email</option>
                                                <option value="Papier">Papier</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Facture addressée vers</label>
                                            <select class="form-control" name="bill_to">
                                                <option value="Magasin">Magasin</option>
                                                <option value="Societé">Societé</option>
                                                <option value="Magasin et Societé">Magasin et Societé</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row">--}}

                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Heure d'ouverture</label>--}}

                                            {{--<div class="input-group bootstrap-timepicker">--}}
                                                {{--<input required type="text" class="form-control timepicker ">--}}

                                                {{--<div class="input-group-addon">--}}
                                                    {{--<i class="fa fa-clock-o"></i>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<!-- /.input group -->--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Heure de fermeture</label>--}}

                                            {{--<div class="input-group bootstrap-timepicker">--}}
                                                {{--<input required type="text" class="form-control timepicker">--}}

                                                {{--<div class="input-group-addon">--}}
                                                    {{--<i class="fa fa-clock-o"></i>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<!-- /.input group -->--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                {{--</div>--}}

                                <div class="form-group">
                                    <label>Recommendation pour livreur (optionnel)</label>
                                    <textarea class="form-control" rows="3" name="deliveryRec" placeholder="Recommendarion pour liveruer ..."></textarea>
                                </div>

                                <div class="row">
                                    <div class="container text-center">

                                        <a href="{{route('showStores', $company->id)}}" class="btn btn-danger pl-1" style="margin: 1em">Annuler</a>
                                        <button  class="btn btn-success pl-1" type="submit" style="margin: 1em">Confirmer</button>

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
