@extends('General.layout') @section('pageTitle', 'Commencer location machine') @section('content')
<style>
.vld-overlay .vld-icon, .vld-parent {
    position: absolute;
    top: 75%;
}

</style>


<div class="content-wrapper" id="app">

    <section class="content-header">

    {{ Breadcrumbs::render('startRental') }}

    </section>

    <section class="content">
        <div class="row">
            <div class="container">

                <general-machine-rent :user="{{Auth::user()->id}}" :machines="{{$machines}}" last="{{url()->previous()}}"> </general-machine-rent>
            </div>

        </div>

    </section>

</div>

@endsection
