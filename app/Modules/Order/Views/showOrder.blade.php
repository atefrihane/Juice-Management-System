@extends('General.vue_layout') @section('pageTitle', 'Afficher une commande') @section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('showOrder',$order) }}
    </section>

    <section class="content" id="app">
        <div class="row">
            <div class="container-fluid">

             <order-show order_id="{{$order->id}}" company_id="{{$order->store->company->id}}" user_id="{{Auth::user()->id}}"></order-show>
                
                
            </div>

        </div>

    </section>

</div>


<script>
order = {

   company_id: {{ $order->store->company->id }}
}
</script>

@endsection
