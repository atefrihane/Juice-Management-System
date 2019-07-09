@extends('General.layoutCompany') @section('pageTitle', 'Ajouter une produit') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addCustomProduct',$company) }}
    </section>

    <section class="content" style="margin-top:20px;">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Ajouter un produit</h3>

                    </div>

                    <form role="form">
                        <div class="box-body">
                        
                               <div class="form-group">
                                        <label for="exampleInputEmail1">Nom Produit</label>
                                        <select class="form-control">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>

                                    </div>
                                    <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code produit</label>
                                            <input class="form-control" id="disabledInput" type="text" placeholder="Code produit">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code à barre</label>
                                            <input class="form-control" id="disabledInput" type="text" placeholder="Code à barre">

                                        </div>
                                    </div>

                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Prix unitaire de base (euro)</label>
                                            <input class="form-control" id="disabledInput" type="number" placeholder="Prix unitaire de base (euro)">

                                        </div>
                                    </div>

                                    </div>

                                       <div class="form-group">
                                            <label for="exampleInputEmail1">Prix unitaire pour societé (euro)</label>
                                            <input class="form-control" id="disabledInput" type="number" placeholder="Prix unitaire pour societé (euro)<">

                                        </div>


                                     





                  <div class="row">
                <div class="container text-center">
                
                <a href="" class="btn btn-danger pl-1">Annuler</a>
                <a href="" class="btn btn-success pl-1">Confirmer</a>
                
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