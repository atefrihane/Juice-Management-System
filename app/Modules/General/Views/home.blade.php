@extends('General.layout')
@section('pageTitle', 'Acceuil')
@section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('home') }}
    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-6">
                <a href="{{route('showCompanies')}}" style="color:white;">

                    <div class="info-box bg-aqua make-it-slow">
                        <span class="info-box-icon"><i class="fa fa-building "></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Liste des societés</span>
                            <span class="info-box-number">{{$countCompanies}}</span>


                        </div>
                </a>

                <!-- /.info-box-content -->
            </div>



        </div>
        <div class="col-md-6">
            <a href="{{route('showOrders')}}" style="color:white;">
                <div class="info-box bg-green make-it-slow">
                    <span class="info-box-icon"><i class="fa fa-shopping-bag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Liste des commandes</span>
                        <span class="info-box-number">{{$countOrders}}</span>


                    </div>
                    <!-- /.info-box-content -->
                </div>
            </a>


        </div>
</div>

<div class="row">

    <div class="col-md-6">
        <a href="{{route('showMachines')}}" style="color:white;">
            <div class="info-box bg-teal make-it-slow"">
                                    <span class=" info-box-icon"><i class="fa fa-plug"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Liste des machines</span>
                    <span class="info-box-number">{{$countMachines}}</span>


                </div>

            </div>
        </a>
        <!-- Info Boxes Style 2 -->




    </div>
    <div class="col-md-6">
        <a href="{{route('showProducts')}}" style="color:white;">
            <div class="info-box bg-blue make-it-slow">
                <span class="info-box-icon"><i class="fa fa-cubes"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Liste des produits</span>
                    <span class="info-box-number">{{$countProducts}}</span>

                </div>
                <!-- /.info-box-content -->
            </div>
        </a>


    </div>
</div>
<div class="row">

    <div class="col-md-6">
        <a href="{{route('showWarehouses')}}" style="color:white;">
            <div class="info-box bg-fuchsia make-it-slow">
                <span class="info-box-icon"><i class="fa fa-tasks"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Liste des entrepôts</span>
                    <span class="info-box-number">{{$countWarehouses}}</span>


                </div>

            </div>
        </a>




    </div>
    <div class="col-md-6">
        <a href="{{route('showConversations')}}" style="color:white;">
            <div class="info-box bg-orange make-it-slow">
                <span class="info-box-icon"><i class="fa fa-envelope"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Liste des Messages</span>
                    <span class="info-box-number">{{$countConversations}}</span>

                </div>
                <!-- /.info-box-content -->
            </div>

    </div>
    </a>

</div>
<div class="row">

    <div class="col-md-6">
        <a href="{{route('showAddAdvertisement')}}" style="color:white;">
            <div class="info-box bg-olive make-it-slow">
                <span class="info-box-icon"><i class="fa fa-camera"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Liste des régies publicitaires</span>
                    <span class="info-box-number">{{$countAdvertisements}}</span>


                </div>

            </div>

        </a>




    </div>

</div>
</section>

</div>


@endsection
