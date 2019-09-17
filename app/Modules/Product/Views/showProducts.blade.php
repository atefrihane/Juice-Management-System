@extends('General.layout')
@section('pageTitle', 'Liste des produits')
 @section('content')

    <div class="content-wrapper">

<section class="content-header">

      {{ Breadcrumbs::render('product') }}
    </section>


    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Liste des produits</h3>
              <a href="{{route('showAddProduct')}}" class="btn btn-primary pull-right" disabled>Ajouter un produit</a>


              <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover example2">
                <thead>
                <tr>

                    <th>Nom Produit</th>
                    <th>Type</th>
                    <th>Désignation</th>
                    <th>Prix unitaire de base</th>
                    <th>Etat</th>
                    <th></th>
                </tr>
                </thead>
                  <tbody>
                  @forelse($products as $product)
                  <tr>
                      <td>{{$product->nom}}</td>
                      <td>{{$product->type}}</td>
                      <td>{{$product->designation}}</td>

                      <td>{{$product->public_price}}</td>
                      <td> {{$product->status}}</td>

                      <td class="not-this text-center">
                          <div class="btn-group">
                              <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                              <ul class="dropdown-menu edit" role="menu">

                                  <li><a href="#">Changer etat vers non disponible</a></li>
                                  <li><a href="{{route('editProduct', $product->id)}}">Modifier</a></li>
                                  <li>
                                      <a data-toggle="modal" data-target="#modal-default{{$product->id}}"   >Supprimer</a>
                                  </li>
                              </ul>
                          </div>
                      </td>
                  </tr>
                  <div class="modal fade" id="modal-default{{$product->id}}" style="display: none;">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span></button>
                                  <h4 class="modal-title">Vous voulez vraiment supprimer ce produit ?</h4>
                              </div>
                              <div class="modal-body">
                                  <p> Ce processus ne peut pas être annulé.</p>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal"  >Close</button>
                                  <a  class="btn btn-primary" href="{{route('deleteProduct', $product->id)}}">Supprimer</a>
                              </div>
                          </div>
                          <!-- /.modal-content -->
                      </div>

                      <!-- /.modal-dialog -->
                  </div>
                      @empty
                      <tr>aucun produit !!! </tr>
                  @endforelse
                </tbody>

              </table>
            </div>

          </div>


        </div>

      </div>

    </section>

  </div>

 @endsection
