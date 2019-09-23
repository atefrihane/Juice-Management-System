@extends('General.layout') @section('pageTitle', 'Commencer location machine') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('rental', $machine) }}
    </section>

    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary" id="apep">

                    <div class="box-header">
                        <h3 class="box-title">Commencer location machine </h3>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                       
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code Machine</label>
                                        <select class="form-control" name="machine_id" required
                                            v-bind:value="rental.machine_id"
                                            v-on:change="getMachine($event.target.value)">
                                            @foreach($machines as $mach )
                                            <option value="{{$mach->id}}"
                                                {{$mach->id == $machine->id ? 'selected': '' }}>{{  $mach->code }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Désignation Machine</label>
                                        <select class="form-control" name="machine_id" required
                                            v-bind:value="rental.machine_id"
                                            v-on:change="rental.machine_id= $event.target.value">
                                            @foreach($machines as $mach )
                                            <option value="{{$mach->id}}"
                                                {{$mach->id == $machine->id ? 'selected': '' }}>
                                                {{  $mach->designation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                            </div>
                            <div class="row">



                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Societé</label>
                                        <select class="form-control" name="machine_id" required
                                            v-on:change="getStores($event.target.value)">
                                            <option></option>
                                            @foreach($companies as $mach )
                                            <option value="{{$mach->id}}">{{  $mach->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Magasin</label>
                                        <select class="form-control" v-model="rental.store_id" required>

                                            <option v-if="stores.length > 0" v-for="store in stores" :value="store.id">
                                                @{{  store.designation }}</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date du début de location</label>
                                        <input class="form-control" required id="startDate"
                                            v-model="rental.date_debut" type="date" min="" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date de fin de location</label>
                                        <input class="form-control" required id="endDate"
                                            v-model="rental.date_fin" type="date" min="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Prix location mensuel</label>
                                        <input class="form-control" required name="designation" id="disabledInput"
                                            v-model="rental.price" type="number" placeholder="Prix">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Localisation</label>
                                        <textarea class="form-control" required rows="2" name="location"
                                            v-model="rental.location" placeholder="localisation"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Commentaires (optionnel)</label>
                                        <textarea class="form-control" rows="3" v-model="rental.comment" name="comment"
                                            placeholder="Commentaires"></textarea>
                                    </div>
                                </div>
                            </div>
                            <label style="font-weight: bold; font-size: 16px; margin-top: 20px"> Configuration des bacs
                            </label>

                            <div class="container-fluid " style="background-color: #e4e4e4; margin: 16px; padding: 24px"
                                v-for="bac in bacs">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group d-flex">
                                            <label class="col-10">Numero du bac: </label>
                                            <input type="number" readonly class="form-control" v-model="bac.order">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group " style="display: flex; flex-direction: column">
                                            <label>Etat : </label>
                                            <select class="form-control" v-model="bac.status">
                                                <option selected value="fonctionnelle">Fonctionnelle</option>
                                                <option value="en-panne">En panne</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group " style="display: flex; flex-direction: column">
                                            <label>Produit en bac </label>
                                            <select class="form-control" v-model="bac.product">

                                                <option v-for="product in products" :value="product">@{{product.nom}}
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group " v-if="bac.product"
                                            style="display: flex; flex-direction: column">
                                            <label class="col-12">Melange par defaut </label>
                                            <select class="form-control" v-model="bac.mixture_id">
                                                <option v-for="mixture in bac.product.mixtures" :value="mixture.id">
                                                    @{{ mixture.name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group " v-if="!bac.product"
                                            style="display: flex; flex-direction: column">
                                            <label class="col-12">Melange par defaut </label>
                                            <select class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="container text-center">

                                    <a href="{{route('showMachines')}}" class="btn btn-danger pl-1"
                                        style="margin: 1em">Annuler</a>
                                    <button type="button" class="btn btn-success pl-1" style="margin: 1em"
                                        v-on:click="saveRental">Confirmer</button>

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



