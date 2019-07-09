@extends('General.layout')
@section('pageTitle', 'Acceuil')
 @section('content')


    <div class="content-wrapper">

<section class="content-header">
  
      {{ Breadcrumbs::render('home') }}
    </section>


    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Liste des societés</h3>
              <a href="{{route('showAddCompany')}}" class="btn btn-primary pull-right">Ajouter une societé</a>
            
     
              <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table  class="table table-bordered table-hover example2" style="width:100%;">
                <thead>
                <tr>
                  <th>Nom societé</th>
                  <th>Code</th>
                  <th>Code Postal</th>
                  <th>Nbr de Magasins</th>
                  <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                @forelse($companies as $company)

                <tr class="table-tr">
                  <td data-url="{{route('showCompany',$company->id)}}">{{$company->name}}</td>
                  <td  data-url="{{route('showCompany',$company->id)}}">{{$company->code}}</td>
                  <td  data-url="{{route('showCompany',$company->id)}}">{{$company->zip_code}}</td>
                  <td  data-url="{{route('showCompany',$company->id)}}">5</td>
                  <td  data-url="{{route('showCompany',$company->id)}}">{{$company->status}}</td>
                  <td class="not-this">

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

                @empty
                <tr>
                 <p>Aucune societé !</p>
                </tr>
                @endforelse



                </tbody>

              </table>

            </div>
            <!-- /.box-body -->
          </div>


        </div>
        <!-- /.col -->
      </div>

    </section>

  </div>

 @endsection
