@extends('General.layoutCompany') @section('pageTitle', 'Modifier un magasin') @section('content')


    <div class="content-wrapper">

        <section class="content-header">

            {{ Breadcrumbs::render('addStore',$company) }}
        </section>

        <section class="content" style="margin-top:20px;">
            <div class="row">
                <div class="container">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title"> Modifier un magasin</h3>

                        </div>

                        <form role="form" action="{{route('updateStore', $store->id)}}" method="post" enctype="multipart/form-data">
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
                                            <input class="form-control" id="disabledInput" type="text" placeholder="ID" value="{{$store->id}}" disabled>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code</label>
                                            <input type="text" class="form-control" name="code" value="{{$store->code}}" id="exampleInputEmail1" placeholder="Code..">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Etat</label>
                                            <select name="status" class="form-control">
                                                <option value="actif"
                                                @if($store->status == 'actif')
                                                    selected
                                                @endif
                                                >Actif</option>
                                                <option value="non-actif"
                                                    @if($store->status == 'non-actif')
                                                        selected
                                                    @endif>Non Actif</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom Societé</label>
                                    <input class="form-control" id="disabledInput" value="{{$company->name}}" type="text" placeholder="Groupe">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Désignation</label>
                                    <input class="form-control" id="disabledInput" type="text" value="{{$store->designation}}" name="designation" placeholder="Nom Magasin">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Enseigne</label>
                                    <select class="form-control" name="sign">
                                        <option value="Franprix"
                                        @if($store->sign == 'Franprix')
                                            selected
                                        @endif
                                        >Franprix</option>
                                        <option value="G20"
                                        @if($store->sign == 'G20')
                                            selected
                                        @endif
                                        >G20</option>
                                        <option value="Shopi"
                                        @if($store->sign == 'Shopi' )
                                            selected
                                        @endif
                                        >Shopi</option>
                                        <option value="LECLERC"
                                        @if($store->sign == 'LECLERC')
                                            selected
                                        @endif
                                        >LECLERC</option>
                                        <option value="Restaurant"
                                        @if($store->sign == 'Restaurant' )
                                            selected
                                        @endif
                                        >Restaurant</option>
                                        <option value="Stand"
                                        @if($store->sign =='Stand' )
                                            selected
                                        @endif
                                        >Stand</option>
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
                                                <option value="Paris"
                                                @if($store->city == 'Paris')
                                                    selected
                                                @endif
                                                >Paris</option>
                                                <option value="Lyon"
                                                @if($store->city == 'Lyon')
                                                    selected
                                                @endif
                                                >Lyon</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code Postal</label>
                                            <input class="form-control" name="zip_code" id="disabledInput" value="{{$store->zip_code}}" type="text" placeholder="Code Postal">

                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Adresse du magasin</label>
                                    <input class="form-control" id="disabledInput" type="text" value="{{$store->address}}" name="address" placeholder="Nom Magasin">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Complement(optionnel)</label>
                                    <input class="form-control" id="disabledInput" type="text" value="{{$store->complement}}" name="complement" placeholder="Nom Magasin">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input class="form-control" id="disabledInput" type="email" value="{{$store->email}}" name="email" placeholder="Nom Magasin">

                                </div>
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Telephone</label>
                                            <input class="form-control" name="cc"   type="text" placeholder="Code pays" value="{{explode(' ', $store->tel)[0]}}" maxlength="4">

                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" style="color: transparent">*</label>
                                            <input type="number" name="tel" value="{{explode(' ', $store->tel)[1]}}" class="form-control" id="exampleInputEmail1" placeholder="Telephone">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Commentaires (optionnel)</label>
                                    <textarea class="form-control" rows="3" name="comment" placeholder="Commentaires">{{$store->comment}}</textarea>
                                </div>



                                <div class="form-group">
                                    <label for="exampleInputFile"> photo du magasion (optionnel)</label>
                                    <input type="file" name="photo" id="exampleInputFile">
                                </div>
                                <label > Facturation</label>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Type d'envoi des factures</label>
                                            <select class="form-control" name="bill_type">
                                                <option value="Email"
                                                @if($store->bill_type == 'Email')
                                                    selected
                                                @endif
                                                >Email</option>
                                                <option value="Papier"
                                                @if($store->bill_type == 'Papier')
                                                selected
                                                @endif
                                                >Papier</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Facture addressée vers</label>
                                            <select class="form-control" name="bill_to">
                                                <option value="Magasin"
                                                @if($store->bill_to == 'Magasin')
                                                    selected
                                                @endif
                                                >Magasin</option>
                                                <option value="Societé"
                                                @if($store->bill_to == 'Societé')
                                                    selected
                                                @endif
                                                >Societé</option>
                                                <option value="Magasin et Societé"
                                                        @if($store->bill_to == 'Magasin et Societé')
                                                        selected
                                                    @endif
                                                >Magasin et Societé</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row">--}}

                                {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                {{--<label>Heure d'ouverture</label>--}}

                                {{--<div class="input-group bootstrap-timepicker">--}}
                                {{--<input type="text" class="form-control timepicker ">--}}

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
                                {{--<input type="text" class="form-control timepicker">--}}

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
                                    <textarea class="form-control" rows="3" name="deliveryRec" placeholder="Recommendarion pour liveruer ..."> {{$store->deliveryRec}}</textarea>
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
