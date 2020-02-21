@extends('General.layout')
@section('pageTitle', 'Importer une régie publicitaire')
@section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('advertisements') }}
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12" id="app">
                <ads-upload> </ads-upload>

            </div>


        </div>

</div>

</section>

</div>


@endsection
