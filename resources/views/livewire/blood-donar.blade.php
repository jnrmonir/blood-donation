<div>

    @section('title')
    Blood Donars
    @endsection

    @section('description')
    BLood Donars
    @endsection

    @section('keywords')
    BLood Donars
    @endsection


    <!-- Content Header (Page header) -->
    <div class="content-header bg-white shadow-sm">
        <div class="container clearfix">
            <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">Blood Donars</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active">Blood Donars</li>
            </ol>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



     <!-- Main content -->
     <div class="content mt-2">
        <div class="container">

    <div class="card m-0 shadow-none rounded-0">
        <div class="card-header mt-0 mb-0">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-1">
                    <select class="form-control" style="width: 100%;" wire:model="selectedbloodgroup">

                        <option value="0" selected="selected">All</option>
                        <option disabled>Choose Blood Group</option>
                        @foreach ($bloodgroups as $bloodgroup)
                            <option value="{{ $bloodgroup->id }}" class="text-uppercase">{{ $bloodgroup->full_name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-1">
                    <select class="form-control" style="width: 100%;" wire:model="selectedcountry">
                        <option value="0">Choose Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @auth @if($country->id == Auth::user()->profile->present_country_id) selected="selected" @endif @endauth>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-1">
                    <select class="form-control" style="width: 100%;" @if(!$selectedcountry) disabled @endif wire:model="selectedstate">
                        <option selected="selected" value="0">Choose State</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-1">
                    <select class="form-control" style="width: 100%;" @if(!$selectedstate) disabled @endif wire:model="selectedcity">
                        <option selected="selected" value="0">Choose City</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>





        <div class="row mt-1" wire:loading.remove wire:target="selectedcountry,selectedstate,selectedcity,selectedbloodgroup,bloodDonar,nextPage,previousPage,gotoPage">
            @if($bloodDonars->count() <= 0)
            <div class="col-md-12">
                <div class="card">
                    <h2 class="text-center text-danger text-capitalize mb-0">Blood Donar Doesn't Found here</h2>
                </div>
            </div>
            @endif

            {{-- user geting show with loop --}}
            @foreach ($bloodDonars as $bloodDonar)

            {{-- last blood donation time  --}}
            @if($bloodDonar->last_blood_donation != null)
            @php
                $date = Carbon\Carbon::parse($bloodDonar->last_blood_donation);
                $now = Carbon\Carbon::now();

                $diff = $date->diffInDays($now);
                $get_diff = $diff / 24;
            @endphp
            @else
            @php
            $get_diff = 4;
            @endphp
            @endif

            {{-- donar list --}}
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="card rounded-0">
                    <div style="height:{{ round($get_diff*25) }}%;width: 3px;background: red;position: absolute;bottom: auto;top: 0px;"></div>
                    <div class="d-flex flex-row mx-2 my-2">

                       {{-- user profile photo --}}
                        @if ($bloodDonar->profile_photo_path != null)
                        <img src="{{ Storage::url('images/avatars/'.$bloodDonar->profile_photo_path) }}" width="70" height="70" class="rounded-circle" alt="{{ $bloodDonar->name }}">
                        @else
                        <img src="{{ asset('images/avator.png') }}" width="70" height="70" class="rounded-circle" alt="{{ $bloodDonar->name }}">
                        @endif

                        {{-- user activity status --}}
                        @if(Cache::has('user-is-online-'.$bloodDonar->id))
                        <span style="right: auto; left:57px; width: 10px; position: absolute; height: 10px; background-color: #00ff3a; border-radius: 50%; box-shadow: #022d17 0 -1px 7px 1px, inset #12ff66 0 -1px 9px, #000 0 2px 12px;"></span>
                        @else
                        <span style="right: auto; left:57px; width: 10px; position: absolute; height: 10px; background-color: #232523; border-radius: 50%; box-shadow: #ffffff 0 -1px 7px 1px, inset #b7c7bd 0 -1px 9px, #634747 0 2px 12px;"></span>
                        @endif

                        {{-- user information --}}
                        <div class="d-flex flex-column ml-2">
                            <h5 class="mb-0"><a href="{{ route('blood_donar_profile',$bloodDonar->slug) }}" class="text-capitalize">{{ $bloodDonar->name }}</a></h5>
                            <span class="text-gray text-capitalize">{{ $bloodDonar->bloodGroup->full_name }} </span>
                            <small class="text-gray"><i class="fa fa-phone text-danger"></i> <a href="tel:{{ $bloodDonar->phone }}" class="">{{ $bloodDonar->phone }}</a></small>
                            <small class="text-black-50"><i class="fa fa-map-marker text-danger"></i> {{ $bloodDonar->profile->present_address }}</small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between install mx-3">
                        <small>Last Active : {{ $bloodDonar->last_seen->diffForHumans() ?? ''}}</small>
                        @if($bloodDonar->id != Auth::id())
                        <span class="text-info" style="cursor: pointer;" wire:click="requestForBlood('{{ $bloodDonar->id }}')" data-toggle="modal" data-target="#rmodal-default"><i class="fa fa-sms text-pink"></i> Request For Blood</i>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    {{-- pre loader --}}
    <div class="row">
        <div class="col-12 text-center" wire:loading wire:target="selectedcountry,selectedstate,selectedcity,selectedbloodgroup,nextPage,previousPage,gotoPage">
            <div class="spinner-grow text-danger" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-warning" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-primary" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-info" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-success" role="status">
              <span class="sr-only">Loading...</span>
            </div>
      </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            {{ $bloodDonars->links() }}
        </div>
    </div>

     {{-- request for blood modal --}}
    <div wire:ignore.self class="modal fade" id="rmodal-default">

        <div class="modal-dialog modal-md">
          <div class="modal-content text-dark">
            <div class="modal-header">
              <h3 class="modal-title text-capitalize h4">Blood Request</h3>
              <div class="spinner-grow text-danger" role="status" wire:loading wire:target="requestForBlood">
                <span class="sr-only">Loading...</span>
              </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @if($single_blood_donar != null)
            <div class="modal-body" wire:loading.remove wire:target="requestForBlood">
                {{-- @auth --}}
                @if(Auth::id() != $single_blood_donar->id)
                <h4 class="text-center">Do you want to blood request <b class="text-maroon text-capitalize">{{ $single_blood_donar->name }}</b>
                     in the area <b class="text-gray">{{ $single_blood_donar->profile->present_address }}</b>
                </h4>
                <!-- request for blood card form -->
                <div class="card " id="register1">
                    <div class="card-body register-card-body">
                        @if (session()->has('wrong'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('wrong') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        @endif

                        @if($updateStatus)
                        <p class="text-center">
                            Select your blood request which you have already created
                        </p>


                        <div class="form-group">
                            <label for="newbloodgroup" class="col-form-label">Select Your Exists Requests</label>
                            <div class="">
                                <div class="input-group mb-3">
                                    <select id="exist_blood_request_id" name="exist_blood_request_id" class="form-control @error('exist_blood_request_id') is-invalid  @enderror" wire:model="exist_blood_request_id" style="width: 100%;">
                                        <option>Choose Your Blood Request</option>
                                        @foreach($exist_blood_requests as $exist_blood_request)
                                            <option value="{{ $exist_blood_request->id }}" class="text-capitalize">{{ $exist_blood_request->bloodGroup->full_name }} <em style="font-size: 10px !important;">Requested On {{ $exist_blood_request->updated_at->diffForHumans() }}</em></option>
                                        @endforeach
                                    </select>

                                    @error('exist_blood_request_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note" class="col-form-label">Message</label>
                            <div class="">

                                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" wire:model.lazy="note"></textarea>

                                    @error('note')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                            </div>
                        </div>


                        <div class="form-group">

                            <div class="">
                                <button wire:click="updateRequest" type="button" @if($validationStatus == false) disabled @endif class="btn btn-success btn-sm">
                                    <span wire:loading wire:target="updateRequest">
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
                                    <span wire:loading.remove wire:target="updateRequest">Submit Your Blood Request</span>
                                    @endif
                                </button>
                            </div>
                        </div>



                        @else

                        {{-- create new blood request --}}

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
                                        @foreach($bloodgroups as $bloodGroup)
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
                                    <button wire:click="submit" type="button" @if($validationStatus == false) disabled @endif class="btn btn-success btn-sm btn-block">
                                        <span wire:loading wire:target="submit">
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
                                        <span wire:loading.remove wire:target="submit">Submit Blood Request</span>
                                        @endif
                                    </button>
                                </div>
                            </div>

                            @endif
                    </div>
                    <!-- /.form-box -->
                </div><!-- /.card -->
                @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Oppss!!,Something Went to Wrong,You Can not Requested To You!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                {{-- @endauth --}}


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

                        <button class=" btn p-0 btn-link register">Register a new membership</button>
                        <br>
                        <button class=" btn p-0 btn-link register1">Request For Blood</button>
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
            @endif

            @auth
                @if($updateStatus)
                   <div class="modal-footer">
                    <button wire:click="createNewRequest" class="btn btn-sm btn-info">
                        <span wire:loading.remove wire:target="createNewRequest">No ,I will Create A New Request</span>
                        <span wire:loading wire:target="createNewRequest">
                            <span class="spinner-border text-left spinner-border-sm text-success" role="status">
                                <span class="sr-only">Loading..</span>
                            </span>
                            Loading...
                        </span>
                    </button>
                  </div>
                @else
                  <div class="modal-footer">
                        <button wire:click="updateExistRequest" class="btn btn-sm btn-info">
                            <span wire:loading.remove wire:target="updateExistRequest">No ,I will Use My Existing Request</span>
                            <span wire:loading wire:target="updateExistRequest">
                                <span class="spinner-border text-left spinner-border-sm text-success" role="status">
                                    <span class="sr-only">Loading..</span>
                                </span>
                                Loading...
                            </span>
                        </button>
                  </div>
                @endif
            @endauth
          </div>
        </div>

    </div>


      {{-- session message --}}
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


        </div><!-- /.container -->
    </div>
    <!-- /.content -->
</div>
