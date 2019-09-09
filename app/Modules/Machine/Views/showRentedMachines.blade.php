@extends('General.layoutCompany')
@section('pageTitle', 'Liste des machines')
 @section('content')

    <div class="content-wrapper">

<section class="content-header">

      {{ Breadcrumbs::render('rentedMachine',$company) }}
    </section>


    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Machines en location pour la  societé  &nbsp;&nbsp; <small>  {{$company->name}}</small></h3>


              <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover example2">
                <thead>
                <tr>
                  <th></th>
                  <th>Code Machine</th>
                  <th>Désignation</th>
                  <th>Nbr de bacs</th>
                  <th>Magasin</th>

                  <th>Etat</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($machines as $machine)
                <tr>
                    <td>    <img src="../../{{$machine->machine->photo_url}}" height="80" class="user-image" alt="User Image"> </td>
                    <td>{{$machine->machine->code}}</td>
                    <td>{{$machine->machine->designation}}</td>
                    <td>{{$machine->machine->number_bacs}}</td>

                    <td>{{$machine->store->designation}}</td>
                    <td>{{$machine->machine->status}}</td>
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

                    </td>
                </tr>
                    @empty
                    <tr>aucune machine en location !!</tr>
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
