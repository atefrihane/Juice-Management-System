@extends('General.layoutCompany') @section('pageTitle', 'Detail contact') @section('content')


<div class="content-wrapper">
    <section class="content-header">
        {{ Breadcrumbs::render('showContact',$company,$user) }}

    </section>
    <section class="content" style="margin-top:20px;">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Informations du contact</h3>

                    </div>

                    <form role="form">

                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code</label>
                                        <input type="text" name="code" class="form-control" id="exampleInputEmail1"
                                            placeholder="Code.." value="{{$user->code}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nom societé</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" readonly
                                            placeholder="Nom societé.." value="{{$company->name}}" disabled>
                                    </div>
                                </div>



                            </div>




                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nom</label>
                                        <input class="form-control" name="nom" id="disabledInput" type="text"
                                            placeholder="Nom" value="{{$user->nom}}" disabled>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Prénom</label>
                                        <input class="form-control" name="prenom" id="disabledInput" type="text"
                                            placeholder="Prénom" value="{{$user->prenom}}" disabled>

                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Civilité</label>
                                <input type="text" class="form-control" value="{{$user->civilite}}" disabled>

                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input class="form-control" name="email" id="disabledInput" type="Email"
                                            placeholder="Email" value="{{$user->email}}" disabled>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Téléphone</label>
                                        <input class="form-control" name="telephone" id="disabledInput" type="phone"
                                            placeholder="Téléphone" value="{{$user->telephone}}" disabled>

                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Type de contact</label>
                                <input class="form-control" name="type" id="disabledInput" type="text"
                                    placeholder="Téléphone" value="{{ucfirst($user->getType())}}" disabled>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Magasin(s) de responsabilité(s)</label>
                                <div class="box-body">
                                    <table class="table table-bordered table-hover example2">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Code</th>
                                                <th>Désignation</th>
                                                <th>Ville</th>
                                                <th>Code postal</th>
                                                <th>Etat</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($user->getType() == 'Directeur')

                                            <tr class="table-tr">
                                                <td style="width:20%;"
                                                    data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$user->child->store->id])}}">
                                                    <img src="{{asset('/img/'.$user->child->store->photo)}}" height="80"
                                                        class="user-image" alt="User Image"></td>
                                                <td
                                                    data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$user->child->store->id])}}">
                                                    {{$user->child->store->code}}</td>
                                                <td
                                                    data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$user->child->store->id])}}">
                                                    {{$user->child->store->designation}}</td>
                                                <td
                                                    data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$user->child->store->id])}}">
                                                    {{$user->child->store->city->name}}</td>
                                                <td
                                                    data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$user->child->store->id])}}">
                                                    {{$user->child->store->zipcode->code}}</td>
                                                <td
                                                    data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$user->child->store->id])}}">
                                                    {{$user->child->store->status}}</td>

                                            </tr>
                                            @else
                                            @foreach($user->child->stores as $store)
                                            <tr class="table-tr">
                                                <td style="width:20%;"
                                                    data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$store->id])}}">
                                                    <img src="{{asset('/')}}{{$store->photo}}" height="80"
                                                        class="user-image" alt="User Image"></td>
                                                <td
                                                    data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$store->id])}}">
                                                    {{$store->code}}</td>
                                                <td
                                                    data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$store->id])}}">
                                                    {{$store->designation}}</td>
                                                <td
                                                    data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$store->id])}}">
                                                    {{$store->city->name}}</td>
                                                <td
                                                    data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$store->id])}}">
                                                    {{$store->zipcode->code}}</td>
                                                <td
                                                    data-url="{{route('showStore',['company_id'=>$company->id,'store_id'=>$store->id])}}">
                                                    {{ucfirst($store->status)}}</td>

                                            </tr>
                                            @endforeach
                                            @endif








                                        </tbody>

                                    </table>
                                </div>
                            </div>






                            <div class="form-group">
                                <label for="exampleInputEmail1">Code d'accés</label>
                                <input class="form-control" name="accessCode" id="disabledInput" type="text"
                                    placeholder="Code d'accés" value="{{$user->accessCode}}" disabled>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Mot de passe</label>
                                <input class="form-control" name="passWord" id="disabledInput" type="text"
                                    placeholder="Mot de passe" value="{{$user->password}}" disabled>

                            </div>


                            <div class="form-group">
                                <label>Commentaire (optionnel)</label>
                                <textarea class="form-control" rows="3" name="comment" placeholder="Commentaires"
                                    disabled> {{$user->child->comment}}</textarea>
                            </div>




                        </div>

                    </form>
                </div>

                <!-- /.col -->
            </div>

        </div>

    </section>
    <div class="container">
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-body">
                <h4>
                    Historique du contact
                    <small> {{$user->formatName()}}</small>
                </h4>
                <table class="table table-bordered table-hover example2">
                    <thead>
                        <tr>
                            <th> Date et heure</th>
                            <th>Utilisateur</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($user->histories as $history)
                        <tr>
                            <td>@formatDate($history->created_at)</td>
                            <td>{{$history->user->formatName()}}</td>
                            <td>{{$history->action}}</td>


                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Auccun contact trouvé !</td>
                        </tr>

                        @endforelse




                    </tbody>

                </table>


                <div class="text-center">

                    <a href="{{url()->previous()}}" class="btn btn-danger" data-dismiss="modal">Fermer</a>

                </div>

            </div>

        </div>
    </section>
    </div>
 
   
</div>

@endsection
