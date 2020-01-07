@extends('General.layout')
@section('pageTitle', 'Acceuil')
@section('content')


<div class="content-wrapper" id="app">

    <section class="content-header">

        {{ Breadcrumbs::render('home') }}
    </section>

    <section class="content">
        <div class="container-fluid">
        <show-conversation :conversation="{{$conversation}}" auth_id="{{Auth::id()}}"> </show-conversation>

        </div>




    </section>



</div>


@endsection
