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
              <table  class="table table-bordered table-hover example2" >
                <thead>
                <tr>
                  <th>Logo</th>
                  <th>Nom societé</th>
                  <th>Code</th>
                  <th>Code Postal</th>
                  <th>Nbr de Magasins</th>
                  <th>Statut</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($companies as $company)
                <tr class="table-tr">
                  <td data-url="{{route('showStores',$company->id)}}" style="width: 60px"><img src="{{$company->logo}}" height="50" alt=""></td>
                  <td data-url="{{route('showStores',$company->id)}}">{{$company->name}}</td>
                  <td  data-url="{{route('showStores',$company->id)}}">{{$company->code}}</td>
                  <td  data-url="{{route('showStores',$company->id)}}">{{$company->zip_code}}</td>
                  <td  data-url="{{route('showStores',$company->id)}}">{{$company->getNbrStores()}}</td>
                  <td  data-url="{{route('showStores',$company->id)}}">{{$company->getStatus()}}</td>
                  <td class="not-this" data-url="javascript:void(0)">
                        <div class="btn-group">
                            <a class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu edit" role="menu">
                                <li><a href="{{route('editCompany', $company->id)}}">Modifier</a></li>
                                <li>
                                    <a data-toggle="modal" data-target="#modal-default" onclick="setIdToDelete({{$company->id}})"  >Supprimer</a>
                                </li>
                            </ul>
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
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Vous voulez vraiment supprimer cette societé ?</h4>
                </div>
                <div class="modal-body">
                    <p> Ce processus ne peut pas être annulé.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"  >Close</button>
                    <button type="button" class="btn btn-primary" onclick="deleteCompany()">Supprimer</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>

        <!-- /.modal-dialog -->
    </div>
    <script>
        @if(!empty(session('token')))
        localStorage.setItem('token','{{session('token')}}' );
        @endif
    </script>
    <script>
        var idToDelete;

        function setIdToDelete(id){
            idToDelete = id;
        }
        function deleteCompany(){
            let baseurl = '{{config('app.url')}}';
         location.replace( baseurl + 'company/delete/' + idToDelete);
        }
    </script>

 @endsection
