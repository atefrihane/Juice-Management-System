@extends('General.layoutCompany') @section('pageTitle', 'Detail contact') @section('content')

    <div class="" style="height: 50px; background-color: #ecf0f5;">
    </div>

    <div class="content-wrapper" >
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <div class="box-title"><h1>Details du contact</h1> </div>

                    </div>


        <section class="content" style="margin-top:20px;">
            <div class="box-body container">
                <div class=" container row" >
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-10">
                        <h3>
                        @if($user->civilite == 'Homme')
                            M.
                            @else
                            Mme.
                            @endif

                            {{$user->nom.' '. $user->prenom}}
                        </h3>
                    </div>
                </div>
                <div class=" container row" style="margin-top: 15px">

                    <div class="col-md-2">

                    </div>
                    <div class="col-md-10">
                       <div>Type contact</div>
                        <div style="font-size: 24px">{{$user->getType()}}</div>
                    </div>
                </div>
                <div class=" container row" style="margin-top: 15px">

                    <div class="col-md-2">

                    </div>
                    <div class="col-md-10">
                       <div>Code</div>
                        <div style="font-size: 24px">{{$user->code}}</div>
                    </div>
                </div>
                <div class=" container row" style="margin-top: 15px">

                    <div class="col-md-2">

                    </div>
                    <div class="col-md-5">
                       <div>email</div>
                        <div style="font-size: 24px">{{$user->email}}</div>
                    </div>
                    <div class="col-md-5">
                       <div>Téléphone</div>
                        <div style="font-size: 24px">{{$user->telephone}}</div>
                    </div>
                </div>
                <div class=" container row" style="margin-top: 15px; margin-bottom: 30px">

                    <div class="col-md-2">

                    </div>
                    <div class="col-md-10">
                        <div>Code d'accès</div>
                        <div style="font-size: 24px">{{$user->accessCode}}</div>
                    </div>
                </div>

            </div>
        </section>
    </div>
            </div>
        </div>
    </div>
@endsection
