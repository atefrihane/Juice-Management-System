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
              <a href="{{route('showAddProduct')}}" class="btn btn-primary pull-right">Ajouter un produit</a>


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

                      <td class="not-this">
                          <div class="btn-group">
                              <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                              <ul class="dropdown-menu edit" role="menu">

                                  <li><a href="#">Changer etat vers non disponible</a></li>
                                  <li><a href="#">Modifier</a></li>
                                  <li><a href="#">Supprimer</a></li>

                              </ul>
                          </div>
                      </td>
                  </tr>
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
