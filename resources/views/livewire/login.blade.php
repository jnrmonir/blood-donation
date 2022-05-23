<div>
        @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Horry!</strong> {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if (session()->has('wrong'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> {{ session('wrong') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="input-group mb-3">
            <input type="email" wire:model.lazy="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
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
            <input type="password" wire:model.lazy="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
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

                <button wire:click="login" type="button" @if($status == false) disabled  @endif class="btn btn-danger btn-block">
                    <span wire:loading wire:loading.target="login">
                        <span class="spinner-border text-left spinner-border-sm text-success" role="status">
                            <span class="sr-only">Loading..</span>
                        </span>
                        <span class="text-right">Loading..</span>
                    </span>

                    @if ($pending)
                    <span>
                        <span class="spinner-border text-left spinner-border-sm text-success" role="status">
                            <span class="sr-only">Loading..</span>
                        </span>
                        <span class="text-right">Loading..</span>
                    </span>
                    @else
                    <span wire:loading.remove >Login</span>
                    @endif

                </button>

            </div>
            <!-- /.col -->
        </div>

        <script>
            $('.login').click(function(){
                $('#register').addClass('d-none');
                $('#forget-password').addClass('d-none');
                $('#register1').addClass('d-none');
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
            $('.register1').click(function () {
                $('#register1').removeClass('d-none');
                $('#login').addClass('d-none');
                $('#register').addClass('d-none');
                $('#forget-password').addeClass('d-none');
            });
        </script>

</div>
