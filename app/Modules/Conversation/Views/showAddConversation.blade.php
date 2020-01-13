@extends('General.layout')
@section('pageTitle', 'Démarrer une conversation')
@section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addConversation') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="container-fluid">

                <div class="box box-primary">

                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                        <i class="fa fa-envelope"></i>

                        <h3 class="box-title">Démarrer une conversation</h3>
                    </div>


                    <form role="form" action="{{route('handleAddConversation')}}" method="post">
                        {{csrf_field()}}

                        <div class="box-body">


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Societé</label>
                                        <select class="form-control company" name="company_id"
                                            value="{{old('company_id')}}" required>
                                            <option value="">Séléctionner une societé</option>
                                            @forelse ($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                            @empty
                                            <option value="">Aucune societé</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Contacts</label>
                                        <select class="form-control contact" name="user_id" value="{{old('user_id')}}"
                                            required>
                                            <option value="">Aucun contact</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Sujet</label>
                                        <input required type="text" class="form-control" name="subject"
                                            id="exampleInputPassword1" placeholder="Sujet" value="{{old('subject')}}"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Message </label>
                                <textarea class="form-control" rows="6" name="message" placeholder="Message..."
                                    required>{{old('message')}}</textarea>
                            </div>

                            <div class="row">
                                <div class="container text-center">

                                    <a href="{{url()->previous()}}" class="btn btn-danger pl-1"
                                        style="margin: 1em">Annuler</a>
                                    <button type="submit" class="btn btn-success pl-1"
                                        style="margin: 1em">Confirmer</button>

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
