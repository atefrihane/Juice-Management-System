@extends('General.layout') @section('pageTitle', 'Ajouter une machine') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addMachine') }}
    </section>

    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Ajouter une machine</h3>

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
                                        <label for="exampleInputEmail1">Code à barres</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Code à barres">

                                    </div>



                                        <div class="form-group">
                                        <label for="exampleInputEmail1">Désignation</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="Désignation">

                                    </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type</label>
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
                                        <label for="exampleInputEmail1">Nbr de bacs</label>
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
                                        <label for="exampleInputEmail1">Nbr de bacs</label>
                                        <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>


                                    </div>



                                         <div class="form-group">
                                        <label for="exampleInputEmail1">Affichage tablette</label>
                                        <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>


                                    </div>

                                         <div class="form-group">
                                        <label for="exampleInputEmail1">Prix de location mensuelle ( en euros )</label>
                                        <input class="form-control" id="disabledInput" type="number" placeholder="Prix de location mensuelle ( en euros )">

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
