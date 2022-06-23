<!DOCTYPE html>
<html class="h-100" lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>User Login</title>
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

                                <h4 class="text-center">User Login</h4>
                                <form action="{{ route('user.authenticate') }}" method="POST" class="mt-5 mb-5 login-input">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <input name="user_email" type="email" class="form-control" placeholder="Email" autofocus autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <input name="user_password" type="password" class="form-control" placeholder="Password" autocomplete="off" required>
                                    </div>
                                    <button type="submit" class="btn login-form__btn submit w-100">Sign In</button>
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
    <script src="{{ asset('assets/backend/js/sweetalert2@11.js') }}"></script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    
    
        @if (session()->has('success'))
            Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
            })
        @endif

        @if (session()->has('error'))
            Toast.fire({
            icon: 'error',
            title: '{{ session('error') }}'
            })
        @endif
        
    </script>

</body>
</html>