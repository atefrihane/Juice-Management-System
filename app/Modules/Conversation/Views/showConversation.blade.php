@extends('General.layout')
@section('pageTitle', 'Conversation')
@section('content')


<div class="content-wrapper" id="app">

    <section class="content-header">

        {{ Breadcrumbs::render('showConversation',$conversation) }}
    </section>

    <section class="content">
        <div class="container">
        <show-conversation :conversation="{{$conversation}}" auth_id="{{Auth::id()}}"> </show-conversation>
        </div>
    </section>



</div>


@endsection
