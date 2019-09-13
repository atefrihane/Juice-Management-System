@extends('General.layout')
@section('pageTitle', 'Historique des machines')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            {{ Breadcrumbs::render('historyMachine',$rentals->first()->machine) }}
        </section>


        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Historique des Locations</h3>



                            <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered table-hover example2" >
                                <thead>
                                <tr >

                                    <th>Code machine</th>
                                    <th>Désignation machine</th>
                                    <th>Societé </th>
                                    <th>Désignation magasin</th>
                                    <th>Prix</th>
                                    <th>Date debut</th>
                                    <th>Date fin</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($rentals as $rental)
                                    <tr class="table-tr">
                                        <td data-url="{{route('showRental', $rental->id)}}" >{{$rental->machine->code}}</td>
                                        <td data-url="{{route('showRental', $rental->id)}}" >{{$rental->machine->designation}}</td>
                                        <td data-url="{{route('showRental', $rental->id)}}" >{{$rental->store->company->name}}</td>
                                        <td data-url="{{route('showRental', $rental->id)}}" >{{$rental->store->designation}}</td>
                                        <td data-url="{{route('showRental', $rental->id)}}" >{{$rental->price }}</td>
                                        <td data-url="{{route('showRental', $rental->id)}}" >{{$rental->date_debut}}</td>
                                        <td data-url="{{route('showRental', $rental->id)}}" >{{$rental->date_fin}}</td>
                                    </tr>
                                @empty
                                    <tr>Aucune machine ! </tr>
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

