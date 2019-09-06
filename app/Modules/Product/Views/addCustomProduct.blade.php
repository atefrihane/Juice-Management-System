@extends('General.layoutCompany') @section('pageTitle', 'Ajouter une produit') @section('content')

<style>
.swal2-popup { font-size: 1.6rem !important; }
</style>
<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addCustomProduct',$company) }}
    </section>

    <section class="content" style="margin-top:20px;" id="app">
        <div class="row">
            <div class="container">

            <product-price> </product-price>

            </div>

    </section>

</div>
<script>
company = {
   companyId: {{ $company->id }}
}
</script>



@endsection
