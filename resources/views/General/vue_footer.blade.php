<!-- ./wrapper -->

<!-- jQuery 3 -->

<script src="{{ asset('/js/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>


<script src="{{ asset('/js/bootstrap-timepicker.min.js') }}"></script>

<script src="{{ asset('/js/raphael.min.js') }}"></script>

<!-- <script src="{{ asset('/js/morris.min.js') }}" ></script>  -->

<script>
$('document').ready(function(){
    $('.table-tr > td:not(:last-child').click(function () {
        window.location = $(this).data("url");
    });
    $('.table-t > td:not(:last-child').click(function () {
        window.location = $(this).data("url");
    });

})
  
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




</html>
