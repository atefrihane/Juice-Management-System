@extends('General.layoutStore') @section('pageTitle', 'Détail location') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('detailRentMachine',$rental->machine->code) }}
    </section>

    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary" id="apep">

                    <div class="box-header">
                        <h3 class="box-title">Détail location machine </h3>
                        <div class="btn-group breadcrumb1 pull-right">
                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"></a>
                            <ul class="dropdown-menu" role="menu" x-placement="bottom-start"
                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 31px, 0px);">
                                <li><a href="{{route('showEditRental',$rental->id)}}">Modifier</a></li>

                                <li><a href="{{route('showEndRental',$rental->id)}}">Arrêter location</a></li>

                            </ul>
                        </div>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code Machine</label>
                                        <input type="text" class="form-control" value="{{$rental->machine->code}}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Désignation Machine</label>
                                        <input type="text" class="form-control"
                                            value="{{$rental->machine->designation}}" readonly>

                                    </div>
                                </div>



                            </div>
                            <div class="row">



                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Societé</label>
                                        <input type="text" class="form-control" readonly
                                            value="{{$rental->store->company->name}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Magasin</label>
                                        <input type="text" class="form-control" readonly
                                            value="{{$rental->store->designation}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date du début de location</label>
                                        <input class="form-control" readonly value="{{$rental->date_debut}}"
                                            id="disabledInput" type="date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date de fin de location</label>
                                        <input class="form-control" id="disabledInput" readonly
                                            value="{{$rental->date_fin}}" type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Prix location mensuel</label>
                                        <input class="form-control" value="{{$rental->price}}" readonly
                                            name="designation" type="number" placeholder="Prix">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Localisation</label>
                                        <textarea class="form-control" readonly rows="2" name="location"
                                            placeholder="localisation">{{$rental->location}}</textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Commentaires (optionnel)</label>
                                        <textarea class="form-control" readonly rows="3" name="comment"
                                            placeholder="Commentaires">{{$rental->Comment}}</textarea>
                                    </div>
                                </div>
                            </div>
                            @if($rental->machine->bacs)
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Configurations des bacs : </label>
                                </div>
                            </div>
                            @foreach($rental->machine->bacs as $bac)
                       
                            <div style="background-color: #e4e4e4; margin: 16px; padding: 24px">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group d-flex">
                                            <label class="col-10">Numero du bac: </label>
                                            <input type="text" class="form-control" value="{{$bac->order}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group " style="display: flex; flex-direction: column">
                                            <label>Etat : </label>
                                            <input type="text" class="form-control" value="{{ucfirst($bac->status)}}"
                                                disabled>

                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group " style="display: flex; flex-direction: column">
                                            <label>Produit en bac </label>
                                            <input type="text" class="form-control"
                                                value="{{$bac->product ? ucfirst($bac->product->nom) : 'Aucun'}}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group " style="display: flex; flex-direction: column">
                                            <label class="col-12">Melange par defaut </label>
                                            <input type="text" class="form-control"
                                                value="{{$bac->mixture ? ucfirst($bac->mixture->name) : 'Aucun'}}"
                                                disabled>
                                        </div>

                                    </div>
                                </div>
                             

                            </div>
                 
                            @endforeach
                            @endif






                        </div>

                    </form>
                </div>

                <!-- /.col -->
            </div>

        </div>

    </section>

</div>



</script>
@endsection
