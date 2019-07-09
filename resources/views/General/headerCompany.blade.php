
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
  <link href="{{ asset('/css/bootstrap-timepicker.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/AdminLTE.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('showCompany',$company->id)}}" class="logo">
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
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('handleSignOut')}}" class="btn btn-default btn-flat">Sign out</a>
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
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
    

          <li><a href="{{route('showHome')}}"><i class="fa fa-arrow-left"></i> <span>Retour Menu Principal</span></a></li>
        <li class="{{ Route::is('showCompany',$company->id) ? 'active' : '' }}"><a href="{{route('showCompany',$company->id)}}"><i class="fa fa-question-circle""></i> <span>Informations</span></a></li>
        <li class="{{ Route::is('showStores',$company->id) ? 'active' : '' }}"><a href="{{route('showStores',$company->id)}}"><i class="fa fa-building"></i> <span>Magasins</span></a></li>
        <li class="{{ Route::is('showContacts',$company->id) ? 'active' : '' }}"><a href="{{route('showContacts',$company->id)}}"><i class="fa fa-male"></i> <span>Contacts</span></a></li>
        <li class="{{ Route::is('showRentedMachines',$company->id) ? 'active' : '' }}"><a href="{{route('showRentedMachines',$company->id)}}""><i class="fa fa-plug"></i> <span>Machines en location</span></a></li>
        <li class="{{ Route::is('showCustomProducts',$company->id) ? 'active' : '' }}"><a href="{{route('showCustomProducts',$company->id)}}"><i class="fa fa-dollar"></i> <span>Tarifs produits</span></a></li>
  
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->