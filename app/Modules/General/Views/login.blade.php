<!DOCTYPE html>
<html>
@section('pageTitle', 'Connexion')
@include('General.head')

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Wize </b>Admin</a>
        </div>

        <div class="login-box-body">
            <p class="login-box-msg">Se connecter à votre compte </p>

            <form action="{{route('handleLogin')}}" method="post">
                {{csrf_field()}}
                <div class="form-group has-feedback">
                    <input type="text" name="accessCode" class="form-control" placeholder="Code d'accés" <span
                        class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">Se connecter</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>




        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->

    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->

    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('/js/icheck.min.js') }}"></script>

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')
</body>

</html>
