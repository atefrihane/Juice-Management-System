<head>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Bootstrap 3.3.7 -->
    <title>@yield('pageTitle')</title>
    <style>
        .times-webkit-datetime-edit-ampm-field {
            display: none;
        }

        .times::-webkit-inner-spin-button,
        .times::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 9px;
        }

        .times::-ms-inner-spin-button,
        .times::-ms-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 9px;
        }

        .times::-ms-moz-spin-button,
        .times::-ms-moz-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 9px;
        }

        .vdp-datepicker>div>input {

            background-color: transparent !important;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none !important;
            margin: 0 !important;
            /* <-- Apparently some margin are still there even though it's hidden */
        }

        input[type=number] {
            -moz-appearance: textfield !important;
            /* Firefox */
        }

    </style>
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Font Awesome -->


    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Ionicons -->

    <link href="{{ asset('/css/ionicons.min.css') }}" rel="stylesheet">
    <!-- Theme style -->

    <link href="{{ asset('/css/AdminLTE.min.css') }}" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->

    <link href="{{ asset('/css/_all-skins.min.css') }}" rel="stylesheet">
    <!-- Morris chart -->

    <link href="{{ asset('/css/morris.css') }}" rel="stylesheet">
    <!-- jvectormap -->

    <link href="{{ asset('/css/jquery-jvectormap.css') }}" rel="stylesheet">
    <!-- Date Picker -->



    <link href="{{ asset('/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!-- Daterange picker -->

    <link href="{{ asset('/css/daterangepicker.css') }}" rel="stylesheet">
    <!-- bootstrap wysihtml5 - text editor -->


    <link href="{{ asset('/css/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/blue.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('/css/dataTables.custom.css') }}" rel="stylesheet"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .btn-width {
            width: 200px;
            margin-bottom: 10px;
        }

        .swal-footer {
            text-align: center !important;
        }

        .table-tr>td>img {
            display: block;
            width: 50%;
            height: 60px;
        }

        .swal2-popup {
            font-size: 1.6rem !important;
        }

        .scrollable {
            max-height: 200px;
            overflow-y: scroll;
            width: 250px;
            ;
        }

        /* effect-shine */
a.effect-shine:hover {
  -webkit-mask-image: linear-gradient(-75deg, rgba(0,0,0,.6) 30%, #000 50%, rgba(0,0,0,.6) 70%);
  -webkit-mask-size: 200%;
  animation: shine 2s infinite;
}

@-webkit-keyframes shine {
  from {
    -webkit-mask-position: 150%;
  }
  
  to {
    -webkit-mask-position: -50%;
  }
}
.pagination {
    display:flex;
    justify-content: center;
}

    </style>

</head>
