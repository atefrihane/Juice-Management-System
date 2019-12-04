@extends('General.layout') @section('pageTitle', 'Commencer location machine') @section('content')


<div class="content-wrapper" id="app">

    <section class="content-header">



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
