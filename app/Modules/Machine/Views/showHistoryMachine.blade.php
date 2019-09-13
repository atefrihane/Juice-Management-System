@extends('General.layout') @section('pageTitle', 'Historique machine') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('machineHistory',$machine) }}
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Historique Machine : <b>  {{$machine->code}}</b></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Etat</th>
                                    <th>Commentaire</th>
                                    <th>Machine</th>
                                    <th>Effectué par</th>


                                </tr>
                            </thead>
                            <tbody>

                                @forelse($machine->histories as $machineHistory)
                                <tr class="table-tr">
                                @if($machineHistory->machine->photo_url)
                                    <td class="text-center"><img
                                            src="{{asset('/')}}{{$machineHistory->machine->photo_url}}" height="100"
                                            alt=""></td>
                                            @else
                                            <td class="text-center"><img
                                            src="{{asset('/img')}}/no-logo.png" height="100"
                                            alt=""></td>

                                            @endif
                                    <td>{{$machineHistory->event}}</td>
                                    <td>{{$machineHistory->comment}}</td>
                                    <td>{{$machine->code}}</td>
                                    <td>{{$machineHistory->user->nom}}</td>
                                  
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center"> <h4>Aucune information existante !</h4></td>
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

    </section>>

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
