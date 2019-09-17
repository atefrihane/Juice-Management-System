@extends('General.layout')
@section('pageTitle', 'Liste des commandes')
 @section('content')

    <div class="content-wrapper">

<section class="content-header">
   
      {{ Breadcrumbs::render('order') }}
    </section>


    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Liste des Commandes</h3>
              <a href="{{route('showAddOrder')}}" class="btn btn-primary pull-right">Ajouter une commande</a>
            
     
              <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover example2">
                <thead>
                <tr>
                  <th>Code</th>
                  <th>produits</th>
                  <th>Destinataire</th>
                  <th>Montant à payer</th>
                  <th>Etat</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>CMD016</td>
                  <td>Jus de fraise x 10</td>
                  <td>Carrefour</td>
                  <td>50€</td>
                  <td> En attente</td>
                  <td class="not-this text-center">

                      <div class="btn-group">
                      <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                  <ul class="dropdown-menu edit" role="menu">
                    <li><a href="#">Modifier</a></li>
                    <li><a href="#">Annuler</a></li>
                    <li><a href="#">Supprimer</a></li>
                   
                  </ul>
                </div>
  
                 

                    
                  </div>
                  </td>
                </tr>


                   <tr>
                  <td>CMD017</td>
                  <td>Jus d'orange x 10</td>
                  <td>Carrefour</td>
                  <td>50€</td>
                  <td> En attente</td>
                  <td class="not-this text-center">

                      <div class="btn-group">
                      <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                  <ul class="dropdown-menu edit" role="menu">
                    <li><a href="#">Modifier</a></li>
                    <li><a href="#">Annuler</a></li>
                    <li><a href="#">Supprimer</a></li>
                   
                  </ul>
                </div>
  
                 

                    
                  </div>
                  </td>
                </tr>


                   <tr>
                  <td>CMD017</td>
                  <td>Jus de banane x 10</td>
                  <td>Carrefour</td>
                  <td>50€</td>
                  <td> En attente</td>
                  <td class="not-this text-center">

                      <div class="btn-group">
                      <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                  <ul class="dropdown-menu edit" role="menu">
                    <li><a href="#">Modifier</a></li>
                    <li><a href="#">Annuler</a></li>
                    <li><a href="#">Supprimer</a></li>
                   
                  </ul>
                </div>
  
                 

                    
                  </div>
                  </td>
                </tr>
           
           



                </tbody>

              </table>
            </div>

          </div>


        </div>

      </div>

    </section>

  </div>

 @endsection
