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
<!-- <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.1.min.js"></script> -->
<!-- <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
</script> -->

@yield('scripts-custom')
<script>
var oTable = $('.table').DataTable( {
    "language": {
      "url": "http://cdn.datatables.net/plug-ins/a5734b29083/i18n/French.json"
    },
    "bLengthChange": false ,
    "columnDefs": [ {
        "targets": -1,
    "orderable": false,

  

    },
  

     ],
     order: [ [ $('th.date-create').index(),  'desc' ] ],

    "pageLength": 20
} );


</script>


<script>
$('document').ready(function(){
$('.not-this > .btn-group > .dots').click(function(){

  if ($(this).parent().hasClass('open')){
     ($(this).parent().removeClass('open'));
  }
else {
  ($(this).parent().addClass('open'));

}

});


$('.dropdown-toggle').click(function(){

if ($(this).parent().hasClass('open')){
   ($(this).parent().removeClass('open'));
}
else {
($(this).parent().addClass('open'));

}

});

$('.vdp-datepicker > div > input').addClass('form-control');
$(".vdp-datepicker > div > input").attr("placeholder", "Sélectionner une date");

});
</script>

<script>
    $('.country').on('change', function () {
        var url = {!!json_encode(url('/')) !!}
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: url + '/country/cities/' + this.value,
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
                   var val= ($('.cities option:nth-child(1)').val())
                    $.ajax({
                        type: 'GET', //THIS NEEDS TO BE GET
                        url: url + '/city/' + val,
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
                    $('.zipcodes').html($('<option value="" class="foobar">Aucun code postal</option>'));

                }




            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    $('.cities').on('change', function () {
        var url = {!!json_encode(url('/')) !!}
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: url + '/city/' + this.value,
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
$(document).ready(function(){
  $(".designation").bind('change paste keyup' ,function(){
    var value = $(this).val();
    str = value.replace(/\s+/g, '');
    var res = str.substr(0, 6).toUpperCase();
    $('.code').val(res);
 });
});
</script>


@yield('customProducts')





</html>
