@extends('General.layoutCompany') @section('pageTitle', 'Ajouter une contact') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addContact',$company) }}
    </section>

    <section class="content" style="margin-top:20px;">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Ajouter un contact</h3>

                    </div>

                    <form role="form">
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ID</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="ID" disabled>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Code..">
                                    </div>
                                </div>

                   

                            </div>

                    


                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nom</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Nom">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Prénom</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Prénom">

                                    </div>
                                </div>

                            </div>

                               <div class="form-group">
                                        <label for="exampleInputEmail1">Sexe</label>
                                        <select class="form-control">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>

                                    </div>
                                    <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input class="form-control" id="disabledInput" type="email" placeholder="Nom">

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Téléphone</label>
                                            <input class="form-control" id="disabledInput" type="phone" placeholder="Téléphone">

                                        </div>
                                    </div>

                                    </div>


                                            <div class="form-group">
                                        <label for="exampleInputEmail1">Type de contact</label>
                                        <select class="form-control">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>

                                    </div>

                                        <div class="form-group">
                                        <label for="exampleInputEmail1">Magasins de responsabilités</label>
                                        <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox">
                                            Nom Magasin
                                            </label>
                                        </div>

                                 

                                      
                                        </div>

                                    </div>


                                       <div class="form-group">
                                        <label for="exampleInputEmail1">Code d'accés</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Code d'accés">

                                    </div>

                                       <div class="form-group">
                                        <label for="exampleInputEmail1">Mot de passe</label>
                                        <input class="form-control" id="disabledInput" type="password" placeholder="Mot de passe">

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