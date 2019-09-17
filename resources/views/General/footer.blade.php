<!-- ./wrapper -->

<!-- jQuery 3 -->

<script src="{{ asset('/js/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>


<script src="{{ asset('/js/bootstrap-timepicker.min.js') }}"></script>

<script src="{{ asset('/js/raphael.min.js') }}"></script>

<!-- <script src="{{ asset('/js/morris.min.js') }}" ></script>  -->

<script>
    $('.table-tr > td:not(:nth-child(6))').click(function () {
        window.location = $(this).data("url");
    });

</script>


@yield('dynamicProduct.script')



<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->





<script src="{{ asset('/js/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->

<script src="{{ asset('/js/jquery-jvectormap-1.2.2.min.js') }}"></script>

<script src="{{ asset('/js/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->

<script src="{{ asset('/js/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->


<script src="{{ asset('/js/moment.min.js') }}"></script>

<script src="{{ asset('/js/daterangepicker.js') }}"></script>
<!-- datepicker -->

<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->

<script src="{{ asset('/js/bootstrap3-wysihtml5.all.min.js') }}"></script>

<!-- Slimscroll -->


<script src="{{ asset('/js/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->


<script src="{{ asset('/js/fastclick.js') }}"></script>
<!-- AdminLTE App -->

<script src="{{ asset('/js/adminlte.min.js') }}"></script>


<script src="{{ asset('/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/js/jquery.inputmask.js') }}"></script>
<script src="{{ asset('/js/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('/js/jquery.inputmask.extensions.js') }}"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Include this after the sweet alert js file -->
@include('sweet::alert')


</body>
<script src="{{asset('/js/app.js')}}"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
</script>
<script>
var oTable = $('.table').DataTable( {
    "language": {
      "url": "http://cdn.datatables.net/plug-ins/a5734b29083/i18n/French.json"
    },
    "bLengthChange": false 
} );
</script>

</html>
