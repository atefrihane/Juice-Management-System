<!-- ./wrapper -->

<!-- jQuery 3 -->

<script src="{{ asset('/js/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>


<script src="{{ asset('/js/bootstrap-timepicker.min.js') }}"></script>

<script src="{{ asset('/js/raphael.min.js') }}"></script>

<!-- <script src="{{ asset('/js/morris.min.js') }}" ></script>  -->

<script>
    $('.table-tr > td:not(:last-child').click(function () {
        window.location = $(this).data("url");
    });

    $('.table-t > td:not(:last-child').click(function () {
        window.location = $(this).data("url");
    });

</script>


@yield('dynamicProduct.script')



<script src="{{ asset('/js/bootstrap.min.js') }}"></script>



<script src="{{ asset('/js/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->


<script src="{{ asset('/js/fastclick.js') }}"></script>
<!-- AdminLTE App -->

<script src="{{ asset('/js/adminlte.min.js') }}"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Include this after the sweet alert js file -->
@include('sweet::alert')


</body>
<script src="{{asset('/js/app.js')}}"></script>
{{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}
<!-- <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.1.min.js"></script> -->
<!-- <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
</script> -->

@yield('scripts-custom')
@include('General.datatable')
@include('General.productDetails')
@include('General.conversations')
<script>
    $('document').ready(function () {
        $('.not-this > .btn-group > .dots').click(function () {

            if ($(this).parent().hasClass('open')) {
                ($(this).parent().removeClass('open'));
            } else {
                ($(this).parent().addClass('open'));

            }

        });


        $('.dropdown-toggle').click(function () {

            if ($(this).parent().hasClass('open')) {
                ($(this).parent().removeClass('open'));
            } else {
                ($(this).parent().addClass('open'));

            }

        });

        $('.vdp-datepicker > div > input').addClass('form-control');
        $(".vdp-datepicker > div > input").attr("placeholder", "Sélectionner une date");

    });

//     $(function(){
//    $("input[type='number']").prop('min',1);
//    $("input[type='number']").prop('max',999999);
// });


</script>

<script>

if($('.country').val())
{
  

    let value = $('.country').val()

    var url = {!!json_encode(url('/')) !!}
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: url + '/country/cities/' + value,
            headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            dataType: 'json',
            success: function (data) {
                var response = JSON.parse(JSON.stringify(data));
      
                var html = "";
                if (data.cities.length > 0) {
                    for (var i = 0; i < data.cities.length; i++) {
                        html += '<option value="' + data.cities[i].id + '" class="foobar">' + data
                            .cities[i].name + '</option>'
                        $('.cities').html(html);
                    }
                    $('.cc').val(data.code);
                    var val = ($('.cities option:nth-child(1)').val())
                    $.ajax({
                        type: 'GET', //THIS NEEDS TO BE GET
                        url: url + '/city/' + val,
                        headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                        dataType: 'json',
                        success: function (data) {
                            var response = JSON.parse(JSON.stringify(data));
                        

                            var html = "";
                            if (data.zipcodes.length > 0) {
                                for (var i = 0; i < data.zipcodes.length; i++) {
                                    html += '<option value="' + data.zipcodes[i].id +
                                        '" class="foobar">' + data.zipcodes[i].code +
                                        '</option>'
                                    $('.zipcodes').html(html);
                                }
                            } else {
                                html +=
                                    '<option value="" class="foobar">Aucun code postal</option>'
                                $('.zipcodes').html(html);

                            }



                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                } else {
                    html += '<option value="" class="foobar">Aucune ville</option>'
                    $('.cities').html(html);
                    $('.zipcodes').html($(
                        '<option value="" class="foobar">Aucun code postal</option>'));

                }

             

              




            },
            error: function (data) {
                console.log(data);
            }
        });

}
    $('.country').on('change', function () {
        var url = {!!json_encode(url('/')) !!}
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: url + '/country/cities/' + this.value,
            headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            dataType: 'json',
            success: function (data) {
                var response = JSON.parse(JSON.stringify(data));


                var html = "";
                if (data.cities.length > 0) {
                    for (var i = 0; i < data.cities.length; i++) {
                        html += '<option value="' + data.cities[i].id + '" class="foobar">' + data
                            .cities[i].name + '</option>'
                        $('.cities').html(html);
                    }
                    $('.cc').val(data.code);
                    var val = ($('.cities option:nth-child(1)').val())
                    $.ajax({
                        type: 'GET', //THIS NEEDS TO BE GET
                        url: url + '/city/' + val,
                        headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                        dataType: 'json',
                        success: function (data) {
                            var response = JSON.parse(JSON.stringify(data));

                            var html = "";
                            if (data.zipcodes.length > 0) {
                                for (var i = 0; i < data.zipcodes.length; i++) {
                                    html += '<option value="' + data.zipcodes[i].id +
                                        '" class="foobar">' + data.zipcodes[i].code +
                                        '</option>'
                                    $('.zipcodes').html(html);
                                }
                            } else {
                                html +=
                                    '<option value="" class="foobar">Aucun code postal</option>'
                                $('.zipcodes').html(html);

                            }



                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                } else {
                    html += '<option value="" class="foobar">Aucune ville</option>'
                    $('.cities').html(html);
                    $('.zipcodes').html($(
                        '<option value="" class="foobar">Aucun code postal</option>'));

                }




            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    $('.cities').on('change', function () {
        var url = {!!json_encode(url('/'))!!}
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: url + '/city/' + this.value,
            headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            dataType: 'json',
            success: function (data) {
                var response = JSON.parse(JSON.stringify(data));

                var html = "";
                if (data.zipcodes.length > 0) {
                    for (var i = 0; i < data.zipcodes.length; i++) {
                        html += '<option value="' + data.zipcodes[i].id + '" class="foobar">' + data
                            .zipcodes[i].code + '</option>'
                        $('.zipcodes').html(html);
                    }
                } else {
                    html += '<option value="" class="foobar">Aucun code postal</option>'
                    $('.zipcodes').html(html);

                }



            },
            error: function (data) {
                console.log(data);
            }
        });
    });

</script>

<script>
    $(document).ready(function () {
     $(".designation").on('keyup', function () {
        
        if($('.code').val().length == 0 )
        {
            var value = $(this).val();
        str = value.replace(/\s+/g, '');
        var res = str.substr(0, 6).toUpperCase();
        $('.code').val(res)
    
               
        }
     });

     $(".designation").on('change', function () {
                    

                    var value = $(this).val();
                    if(value.length > 0)
                    {
                        str = value.replace(/\s+/g, '');
                    var res = str.substr(0, 6).toUpperCase();
                    $('.code').val(res);
                        
                    }
              
    
                    });
    
                    $(".code").on('change', function () {
                        
                        var currentVal= $(this).val();
                        var value = $('.designation').val();
                        if(currentVal.length == 0)
                        {
                            str = value.replace(/\s+/g, '');
                        var res = str.substr(0, 6).toUpperCase();
                        $('.code').val(res);
    
                        }
                     
        
                        });

   
      

                        $("input[type=text]").not('.code').attr('maxlength','150');
                        $(".code").attr('maxlength','20');
                        $("input[type=number]").attr({
                            "max" : 999999,
                    
                        });
                                $("textarea").attr('maxlength','200');
    

    });

</script>


@yield('custom')
<script>
    $('form').submit(function (e) {
        $('.btn-success').attr('disabled', 'disabled');
    });
    
    $('input[type=number]').on('wheel', function(e){
    return false;
});


</script>






</html>
