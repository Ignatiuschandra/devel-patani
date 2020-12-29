<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login PATANI</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo_square.png') }}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_form/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_form/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_form/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_form/vendor/animate/animate.css') }}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_form/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_form/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_form/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_form/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_form/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_form/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="{{ url('do-login') }}" method="post">
                    <input type="hidden" name="redirect_back" value="0">
                    @csrf
                    {{-- <span class="login100-form-title p-b-26">
                        SI BSM
                    </span> --}}
                    <span class="login100-form-title p-b-48">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/img/footer-logo.png') }}" width="150"></a>
                    </span>

                    <div class="wrap-input100 validate-input">
                        <input class="input100 has-val" type="text" name="username">
                        <span class="focus-input100" data-placeholder="Username"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100 has-val" type="password" name="password">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
                <br>
                <p class="text-center"><a href="{{ url('register') }}">Create an Account</a></p>
            </div>
        </div>
    </div>
    

    <div id="dropDownSelect1"></div>
    
<!--===============================================================================================-->
    <script src="{{ asset('assets/login_form/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('assets/login_form/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('assets/login_form/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('assets/login_form/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('assets/login_form/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('assets/login_form/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/login_form/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('assets/login_form/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('assets/login_form/js/main.js') }}"></script>

    <script type="text/javascript">
        @if (session('status'))
            alert("{{ session('status') }}");
        @endif
    </script>

</body>
</html>