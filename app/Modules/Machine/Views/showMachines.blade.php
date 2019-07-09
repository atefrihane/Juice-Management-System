@extends('General.layout')
@section('pageTitle', 'Liste des machines')
 @section('content')

    <div class="content-wrapper">

<section class="content-header">
   
      {{ Breadcrumbs::render('machine') }}
    </section>


    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Liste des machines</h3>
              <a href="{{route('showAddMachine')}}" class="btn btn-primary pull-right">Ajouter une machine</a>
            
     
              <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover example2">
                <thead>
                <tr>
                  <th></th>
                  <th>Code</th>
                  <th>Désignation</th>
                  <th>Nbr de bacs</th>
                  <th>Prix loc mens</th>
                  <th>Statut</th>
                  <th>Etat</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>    <img src="{{asset('/img/user2-160x160.jpg')}}" class="user-image" alt="User Image"> </td>
                  <td>CMD016</td>
                  <td>Machine A</td>
                  <td>3</td>
                  <td>50€</td>
                  <td> En location</td>
                  <td>Panne</td>
                  <td class="not-this">
       <div class="btn-group">
                      <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                  <ul class="dropdown-menu edit" role="menu">
                    <li><a href="#">Commencer location</a></li>
                    <li><a href="#">Changer etat</a></li>
                    <li><a href="#">Modifier</a></li>
                    <li><a href="#">Supprimer</a></li>
                   
                  </ul>
                </div>
  
                 

                    
                  </div>
                  </td>
                </tr>


                   <tr>
                   <td>    <img src="{{asset('/img/user2-160x160.jpg')}}" class="user-image" alt="User Image"> </td>
                  <td>CMD017</td>
                  <td>Machine B</td>
                  <td>4</td>
                  <td>50€</td>
                  <td> En location</td>
                  <td>Fonctionnelle</td>
                  <td class="not-this">

                  <div class="btn-group">
                      <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                  <ul class="dropdown-menu edit" role="menu">
                    <li><a href="#">Commencer location</a></li>
                    <li><a href="#">Changer etat</a></li>
                    <li><a href="#">Modifier</a></li>
                    <li><a href="#">Supprimer</a></li>
                   
                  </ul>
                </div>
  
                 

                    
                  </div>
                  </td>
                </tr>


                   <tr>
                   <td>    <img src="{{asset('/img/user2-160x160.jpg')}}" class="user-image" alt="User Image"> </td>
                  <td>CMD017</td>
                  <td>Machine C</td>
                  <td>5</td>
                  <td>50€</td>
                  <td> Libre</td>
                  <td>Fonctionnelle</td>
                  <td class="not-this">

                      <div class="btn-group">
                      <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                  <ul class="dropdown-menu edit" role="menu">
                    <li><a href="#">Commencer location</a></li>
                    <li><a href="#">Changer etat</a></li>
                    <li><a href="#">Modifier</a></li>
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
