@extends('General.layoutCompany')
@section('pageTitle', 'Liste des Magasins')
 @section('content')
<style>

 .dots:after{ 
   content: '\f141';
   font-family: FontAwesome;
font-size:20px;
   color:black;


} 
.edit{
margin: 6px -20px 0 !important;
min-width:100px;
}
</style>

    <div class="content-wrapper">

<section class="content-header">
   
{{ Breadcrumbs::render('store', $company) }}
    </section>


    <section class="content" style="margin-top:20px;">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Liste des Magasins</h3>
              <a href="{{route('showAddStore',$company->id)}}" class="btn btn-primary pull-right">Ajouter un magasin</a>
            
     
              <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table  class="table table-bordered table-hover example2">
                <thead>
                <tr>
                  <th>Nom de Magasin</th>
                  <th>Ville</th>
                  <th>Code Postal</th>
                  <th>Nbr de machines</th>
                  <th>Activité</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>CMD016</td>
                  <td>Paris</td>
                  <td>75000</td>
                  <td>50€</td>
                  <td> En attente</td>
                
                </tr>


                   <tr>
                  <td>CMD017</td>
                  <td>Paris</td>
                  <td>75000</td>
                  <td>50€</td>
                  <td> En attente</td>
              
                </tr>


                   <tr>
                  <td>CMD018</td>
                  <td>Paris</td>
                  <td>75000</td>
                  <td>50€</td>
                  <td> En attente</td>
               
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
