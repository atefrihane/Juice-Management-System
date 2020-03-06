@extends('General.layout')
@section('pageTitle', 'Acceuil')
@section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('home') }}
    </section>

    <section class="content" id="app">
    <test-event :user="{{Auth::user()}}"> </test-event>
    </section>

@endsection
