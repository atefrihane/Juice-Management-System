@extends('General.layout')
@section('pageTitle', 'Mise a jour état machine')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            {{ Breadcrumbs::render('company') }}
        </section>


        <section class="content">
            <div class="row">
                <div class="container">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title"> Mise à jour état machine </h3>

                        </div>


                        <form role="form" action="{{route('handleUpdateState',$machine->id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="box-body">
                                <div class="row">



                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Etat</label>
                                            <select class="form-control" name="status">
                                                @if($machine->status != 'Fonctionnelle')
                                                <option value="Fonctionnelle">Fonctionnelle</option>
                                                @endif
                                                @if($machine->status != 'Non utilisé')
                                                <option value="Non utilisé">Non utilisé</option>
                                                @endif
                                                @if($machine->status != 'En panne')
                                                    <option value="En panne">En panne</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label>Commentaires (optionnel)</label>
                                    <textarea class="form-control" rows="3" name="comment" placeholder="Commentaires"></textarea>
                                </div>
                                <div class="row">
                                    <div class="container">

                                    </div>
                                </div>
                                <div class="container center-block">
                                    <div class="row">
                                        <div class="container text-center">

                                            <a onclick="history.back()" class="btn btn-danger pl-1" style="margin: 1em">Annuler</a>
                                            <button type="submit" class="btn btn-success pl-1" style="margin: 1em">Confirmer</button>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- /.col -->
                </div>

            </div>

        </section>

    </div>
@endsection
