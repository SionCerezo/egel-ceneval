<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Login - Egel Ceneval FCC</title>
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
</style>
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
        style="background: url({{ asset('images/bgLogin.jpg') }}) no-repeat center center; background-size: cover;">
            <div class="auth-box row">
                {{-- <div class="col-lg-7 col-md-5 modal-bg-img" style="background: url({{ asset('images/ceneval.jpg')}}) no-repeat center center;">
                </div> --}}
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="{{ asset('images/logo-fcc.png') }}" width="50" height="63" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Iniciar sesión</h2>
                        <p class="text-center">Ingresa tu e-mail y tu contraseña para acceder.</p>

                        @if (session()->has('loginFail'))
                            <span class="invalid-feedback" role="alert" style="display: inline">
                                <strong>{{ session()->get('loginFail') }}</strong>
                            </span>
                        @endif

                        <form class="mt-4" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Usuario</label>
                                        <input class="form-control" name="email" id="uname" type="text" value="{{ old('email') }}"
                                            placeholder="ingresa tu e-mail" @error('email') is-invalid @enderror>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert" style="display: inline">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Password</label>
                                        <input class="form-control" name="password" id="pwd" type="password"
                                            placeholder="ingresa tu password" @error('password') is-invalid @enderror>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert" style="display: inline">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Entrar</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    ¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-danger">Registrarse</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>

    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('js/login.js') }}"></script>

    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>
