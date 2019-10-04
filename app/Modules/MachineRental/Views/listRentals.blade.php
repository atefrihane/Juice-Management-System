@extends('General.layout')
@section('pageTitle', 'Historique des machines')
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('historyMachine',$machine->code) }}
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Historique des Locations : <b>{{$machine->designation}}</b></h3>



                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>

                                    <th>Date debut</th>
                                    <th>Date fin</th>
                                    <th>Societé </th>
                                    <th>Désignation magasin</th>
                                    <th>Prix</th>
                                    <th>Raison d'arrêt</th>
                                    <th>Commentaire</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rentals as $rental)
                                <tr class="table-tr">
                                    <td data-url="{{route('showRental', $rental->id)}}">{{$rental->date_debut}}</td>
                                    <td data-url="{{route('showRental', $rental->id)}}">{{$rental->date_fin}}</td>
                                    <td data-url="{{route('showRental', $rental->id)}}">
                                        {{$rental->store->company->name}}</td>
                                    <td data-url="{{route('showRental', $rental->id)}}">{{$rental->store->designation}}
                                    </td>
                                    <td data-url="{{route('showRental', $rental->id)}}">{{$rental->price }}</td>
                                    <td>{{$rental->end_reason}}</td>
                                    <td style="width:30%;">{{$rental->Comment}}</td>
                                    <td> <a href="#" class="btn btn-success">Modifier</a></td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">
                                        <h4 colspan="7" class="text-center">Aucune location trouvée !</h4>
                                    </td>
                                </tr>
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
