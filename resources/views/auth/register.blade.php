
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blood Bank | Register</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Ionicons -->
    <link rel="stylesheet" href="frontend/assets/css/select2.min.css">


    <!-- Theme style -->
    <link rel="stylesheet" href="frontend/assets/css/theme.min.css">
    <!-- Google Font: Source Sans Pro -->
    @livewireStyles
</head>
<body class="hold-transition login-page">
<div class="login-box w-50">
    <div class="login-logo">
        <a href="{{url('/')}}"><b>Blood</b>Bank</a>
    </div>



    <!-- register card form -->
    <div class="card" id="register">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="post">
                @csrf
                <livewire:register />
            </form>


            <button class="text-center p-0 btn btn-link login">I already have a membership</button>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->

    <!-- login card form -->
    <div class="card d-none" id="login">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="email"  name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password"  name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-8 text-left">
                        <div class="icheck-primary">
                            <input type="checkbox" wire:model="remember_me">
                            <label for="remember" class="text-gray">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">

                        <button  type="submit"  class="btn btn-danger btn-block">
                         Login
                        </button>

                    </div>
                    <!-- /.col -->
                </div>

            </form>


            <button class="btn p-0 btn-link forget-password">Forgotten Password?</button><br>
            <button class=" btn p-0 btn-link register">Create New Account</button>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->

    <!-- forget password card form -->
    <div class="card d-none" id="forget-password">
        <div class="card-body register-card-body">
            <p class="login-box-msg">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            <form action="{{ route('password.email') }}" method="post">

                <div class="input-group mb-3">
                    <input type="email" name="email" autofocus required class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn bg-maroon btn-block">Send Password Reset Email</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <button class=" btn p-0 btn-link login">Login</button>
            <button class=" btn btn-link register">Register a new membership</button>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('frontend') }}/assets/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="{{ asset('frontend') }}/assets/js/theme.min.js"></script>


<script>
    $('.login').click(function(){
        $('#register').addClass('d-none');
        $('#forget-password').addClass('d-none');
        $('#login').removeClass('d-none');
    });

    $('.register').click(function () {
        $('#login').addClass('d-none');
        $('#forget-password').addClass('d-none');
        $('#register').removeClass('d-none');
    });

    $('.forget-password').click(function () {
        $('#login').addClass('d-none');
        $('#register').addClass('d-none');
        $('#forget-password').removeClass('d-none');
    });
</script>



@if (session()->has('status'))
    <script>
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'center',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: '{{ session('status') }}'
            });
        });

    </script>
@endif

@if ($errors->any())

    @foreach ($errors->all() as $error)
        <script>
            $(function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 5000
                });
                Toast.fire({
                    icon: 'error',
                    title: '{{ $error }}'
                });
            });

        </script>
    @endforeach

@endif


@livewireScripts
</body>
</html>



