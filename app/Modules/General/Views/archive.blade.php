@extends('General.layout')
@section('pageTitle', 'Liste des commandes')
@section('content')
<style>
    .edit {
        margin: 6px -120px 0 !important;
        min-width: 100px !important;
    }

</style>
<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('archive') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Archive des Commandes</h3>
                    </div>

                    <div class="box-body">
                        <table class="tables table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th class="date-create">Date et heure de création</th>
                                    <th>Magasin</th>
                                    <th>Code postal</th>
                                    <th>Montant</th>
                                    <th>Etat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>{{$order->code}}</td>
                                    <td>{{ $order->created_at->format('d-m-Y')}} à
                                        {{ $order->created_at->timezone('Europe/Paris')->format('H:i:s')}}</td>
                                    <td>{{$order->store->designation}}</td>
                                    <td>{{$order->store->zipcode->code}}</td>
                                    <td> {{$order->total}}€</td>
                                    <td>Comptabilisée</td>
                                    <td class="not-this text-center">

                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">
                                                <li><a href="{{route('showOrder',$order->id)}}">Voir détails</a></li>
                                            </ul>
                                        </div>
                    </div>
                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Aucune commande existante ! </td>
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

@section('scripts-custom')
<script>
var oTable = $('.tables').DataTable( {
    "language": {
      "url": "http://cdn.datatables.net/plug-ins/a5734b29083/i18n/French.json"
    },
    "bLengthChange": false ,
    "columnDefs": [ {
        "targets": -1,
    "orderable": false,

  

    },
  

     ],
     order: [ [ $('th.date-create').index(),  'desc' ] ],

    "pageLength": 20
} );

</script>
@endsection