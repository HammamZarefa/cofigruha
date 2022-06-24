<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Anapat - Admin Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        /*#login::-webkit-input-placeholder{*/
        /*    font-size: 11px;*/
        /*}*/
    </style>

</head>

<body style="padding: 30px 0;background: linear-gradient(90deg, #91d2f2, #61abd0);">


<!-- *************************************************************************** -->
<div class="align" style="padding: 30px 0;">
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <img width="207" height="97" src="{{ asset('admin/img/logo-anpat.png')}}" class="attachment-medium size-medium" alt="" loading="lazy" srcset="{{ asset('admin/img/logo-anpat.png')}}" sizes="(max-width: 207px) 100vw, 207px">
                <form class="login" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input id="login" type="text" class="login__input{{ $errors->has('alias') || $errors->has('email') ? ' is-invalid' : '' }}"
                               name="login" value="{{ old('alias') ?: old('email') }}" required  autofocus placeholder="Usuario" >
                        @if ($errors->has('alias') || $errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('alias') ?: $errors->first('email')  }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input id="password" type="password" class="login__input" name="password" required autocomplete="current-password" placeholder="Contraseña">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="custom-control custom-checkbox small">
                        <input class="custom-control-input" type="checkbox" name="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customCheck">Recuérdame </label>
                    </div>
                    {{-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                    Login
                  </a> --}}
                    <button class="button login__submit">

                        <span class="button__text">Acceso</span>
                    </button>
                </form>
                <!-- <div class="social-login">
                  <h3>log in via</h3>
                  <div class="social-icons">
                    <a href="#" class="social-login__icon fab fa-instagram"></a>
                    <a href="#" class="social-login__icon fab fa-facebook"></a>
                    <a href="#" class="social-login__icon fab fa-twitter"></a>
                  </div>
                </div> -->
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
</div>
<!-- *************************************************************************** -->
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
