@extends('General.layout')
@section('pageTitle', 'Ajouter une quantité de produit')
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
                        <h3 class="box-title"> Détail entrepôt</h3>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data" action="{{route('storeMachine')}}">
                        {{csrf_field()}}


                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">ID</label>
                                    <input type="text" name="id" class="form-control" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Code</label>
                                    <input type="text" name="code" class="form-control" placeholder="Code">
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Désignation</label>
                                    <input type="number" name="photo" class="form-control" placeholder="Désignation">
                                </div>
                            </div>
                        </div>


                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Ville</label>
                                    <select class="form-control" name="name">
                                        <option value="bourg">Bour-en-Bresse (01)</option>
                                        <option value="laon">Laon (02)</option>
                                        <option value="moulins">Moulins (03)</option>
                                        <option value="digne">Digne (04)</option>
                                        <option value="gap">Gap (05)</option>
                                        <option value="nice">Nice (06)</option>
                                        <option value="privas">Privas (07)</option>
                                        <option value="charleville">Charleville-Mézières (08)</option>
                                        <option value="foix">Foix (09)</option>
                                        <option value="troyes">Troyes (10)</option>
                                        <option value="carcassonne">Carcassonne (11)</option>
                                        <option value="rodez">Rodez (12)</option>
                                        <option value="marseille">Marseille (13)</option>
                                        <option value="caen">Caen (14)</option>
                                        <option value="aurillac">Aurilac (15)</option>
                                        <option value="angouleme">Angoulême (16)</option>
                                        <option value="larochelle">La Rochelle (17)</option>
                                        <option value="bourges">Bourges (18)</option>
                                        <option value="tulle">Tulle (19)</option>
                                        <option value="ajaccio">Ajaccio (2A)</option>
                                        <option value="bastia">Bastia (2B)</option>
                                        <option value="dijon">Dijon (21)</option>
                                        <option value="saintbrieuc">Saint-Brieuc (22)</option>
                                        <option value="gueret">Guéret (23)</option>
                                        <option value="perigueux">Périgueux (24)</option>
                                        <option value="besancon">Besançon (25)</option>
                                        <option value="lille">Valence (26)</option>
                                        <option value="evreux">Evreux (27)</option>
                                        <option value="chartres">Chartres (28)</option>
                                        <option value="quimper">Quimper (29)</option>
                                        <option value="nimes">Nîmes (30)</option>
                                        <option value="toulouse">Toulouse (31)</option>
                                        <option value="auch">Auch (32)</option>
                                        <option value="bordeaux">Bordeaux (33)</option>
                                        <option value="montpellier">Montpellier (34)</option>
                                        <option value="rennes">Rennes (35)</option>
                                        <option value="chateauroux">chateauroux (36)</option>
                                        <option value="tours">Tours (37)</option>
                                        <option value="grenoble">Grenoble (38)</option>
                                        <option value="lons">Lons-le-Saunier (39)</option>
                                        <option value="montdemarsan">Mont-de-Marsan (40)</option>
                                        <option value="blois">Blois (41)</option>
                                        <option value="saintetienne">Saint-Etienne (42)</option>
                                        <option value="lepuyenvelay">Le Puy-en-Velay (43)</option>
                                        <option value="nantes">Nantes (44)</option>
                                        <option value="orleans">Orléans (45)</option>
                                        <option value="cahors">Cahors (46)</option>
                                        <option value="agen">Agen (47)</option>
                                        <option value="mende">Mende (48)</option>
                                        <option value="angers">Angers (49)</option>
                                        <option value="saintlo">Saint-Lô (50)</option>
                                        <option value="chalons">Châlons-en-Champagne (51)</option>
                                        <option value="chaumont">Chaumont (52)</option>
                                        <option value="laval">Laval (53)</option>
                                        <option value="nancy">Nancy (54)</option>
                                        <option value="barleduc">Bar-le-Duc (55)</option>
                                        <option value="vannes">Vannes (56)</option>
                                        <option value="metz">Metz (57)</option>
                                        <option value="nevers">Nevers (58)</option>
                                        <option value="lille">Lille (59)</option>
                                        <option value="beauvais">Beauvais (60)</option>
                                        <option value="alencon">Alençon (61)</option>
                                        <option value="arras">Arras (62)</option>
                                        <option value="clermont">Clermont-Ferrand (63)</option>
                                        <option value="pau">Pau (64)</option>
                                        <option value="tarbes">Tarbes (65)</option>
                                        <option value="perpignan">Perpignan (66)</option>
                                        <option value="strasbourg">Strasbourg (67)</option>
                                        <option value="colmar">Colmar (68)</option>
                                        <option value="lyon">Lyon (69)</option>
                                        <option value="vesoul">Vesoul (70)</option>
                                        <option value="macon">Mâcon (71)</option>
                                        <option value="lemans">Le Mans (72)</option>
                                        <option value="chambery">Chambéry (73)</option>
                                        <option value="annecy">Annecy (74)</option>
                                        <option value="paris">Paris (75)</option>
                                        <option value="rouen">Rouen (76)</option>
                                        <option value="melun">Melun (77)</option>
                                        <option value="versailles">Versailles (78)</option>
                                        <option value="niort">Niort (79)</option>
                                        <option value="amiens">Amiens (80)</option>
                                        <option value="albi">Albi (81)</option>
                                        <option value="montauban">Montauban (82)</option>
                                        <option value="toulon">Toulon (83)</option>
                                        <option value="avignon">Avignon (84)</option>
                                        <option value="larochesuryon">La-Roche-sur-Yon (85)</option>
                                        <option value="poitiers">Poitiers (86)</option>
                                        <option value="limoges">Limoges (87)</option>
                                        <option value="epinal">Epinal (88)</option>
                                        <option value="auxerre">Auxerre (89)</option>
                                        <option value="belfort">Belfort (90)</option>
                                        <option value="evry">Evry (91)</option>
                                        <option value="nanterre">Nanterre (92)</option>
                                        <option value="bobigny">Bobigny (93)</option>
                                        <option value="creteil">Créteil (94)</option>
                                        <option value="pontoise">Pontoise (95)</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Code Postal</label>
                                    <input type="number" name="photo" class="form-control" placeholder="Code Postal">
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Surface ( en m²)</label>
                                    <input type="number" name="photo" class="form-control" placeholder="Surface">
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Addresse</label>
                                    <input type="number" name="photo" class="form-control" placeholder="Addresse">
                                </div>
                            </div>
                        </div>


                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Complement d'addresse</label>
                                    <input type="number" name="photo" class="form-control"
                                        placeholder="Complement d'addresse">
                                </div>
                            </div>
                        </div>


                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Commentaire</label>
                                    <textarea class="form-control" rows="3" name="comment"
                                        placeholder="Commentaire"></textarea>
                                </div>
                            </div>
                        </div>



                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Photo de l'entrepot (optionnelle)</label>
                                    <input type="file" class="form-control">
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
