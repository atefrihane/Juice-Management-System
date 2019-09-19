<!DOCTYPE html>
<html>

<head>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <title>@yield('pageTitle')</title>

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
    <style>
        .btn-width {
            width: 200px;
            margin-bottom: 10px;
        }

    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="{{route('showHome')}}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>W</b>F</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Wize </b>Admin</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->

                        <!-- Notifications: style can be found in dropdown.less -->


                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs"> {{ucfirst(Auth::user()->nom)}}
                                    {{ucfirst(Auth::user()->prenom)}}</span>
                            </a>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">


                                    <p>
                                        {{ucfirst(Auth::user()->nom)}} {{ucfirst(Auth::user()->prenom)}} -
                                        {{ucfirst(Auth::user()->child->role->role_name)}}
                                        <small>{{Auth::user()->email}}</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="text-center">
                                        <a href="#" class="btn btn-default btn-flat btn-width">Informations du
                                            compte</a>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-default btn-flat btn-width">Gestion des comptes</a>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{route('handleSignOut')}}"
                                            class="btn btn-default btn-flat btn-width">Déconnexion</a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->

                <!-- search form -->

                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">

                    <li style="margin-bottom: 30px"><a href="{{route('showStores',$store->company->id)}}"><i class="fa fa-arrow-left"></i><span>Retour Menu Societé</span></a></li>
                    <li class="{{ Route::is('showStore') ? 'active' : '' }}"><a href="{{route('showStore',['company_id'=>$store->company->id,'store_id'=>$store->id])}}"><i class="fa fa-question-circle""></i> <span>Informations</span></a></li>
                    <li class="{{ Route::is('showStoreRentals') ? 'active' : '' }}"><a href="{{route('showStoreRentals',['company_id'=>$store->company->id,'store_id'=>$store->id])}}"><i class=" fa fa-plug"></i><span>Machines</span></a></li>
                    <li class="{{ Route::is('showHome') ? 'active' : '' }}"><a href=""><i class="fa fa-truck"></i><span>Commandes</span></a></li>
                    <li class="{{ Route::is('showHome') ? 'active' : '' }}"><a href=""><i class="fa fa-database"></i><span>Stock</span></a></li>
                    

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
