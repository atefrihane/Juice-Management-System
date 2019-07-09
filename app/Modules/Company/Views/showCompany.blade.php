@extends('General.layoutCompany')
@section('pageTitle', $company->name)
@section('content')
<style>

 .dots:after{ 
   content: '\f141';
   font-family: FontAwesome;
font-size:20px;
   color:black;


} 
.edit{
margin: 6px -20px 0 !important;
min-width:100px;
}
</style>
<div class="content-wrapper">



<section class="content-header">
{{ Breadcrumbs::render('detail', $company) }}
    
    </section>

<div class="container" style="margin-top:50px;">
<section class="content-header">
<h1>
        Informations de la societé
        <small> {{$company->name}}</small>
      </h1>
      <div class="btn-group breadcrumb1">
                      <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                  <ul class="dropdown-menu edit" role="menu">
                    <li><a href="#">Modifier</a></li>
      
                    <li><a href="#">Supprimer</a></li>
                   
                  </ul>
    
    </section>

<section class="content">
<div class="row">
<div class="col-md-4">
<img src="{{ asset('/img/' . $company->logo) }}" style="width:100%;padding:40px;">
</div>
<div class="col-md-8">
<form>
<div class="row">
<div class="col-md-6">
<div class="form-group">
    <label for="exampleInputEmail1">Code</label>
    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Code..">
  
  </div>
</div>
<div class="col-md-6">
<div class="form-group">
    <label for="exampleInputPassword1">Statut</label>
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
    <input type="text" class="form-control"  placeholder="Nom du groupe">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Désignation</label>
    <input type="text" class="form-control"  placeholder="Désignation">
  </div>
 

 <div class="row">
<div class="col-md-6">
<div class="form-group">
    <label for="exampleInputEmail1">Ville</label>
    <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Ville">

  </div>
</div>
<div class="col-md-6">
<div class="form-group">
    <label for="exampleInputPassword1">Code Postal</label>
    <input type="text" class="form-control"  placeholder="Code Postal">
  </div>
</div>
</div>

  <div class="form-group">
    <label for="exampleInputPassword1">Adresse de siége</label>
    <input type="text" class="form-control"  placeholder="Adresse de siége">
  </div>
 


   <div class="form-group">
    <label for="exampleInputPassword1">Complément addresse (optionnel )</label>
    <input type="text" class="form-control"  placeholder="Complément addresse">
  </div>

    <div class="form-group">
                  <label>Commentaires (optionnel)</label>
                  <textarea class="form-control" rows="3" placeholder="Commentaires"></textarea>
                </div>
 




</form>

</div>
</div>




</section>
</div>
</div>
@endsection
