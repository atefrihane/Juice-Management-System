@extends('General.layout') @section('pageTitle', 'Ajouter une machine') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addProduct') }}
    </section>

    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Ajouter une produit</h3>

                    </div>

                    <form role="form">
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ID</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="aa" disabled>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code..">
                                    </div>
                                </div>

                            </div>

                                <div class="form-group">
                                        <label for="exampleInputEmail1">Nom Produit</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Nom Produit">

                                    </div>



                                        <div class="form-group">
                                        <label for="exampleInputEmail1">Type de Produit</label>
                                        <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>


                                    </div>

                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Version de Produit</label>
                                        <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>


                                    </div>


                                        <div class="form-group">
                                        <label for="exampleInputEmail1">Code à barre</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Code à barre">

                                    </div>



                                            <div class="form-group">
                                        <label for="exampleInputEmail1">Désignation</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Désignation">

                                    </div>


                                           <div class="form-group">
                                        <label for="exampleInputEmail1">Composition</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Composition">

                                    </div>

                                              <div class="form-group">
                                        <label for="exampleInputEmail1">Poids (en kg)</label>
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
                                        <label for="exampleInputEmail1">Hauteur(cm)</label>
                                        <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>


                                    </div>
                                </div>

                                      <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Largeur(cm)</label>
                                        <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>


                                    </div>
                                </div>


                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Profondeur(cm)</label>
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
                                        <label for="exampleInputEmail1">Prix unitaire de base</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Désignation">

                                    </div>



                                 <div class="form-group">
                                        <label for="exampleInputEmail1">Durée de validité de produit fermé ( en jours)</label>
                                        <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>


                                    </div>


                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Durée de validité aprés ouverture ( en heures)</label>
                                        <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>


                                    </div>



                                         <div class="form-group">
                                        <label for="exampleInputEmail1">Colissage</label>
                                        <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>


                                    </div>

                                    


                                        <div class="form-group">
                                        <label>Commentaires (optionnel)</label>
                                        <textarea class="form-control" rows="3" placeholder="Commentaires"></textarea>
                                        </div>
                                
                                        <div class="form-group">
                                    <label for="exampleInputFile">Photo du produit (optionnel)</label>
                                    <input type="file" id="exampleInputFile">

  
                                             </div>

                                    <div class="row">
                                    <div class="container text-center">
                                    
                                    <a href="" class="btn btn-danger pl-1">Annuler</a>
                                    <a href="" class="btn btn-success pl-1">Confirmer</a>
                                    
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
@section('dynamicProduct.script')
<script>
$('document').ready(function(){

  var newProduct=$('.box-color').html();
  var newButton=$('.clicked').html();
$('.clicked').click(function(){
// var html="";
// html+= '<div class="box-tools pull-right">';
// html+='<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
// html+=' <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>';
// html+='</div>';
// $(newProduct).prepend(html);

$('.box-color').append(newProduct);
$('.products').each(function(i, obj) {
   if (i!=0) {
    $(this).children(":first").css("display","block");


      }
});

});

   $(document).on('click', '.removed', function(){
    $(this).parent().parent().slideUp();
});

});
</script>
@endsection
