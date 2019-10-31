@extends('General.vue_layout') @section('pageTitle', 'Modifier une commande') @section('content')
<style>
    .dataTables_filter {
        display: none !important;
    }

  

</style>
<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('updateOrder') }}
    </section>

    <section class="content" id="app">
        <div class="row">
            <div class="container-fluid">

             <order-update order_id="{{$order->id}}" company_id="{{$order->store->company->id}}" user_id="{{Auth::user()->id}}"></order-update>
                <!-- /.col -->
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
