@extends('General.layout') @section('pageTitle', 'Arrêter location machine') @section('content')


    <div class="content-wrapper">

        <section class="content-header">

            {{ Breadcrumbs::render('endRental') }}
        </section>

        <section class="content">
            <div class="row">
                <div class="container">

                    <div class="box box-primary" >

                        <div class="box-header">
                            <h3 class="box-title">Arrêter location machine </h3>

                        </div>

                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('endRental', $rental->id)}}">
                            {{csrf_field()}}
                            <div class="box-body">
                            <input type="hidden" name="url" value="{{url()->previous()}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code Machine</label>
                                            <input type="text" class="form-control" value="{{$rental->machine->code}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Désignation Machine</label>
                                            <input type="text" class="form-control" value="{{$rental->machine->designation}}" readonly>
                                        </div>
                                    </div>



                                </div>
                                <div class="row">



                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Societé</label>
                                            <input type="text" class="form-control" readonly value="{{$rental->store->company->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Magasin</label>
                                            <input type="text" class="form-control" readonly value="{{$rental->store->designation}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date de debut de location</label>
                                            <input class="form-control"  id="disabledInput" name="date_fin"  value="{{$rental->date_debut}}"  type="date" disabled >
                                        </div>

                                     </div>


                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date de fin de location</label>
                                            <input class="form-control"  id="disabledInput" name="date_fin"  value="{{$rental->date_fin}}"  type="date" required >
                                         </div>
                                     </div>



                                </div>

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Raison fin de location</label>
                                                <select  class="form-control" name="end_reason">
                                                    <option value="Fin du contrat de location">Fin du contrat de location</option>
                                                    <option value="Machine non rentable">Machine non rentable</option>
                                                    <option value="Machine en panne">Machine en panne</option>
                                                    <option value="Autre">Autre</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Commentaires (optionnel)</label>
                                                <textarea class="form-control"   rows="3"  name="comment" placeholder="Commentaires">{{$rental->Comment}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <div class="row">
                                <div class="container text-center">

                                    <a href="{{url()->previous()}}" class="btn btn-danger pl-1" style="margin: 1em">Annuler</a>
                                    <button type="submit" class="btn btn-success pl-1" style="margin: 1em">Confirmer</button>

                                </div>
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
