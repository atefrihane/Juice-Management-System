@extends('General.vue_layout') @section('pageTitle', 'Préparer les produits') @section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('showUpdateStatusOrder',$order) }}
    </section>

    <section class="content" id="app">
        <div class="row">
            <div class="container-fluid">

     
          <order-prepared-products
             order_id="{{$order->id}}"
             code="{{$order->code}}"
             status="{{$order->status}}"
             user_id="{{Auth::user()->id}}"
               > </order-prepared-products>
                
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
