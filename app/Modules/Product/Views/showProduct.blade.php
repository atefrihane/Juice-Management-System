@extends('General.layout') @section('pageTitle', 'Détails produit') @section('content')


<div class="content-wrapper" id="app">

    <section class="content-header">

        {{ Breadcrumbs::render('showProduct',$product) }}
    </section>

    <section class="content" id="app">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Information du  produit</h3>

                    </div>


                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ID</label>
                                    <input class="form-control" id="disabledInput" type="text" value="{{$product->id}}"
                                        disabled>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Code </label>
                                    <input type="text" name="code" class="form-control" id="exampleInputEmail1"
                                        value="{{$product->code}}" placeholder="Code.." disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Etat</label>
                                    <input type="text" name="code" class="form-control" id="exampleInputEmail1"
                                        value="{{ucfirst($product->status)}}" placeholder="Code.." disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nom Produit</label>
                            <input class="form-control" id="disabledInput" type="text" placeholder="Nom Produit"
                                value="{{$product->nom}}" disabled>

                        </div>



                        <div class="form-group">
                            <label for="exampleInputEmail1">Type de Produit</label>
                            <input class="form-control" id="disabledInput" type="text" placeholder="Type Produit"
                                value="{{ucfirst($product->type)}}" disabled>


                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Version de Produit</label>
                            <input class="form-control" id="disabledInput" type="text" placeholder="Version.."
                                value="{{$product->version}}" disabled>

                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Code à barre</label>
                            <input class="form-control" id="disabledInput" type="text" placeholder="Code à barre"
                                value="{{$product->barcode}}" disabled>

                        </div>



                        <div class="form-group">
                            <label for="exampleInputEmail1">Désignation</label>
                            <input class="form-control" id="disabledInput" type="text" placeholder="Désignation"
                                value="{{$product->designation}}" disabled>

                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Composition</label>
                            <input class="form-control" id="disabledInput" type="text" placeholder="Composition"
                                value="{{$product->composition}}" disabled>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Couleur du produit</label>
                                    <input class="form-control" id="disabledInput" type="color"
                                        value="{{$product->color}}" disabled>

                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Poids (en kg)</label>

                            <input class="form-control" id="disabledInput" type="number" step="0.01" placeholder="Poids"
                                value="{{$product->weight}}" disabled>


                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hauteur(cm)</label>
                                    <input class="form-control" id="disabledInput" type="number" step="0.01"
                                        placeholder="hauteur" value="{{$product->height}}" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Largeur(cm)</label>
                                    <input class="form-control" id="disabledInput" type="number" step="0.01"
                                        placeholder="Largeur" value="{{$product->width}}" disabled>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Profondeur(cm)</label>
                                    <input class="form-control" id="disabledInput" type="number" step="0.01"
                                        placeholder="Profondeur" value="{{$product->depth}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Prix unitaire de vente </label>
                            <p class="form-control" style="background-color:#eee;">@convert($product->public_price)</p>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Durée de validité de produit fermé ( en jours)</label>
                            <input class="form-control" id="disabledInput" type="number"
                                placeholder="Durée de validité de produit fermé"
                                value="{{$product->period_of_validity}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Durée de validité aprés ouverture ( en heures)</label>
                            <input class="form-control" id="disabledInput" type="number"
                                placeholder="Duree de validité apres ouverture"
                                value="{{$product->validity_after_opening}}" disabled>
                        </div>

                        <div class="form-group">
                            <label>Commentaires (optionnel)</label>
                            @if($product->comment)
                            <textarea class="form-control" rows="3" placeholder="Commentaires"
                                disabled>{{$product->comment}}</textarea>
                            @else
                            <textarea class="form-control" rows="3" placeholder="Commentaires" disabled>Aucun</textarea>

                            @endif
                        </div>

                        <div class="form-group">

                            <label for="exampleInputFile">Photo du produit (optionnel)</label>
                            <div class="row">
                                <div class="container">

                                    @if($product->photo_url)
                                    <td> <img src="{{asset('/img')}}/{{$product->photo_url}}" height="80"
                                            class="user-image" alt="User Image"> </td>
                                    @else
                                    <td> <img src="{{asset('/img')}}/no-logo.png" height="80" class="user-image"
                                            alt="User Image"> </td>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre d'unités par display</label>
                            <input class="form-control" id="disabledInput" type="number"
                                placeholder="Nombre d'unités par display" value="{{$product->unit_by_display}}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre de display par colis</label>
                            <input class="form-control" id="disabledInput" type="number"
                                placeholder="Nombre de display par colis" value="{{$product->unit_per_package}}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Colisage</label>
                            <input class="form-control" id="disabledInput" type="number" placeholder="Colisage"
                                value="{{$product->validity_after_opening}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">TVA</label>
                            <input class="form-control" id="disabledInput" type="number" placeholder="TVA.."
                                value="{{$product->tva}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Possibilités de melange :</label>
                        </div>
                        @forelse($product->mixtures as $mixture)
                        <div class="box" style="border:1px solid rgb(228, 228, 228);background:rgb(228, 228, 228);">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nom du mélange</label>
                                            <input class="form-control" id="disabledInput" type="text"
                                                placeholder="Nom du mélange" value="{{$mixture->name}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Type du mélange</label>
                                            <input class="form-control" id="disabledInput" type="text"
                                                placeholder="Nom du mélange" value="{{ucfirst($mixture->type)}}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Quantité de produit fini(en litre)</label>
                                            <input class="form-control" id="disabledInput" type="number" step="0.01"
                                                placeholder="Quantité de produit fini.."
                                                value="{{$mixture->final_amount}}" disabled>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Poids necessaire du produit (en kg)</label>
                                            <input class="form-control" id="disabledInput" type="number"
                                                placeholder="Poids.." step="0.01" value="{{$mixture->needed_weight}}"
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Quantité d'eau (en litre)</label>
                                            <input class="form-control" id="disabledInput" type="number" step="0.01"
                                                placeholder="Quantité eau..." value="{{$mixture->water_amount}}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Quantité de sucre (en kg)</label>
                                            <input class="form-control" id="disabledInput" type="number" step="0.01"
                                                placeholder="Quantité sucre..." value="{{$mixture->sugar_amount}}"
                                                disabled>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Volume de verre (en cl)</label>
                                            <input class="form-control" id="disabledInput" type="number" step="0.01"
                                                placeholder="Volume de verre..." value="{{$mixture->glass_size}}"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty

                        <h4 class="text-center"> Aucun Mélange trouvé</h4>
                        @endforelse
                    </div>

                    </form>
                </div>

                <!-- /.col -->
            </div>

        </div>

    </section>
    <section class="content-header">
        <div class="container">
            <div class="box box-primary">
                <div class="box-body">
                    <h4>
                        Historique du produit
                        <small> {{$product->name}}</small>
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
                            @forelse($product->histories as $history)
                            <tr>
                                <td>@formatDate($history->created_at)</td>
                                <td>{{$history->user->nom}} {{$history->user->prenom}}</td>
                                <td>{{$history->action}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    <h4>Aucun historique trouvé!</h4>
                                </td>
                            </tr>
                            @endforelse




                        </tbody>

                    </table>
                </div>


                <div class="box-body">
                    <div class="row">
                        <div class="container text-center">
                            <a href="{{url()->previous() }}" class="btn btn-danger">Quitter</a>


                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

</div>



@endsection
