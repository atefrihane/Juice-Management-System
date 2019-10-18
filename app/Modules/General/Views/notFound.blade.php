@extends('General.layout')
@section('pageTitle', 'Oups!')
@section('content')
<div class="content-wrapper">
    <section class="content-header">

    </section>
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>

            <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> Oops! Page introuvable.</h3>

                <p>

                    Nous n'avons pas trouvé la page que vous cherchiez.
                    En attendant, vous pouvez revenir au <a href="{{route('showHome')}}">tableau de bord </a>

                </p>


            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
</div>

@endsection
