@extends('General.layout') @section('pageTitle', 'Ajouter un produit') @section('content')


<div class="content-wrapper" id="app">

    <section class="content-header">

        {{ Breadcrumbs::render('addProduct') }}
    </section>

    <section class="content" id="app">
        <div class="row">
            <div class="container">

               <product-add> </product-add>

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
