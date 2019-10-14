@extends('General.layout')
@section('pageTitle', 'Modifier un pays')
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

        {{ Breadcrumbs::render('updateCountry',$country->name) }}
    </section>


    <section class="content">


        <div class="row">
            <div class="col-xs-12" id="app">

                <country-update> </country-update>

            </div>
            <!-- /.col -->
        </div>

    </section>

</div>
<script>
var data = {
    country:{!! $country !!},
    zipcodes:{!! $cities !!},

}
</script>


@endsection
