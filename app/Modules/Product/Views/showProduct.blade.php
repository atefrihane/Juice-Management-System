@extends('General.layout') @section('pageTitle', 'Ajouter un produit') @section('content')


<div class="content-wrapper" id="app">

    <section class="content-header">

        {{ Breadcrumbs::render('showProduct',$product) }}
    </section>

    <section class="content" id="app">
        <div class="row">
            <div class="container">

            <div class="box box-primary">

<div class="box-header">
    <h3 class="box-title"> Modifier un produit</h3>

</div>


<div class="box-body">

    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">ID</label>
                <input class="form-control" id="disabledInput" type="text" disabled>

            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Code </label>
                <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                   >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Etat</label>
                <select class="form-control">
                    <option value="disponible">Disponible</option>
                    <option value="non disponible">Non disponible</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Nom Produit</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="Nom Produit">

    </div>



    <div class="form-group">
        <label for="exampleInputEmail1">Type de Produit</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="Nom Produit"
            disabled>


    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Version de Produit</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="Version..">

    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">Code à barre</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="Code à barre">

    </div>



    <div class="form-group">
        <label for="exampleInputEmail1">Désignation</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="Désignation"
           >

    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">Composition</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="Composition"
           >

    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Couleur du produit</label>
                <input class="form-control" id="disabledInput" type="color" value="#ff0000">

            </div>
        </div>
    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">Poids (en kg)</label>

        <input class="form-control" id="disabledInput" type="number" step="0.01" placeholder="Poids"
           >


    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Hauteur(cm)</label>
                <input class="form-control" id="disabledInput" type="number" step="0.01" placeholder="hauteur"
                   >
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Largeur(cm)</label>
                <input class="form-control" id="disabledInput" type="number" step="0.01" placeholder="Largeur"
                   >
            </div>
        </div>


        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Profondeur(cm)</label>
                <input class="form-control" id="disabledInput" type="number" step="0.01"
                    placeholder="Profondeur">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Prix unitaire de vente </label>
        <input class="form-control" id="disabledInput" type="number" step="0.01"
            placeholder="Prix unitaire de vente ">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Durée de validité de produit fermé ( en jours)</label>
        <input class="form-control" id="disabledInput" type="number"
            placeholder="Durée de validité de produit fermé">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Durée de validité aprés ouverture ( en heures)</label>
        <input class="form-control" id="disabledInput" type="number"
            placeholder="Duree de validité apres ouverture">
    </div>

    <div class="form-group">
        <label>Commentaires (optionnel)</label>
        <textarea class="form-control" rows="3" placeholder="Commentaires"></textarea>
    </div>

    <div class="form-group">
      
        <label for="exampleInputFile">Photo du produit (optionnel)</label>
          <div class="row" >
            <div class="container">
      
                <img  alt="" class="img-thumbnail" style="width:100px;">
            </div>
        </div>
        
        <input type="file" id="exampleInputFile"  style="margin-top:20px;">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre d'unitée par display</label>
        <input class="form-control" id="disabledInput" type="number" placeholder="Nombre d'unitée par display"
           >
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre de display par colis</label>
        <input class="form-control" id="disabledInput" type="number" placeholder="Nombre de display par colis"
           >
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Colisage</label>
        <input class="form-control" id="disabledInput" type="number" placeholder="Colisage">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">TVA</label>
        <input class="form-control" id="disabledInput" type="number" placeholder="Colisage">
    </div>

    <div class="form-group" >
        <label for="exampleInputFile">Possibilités de melange :</label>
    </div>
    <div class="box" style="border:1px solid rgb(228, 228, 228);background:rgb(228, 228, 228);"
         >
        <div class="box-body">
            <div class="box-body">
                <a href="" class="pull-right btn btn-default" 
                    @click.prevent="deleteMixture(mixture)"><i class="fa fa-minus"></i></a>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom du mélange</label>
                        <input class="form-control" id="disabledInput" type="text" placeholder="Nom du mélange"
                           >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Type du mélange</label>
                        <select class="form-control">
                            <option :value="null" disabled>Séléctionner un type du mélange</option>
                            <option value="granite">Granité</option>
                            <option value="jus">Jus</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Quantité de produit fini(en litre)</label>
                        <input class="form-control" id="disabledInput" type="number" step="0.01"
                            placeholder="Quantité de produit fini..">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Poids necessaire du produit (en kg)</label>
                        <input class="form-control" id="disabledInput" type="number" placeholder="Poids.."
                            step="0.01">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Quantité d'eau (en litre)</label>
                        <input class="form-control" id="disabledInput" type="number" step="0.01"
                            placeholder="Quantité eau...">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Quantité de sucre (en kg)</label>
                        <input class="form-control" id="disabledInput" type="number" step="0.01"
                            placeholder="Quantité sucre...">
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Volume de verre (en cl)</label>
                        <input class="form-control" id="disabledInput" type="number" step="0.01"
                            placeholder="Volume de verre...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-default" 
        ><i class="fa fa-plus"></i></button>

    <div class="box-body">
        <div class="row">
            <div class="container text-center">

                <button type="button" class="btn btn-danger pl-1" style="margin: 1em" >
                    Annuler</button>
                <button class="btn btn-success pl-1" type="button" 
                    >Confirmer</button>

            </div>
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
