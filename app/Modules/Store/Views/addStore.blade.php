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

                    <form role="form" action="{{route('addStore', $company->id)}}" method="post"
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

                               

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code</label>
                                        <input required required type="text" class="form-control code" name="code"
                                            id="exampleInputEmail1" placeholder="Code" value="{{old('code')}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
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
                                <input required class="form-control" id="disabledInput" readonly
                                    value="{{$company->name}}" type="text" placeholder="Groupe">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Désignation</label>
                                <input required class="form-control designation" id="disabledInput" type="text"
                                    name="designation" placeholder="Nom Magasin" value="{{old('designation')}}"
                                    pattern=".{6,}" title="6 caractères minimum">

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
                                    <option value="casino">Casino</option>
                                </select>


                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Adresse du magasin</label>
                                <input required class="form-control" id="disabledInput" type="text" name="address"
                                    placeholder="Adresse du Magasin" value="{{old('address')}}">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Complément d'adresse (optionnel)</label>
                                <input class="form-control" id="disabledInput" type="text" name="complement"
                                    placeholder="Complement" value="{{old('complement')}}">

                            </div>

                            <div class="row">


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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Code Postal</label>
                                        <select class="form-control zipcodes" name="zipcode_id"
                                            value="{{old('zipcode_id')}}" required>
                                            <option value="">Selectionner un code postal</option>
                                         
                                            
                                        </select>
                                    </div>

                                </div>


                            </div>
                          
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input required class="form-control" id="disabledInput" type="email" name="email"
                                    placeholder="Email" value="{{old('email')}}">

                            </div>
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Télephone</label>
                                        <input required class="form-control cc" name="cc" type="text"
                                            placeholder="Code pays" value="" maxlength="4" value="{{old('cc')}}">

                                    </div>
                                </div>

                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" style="color: transparent">*</label>
                                        <input required type="text" name="tel" class="form-control"
                                            id="exampleInputEmail1" placeholder="Telephone" value="{{old('tel')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Commentaires (optionnel)</label>
                                <textarea class="form-control" rows="3" name="comment" placeholder="Commentaires"
                                    value="{{old('comment')}}">{{old('comment')}}</textarea>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputFile"> Photo du magasion (optionnel)</label>
                                <input type="file" name="photo" id="exampleInputFile">
                            </div>
                            <label style="font-size: 24px; margin-top: 24px; font-weight: bold;"> Facturation</label>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type d'envoi des factures</label>
                                        <select class="form-control" name="bill_type" value="{{old('bill_type')}}">
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
                                        <select class="form-control" name="bill_to" value="{{old('bill_to')}}">
                                            <option value="Magasin">Magasin</option>
                                            <option value="Societé">Societé</option>
                                            <option value="Magasin et Societé">Magasin et Societé</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Recommandation pour livreur (optionnel)</label>
                                <textarea class="form-control" rows="3" name="deliveryRec"
                                    placeholder="Recommendarion pour liveruer ..."></textarea>
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
                                    <tr>
                                        <td>Lundi</td>
                                        <td> <input type="time" class="form-control" name="mondayDayStart"  value="{{old('mondayDayStart') }}"></td>
                                        <td> <input type="time" class="form-control" name="mondayDayEnd"    value="{{old('mondayDayEnd')}}"></td>
                                        <td> <input type="time" class="form-control" name="mondayNightStart" value="{{old('mondayNightStart')}}"></td>
                                        <td> <input type="time" class="form-control" name="mondayNightEnd"  value="{{old('mondayNightEnd')}}"></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" name="mondayClosed" type="checkbox"
                                                    id="gridCheck" @if(old('mondayClosed')) checked @endif>

                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>Mardi</td>
                                        <td> <input type="time" class="form-control" name="tuesdayDayStart" value="{{old('tuesdayDayStart')}}"></td>
                                        <td> <input type="time" class="form-control" name="tuesdayDayEnd" value="{{old('tuesdayDayEnd')}}"></td>
                                        <td> <input type="time" class="form-control" name="tuesdayNightStart" value="{{old('tuesdayNightStart')}}"></td>
                                        <td> <input type="time" class="form-control" name="tuesdayNightEnd" value="{{old('tuesdayNightEnd')}}"></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" name="tuesdayClosed" type="checkbox"
                                                    id="gridCheck" @if(old('tuesdayClosed')) checked @endif>

                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Mercredi</td>
                                        <td> <input type="time" class="form-control" name="wednesdayDayStart" value="{{old('wednesdayDayStart')}}"></td>
                                        <td> <input type="time" class="form-control" name="wednesdayDayEnd" value="{{old('wednesdayDayEnd')}}"></td>
                                        <td> <input type="time" class="form-control" name="wednesdayNightStart" value="{{old('wednesdayNightStart')}}"></td>
                                        <td> <input type="time" class="form-control" name="wednesdayNightEnd" value="{{old('wednesdayNightEnd')}}"></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" name="wednesdayClosed" type="checkbox"
                                                    id="gridCheck" @if(old('wednesdayClosed')) checked @endif>

                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Jeudi</td>
                                        <td> <input type="time" class="form-control" name="thursdayDayStart" value="{{old('thursdayDayStart')}}"></td>
                                        <td> <input type="time" class="form-control" name="thursdayDayEnd" value="{{old('thursdayDayEnd')}}"></td>
                                        <td> <input type="time" class="form-control" name="thursdayNightStart" value="{{old('thursdayNightStart')}}"></td>
                                        <td> <input type="time" class="form-control" name="thursdayNightEnd" value="{{old('thursdayNightEnd')}}"></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" name="thursdayClosed" type="checkbox"
                                                    id="gridCheck" @if(old('thursdayClosed')) checked @endif>

                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Vendredi</td>
                                        <td> <input type="time" class="form-control" name="fridayDayStart" value="{{old('fridayDayStart')}}"></td>
                                        <td> <input type="time" class="form-control" name="fridayDayEnd" value="{{old('fridayDayEnd')}}"></td>
                                        <td> <input type="time" class="form-control" name="fridayNightStart" value="{{old('fridayNightStart')}}"></td>
                                        <td> <input type="time" class="form-control" name="fridayNightEnd" value="{{old('fridayNightEnd')}}"></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" name="fridayClosed" type="checkbox"
                                                    id="gridCheck" @if(old('fridayClosed')) checked @endif>

                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Samedi</td>
                                        <td> <input type="time" class="form-control" name="saturdayDayStart" value="{{old('saturdayDayStart')}}"></td>
                                        <td> <input type="time" class="form-control" name="saturdayDayEnd" value="{{old('saturdayDayEnd')}}"></td>
                                        <td> <input type="time" class="form-control" name="saturdayNightStart" value="{{old('saturdayNightStart')}}"></td>
                                        <td> <input type="time" class="form-control" name="saturdayNightEnd" value="{{old('saturdayNightEnd')}}"></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" name="saturdayClosed" type="checkbox"
                                                    id="gridCheck" @if(old('saturdayClosed')) checked @endif>

                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Dimanche</td>
                                        <td> <input type="time" class="form-control" name="sundayDayStart" value="{{old('sundayDayStart')}}"></td>
                                        <td> <input type="time" class="form-control" name="sundayDayEnd" value="{{old('sundayDayEnd')}}"></td>
                                        <td> <input type="time" class="form-control" name="sundayNightStart" value="{{old('sundayNightStart')}}"> </td>
                                        <td> <input type="time" class="form-control" name="sundayNightEnd" value="{{old('sundayNightEnd')}}"></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" name="sundayClosed" type="checkbox"
                                                    id="gridCheck" @if(old('sundayClosed')) checked @endif>

                                            </div>
                                        </td>

                                    </tr>



                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>

                            <div class="row">
                                <div class="container text-center">

                                    <a href="{{route('showStores', $company->id)}}" class="btn btn-danger pl-1"
                                        style="margin: 1em">Annuler</a>
                                    <button class="btn btn-success pl-1" type="submit"
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
    $("input[type=checkbox]").change(function () {
    if ($('#frm input[type=checkbox]:checked').length > 0) {
   
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
});
</script>


@endsection
@endsection
