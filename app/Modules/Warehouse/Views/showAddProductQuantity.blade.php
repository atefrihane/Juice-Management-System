@extends('General.layout')
@section('pageTitle', 'Ajouter une quantité de produit')
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('productQuantity') }}
    </section>


    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Ajouter une quantité de produit</h3>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data" action="{{route('storeMachine')}}">
                        {{csrf_field()}}

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Nom de produit</label>
                                    <select class="form-control" name="name">
                                        <option value="Jus-granité">Jus </option>
                                        <option value="Jus-granité">Granité</option>
                                        <option value="Jus-granité">Jus et granité</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Code produit</label>
                                    <input type="text" name="photo" class="form-control" placeholder="Code produit">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Code à barre</label>
                                    <input type="text" name="photo" class="form-control" placeholder="Code à barre">
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Colisage</label>
                                    <input type="number" name="photo" class="form-control" placeholder="Colisage">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date prémption du produit fermé</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Quantité (nombre des unités)</label>
                                    <input type="number" name="photo" class="form-control" placeholder="Colisage">
                                </div>

                            </div>
                        </div>




                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Date de fabrication</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Entrepot</label>
                                    <select class="form-control" name="name">
                                        <option value="Jus-granité">A </option>
                                        <option value="Jus-granité">B</option>
                                        <option value="Jus-granité">C</option>
                                    </select>
                                </div>
                            </div>
                        </div>





                        <div class="row">
                            <div class="container text-center">

                                <a href="{{route('showMachines')}}" class="btn btn-danger pl-1"
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
