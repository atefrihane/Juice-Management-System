@extends('General.vue_layout') @section('pageTitle', 'Ajouter une commande') @section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addOrder') }}
    </section>

    <section class="content" id="app">
        <div class="row">
            <div class="container-fluid">

             <order-add></order-add>
                <!-- /.col -->
            </div>

        </div>

    </section>

</div>

@endsection
<script>
order = {
   orderId: {{ $lastOrder }},
   userId: {{ Auth::user()->id }}
}
</script>


