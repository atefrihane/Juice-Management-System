<!DOCTYPE html>
<html>

@include('General.head')


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
                    <span class="sr-only">Toggle navigation</span> &nbsp; <small></small>
                    <span class="hidden-xs"> Menu principal</span>
                </a>


                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->

                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">

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
                                                <i class="fa fa-warning text-yellow"></i> Very long description here
                                                that may not fit into the
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

                                <span class="hidden-xs"> {{ucfirst(Auth::user()->nom)}}
                                    {{ucfirst(Auth::user()->prenom)}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">


                                    <p>
                                        {{Auth::user()->formatName()}} -
                                        @switch(Auth::user()->child->role->role_name)
                                        @case('DBO')
                                        DBO
                                        @break;
                                        @case('SUPERADMIN')
                                        Super Admin
                                        @break;
                                        @case('ADMIN')
                                        Admin
                                        @break
                                        @case('PREPARATOR')
                                        Préparateur
                                        @break
                                        @case('MAIN_DELIVERY')
                                        Livreur principale
                                        @break
                                        @case('SECOND_DELIVERY')
                                        Livreur
                                        @break

                                        @endswitch
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
                                    @if(Auth::user()->DBO() || Auth::user()->superAdmin())
                                    <div class="text-center">
                                        <a href="{{route('admin')}}"
                                            class="btn btn-default btn-flat btn-width">Gestion des comptes</a>
                                    </div>
                                    @endif
                                    <div class="text-center">
                                        <a href="{{route('showStaticManagement')}}"
                                            class="btn btn-default btn-flat btn-width">Gestion des constantes</a>
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



                    <li class="{{ Route::is('showHome') ? 'active' : '' }}"><a href="{{route('showHome')}}"><i
                                class="fa fa-building "></i> <span>Societés</span></a></li>
                    <li class="{{ Route::is('showOrders') ? 'active' : '' }}"><a href="{{route('showOrders')}}"><i
                                class="fa fa-shopping-bag"></i> <span>Commandes</span></a></li>
                    <li class="{{ Route::is('showMachines') ? 'active' : '' }}"><a href="{{route('showMachines')}}"><i
                                class="fa fa-plug"></i> <span>Machines</span></a></li>
                    <li class="{{ Route::is('showProducts') ? 'active' : '' }}"><a href="{{route('showProducts')}}"><i
                                class="fa fa-cubes"></i> <span>Produits</span></a></li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-tasks"></i>
                            <span>Entrepôt</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu" style="display: {{ (Route::is('showWarehouses') or  Route::is('showWarehouseProducts')) ? 'block' : 'none' }};" >
                            <li class="{{ Route::is('showWarehouses') ? 'active' : '' }}"><a
                                    href="{{route('showWarehouses')}}"><i class="fa fa-building "></i> <span>Nos
                                        Entrepôts</span></a></li>
                            <li class="{{ Route::is('showWarehouseProducts') ? 'active' : '' }}"><a
                                    href="{{route('showWarehouseProducts')}}"><i class="fa fa-cubes"></i> <span>Produits
                                        en stock</span></a></li>

                        </ul>
                    </li>
                    @if(Auth::user()->primaryAdmin())
                    <li class="{{ Route::is('showConversations') ? 'active' : '' }}">
                            <a href={{route('showConversations')}}>
                              <i class="fa fa-envelope"></i> <span>Messages</span>
                              <span class="pull-right-container">
                              <small class="label pull-right bg-green">{{$countConversations}}</small>
                              </span>
                            </a>
                          </li>
                          @endif
                   
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->


        <script>


        </script>
