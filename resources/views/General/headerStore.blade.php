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
                    <span class="hidden-xs"> {{$store->designation}}</span>
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
                                        <a href="{{route('addAdmin')}}"
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

                    <li style="margin-bottom: 30px"><a href="{{route('showStores',$store->company->id)}}"><i class="fa fa-arrow-left"></i><span>Retour Menu Societé</span></a></li>
                    <li class="{{ Route::is('showStore') ? 'active' : '' }}"><a href="{{route('showStore',['company_id'=>$store->company->id,'store_id'=>$store->id])}}"><i class="fa fa-question-circle""></i> <span>Informations</span></a></li>
                    <li class="{{ Route::is('showStoreRentals') ? 'active' : '' }}"><a href="{{route('showStoreRentals',['company_id'=>$store->company->id,'store_id'=>$store->id])}}"><i class=" fa fa-plug"></i><span>Machines</span></a></li>
                    <li class="{{ Route::is('showHome') ? 'active' : '' }}"><a href=""><i class="fa fa-truck"></i><span>Commandes</span></a></li>
                    <li class="{{ Route::is('showStoreStock') ? 'active' : '' }}"><a href="{{route('showStoreStock',['company_id'=>$store->company->id,'store_id'=>$store->id])}}"><i class="fa fa-database"></i><span>Stock</span></a></li>
                    

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
