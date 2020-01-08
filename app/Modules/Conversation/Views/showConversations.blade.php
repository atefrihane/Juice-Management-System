@extends('General.layout')
@section('pageTitle', 'Démarrer une conversation')
@section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('conversations') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box"
                    style="box-shadow: none !important;background:none !important;border-top:none !important;">
                    <div class="box-header">
                        <h3 class="box-title">Conversations ({{count($conversations)}})</h3>
                        @if(Auth::user()->primaryAdmin())
                        <a href="{{route('showAddConversation')}}" class="btn btn-primary pull-right">Démarrer une
                            conversation</a>
                        @endif
                    </div>
                    <div class="box-body ">
                        @forelse($conversations as $conversation)

                        <div class="box box-solid {{$conversation->messages->last()->seen == 0  ? 'box-bg' :  ''}}"
                            data-id="{{$conversation->id}}">
                            <div class="box-body">

                                <blockquote style=" position: relative !important;top:2rem !important;">
                                    <div class="btn-group" style="float:right;">
                                        <a class="dots" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"></a>
                                        <ul class="dropdown-menu edit" role="menu">
                                            <li><a href=""">Voir détails</a></li>
                                                    <li><a href=""">Supprimer</a></li>
                                        </ul>
                                    </div>
                                    <p> <a href="{{route('showConversation',$conversation->id)}}"
                                            class="effect-shine">Sujet : {{$conversation->subject}}
                                        </a>

                                        &nbsp;&nbsp; <span class="dot"></span>


                                    </p>

                                    <small>Lancée par : <cite title="Source Title"> <b>
                                                {{$conversation->messages->first()->user->formatName()}}
                                                @switch($conversation->messages->first()->user->getType())
                                                @case('admin')
                                                (Admin)
                                                @break
                                                @case('Directeur')

                                                ({{$conversation->messages->first()->user->child->store->company->name}})
                                                @break
                                                @case('Autre')
                                                ({{$conversation->messages->first()->user->child->stores->first()->company->name}})
                                                @break
                                                @endswitch


                                            </b></cite></small>


                                </blockquote>
                                <small> Dérnier message : @formatDate($conversation->messages->last()->created_at) par
                                    {{$conversation->messages->last()->user->formatName()}}
                                    @switch($conversation->messages->last()->user->getType())
                                    @case('admin')
                                    (Admin)
                                    @break
                                    @case('Directeur')

                                    ({{$conversation->messages->last()->user->child->store->company->name}})
                                    @break
                                    @case('Autre')
                                    ({{$conversation->messages->last()->user->child->stores->first()->company->name}})
                                    @break
                                    @endswitch</small>


                            </div>
                        </div>


                        @empty
                        <div class="box box-solid">
                             
                                <!-- /.box-header -->
                                <div class="box-body">
                                  <blockquote>
                                    <p class="text-center" style="margin-top:10px;">Aucune conversation trouvée !</p>
                              
                                  </blockquote>
                                </div>
                                <!-- /.box-body -->
                              </div>

                        @endforelse
                        {{ $conversations->links() }}
                    </div>



                </div>
            </div>

    </section>

</div>


@endsection
