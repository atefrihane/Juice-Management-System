@extends('General.layoutStore')
@section('pageTitle', $store->designation)
@section('content')
<style>
    .dots:after {
        content: '\f141';
        font-family: FontAwesome;
        font-size: 20px;
        color: black;


    }

    .edit {
        margin: 6px -20px 0 !important;
        min-width: 100px;
    }

</style>
<div class="content-wrapper">



    <section class="content-header">
       
    {{ Breadcrumbs::render('detailStore',$store->company,$store->designation) }}
    </section>

    <div class="container" style="margin-top:50px;">
        <section class="content-header">
            <h1>
                Informations du magasin
                <small> {{$store->designation}}</small>
            </h1>
            <div class="btn-group breadcrumb1">
                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <ul class="dropdown-menu edit" role="menu">
                    <li><a href="{{route('editStore',$store->id)}}">Modifier</a></li>

                    <li><a href="" data-toggle="modal" data-target="#modal-default{{$store->id}}">Supprimer</a></li>

                </ul>
            </div>

        </section>

                 <div class="modal fade" id="modal-default{{$store->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Vous voulez vraiment supprimer ce magasin ?
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p> Ce processus ne peut pas être annulé.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <form action="{{ route('deleteStore',$store->id) }}"
                                                        method="post">
                                                        {{csrf_field()}}
                                                        <a href="#" class="btn btn-danger"
                                                            data-dismiss="modal">Annuler</a>

                                                        <button type="submit" class="btn btn-success">Confirmer</button>
                                                      

                                                    </form>

                                                </div>


                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>

                                    <!-- /.modal-dialog -->
                                </div>

        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{asset('/')}}{{$store->photo}}" style="width:100%;padding:40px;">
                </div>
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code</label>
                                            <input type="text" class="form-control" value="{{$store->code}}" readonly
                                                aria-describedby="emailHelp" placeholder="Code..">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Statut</label>
                                            <input type="text" class="form-control"
                                                value="{{ucfirst($store->status)}}"
                                                readonly placeholder="Nom du groupe">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Désignation</label>
                                    <input type="text" class="form-control" value="{{$store->designation}}" readonly
                                        placeholder="Nom du groupe">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ville</label>
                                            <input type="text" class="form-control" value="{{$store->city}}" readonly
                                                aria-describedby="emailHelp" placeholder="Ville">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Code Postal</label>
                                            <input type="text" class="form-control" value="{{$store->zip_code}}"
                                                readonly placeholder="Code Postal">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Adresse de siége</label>
                                    <input type="text" class="form-control" value="{{$store->address}}" readonly
                                        placeholder="Adresse de siége">
                                </div>



                                <div class="form-group">
                                    <label for="exampleInputPassword1">Complément addresse (optionnel )</label>
                                    <input type="text" class="form-control" value="{{$store->complement}}" readonly
                                        placeholder="Complément addresse">
                                </div>

                                <div class="form-group">
                                    <label>Commentaires (optionnel)</label>
                                    <textarea class="form-control" rows="3" readonly
                                        placeholder="Commentaires">{{$store->comment}}</textarea>
                                </div>





                            </form>
                        </div>
                    </div>
                </div>
            </div>




        </section>
    </div>
</div>
@endsection
