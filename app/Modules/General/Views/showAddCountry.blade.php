@extends('General.layout')
@section('pageTitle', 'Ajouter un pays')
@section('content')

<style>
    .dataTables_filter {
        display: none !important;
    }

    /* .vue-input-tag-wrapper .input-tag {
        padding: 10px !important;
    } */

</style>
<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addCountry') }}
    </section>


    <section class="content">


        <div class="row">
            <div class="col-xs-12" id="app">

                <country-add> </country-add>

            </div>
            <!-- /.col -->
        </div>

    </section>

</div>


@endsection
