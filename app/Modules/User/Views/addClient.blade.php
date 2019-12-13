@extends('General.layoutCompany') @section('pageTitle', 'Ajouter une contact') @section('content')


<div class="content-wrapper" id="app">

    <section class="content-header">

        {{ Breadcrumbs::render('addContact',$company) }}
    </section>

    <contact-add :company="{{$company}}" :user="{{Auth::user()}}"> </contact-add>

</div>



@endsection


