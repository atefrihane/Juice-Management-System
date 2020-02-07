@extends('General.layoutCompany') @section('pageTitle', 'Modifier un magasin') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('editStore',$company) }}
    </section>

    <section class="content" style="margin-top:20px;">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Modifier un magasin</h3>

                    </div>

                    <form role="form" action="{{route('updateStore', $store->id)}}" method="post"
                        enctype="multipart/form-data" id="frm">
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
                                        <input class="form-control" id="disabledInput" type="text" placeholder="ID"
                                            value="{{$store->id}}" disabled>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code</label>
                                        <input type="text" class="form-control code " name="code"
                                          value="{{ old( 'code', $store->code) }}" id="exampleInputEmail1" placeholder="Code..">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Etat</label>
                                        <select name="status" class="form-control">
                                        <option value="actif" {{old('status') == 'actif' ? 'selected' : ''}}>Actif</option>
                                            <option value="non-actif"  {{old('status') == 'non-actif' ? 'selected' : ''}}>Non Actif</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom Societé</label>
                                <input class="form-control" id="disabledInput" value="{{$company->name}}" type="text"
                                    placeholder="Groupe" disabled>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Désignation</label>
                                <input class="form-control designation" id="disabledInput" type="text"  name="designation" placeholder="Nom Magasin"
                                    pattern=".{6,}" title="6 caractères minimum"  value="{{ old( 'designation', $store->designation) }}">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enseigne</label>
                                <select class="form-control" name="sign">
                                    <option value="Franprix" @if(old('sign') == 'Franprix')
                                        selected
                                        @endif
                                        >Franprix</option>
                                    <option value="G20" @if(old('sign')  == 'G20')
                                        selected
                                        @endif
                                        >G20</option>
                                    <option value="Shopi" @if(old('sign') == 'Shopi' )
                                        selected
                                        @endif
                                        >Shopi</option>
                                    <option value="LECLERC" @if(old('sign')  == 'LECLERC')
                                        selected
                                        @endif
                                        >LECLERC</option>
                                    <option value="Restaurant" @if(old('sign') == 'Restaurant' )
                                        selected
                                        @endif
                                        >Restaurant</option>
                                    <option value="Stand" @if(old('sign')  =='Stand' )
                                        selected
                                        @endif
                                        >Stand</option>
                                </select>


                            </div>

                            <div class="form-group">
                                    <label for="exampleInputEmail1">Type de commande</label>
                                    <select class="form-control" name="order_type" required>
                                        <option value="" disabled>Séléctionner un type</option>
                                        <option value="1" {{old('order_type') == 1 ? 'selected'  : ''}}>Seulement en colis</option>
                                        <option value="2" {{old('order_type') == 2 ? 'selected'  : ''}}>Colis et nombre d'unités</option>
    
                                    </select>
    
    
                                </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Adresse du magasin</label>
                                <input class="form-control" id="disabledInput" type="text"  value="{{ old( 'address', $store->address) }}"
                                    name="address" placeholder="Nom Magasin">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Complément d'adresse (optionnel)</label>
                                <input class="form-control" id="disabledInput" type="text"
                                value="{{ old( 'complement', $store->complement) }}" name="complement" placeholder="Nom Magasin">

                            </div>



                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pays</label>
                                        <select class="form-control country" name="country_id"
                                            value="{{old('country_id')}}">
                                            @forelse($countries as $country)
                                            <option value="{{$country->id}}"
                                                {{$country->id == old('country_id') ? ' selected' : ''}}>
                                                {{$country->name}}</option>
                                            @empty
                                            <option value=""> Aucun pays trouvé</option>

                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ville</label>
                                        <select class="form-control cities" name="city_id">
                                            @forelse($cities as $city)

                                            <option value="{{$city->id}}"
                                                {{$city->id == old('city_id') ? 'selected' :  ''}}>
                                                {{$city->name}}
                                            </option>
                                            @empty
                                            <option value=""> Aucune ville trouvé</option>

                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Code Postal</label>
                                        <select class="form-control zipcodes" name="zipcode_id">
                                            @forelse($zipcodes as $zipcode)
                                            <option value="{{$zipcode->id}}"
                                                {{$zipcode->id == old('zipcode_id') ? 'selected' :  ''}}>
                                                {{$zipcode->code}}
                                            </option>
                                            @empty
                                            <option value=""> Aucun code postal trouvé</option>

                                            @endforelse
                                        </select>
                                        </select>
                                    </div>
                                </div>


                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input class="form-control" id="disabledInput" type="email"  value="{{ old( 'email', $store->email) }}"
                                    name="email" placeholder="Nom Magasin">

                            </div>
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Télephone</label>
                                        <input class="form-control" name="cc" type="text" placeholder="Code pays"
                                        value="{{ old( 'cc', explode(' ', $store->tel)[0]) }}" maxlength="4">

                                    </div>
                                </div>

                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" style="color: transparent">*</label>
                                        <input type="text" name="tel"  value="{{ old( 'cc', explode(' ', $store->tel)[1]) }}"
                                            class="form-control" id="exampleInputEmail1" placeholder="Telephone">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Commentaires (optionnel)</label>
                                <textarea class="form-control" rows="3" name="comment"
                                    placeholder="Commentaires">{{old('comment')}}</textarea>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputFile"> Photo du magasin (optionnel)</label>
                                @if($store->photo)
                                <div class="row">
                                    <div class="container">
                                        <img src="{{asset('/img/'.$store->photo)}}" alt="..." class="img-thumbnail"
                                            style="width:100px;">
                                    </div>
                                </div>
                                @endif
                                <input type="file" name="photo" id="exampleInputFile" style="margin-top:20px;">
                            </div>
                            <label> Facturation</label>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type d'envoi des factures</label>
                                        <select class="form-control" name="bill_type">
                                            <option value="Email" @if(old('bill_type') == 'Email')
                                                selected
                                                @endif
                                                >Email</option>
                                            <option value="Papier" @if(old('bill_type') == 'Papier')
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
                                            <option value="Magasin" @if(old('bill_to') == 'Magasin')
                                                selected
                                                @endif
                                                >Magasin</option>
                                            <option value="Societé" @if(old('bill_to')  == 'Societé')
                                                selected
                                                @endif
                                                >Societé</option>
                                            <option value="Magasin et Societé" @if(old('bill_to')  == 'Magasin et
                                                Societé')
                                                selected
                                                @endif
                                                >Magasin et Societé</option>
                                        </select>

                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Recommandation pour livreur (optionnel)</label>
                                <textarea class="form-control" rows="3" name="deliveryRec"
                                    placeholder="Recommendarion pour liveruer ..."> {{old('deliveryRec')}}</textarea>
                            </div>
                            <div class="form-group" style="margin-bottom:-15px;">
                                <label style="font-size: 24px; margin-top: 24px; font-weight: bold;"> Horaires</label>

                            </div>

                            <div class="scrollable-table">
                                <table class="tables">
                                    <thead>
    
                                        <th class="no-sort">Jour</th>
                                        <th>Ouverture Matin</th>
                                        <th> Clôture Matin</th>
                                        <th>Ouverture Aprés midi</th>
                                        <th> Clôture Aprés midi</th>
                                        <th>Fermé</th>
    
                                    </thead>
                                    <tbody>
                                        @forelse($store->schedules as $key=>$schedule)
                                        <tr>
                                            <td>
                                                @switch($schedule->day)
                                                @case(1)
                                                Lundi
                                                <input type="hidden" name="schedules[{{$key}}][0]"
                                                    value="{{$schedule->id}}">
                                                @break
                                                @case(2)
                                                Mardi
                                                <input type="hidden" name="schedules[{{$key}}][0]"
                                                    value="{{$schedule->id}}">
                                                @break
                                                @case(3)
                                                Mercredi
                                                <input type="hidden" name="schedules[{{$key}}][0]"
                                                    value="{{$schedule->id}}">
                                                @break
                                                @case(4)
                                                Jeudi
                                                <input type="hidden" name="schedules[{{$key}}][0]"
                                                    value="{{$schedule->id}}">
                                                @break
                                                @case(5)
                                                Vendredi
                                                <input type="hidden" name="schedules[{{$key}}][0]"
                                                    value="{{$schedule->id}}">
                                                @break
                                                @case(6)
                                                Samedi
                                                <input type="hidden" name="schedules[{{$key}}][0]"
                                                    value="{{$schedule->id}}">
                                                @break
                                                @case(7)
                                                dimanche
                                                <input type="hidden" name="schedules[{{$key}}][0]"
                                                    value="{{$schedule->id}}">
                                                @endswitch
    
                                            </td>
                                            <td> <input type="time" class="form-control times" min='00:00' max='23:59'
                                                    name="schedules[{{$key}}][1]" value="{{$schedule->start_day_time}}"
                                                    {{$schedule->closed == 1 ? 'readonly' :  ''}}></td>
                                            <td> <input type="time" class="form-control times" min='00:00' max='23:59'
                                                    name="schedules[{{$key}}][2]" value="{{$schedule->end_day_time}}"
                                                    {{$schedule->closed == 1 ? 'readonly' :  ''}}></td>
                                            <td> <input type="time" class="form-control times" min='00:00' max='23:59'
                                                    name="schedules[{{$key}}][3]" value="{{$schedule->start_night_time}}"
                                                    {{$schedule->closed == 1 ? 'readonly' :  ''}}></td>
                                            <td> <input type="time" class="form-control times" min='00:00' max='23:59'
                                                    name="schedules[{{$key}}][4]" value="{{$schedule->end_night_time}}"
                                                    {{$schedule->closed == 1 ? 'readonly' :  ''}}></td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="schedules[{{$key}}][5]"
                                                        {{ $schedule->closed == 1 ? 'checked' : '' }}>
    
                                                </div>
                                            </td>
    
                                        </tr>
                                        @empty
                                        <tr></tr>
                                        @endforelse
    
    
    
    
    
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                    

                        </div>
                        <div class="row">
                            <div class="container text-center">

                                <a href="{{route('showStores', $company->id)}}" class="btn btn-danger pl-1"
                                    style="margin: 1em">Annuler</a>
                                <button class="btn btn-success pl-1" type="submit"
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

@section('scripts-custom')
<script>
    var oTable = $('.tables').DataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/a5734b29083/i18n/French.json"
        },
        "bLengthChange": false,
        "aaSorting": [],

        "pageLength": 20
    });

</script>
<script>
    $('document').ready(function () {
        $('.form-check > input').each(function () {
            $(this).click(function () {
                if ($(this).is(":checked")) {
                    $(this).closest('tr').find("td:eq(1)").find("input").prop('readonly', true);
                    $(this).closest('tr').find("td:eq(2)").find("input").prop('readonly', true);
                    $(this).closest('tr').find("td:eq(3)").find("input").prop('readonly', true);
                    $(this).closest('tr').find("td:eq(4)").find("input").prop('readonly', true);
                } else {

                    $(this).closest('tr').find("td:eq(1)").find("input").prop('readonly',
                    false);
                    $(this).closest('tr').find("td:eq(2)").find("input").prop('readonly',
                    false);
                    $(this).closest('tr').find("td:eq(3)").find("input").prop('readonly',
                    false);
                    $(this).closest('tr').find("td:eq(4)").find("input").prop('readonly',
                    false);
                }

            })
        })


    })

</script>

@endsection





@endsection
