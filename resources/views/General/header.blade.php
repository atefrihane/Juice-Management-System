
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>@yield('pageTitle')</title> 
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->

  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('showHome')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
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
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
   
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 
              <img src="{{asset('/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->email}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
           
                <img src="{{asset('/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">

                <p>
                 {{Auth::user()->email}}
                  <small>Membre depuis {{Auth::user()->created_at}}</small>
                </p>
              </li>
              <!-- Menu Body -->
            
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('handleSignOut')}}" class="btn btn-default btn-flat">Déconnexion</a>
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
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Chercher...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
 
            

        <li class="{{ Route::is('showHome') ? 'active' : '' }}"><a href="{{route('showHome')}}"><i class="fa fa-building "></i> <span>Societés</span></a></li>
        <li class="{{ Route::is('showOrders') ? 'active' : '' }}"><a href="{{route('showOrders')}}"><i class="fa fa-shopping-bag""></i> <span>Commandes</span></a></li>
        <li class="{{ Route::is('showMachines') ? 'active' : '' }}"><a href="{{route('showMachines')}}"><i class="fa fa-plug"></i> <span>Machines</span></a></li>
        <li class="{{ Route::is('showProducts') ? 'active' : '' }}"><a href="{{route('showProducts')}}"><i class="fa fa-cubes"></i> <span>Produits</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->