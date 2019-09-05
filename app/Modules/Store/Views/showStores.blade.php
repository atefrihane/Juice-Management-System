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
                  <th>Code</th>
                  <th>Désignation</th>
                  <th>Ville</th>
                  <th>Code Postal</th>
                  <th>Etat</th>
                </tr>
                </thead>
                <tbody>
                @forelse($stores as $store)
                    <tr>
                      <td>{{$store->code}}</td>
                      <td>{{$store->designation}}</td>
                      <td>{{$store->city}}</td>
                      <td>{{$store->zip_code}}</td>
                      <td> {{$store->status}}</td>
                        <td class="not-this">
                            <div class="btn-group">
                                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu edit" role="menu">
                                    <li><a href="{{route('editStore', $store->id)}}">Modifier</a></li>
                                    <li>
                                        <a data-toggle="modal" data-target="#modal-default" onclick="setIdToDelete({{$store->id}})"  >Supprimer</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <p>Aucune Magasin !</p>
                    </tr>
                @endforelse
                </tbody>

              </table>
                {{env("APP_URL")}}

            </div>

          </div>


        </div>

      </div>

    </section>

  </div>
<div class="modal fade" id="modal-default" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Vous voulez vraiment supprimer cette Magasin ?</h4>
            </div>
            <div class="modal-body">
                <p> Ce processus ne peut pas être annulé.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"  >Close</button>
                <button type="button" class="btn btn-primary" onclick="deleteStore()">Supprimer</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    var idToDelete;
    function setIdToDelete(id){
        idToDelete = id;
    }
    function deleteStore(){
        let baseurl = '{{   env('APP_URL')}}';
        location.replace(baseurl + 'store/delete/'+ idToDelete);
    }
</script>
 @endsection
