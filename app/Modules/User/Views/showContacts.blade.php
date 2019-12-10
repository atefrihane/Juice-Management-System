@extends('General.layoutCompany')
@section('pageTitle', 'Liste des contacts')
@section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('contact', $company) }}
    </section>


    <section class="content" style="margin-top:20px;">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des Contacts</h3>
                        <a href="{{route('showAddContact',$company->id)}}" class="btn btn-primary pull-right">Ajouter un
                            contact</a>


                        <!-- <h3 class="box-title pull-right"><a href=""> /a></h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover example2">
                            <thead>
                                <tr>
                                    <th>Nom Et Prénom</th>
                                    <th>Code</th>
                                    <th>Type de compte</th>
                                    <th>Magasin</th>
                                    <th></th>

                                </tr>

                            </thead>
                            <tbody>



                                <tr>

                                    <td>Nom</td>
                                    <td>CMD017</td>
                                    <td>Directeur</td>
                                    <td>Nom</td>
                                    <td class="not-this text-center">

                                        <div class="btn-group">
                                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"></a>
                                            <ul class="dropdown-menu edit" role="menu">
                                                <li><a href="#">Modifier</a></li>
                                                <li><a href="#">Annuler</a></li>
                                                <li><a href="#">Supprimer</a></li>

                                            </ul>
                                        </div>




                    </div>
                    </td>



                    </tr>


                    <tr>

                        <td>Nom</td>
                        <td>CMD017</td>
                        <td>Directeur</td>
                        <td>Nom</td>
                        <td class="not-this text-center">

                            <div class="btn-group">
                                <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"></a>
                                <ul class="dropdown-menu edit" role="menu">
                                    <li><a href="#">Modifier</a></li>
                                    <li><a href="#">Annuler</a></li>
                                    <li><a href="#">Supprimer</a></li>

                                </ul>
                            </div>




                </div>
                </td>



                </tr>






                <tr>

                    <td>Nom</td>
                    <td>CMD017</td>
                    <td>Directeur</td>
                    <td>Nom</td>
                    <td class="not-this text-center">

                        <div class="btn-group">
                            <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"></a>
                            <ul class="dropdown-menu edit" role="menu">
                                <li><a href="#">Modifier</a></li>
                                <li><a href="#">Annuler</a></li>
                                <li><a href="#">Supprimer</a></li>

                            </ul>
                        </div>




            </div>
            </td>



            </tr>



            <tr>

                <td>Nom</td>
                <td>CMD017</td>
                <td>Directeur</td>
                <td>Nom</td>
                <td class="not-this text-center">

                    <div class="btn-group">
                        <a href="#" class="dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                        <ul class="dropdown-menu edit" role="menu">
                            <li><a href="#">Modifier</a></li>
                            <li><a href="#">Annuler</a></li>
                            <li><a href="#">Supprimer</a></li>

                        </ul>
                    </div>




        </div>
        </td>



        </tr>







        </tbody>

        </table>
</div>

</div>


</div>

</div>

</section>

</div>

@endsection
