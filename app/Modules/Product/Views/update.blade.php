@extends('General.layout') @section('pageTitle', 'Modifier un produit') @section('content')


<div class="content-wrapper" id="app">

    <section class="content-header">

    {{ Breadcrumbs::render('editProduct',$product) }}
    </section>

    <section class="content" id="app">
        <div class="row">
            <div class="container">

               <product-update :user_id="{{Auth::user()->id}}"> </product-update>
               <vue-progress-bar></vue-progress-bar>

                <!-- /.col -->
            </div>

        </div>

    </section>

</div>

<script>
var data = {
    product:{!! $product !!}

   
}
</script>

@endsection
