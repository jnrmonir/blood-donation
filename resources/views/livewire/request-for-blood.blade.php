<div>

    @section('title')
    Request for Blood
    @endsection

    @section('description')
    Request For Blood. Any kind of requirment blood
    @endsection

    @section('keywords')
    Request For Blood. Any kind of requirment blood
    @endsection



    <!-- Content Header (Page header) -->
    <div class="content-header bg-white shadow-sm">
        <div class="container clearfix">
            <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">Request For Blood</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active">Request For Blood</li>
            </ol>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content mt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-md-auto">

                    <!-- request for blood card form -->
                    <div class="card " id="register1">
                        <div class="card-body register-card-body">

                                   @guest
                                   <p class="text-center">This Form For Create New Blood Request And user Registraiton automatically.You Have does not any account.Ok No Problem. You can do it.But You Have already Account.
                                    <button class="text-center p-0 btn btn-link login">Please Click here</button>
                                   </p>
                                   <div class="form-group">
                                            <label for="full_name" class="">Full Name</label>

                                        <div class="input-group mb-3">
                                            <input type="text" wire:model.lazy="full_name" name="full_name" class="form-control @error('full_name') is-invalid @enderror" autocomplete="" autofocus placeholder="Full name">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fa fa-user-alt"></span>
                                                </div>
                                            </div>
                                            @error('full_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="">Email</label>

                                            <div class="input-group mb-3">
                                                <input type="email" wire:model.lazy="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
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
                                        </div>

                                        <div class="form-group">
                                            <label  class="">Phone</label>
                                            <div class="input-group mb-3">
                                                <input type="tel" wire:model.lazy="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fa fa-phone-alt"></span>
                                                    </div>
                                                </div>
                                                @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="">Password</label>

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
                                        </div>



                                        <div class="form-group">
                                            <label for="password_confirmation" class="">Confirm Password</label>

                                            <div class="input-group mb-3">
                                                <input type="password" name="password_confirmation" wire:model.lazy="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Retype password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   @endguest

                                    <div class="form-group">
                                        <label for="newbloodgroup" class="col-form-label">Blood Group</label>
                                        <div class="">
                                            <div class="input-group mb-3">
                                                <select id="newbloodgroup" name="newbloodgroup" class="form-control @error('newbloodgroup') is-invalid  @enderror" wire:model="newbloodgroup" style="width: 100%;">
                                                    <option>Choose blood group</option>
                                                    @foreach($bloodGroups as $bloodGroup)
                                                        <option value="{{ $bloodGroup->id }}">{{ $bloodGroup->full_name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('newbloodgroup')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="newcountry" class="col-form-label">Country</label>
                                        <div class="">
                                            <div class="input-group mb-3">
                                                <select  id="newcountry" class="form-control @error('newcountry') is-invalid @enderror" name="newcountry" wire:model="newcountry" style="width: 100%;">
                                                    <option>Choose Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" @auth @if($country->id == Auth::user()->profile->present_country_id) selected @endif @endauth>{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('newcountry')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>





                                    @if($newcountry)
                                    <div class="form-group">
                                        <label for="newstate" class="col-form-label">State</label>
                                        <div class="">
                                            <div class="input-group mb-3">
                                                <select  id="newstate" class="form-control @error('newstate') is-invalid @enderror" name="newstate"  wire:model="newstate" style="width: 100%;">
                                                    <option>Choose State</option>
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('newstate')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @endif


                                    @if($newstate)
                                    <div class="form-group">
                                        <label for="newcity" class="col-form-label">City</label>
                                        <div class="">
                                            <div class="input-group mb-3">
                                                <select  id="newcity" class="form-control @error('newcity') @enderror" name="newcity"  wire:model="newcity" style="width: 100%;">
                                                    <option>Choose City</option>
                                                    @foreach($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('newcity')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @endif


                                    @if($newcity)
                                    <div class="form-group">
                                        <label for="address" class="col-form-label">Address</label>
                                        <div class="">
                                            <div class="input-group mb-3">
                                                <input  id="address" type="text" wire:model.lazy="address" name="address" class="form-control @error('address') @enderror" placeholder="Full name">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fa fa-map-marker-alt"></span>
                                                    </div>
                                                </div>
                                                @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @endif


                                    <div class="form-group">
                                        <label for="optional_contact_number" class="col-form-label text-left">Optional Contact Number</label>
                                        <div class="">
                                            <div class="input-group mb-3">
                                                <input type="tel" id="optional_contact_number" wire:model.lazy="optional_contact_number" name="optional_contact_number" class="form-control @error('optional_contact_number') is-invalid @enderror" placeholder="optional contact number">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fa fa-phone-alt"></span>
                                                    </div>
                                                </div>
                                                @error('optional_contact_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="blood_need_date" class="col-form-label">Blood Needed Date</label>
                                        <div class="">
                                            <div class="input-group mb-3">
                                                <input type="date" id="blood_need_date" wire:model.lazy="blood_need_date" name="blood_need_date" class="form-control @error('blood_need_date') is-invalid @enderror" placeholder="need_blood_date">

                                                @error('blood_need_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <label for="note" class="col-form-label">Message</label>
                                    <div>

                                            <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" wire:model.lazy="note"></textarea>

                                            @error('note')
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
                                                Loading...
                                            </span>
                                            @if($status)
                                            <span>
                                                <span class="spinner-border text-left spinner-border-sm text-success" role="status">
                                                    <span class="sr-only">Loading..</span>
                                                </span>
                                                <span>Request Pending.....</span>
                                            </span>
                                            @else
                                            <span wire:loading.remove >Submit Blood Request</span>
                                            @endif
                                        </button>
                                    </div>
                                </div>

                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.card -->


                    <!-- register card form -->
                     <div class="card d-none" id="register">
                         <div class="card-body register-card-body">
                             <p class="login-box-msg">Register a new membership</p>
                                 <livewire:register />
                             <button class="text-center p-0 btn btn-link login">I already have a membership</button>
                         </div>
                         <!-- /.form-box -->
                     </div><!-- /.card -->

                     <!-- login card form -->
                     <div class="card d-none" id="login">
                         <div class="card-body register-card-body">
                             <p class="login-box-msg">Sign in to start your session</p>
                                 <livewire:login />
                             <button class="btn p-0 btn-link register">Register a new membership</button>
                             <br>
                             <button class="text-center p-0 btn btn-link register1">Request For Blood</button>

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

                </div>
            </div>
        </div><!-- /.container -->
    </div>
    <!-- /.content -->

    @push('js')
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
    @endpush

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
</div>

