<!DOCTYPE html>
<html class="h-100" lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>User Register</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/backend/icons/user-icon.png') }}">
    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">
    
</head>

<body class="h-100">
    
    @include('backend.include._preloader')

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">

                                <h4 class="text-center">User Registration</h4>
                                <form action="{{ route('user.register') }}" method="POST" class="mt-5 mb-5 login-input">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <input name="username" type="text" class="form-control @error('username') {{ "is-invalid" }} @enderror" placeholder="Username" autofocus autocomplete="off" required value="{{ old('username') }}">
                                        @error('username')
                                            <div class="invalid-feedback" style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control @error('email') {{ "is-invalid" }} @enderror" placeholder="Email" autocomplete="off" required value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback" style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control @error('password') {{ "is-invalid" }} @enderror" placeholder="Password" autocomplete="off" required>
                                        @error('password')
                                            <div class="invalid-feedback" style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input name="password_confirmation" type="password" class="form-control" placeholder="Password Confirm" autocomplete="off" required>
                                    </div>

                                    <button type="submit" class="btn login-form__btn submit w-100">Sign Up Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('assets/backend/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/settings.js') }}"></script>
    <script src="{{ asset('assets/backend/js/gleek.js') }}"></script>
    <script src="{{ asset('assets/backend/js/styleSwitcher.js') }}"></script>

</body>
</html>