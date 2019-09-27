@extends('General.layoutStore') @section('pageTitle', 'Ajouter une machine') @section('content')


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
                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <ul class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 31px, 0px);">
                    <li><a href="http://localhost/wizefresh/public/store/1/edit">Modifier</a></li>

                    <li><a href="" data-toggle="modal" data-target="#modal-default1">Supprimer</a></li>

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
                                        <input class="form-control" value="{{$rental->public}}" readonly
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
                            @forelse($rental->machine->bacs as $bac)
                            <div class="container-fluid "
                                style="background-color: #e4e4e4; margin: 16px; padding: 24px">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <label class="col-10">numero du bac: </label>
                                            <input type="number" class="form-control col-2" readonly
                                                value="{{$bac->order}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group d-flex">
                                            <label class="col-4">Etat </label>
                                            <input type="text" class="form-control" readonly value="{{$bac->status}}">
                                        </div>
                                    </div>
                                    @if($bac->product)
                                    <div class="col-md-12">
                                        <div class="form-group d-flex">
                                            <label class="col-4">Produit en bac </label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$bac->product->nom}}">

                                        </div>
                                    </div>
                                    @endif
                                    @if($bac->mixture)
                                    <div class="col-md-12">
                                        <div class="form-group d-flex">
                                            <label class="col-4">Melange par defaut </label>
                                            <input type="text" readonly value="{{$bac->mixture->name}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>
                            @empty

                            @endforelse
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
