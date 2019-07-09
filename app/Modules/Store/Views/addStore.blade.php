@extends('General.layoutCompany') @section('pageTitle', 'Ajouter un magasin') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addStore',$company) }}
    </section>

    <section class="content" style="margin-top:20px;">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Ajouter un magasin</h3>

                    </div>

                    <form role="form">
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ID</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="ID" disabled>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Code..">
                                    </div>
                                </div>

                                         <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Activité</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Activité..">
                                    </div>
                                </div>

                            </div>

                              <div class="form-group">
                                        <label for="exampleInputEmail1">Groupe</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Groupe">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nom Magasin</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Nom Magasin">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Enseigne</label>
                                        <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>


                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Désignaiton</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="aa">

                                    </div>


                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ville</label>
                                        <select class="form-control">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code Postal</label>
                                        <input class="form-control" id="disabledInput" type="number" placeholder="Code Postal">

                                    </div>
                                </div>

                            </div>

                            <div class="row">

                            <div class="col-md-6">
                            <div class="form-group">
                  <label>Heure d'ouverture</label>

                  <div class="input-group bootstrap-timepicker">
                    <input type="text" class="form-control timepicker ">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                  <label>Heure de fermeture</label>

                  <div class="input-group bootstrap-timepicker">
                    <input type="text" class="form-control timepicker">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                            </div>

                            </div>


   <div class="form-group">
                                        <label for="exampleInputEmail1">Adresse du magasin</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Adresse du magasin">

                                    </div>

                                       <div class="form-group">
                                        <label for="exampleInputEmail1">Complement d'adresse</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Complement d'adresse">

                                    </div>


                                 <div class="form-group">
                  <label>Commentaires (optionnel)</label>
                  <textarea class="form-control" rows="3" placeholder="Commentaires"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Logo du societé (optionnel)</label>
                  <input type="file" id="exampleInputFile">

  
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