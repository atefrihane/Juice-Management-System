@extends('General.layout') @section('pageTitle', 'Ajouter une machine') @section('content')


    <div class="content-wrapper">

        <section class="content-header">

            {{ Breadcrumbs::render('addMachine') }}
        </section>

        <section class="content">
            <div class="row">
                <div class="container">

                    <div class="box box-primary" id="apep">

                        <div class="box-header">
                            <h3 class="box-title">Début location machine </h3>

                        </div>

                        <form role="form" method="post" enctype="multipart/form-data" >
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
                                            <label for="exampleInputEmail1">Code Machine</label>
                                            <select class="form-control" name="machine_id"  v-bind:value="rental.machine_id" v-on:change="getMachine($event.target.value)">
                                                @foreach($machines as $mach )
                                                    <option value="{{$mach->id}}" {{$mach->id == $machine->id ? 'selected': '' }}>{{  $mach->code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Désignation Machine</label>
                                            <select class="form-control" name="machine_id" v-bind:value="rental.machine_id" v-on:change="rental.machine_id= $event.target.value">
                                                @foreach($machines as $mach )
                                                    <option value="{{$mach->id}}" {{$mach->id == $machine->id ? 'selected': '' }}>{{  $mach->designation }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                </div>
                                <div class="row">



                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Societé</label>
                                            <select class="form-control" name="machine_id"   v-on:change="getStores($event.target.value)">
                                                <option ></option>
                                                @foreach($companies as $mach )
                                                    <option value="{{$mach->id}}" >{{  $mach->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" v-if="stores.length > 0">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Magasin</label>
                                            <select class="form-control" v-model="rental.store_id" >

                                                    <option v-for="store in stores" :value="store.id">@{{  store.designation }}</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date du début de location</label>
                                            <input class="form-control"  id="disabledInput" v-model="rental.date_debut" type="date" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date de fin de location</label>
                                            <input class="form-control"  id="disabledInput" v-model="rental.date_fin" type="date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Prix location mensuel</label>
                                            <input class="form-control" name="designation" id="disabledInput" v-model="rental.price" type="number" placeholder="Prix">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Localisation</label>
                                            <textarea class="form-control" rows="2" name="location" v-model="rental.location" placeholder="localisation"></textarea>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Commentaires (optionnel)</label>
                                            <textarea class="form-control" rows="3" v-model="rental.comment" name="comment" placeholder="Commentaires"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid " style="background-color: #e4e4e4; margin: 16px; padding: 24px" v-for="bac in bacs">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group d-flex">
                                                <label class="col-10">numero du bac: </label>
                                                <input type="number"   class="form-group col-2" readonly  v-model="bac.order">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group d-flex">
                                                <label class="col-4">Etat </label>
                                                <select  class="form-group" v-model="bac.status" >
                                                    <option value="fonctionnelle">Fonctionnelle</option>
                                                    <option value="en-panne">En panne</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex">
                                                <label class="col-4">Produit en bac  </label>
                                                <select  class="form-group" v-model="bac.product">

                                                        <option v-for="product in products" :value="product">@{{product.nom}}</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex" v-if="bac.product">
                                                <label class="col-4">Melange par defaut </label>
                                                <select  class="form-group" v-model="bac.mixture_id" >
                                                    <option v-for="mixture in bac.product.mixtures" :value="mixture.id">@{{ mixture.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="container text-center">

                                        <a href="{{route('showMachines')}}" class="btn btn-danger pl-1" style="margin: 1em">Annuler</a>
                                        <button type="button" class="btn btn-success pl-1" style="margin: 1em" v-on:click="saveRental">Confirmer</button>

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
    <script>
        localStorage.setItem('machine_id', {{$machine->id}});
    </script>
    <script src="{{mix('js/machine.js')}}">

    </script>
@endsection
@section('dynamicProduct.script')
    <script>
       $
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
