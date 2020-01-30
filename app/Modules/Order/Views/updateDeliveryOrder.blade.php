@extends('General.vue_layout') @section('pageTitle', 'Modifier état de la commande') @section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('showUpdateStatusOrder',$order) }}
    </section>

    <section class="content" id="app">
        <div class="row">
            <div class="container-fluid">

             <delivery-update :order="{{$order}}" :user_id="{{Auth::user()->id}}" :history="{{$history ? $history : 'null'}}" > </delivery-update>


            </div>

        </div>

    </section>

</div>


@endsection
