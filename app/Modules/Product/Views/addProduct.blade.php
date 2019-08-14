@extends('General.layout') @section('pageTitle', 'Ajouter une machine') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('addProduct') }}
    </section>

    <section class="content" id="prod">
        <div class="row">
            <div class="container">

                <div class="box box-primary"  >

                    <div class="box-header" >
                        <h3 class="box-title"> Ajouter une produit</h3>

                    </div>

                    <form role="form">
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ID</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="aa" disabled>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code </label>
                                        <input type="text" name="code" v-model="product.code" class="form-control" id="exampleInputEmail1" placeholder="Code..">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Etat</label>
                                        <select class="form-control" v-model="product.status">
                                            <option>disponible</option>
                                            <option>non disponible</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                                <div class="form-group">
                                        <label for="exampleInputEmail1">Nom Produit</label>
                                        <input class="form-control" v-model="product.nom" id="disabledInput" type="text" placeholder="Nom Produit">

                                    </div>



                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type de Produit</label>
                                        <select class="form-control" v-model="product.type">
                                        <option>alimentaire</option>
                                        <option>autre</option>

                                    </select>


                                    </div>

                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Version de Produit</label>
                                          <input class="form-control" v-model="product.version" id="disabledInput" type="text" placeholder="version">

                                    </div>


                                        <div class="form-group">
                                        <label for="exampleInputEmail1">Code à barre</label>
                                        <input class="form-control" id="disabledInput" v-model="product.barcode" type="text" placeholder="Code à barre">

                                    </div>



                                            <div class="form-group">
                                        <label for="exampleInputEmail1">Désignation</label>
                                        <input class="form-control" v-model="product.designation" id="disabledInput" type="text" placeholder="Désignation">

                                    </div>


                                           <div class="form-group">
                                        <label for="exampleInputEmail1">Composition</label>
                                        <input class="form-control" v-model="product.composition" id="disabledInput" type="text" placeholder="Composition">

                                    </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Couleur du produit</label>
                                        <input class="form-control" id="disabledInput" type="text" v-model="product.color" readonly>

                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label ></label>
                                        <input type="color" name="code" v-model="product.color" class="form-control" id="exampleInputEmail1" placeholder="Code..">
                                    </div>
                                </div>
                            </div>


                                              <div class="form-group">
                                        <label for="exampleInputEmail1">Poids (en kg)</label>

                                                  <input class="form-control" v-model="product.weight" id="disabledInput" type="number" placeholder="Poids">


                                              </div>



                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hauteur(cm)</label>
                                        <input class="form-control" v-model="product.height" id="disabledInput" type="number" placeholder="hauteur">



                                    </div>
                                </div>

                                      <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Largeur(cm)</label>
                                        <input class="form-control" v-model="product.width" id="disabledInput" type="number" placeholder="Largeur">



                                    </div>
                                </div>


                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Profondeur(cm)</label>
                                        <input class="form-control" v-model="product.depth" id="disabledInput" type="number" placeholder="Profondeur">



                                    </div>
                                </div>


                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Prix public</label>
                                <input class="form-control" v-model="product.public_price" id="disabledInput" type="number" placeholder="prix">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Durée de validité de produit fermé ( en jours)</label>
                                <input class="form-control" v-model="product.period_of_validity" id="disabledInput" type="number" placeholder="durée de validité de produit fermé">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Durée de validité aprés ouverture ( en heures)</label>
                                <input class="form-control" v-model="product.validity_after_opening" id="disabledInput" type="number" placeholder="duree de validité apres ouverture">
                            </div>







                                        <div class="form-group">
                                        <label>Commentaires (optionnel)</label>
                                        <textarea class="form-control" rows="3" placeholder="Commentaires" v-model="product.comment"></textarea>
                                        </div>

                                        <div class="form-group">
                                    <label for="exampleInputFile">Photo du produit (optionnel)</label>
                                    <input type="file" id="exampleInputFile">


                                             </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre d'unitée par display</label>
                                <input class="form-control" v-model="product.unit_by_display" id="disabledInput" type="number" placeholder="prix">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de display par colis</label>
                                <input class="form-control" v-model="product.unit_per_package" id="disabledInput" type="number" placeholder="durée de validité de produit fermé">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">colisage</label>
                                <input class="form-control" v-model="product.packing" id="disabledInput" type="number" placeholder="duree de validité apres ouverture">
                            </div>
                            <div class="form-group">
                                <label for="">Possibilités de mélange</label>
                            </div>
                            <div class="container-fluid " style="background-color: #e4e4e4" v-for="mixture in mixtures">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Quantité de produit fini(en litre)</label>
                                            <input class="form-control" v-model="mixture.final_amount" id="disabledInput" type="number" placeholder="duree de validité apres ouverture">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nom du melange</label>
                                            <input class="form-control" v-model="mixture.name" id="disabledInput" type="number" placeholder="duree de validité apres ouverture">
                                        </div>
                                    </div>
                                </div>
                               <div class="row">
                                   <div class="col-md-4">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1">poids necessaire du produit (en kg)</label>
                                           <input class="form-control" v-model="mixture.needed_weight" id="disabledInput" type="number" placeholder="duree de validité apres ouverture">
                                       </div>
                                   </div>
                                   <div class="col-md-4">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1">Quantité d'eau (en litre)</label>
                                           <input class="form-control" v-model="mixture.water_amount" id="disabledInput" type="number" placeholder="duree de validité apres ouverture">
                                       </div>
                                   </div>
                                   <div class="col-md-4">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1">Quantité de sucre (en kg)</label>
                                           <input class="form-control" v-model="mixture.sugar_amount" id="disabledInput" type="number" placeholder="duree de validité apres ouverture">
                                       </div>
                                   </div>

                               </div>
                               <div class="row">
                                   <div class="col-md-4">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1">Volume de verre (en cl)</label>
                                           <input class="form-control" v-model="mixture.glass_size" id="disabledInput" type="number" placeholder="duree de validité apres ouverture">
                                       </div>
                                   </div>
                                   <div class="col-md-4">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1">Nombre de verre obtenu @{{ mixture.number_of_glasses }}</label>
                                           <input class="form-control" v-model="mixture.number_of_glasses" id="disabledInput" type="number" placeholder="duree de validité apres ouverture">
                                       </div>
                                   </div>

                               </div>

                            </div>
                            <div class="form-group">
                                <a v-on:click="pushMixture">Ajouter une possibilité de melange</a>
                            </div>

                                    <div class="row">
                                    <div class="container text-center">

                                    <button href="" class="btn btn-danger pl-1">Annuler</button>
                                    <button  class="btn btn-success pl-1" type="button" v-on:click="save">Confirmer</button>

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
<script src="{{mix('js/product.js')}}"></script>
<script src="{{mix('js/app.js')}}"></script>

@endsection
{{--@section('dynamicProduct.script')--}}
{{--<script>--}}
{{--$('document').ready(function(){--}}

{{--  var newProduct=$('.box-color').html();--}}
{{--  var newButton=$('.clicked').html();--}}
{{--$('.clicked').click(function(){--}}
{{--// var html="";--}}
{{--// html+= '<div class="box-tools pull-right">';--}}
{{--// html+='<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';--}}
{{--// html+=' <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>';--}}
{{--// html+='</div>';--}}
{{--// $(newProduct).prepend(html);--}}

{{--$('.box-color').append(newProduct);--}}
{{--$('.products').each(function(i, obj) {--}}
{{--   if (i!=0) {--}}
{{--    $(this).children(":first").css("display","block");--}}


{{--      }--}}
{{--});--}}

{{--});--}}

{{--   $(document).on('click', '.removed', function(){--}}
{{--    $(this).parent().parent().slideUp();--}}
{{--});--}}

{{--});--}}
{{--</script>--}}
{{--@endsection--}}
