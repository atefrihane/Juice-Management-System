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
                    <span class="sr-only">Toggle navigation</span> &nbsp; 
                    <span class="hidden-xs"> {{$company->name}}</span>
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
                                    <a href="{{route('addAdmin')}}" class="btn btn-default btn-flat btn-width">Gestion des comptes</a>
                                    </div>
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


                    <li style="margin-bottom: 30px"><a href="{{route('showHome')}}"><i class="fa fa-arrow-left"></i>
                            <span>Retour Menu Principal</span></a></li>
                    <li class="{{ Route::is('showCompany',$company->id) ? 'active' : '' }}"><a
                            href="{{route('showCompany',$company->id)}}"><i class="fa fa-question-circle""></i> <span>Informations</span></a></li>
        <li class=" {{ Route::is('showStores',$company->id) ? 'active' : '' }}"><a
                                    href="{{route('showStores',$company->id)}}"><i class="fa fa-building"></i>
                                    <span>Magasins</span></a></li>
                    <li class="{{ Route::is('showContacts',$company->id) ? 'active' : '' }}"><a
                            href="{{route('showContacts',$company->id)}}"><i class="fa fa-male"></i>
                            <span>Contacts</span></a></li>
                    <li class="{{ Route::is('showRentedMachines',$company->id) ? 'active' : '' }}"><a
                            href="{{route('showRentedMachines',$company->id)}}"><i class="fa fa-plug"></i>
                            <span>Machines en location</span></a></li>
                    <li class="{{ Route::is('showCustomProducts',$company->id) ? 'active' : '' }}"><a
                            href="{{route('showCustomProducts',$company->id)}}"><i class="fa fa-dollar"></i>
                            <span>Tarifs</span></a></li>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
