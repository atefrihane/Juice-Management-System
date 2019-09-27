@extends('General.layout') @section('pageTitle', 'Commencer location machine') @section('content')
<style>
.vdp-datepicker > div > input {

    background-color:transparent !important;
}
</style>

<div class="content-wrapper" id="app">

    <section class="content-header">

        {{ Breadcrumbs::render('rental', $machine) }}
  
    </section>

    <section class="content">
        <div class="row">
            <div class="container">

             <machine-rent> </machine-rent>
            </div>

        </div>

    </section>

</div>

<script>
var data = {
    machine:{!! $machine !!},
   bacs:{!! $machine->bacs !!}
}
</script>

@endsection


