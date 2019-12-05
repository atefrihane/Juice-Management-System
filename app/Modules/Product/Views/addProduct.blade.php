@extends('General.layout') @section('pageTitle', 'Ajouter un produit') @section('content')


<div class="content-wrapper" id="app">

    <section class="content-header">

        {{ Breadcrumbs::render('addProduct') }}
    </section>

    <section class="content" id="app">
        <div class="row">
            <div class="container">

               <product-add :user_id="{{Auth::user()->id}}"> </product-add>
               <vue-progress-bar></vue-progress-bar>

                <!-- /.col -->
            </div>

        </div>

    </section>

</div>
<script>
product = {
   productId: {{ $product }}
}
</script>


@endsection
