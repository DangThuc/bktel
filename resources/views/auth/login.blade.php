<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="modal-login row align-items-center">
            <div class="wrap-login100 align-items-center">
                <div class="pb-5" data-tilt>
                    <img src="images/img-01.png" alt="IMG">
                </div>
    
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <span class="login100-form-title">
                        Member Login
                    </span>
    
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input id="email" class="input100" type="text" name="email" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <span class="focus-input100"></span>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
    
                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input id="password" class="input100" type="password"  placeholder="{{ __('Password') }}"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            {{ __('Login') }}
                        </button>
                    </div>
    
                    <div class="text-center p-t-12">
    
                    <!-- Reset password page when confirm email, need a token that sent to email, example 123 -->
                        <!-- <a class="txt2"  href="{{ route('password.reset', 123) }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div> -->

                        <a class="txt2"  href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
    
                    <div class="text-center p-t-50">
                        <a class="txt2" href="{{ route('register') }}">
                            Create your Account
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

