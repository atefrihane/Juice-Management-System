@extends('General.layout') @section('pageTitle', 'Modifier une machine') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('editMachine') }}
    </section>

    <section class="content">
        <div class="row">
            <div class="container">

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title"> Modifier une machine</h3>

                    </div>

                    <form role="form" method="post" enctype="multipart/form-data"
                        action="{{route('updateMachine', $machine->id)}}">
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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ID</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="aa"
                                            value="{{$machine->id}}" disabled>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code</label>
                                        <input type="text" name="code" class="form-control code" value="{{$machine->code}}"
                                            id="exampleInputEmail1" placeholder="Code..">
                                    </div>
                                </div>



                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Code à barres</label>
                                <input class="form-control" name="barcode" value="{{$machine->barcode}}"
                                    id="disabledInput" type="text" placeholder="Code à barres">

                            </div>



                            <div class="form-group">
                                <label for="exampleInputEmail1">Désignation</label>
                                <input class="form-control designation" value="{{$machine->designation}}" name="designation"
                                    id="disabledInput" type="text" placeholder="Désignation"  pattern=".{6,}" title="6 caractères minimum" >

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type</label>
                                        <select class="form-control" name="type">
                                            <option value="jus" @if($machine->type == 'jus')  {{'selected="selected"'}} @endif
                                            >Jus </option>
                                            <option value="granite" @if($machine->type == 'granite')  {{'selected="selected"'}} @endif>Granité</option>
                                            <option value="jus-granite" @if($machine->type == 'jus-granite')  {{'selected="selected"'}} @endif>Jus et Granité</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombre de bacs</label>
                                        @if($machine->rented)
                                        <input class="form-control" value="{{$machine->number_bacs}}" name="number_bacs"
                                            id="disabledInput" type="text" placeholder="Nombre de bacs" disabled>
                                            @else
                                            <select name="number_bacs" class="form-control">
                                            <option value="1" {{ $machine->number_bacs == 1 ? 'selected disabled' : '' }}>1</option>
                                            <option value="2" {{ $machine->number_bacs == 2 ? 'selected disabled' : '' }}>2</option>
                                            <option value="3" {{ $machine->number_bacs == 3 ? 'selected disabled' : '' }}>3</option>
                                            <option value="4" {{ $machine->number_bacs == 4 ? 'selected disabled' : '' }}>4</option>
                                            <option value="5" {{ $machine->number_bacs == 5 ? 'selected disabled' : '' }}>5</option>
                                        </select>
                                            @endif



                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Affichage tablette</label>
                                <select class="form-control" name="display_tablet">
                                    <option value="true" {{$machine->display_tablet  ? 'selected':''}}>Oui</option>
                                    <option value="false" {{!$machine->display_tablet ? 'selected':''}}>Non</option>
                                </select>


                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Prix de location mensuelle ( en euros )</label>
                                <input class="form-control" value="{{$machine->price_month}}" id="disabledInput"
                                    name="price_month" type="number"
                                    placeholder="Prix de location mensuelle ( en euros )">

                            </div>


                            <div class="form-group">
                                <label>Commentaires (optionnel)</label>
                                <textarea class="form-control" rows="3" name="comment"
                                    placeholder="Commentaires">{{$machine->comment}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Photo du machine (Optionnel)</label>
                                @if($machine->photo_url)
                                    <div class="row">
                                        <div class="container">
                                            <img src="{{asset('/')}}{{$machine->photo_url}}" alt="..." class="img-thumbnail"
                                                style="width:100px;">
                                        </div>
                                    </div>
                                    @endif
                                <input type="file" name="photo" id="exampleInputFile" style="margin-top:20px;">


                            </div>

                            <div class="row">
                                <div class="container text-center">

                                    <a href="{{route('showMachines')}}" class="btn btn-danger pl-1"
                                        style="margin: 1em">Annuler</a>
                                    <button type="submit" class="btn btn-success pl-1"
                                        style="margin: 1em">Confirmer</button>

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
