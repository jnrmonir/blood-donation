
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blood Bank | Forget Password</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="frontend/assets/font-awesome/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="frontend/assets/css/select2.min.css">
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="frontend/assets/css/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="frontend/assets/css/theme.min.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    @livewireStyles
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{url('/')}}"><b>Blood</b>Bank</a>
    </div>



    <!-- forget password card form -->
    <div class="card " id="forget-password">
        <div class="card-body register-card-body">
            <p class="login-box-msg">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            <form action="{{ route('password.email') }}" method="post">

                <div class="input-group mb-3">
                    <input type="email" name="email" autofocus required class="form-control @error('email') @enderror" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('error')
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
<script src="frontend/assets/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="frontend/assets/js/bootstrap.bundle.min.js"></script>
<script src="frontend/assets/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="frontend/assets/js/theme.min.js"></script>
<script>
    $('.select2').select2()
</script>
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
@livewireScripts
</body>
</html>



