<div>
    <div wire:ignore.self class="modal fade" id="modal-default{{ $requestedBlood->id }}">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content text-dark">
            <div class="modal-header ">
              <h4 class="modal-title text-indigo text-capitalize">  Donate To {{ $requestedBlood->fromUser->name }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>

            </div>
            <div class="modal-body">
                @auth

                <h4 class="text-center">Do you want to donate <b class="text-maroon text-capitalize">{{ $requestedBlood->bloodGroup->full_name }}</b> Blood For
                    <b class="text-purple text-capitalize">{{ $requestedBlood->fromUser->name }}?</b> in the area <b class="text-gray">{{ $requestedBlood->address }}</b>
                </h4>

                <div class="card">
                    <div class="card-body register-card-body">
                        <form>
                            <div class="form-group row">
                                <label for="blood_give_date" class="col-md-4 col-form-label text-left">Blood Give Date</label>
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <input type="date"  wire:model.lazy="blood_give_date" name="blood_give_date" class="form-control @error('blood_give_date') is-invalid @enderror" placeholder="blood_give_date">

                                        @error('blood_give_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>






                            <div class="form-group row">
                                <label for="message" class="col-md-4 col-form-label text-left">Message</label>
                                <div class="col-md-8">

                                        <textarea class="form-control @error('message') is-invalid @enderror"  name="message" wire:model.lazy="message"></textarea>

                                        @error('message')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="blood_request" class="col-md-4 col-form-label text-left"></label>
                                <div class="col-md-8">
                                    <button wire:click="submit" type="button" @if($validationStatus == false) disabled @endif class="btn btn-danger btn-block">
                                        <span wire:loading>
                                            <span class="spinner-border text-left spinner-border-sm text-success" role="status">
                                                <span class="sr-only">Loading..</span>
                                            </span>

                                        </span>
                                        @if($status)
                                        <span>
                                            <span class="spinner-border text-left spinner-border-sm text-success" role="status">
                                                <span class="sr-only">Loading..</span>
                                            </span>
                                            <span>Processing.....</span>
                                        </span>
                                        @else
                                        <span wire:loading.remove >Apply Blood Donate</span>
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endauth
                @guest

               <!-- register card form -->
                <div class="card d-none" id="register">
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
                <div class="card" id="login">
                    <div class="card-body register-card-body">
                        <p class="login-box-msg">Sign in to start your session</p>
                            <livewire:login />
                        <button class=" btn p-0 btn-link register">Register a new membership</button>
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

                        <button class=" btn p-0 btn-link login">Login</button><br>
                        <button class=" btn btn-link register">Register a new membership</button>
                    </div>
                    <!-- /.form-box -->
                </div><!-- /.card -->
              @endguest
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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

  @if (session()->has('wrong'))
      <script>
          $(function() {
              const Toast = Swal.mixin({
                  toast: true,
                  position: 'center',
                  showConfirmButton: false,
                  timer: 3000
              });
              Toast.fire({
                  icon: 'error',
                  title: '{{ session('wrong') }}'
              });
          });

      </script>
  @endif
</div>
