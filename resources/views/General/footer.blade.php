
<!-- ./wrapper -->

<!-- jQuery 3 -->

<script src="{{ asset('/js/jquery.min.js') }}" ></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/js/jquery-ui.min.js') }}" ></script>


<script src="{{ asset('/js/bootstrap-timepicker.min.js') }}" ></script>

<script src="{{ asset('/js/raphael.min.js') }}" ></script>

<!-- <script src="{{ asset('/js/morris.min.js') }}" ></script>  -->

<script>


$('.table-tr > td:not(:nth-child(6))').click(function(){
  window.location = $(this).data("url");
});





  </script>


@yield('dynamicProduct.script')



<script src="{{ asset('/js/bootstrap.min.js') }}" ></script>
<!-- Morris.js charts -->





<script src="{{ asset('/js/jquery.sparkline.min.js') }}" ></script>
<!-- jvectormap -->

<script src="{{ asset('/js/jquery-jvectormap-1.2.2.min.js') }}" ></script>

<script src="{{ asset('/js/jquery-jvectormap-world-mill-en.js') }}" ></script>
<!-- jQuery Knob Chart -->

<script src="{{ asset('/js/jquery.knob.min.js') }}" ></script>
<!-- daterangepicker -->


<script src="{{ asset('/js/moment.min.js') }}" ></script>

<script src="{{ asset('/js/daterangepicker.js') }}" ></script>
<!-- datepicker -->

<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}" ></script>
<!-- Bootstrap WYSIHTML5 -->

<script src="{{ asset('/js/bootstrap3-wysihtml5.all.min.js') }}" ></script>

<!-- Slimscroll -->


<script src="{{ asset('/js/jquery.slimscroll.min.js') }}" ></script>
<!-- FastClick -->


<script src="{{ asset('/js/fastclick.js') }}" ></script>
<!-- AdminLTE App -->

<script src="{{ asset('/js/adminlte.min.js') }}" ></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->


<!-- <script src="{{ asset('/js/dashboard.js') }}" ></script> -->

<!-- AdminLTE for demo purposes -->


<script src="{{ asset('/js/jquery.dataTables.min.js') }}" ></script>
<script src="{{ asset('/js/dataTables.bootstrap.min.js') }}" ></script>
<script src="{{ asset('/js/select2.full.min.js') }}" ></script>
<script src="{{ asset('/js/jquery.inputmask.js') }}" ></script>
<script src="{{ asset('/js/jquery.inputmask.date.extensions.js') }}" ></script>
<script src="{{ asset('/js/jquery.inputmask.extensions.js') }}" ></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })





    //Timepicker
    $('.timepicker').timepicker({
    showInputs: false
  });

  })
</script>

<script>

  $(function () {


  $('.example2').DataTable({
  "language": {
    "sProcessing": "Traitement en cours ...",
    "sLengthMenu": "Afficher _MENU_ lignes",
    "sZeroRecords": "Aucun résultat trouvé",
    "sEmptyTable": "Aucune donnée disponible",
    "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
    "sInfoEmpty": "Aucune ligne affichée",
    "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
    "sInfoPostFix": "",
    "sSearch": "Chercher:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Chargement...",
    "oPaginate": {
      "sFirst": "Premier", "sLast": "Dernier", "sNext": "Suivant", "sPrevious": "Précédent"
    },
    "oAria": {
      "sSortAscending": ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant"
    }
  },

      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,

});
  })


</script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Include this after the sweet alert js file -->
@include('sweet::alert')


</body>

<!-- <script>
$('document').ready(function(){
$(' .sidebar-menu > li ').click(function(){
$(this).addClass('active');
$('.sidebar-menu > li ').not(this).each(function(){
  $(this).removeClass('active');
     });
});


});
</script> -->

</html>
