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

                    <div class="box-body scrollable-table">
                        <table class="table table-bordered table-hover example2 ">
                            <thead>
                                <tr>
                                    <th class="is-wrapped">Code</th>
                                    <th class="date-create">Date et heure de création</th>
                                    <th class="is-wrapped" >Magasin</th>
                                    <th class="is-wrapped" >Code postal</th>
                                    <th class="is-wrapped" >Montant (€) </th>
                                    <th class="is-wrapped" >Commentaire</th>
                                    <th class="is-wrapped" >Etat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr class="table-t">
                                    <td data-url="{{route('showOrder',$order->id)}}">{{$order->code}}</td>
                                    <td data-url="{{route('showOrder',$order->id)}}">{{ $order->created_at->format('d-m-Y')}} à
                                        {{ $order->created_at->timezone('Europe/Paris')->format('H:i:s')}}</td>
                                    <td data-url="{{route('showOrder',$order->id)}}">{{$order->store->designation}}</td>
                                    <td data-url="{{route('showOrder',$order->id)}}">{{$order->store->zipcode->code}}</td>
                                    <td data-url="{{route('showOrder',$order->id)}}">  @convert($order->total)</td>
                                    <td data-url="{{route('showOrder',$order->id)}}">Comptabilisée</td>
                                    <th data-url="{{route('showOrder',$order->id)}}">{{$order->comment}}</th>
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
