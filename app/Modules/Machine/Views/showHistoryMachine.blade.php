@extends('General.layout') @section('pageTitle', 'Historique machine') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('machineHistory',$machine) }}
    </section>

    <section class="content">

        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Détails machines</h3>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data" action="{{route('storeMachine')}}">

                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-2">
                                    @if($machine->photo_url)
                                    <img class="img-responsive" src="{{asset('/')}}/{{$machine->photo_url}}"
                                        alt="Photo">
                                    @else
                                    <img class="img-responsive" src="{{asset('/img')}}/no-logo.png" alt="Photo">
                                    @endif
                                </div>

                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code</label>
                                        <input type="text" name="code" class="form-control" id="exampleInputEmail1"
                                            placeholder="Code" value="{{$machine->code}}" disabled>
                                    </div>


                                    <div class="form-group">


                                        <label for="exampleInputEmail1">Etat</label>
                                        <input type="text" name="code" class="form-control" id="exampleInputEmail1"
                                            placeholder="Code" value="{{$machine->status}}" disabled>

                                    </div>

                                </div>



                            </div>

                            <div class="form-group" style="margin-top:40px;">
                                <label for="exampleInputEmail1">Code à barres</label>
                                <input class="form-control" name="barcode" id="disabledInput" type="text"
                                    placeholder="Code à barres" value="{{$machine->barcode}}" disabled>

                            </div>



                            <div class="form-group">
                                <label for="exampleInputEmail1">Désignation</label>
                                <input class="form-control" name="designation" id="disabledInput" type="text"
                                    placeholder="Désignation" value="{{$machine->designation}}" disabled>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type</label>
                                        <input class="form-control" name="type" id="disabledInput" type="text"
                                    placeholder="type" value="{{$machine->type}}" disabled>


                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombre de bacs</label>
                                        <input class="form-control" name="bacs" id="disabledInput" type="text"
                                    placeholder="type" value="{{$machine->number_bacs}}" disabled>


                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Affichage tablette</label>
                                <input class="form-control" name="tablet" id="disabledInput" type="text"
                                    placeholder="tablet" value="{{$machine->display_tablet}}" disabled>


                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Prix de location mensuelle ( en euros )</label>
                                <input class="form-control" id="disabledInput" name="price_month" type="text"
                                    placeholder="Prix de location mensuelle ( en euros )" value="{{$machine->price_month}}" disabled>

                            </div>


                            <div class="form-group">
                                <label>Commentaires (optionnel)</label>
                                <textarea class="form-control" rows="3" name="comment"
                                    placeholder="Commentaires" disabled>{{$machine->comment}}</textarea>
                            </div>


                            <div class="row" style="margin-top:50px;">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-header">
                                            <h3 class="box-title">Historique</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table class="table table-bordered table-hover example2">
                                                <thead>
                                                    <tr>
                                                        <th>Date et Heure</th>
                                                        <th>Etat</th>
                                                        <th>Effectué par</th>
                                                        <th>Commentaire</th>




                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @forelse($machine->histories as $machineHistory)
                                                    <tr class="table-tr">

                                                             <td>{{$machine->created_at}}</td>
                                                            <td>{{$machineHistory->event}}</td>
                                                            <td>{{$machineHistory->user->nom}}</td>
                                                            <td>{{$machineHistory->comment}}</td>

                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            <h4>Aucune information existante !</h4>
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>

                                            </table>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>


                                </div>
                                <!-- /.col -->
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
    $('document').ready(function () {

        var newProduct = $('.box-color').html();
        var newButton = $('.clicked').html();
        $('.clicked').click(function () {
            // var html="";
            // html+= '<div class="box-tools pull-right">';
            // html+='<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
            // html+=' <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>';
            // html+='</div>';
            // $(newProduct).prepend(html);

            $('.box-color').append(newProduct);
            $('.products').each(function (i, obj) {
                if (i != 0) {
                    $(this).children(":first").css("display", "block");


                }
            });

        });

        $(document).on('click', '.removed', function () {
            $(this).parent().parent().slideUp();
        });

    });

</script>
@endsection
