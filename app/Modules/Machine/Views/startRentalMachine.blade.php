@extends('General.layout') @section('pageTitle', 'Commencer location machine') @section('content')


<div class="content-wrapper" id="app">

    <section class="content-header">

        {{ Breadcrumbs::render('rental', $machine) }}
  
    </section>

    <section class="content">
        <div class="row">
            <div class="container">

            <machine-rent  :occupied_days="{{$occupiedDays}}"> </machine-rent>
            </div>

        </div>

    </section>

</div>

<script>
var data = {
    machine:{!! $machine !!},
   user:{!! Auth::user() !!}
}
</script>

@endsection


