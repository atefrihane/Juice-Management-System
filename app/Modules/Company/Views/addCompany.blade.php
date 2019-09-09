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


            <form role="form" action="{{route('handleAddCompany')}}" method="post" enctype="multipart/form-data">
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

              <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">ID</label>
                  <input  required class="form-control" id="disabledInput" type="text" placeholder="{{$lastCompanyId}}" disabled>

                </div>
              </div>

              <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Code</label>
                  <input  required type="text" class="form-control"  name="code" id="exampleInputEmail1" placeholder="Code">
                </div>
              </div>

                  <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Statut</label>
                  <select class="form-control" name="status">
                    <option value="2">Active</option>
                    <option value="1">En sommeil</option>
                    <option value="0">Fermé</option>
                  </select>
                </div>
              </div>

              </div>


                <div class="form-group">
                  <label for="exampleInputPassword1">Nom du groupe</label>
                  <input  required type="text" class="form-control" name="name" id="exampleInputPassword1" placeholder="Nom du groupe">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Désignation</label>
                  <input  required type="text" class="form-control" name="designation" id="exampleInputPassword1" placeholder="Désignation">
                </div>

                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label>Pays</label>
                  <select class="form-control" name="country">
                    <option value="France">France</option>
                  </select>
                </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label>Ville</label>
                  <select class="form-control" name="city">
                    <option value="Paris">  Paris  </option>
                    <option value="Lion">  Lion  </option>
                  </select>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Code Postal</label>
                  <input  required type="number" name="zip_code" class="form-control" id="exampleInputPassword1" placeholder="Code Postal">
                </div>

                </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Addresse du siege</label>
                  <input  required type="text" name="address" class="form-control" id="exampleInputPassword1" placeholder="Addresse du siege">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Complement addresse (optionnel)</label>
                  <input   type="text" name="complement" class="form-control" id="exampleInputPassword1" placeholder="Complement addresse">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input  required type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="Email">
                </div>
                  <div class="row">

                      <div class="col-md-2">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Telephone</label>
                              <input  required class="form-control" name="cc"  type="text" placeholder="Code pays" value="+33" maxlength="4">

                          </div>
                      </div>

                      <div class="col-md-10">
                          <div class="form-group">
                              <label for="exampleInputEmail1" style="color: transparent">Telephone</label>
                              <input  required type="tel" name="tel" class="form-control" id="exampleInputEmail1" placeholder="Telephone">
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
                <div class="form-group">
                  <label for="exampleInputFile">Logo du societé (optionnel)</label>
                  <input   type="file" name="logo" id="exampleInputFile">


                </div>

                <div class="row">
                <div class="container text-center">

                <a onclick="history.back()" class="btn btn-danger pl-1" style="margin: 1em">Annuler</a>
                <button type="submit" class="btn btn-success pl-1" style="margin: 1em">Ajouter</button>

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
