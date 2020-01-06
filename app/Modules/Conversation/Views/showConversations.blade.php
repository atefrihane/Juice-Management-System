@extends('General.layout')
@section('pageTitle', 'Démarrer une conversation')
@section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('home') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box"
                    style="box-shadow: none !important;background:none !important;border-top:none !important;">
                    <div class="box-header">
                        <h3 class="box-title">Conversations ({{$count}})</h3>
                        @if(Auth::user()->primaryAdmin())
                        <a href="{{route('showAddConversation')}}" class="btn btn-primary pull-right">Démarrer une
                            conversation</a>
                        @endif
                    </div>
                    <div class="box-body">
                        @forelse($conversations as $conversation)
                        <div class="box box-solid">
                            <div class="box-body">
                                <blockquote style="position: relative !important;top:2rem !important;">
                                <p>   <a href="" class="effect-shine">{{$conversation->subject}} 
                                    @if($conversation->messages->last()->seen == 0)
                                    &nbsp;&nbsp; <i class="fa fa-exclamation-circle" style="color:red;"> </i>
                                    @endif
                                
                                </a></p>
                                    <small>Lancée par : <cite title="Source Title"> <b>
                                     {{$conversation->messages->first()->user->formatName()}} ({{ucfirst($conversation->messages->first()->user->getType())}})
                                   
                                    </b></cite></small>

                                 
                                </blockquote>
                                <small>  @formatDate($conversation->created_at)</small>
                                <div class="pull-right">
                                    {{-- <a href="#"><i class="fa fa-eye" style="color:green;font-size:25px;"></i> </a>
                                    &nbsp;&nbsp;&nbsp; --}}
                                    <a href="#"> <i class="fa fa-trash" style="color:red;font-size:25px;"></i> </a>

                                </div>

                            </div>
                        </div>
                        @empty

                        @endforelse
                        {{ $conversations->links() }}
                    </div>

                    
                </div>
            </div>

    </section>

</div>


@endsection
