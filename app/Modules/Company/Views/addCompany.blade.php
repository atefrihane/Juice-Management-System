@extends('General.layout')
@section('pageTitle', 'Ajouter une societé')

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
              <h3 class="box-title"> Ajouter une societé</h3>
  
            </div>
       
       
            <form role="form">
              <div class="box-body">
              <div class="row">

              <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">ID</label>
                  <input class="form-control" id="disabledInput" type="text" placeholder="{{$lastCompanyId}}" disabled>
     
                </div>
              </div>

              <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Code</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code..">
                </div>
              </div>

                  <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Statut</label>
                  <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
              </div>

              </div>

             
                <div class="form-group">
                  <label for="exampleInputPassword1">Nom du groupe</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nom du groupe">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Désignation</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Désignation">
                </div>

                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label>Ville</label>
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
                  <label for="exampleInputPassword1">Code Postal</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Code Postal">
                </div>
                
                </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Addresse du siege</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Addresse du siege">
                </div>

                     <div class="form-group">
                  <label for="exampleInputPassword1">Complement addresse (optionnel)</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Complement addresse">
                </div>

                <div class="form-group">
                  <label>Commentaires (optionnel)</label>
                  <textarea class="form-control" rows="3" placeholder="Commentaires"></textarea>
                </div>
                <div class="row">
                <div class="container">
                
                </div>
                </div>
                <div class="container center-block">
                <div class="form-group">
                  <label for="exampleInputFile">Logo du societé (optionnel)</label>
                  <input type="file" id="exampleInputFile">

  
                </div>

                <div class="row">
                <div class="container text-center">
                
                <a href="" class="btn btn-danger pl-1">Annuler</a>
                <a href="" class="btn btn-success pl-1">Ajouter une societé</a>
                
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