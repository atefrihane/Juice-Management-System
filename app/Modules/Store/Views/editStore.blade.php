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
                                            value="{{$store->code}}" id="exampleInputEmail1" placeholder="Code..">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Etat</label>
                                        <select name="status" class="form-control">
                                            <option value="actif" @if($store->status == 'actif')
                                                selected
                                                @endif
                                                >Actif</option>
                                            <option value="non-actif" @if($store->status == 'non-actif')
                                                selected
                                                @endif>Non Actif</option>
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
                                <input class="form-control designation" id="disabledInput" type="text"
                                    value="{{$store->designation}}" name="designation" placeholder="Nom Magasin"
                                    pattern=".{6,}" title="6 caractères minimum">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enseigne</label>
                                <select class="form-control" name="sign">
                                    <option value="Franprix" @if($store->sign == 'Franprix')
                                        selected
                                        @endif
                                        >Franprix</option>
                                    <option value="G20" @if($store->sign == 'G20')
                                        selected
                                        @endif
                                        >G20</option>
                                    <option value="Shopi" @if($store->sign == 'Shopi' )
                                        selected
                                        @endif
                                        >Shopi</option>
                                    <option value="LECLERC" @if($store->sign == 'LECLERC')
                                        selected
                                        @endif
                                        >LECLERC</option>
                                    <option value="Restaurant" @if($store->sign == 'Restaurant' )
                                        selected
                                        @endif
                                        >Restaurant</option>
                                    <option value="Stand" @if($store->sign =='Stand' )
                                        selected
                                        @endif
                                        >Stand</option>
                                </select>


                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Adresse du magasin</label>
                                <input class="form-control" id="disabledInput" type="text" value="{{$store->address}}"
                                    name="address" placeholder="Nom Magasin">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Complément d'adresse (optionnel)</label>
                                <input class="form-control" id="disabledInput" type="text"
                                    value="{{$store->complement}}" name="complement" placeholder="Nom Magasin">

                            </div>



                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pays</label>
                                        <select class="form-control country" name="country_id"
                                            value="{{old('country_id')}}">
                                            @forelse($countries as $country)
                                            <option value="{{$country->id}}"
                                                {{$country->id == $store->country_id ? ' selected' : ''}}>
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
                                                {{$city->id == $store->city_id ? 'selected' :  ''}}>
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
                                                {{$zipcode->id == $store->zipcode_id ? 'selected' :  ''}}>
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
                                <input class="form-control" id="disabledInput" type="email" value="{{$store->email}}"
                                    name="email" placeholder="Nom Magasin">

                            </div>
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Télephone</label>
                                        <input class="form-control cc" name="cc" type="text" placeholder="Code pays"
                                            value="{{explode(' ', $store->tel)[0]}}" maxlength="4">

                                    </div>
                                </div>

                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" style="color: transparent">*</label>
                                        <input type="text" name="tel" value="{{explode(' ', $store->tel)[1]}}"
                                            class="form-control" id="exampleInputEmail1" placeholder="Telephone">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Commentaires (optionnel)</label>
                                <textarea class="form-control" rows="3" name="comment"
                                    placeholder="Commentaires">{{$store->comment}}</textarea>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputFile"> photo du magasion (optionnel)</label>
                                <input type="file" name="photo" id="exampleInputFile">
                            </div>
                            <label> Facturation</label>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type d'envoi des factures</label>
                                        <select class="form-control" name="bill_type">
                                            <option value="Email" @if($store->bill_type == 'Email')
                                                selected
                                                @endif
                                                >Email</option>
                                            <option value="Papier" @if($store->bill_type == 'Papier')
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
                                            <option value="Magasin" @if($store->bill_to == 'Magasin')
                                                selected
                                                @endif
                                                >Magasin</option>
                                            <option value="Societé" @if($store->bill_to == 'Societé')
                                                selected
                                                @endif
                                                >Societé</option>
                                            <option value="Magasin et Societé" @if($store->bill_to == 'Magasin et Societé')
                                                selected
                                                @endif
                                                >Magasin et Societé</option>
                                        </select>

                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Recommendation pour livreur (optionnel)</label>
                                <textarea class="form-control" rows="3" name="deliveryRec"
                                    placeholder="Recommendarion pour liveruer ..."> {{$store->deliveryRec}}</textarea>
                            </div>
                            <div class="form-group" style="margin-bottom:-15px;">
                                <label style="font-size: 24px; margin-top: 24px; font-weight: bold;"> Horaires</label>

                            </div>


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
        $('.form-check > input').each(function() {
            $(this).click(function(){
                if ($(this).is(":checked"))
                {
                    $(this).closest('tr').find("td:eq(1)").find("input").prop('readonly', true);
                    $(this).closest('tr').find("td:eq(2)").find("input").prop('readonly', true);
                    $(this).closest('tr').find("td:eq(3)").find("input").prop('readonly', true);
                    $(this).closest('tr').find("td:eq(4)").find("input").prop('readonly', true);
                }
                else{
            
                    $(this).closest('tr').find("td:eq(1)").find("input").prop('readonly', false);
                    $(this).closest('tr').find("td:eq(2)").find("input").prop('readonly', false);
                    $(this).closest('tr').find("td:eq(3)").find("input").prop('readonly', false);
                    $(this).closest('tr').find("td:eq(4)").find("input").prop('readonly', false);
                }
      
            })
        })
      

    })

</script>

@endsection





@endsection
