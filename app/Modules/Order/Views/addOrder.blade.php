@extends('General.layout') @section('pageTitle', 'Ajouter une commande') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addOrder') }}
    </section>

    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Ajouter une commande</h3>

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

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Saisie par</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="aa">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date:</label>

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

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Destinataire</label>

                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Societé</label>
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
                                        <label for="exampleInputEmail1">Magazin</label>
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

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Produits à commander</label>

                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 list-products">

                                <div class="box box-color">

                                    <div class="box-body products" style="margin-bottom:10px;">

                                    <div class="box-tools pull-right" style="display:none;">

                                         <button type="button" class="btn btn-box-tool removed " ><i class="fa fa-remove " style="font-size:20px;"></i></button>
                                        </div>

                                        <form>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nom de produit</label>
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
                                                        <label for="exampleInputEmail1">Code de produit</label>
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
                                                        <label for="exampleInputEmail1">Code à barre</label>
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
                                                <label for="exampleInputEmail1">Nom de produit</label>
                                                <select class="form-control">
                                                    <option>option 1</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                    <option>option 5</option>
                                                </select>
                                            </div>


                                        </form>
                                    </div>





                                    </div>



                                </div>
                            </div>



                                <div class="row">
                                    <div class="form-group container text-center">

                                              <button class="btn clicked"><i class="fa fa-plus-circle""></i>&nbsp;&nbsp;Ajouter un produit</button>

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
