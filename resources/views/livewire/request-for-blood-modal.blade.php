<div>
    <div wire:ignore.self class="modal fade" id="rmodal-default{{ $user->id }}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content text-dark">
            <div class="modal-header ">
              <h5 class="modal-title text-capitalize">Blood Request To <b>{{ $user->name }}</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @auth
                <h4 class="text-center">Do you want to blood request <b class="text-maroon text-capitalize">{{ $user->name }}</b>
                     in the area <b class="text-gray">{{ $user->profile->present_address }}</b>
                </h4>
                <!-- request for blood card form -->
                <div class="card " id="register">
                    <div class="card-body register-card-body">

                        @if(Auth::user()->bloodRequests()->count() > 0)
                        <div class="row">
                            <div class="col-md-6">
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
                            </div>
                        </div>
                        @else

                        <div class="row">
                            <div class="col-md-6">
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
                            </div>

                            <div class="col-md-6">
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
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-6">
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
                            </div>

                            <div class="col-md-6">
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
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
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
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="blood_need_bag" class="col-form-label">Blood Needed Bag</label>
                                    <div class="">
                                        <div class="input-group mb-3">
                                            <input type="number" id="blood_need_bag" wire:model.lazy="blood_need_bag" name="blood_need_bag" class="form-control @error('blood_need_bag') is-invalid @enderror" placeholder="Requeired Blood Bag">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-shopping-bag"></span>
                                                </div>
                                            </div>
                                            @error('blood_need_bag')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="primary_contact_number" class="col-form-label">Primary Contact Number</label>
                                    <div class="">
                                        <div class="input-group mb-3">
                                            <input type="tel" disabled id="primary_contact_number" wire:model.lazy="primary_contact_number" name="primary_contact_number" class="form-control @error('primary_contact_number') is-invalid @enderror" placeholder="primary contact number">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fa fa-phone-alt"></span>
                                                </div>
                                            </div>
                                            @error('primary_contact_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
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
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
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
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="blood_need_time" class="col-form-label">Blood Needed Time</label>
                                    <div class="">
                                        <div class="input-group mb-3">
                                            <input type="time" onclick="timechange" id="blood_need_time" wire:model.lazy="blood_need_time" name="blood_need_time" class="form-control @error('blood_need_time') is-invalid @enderror">

                                            @error('blood_need_time')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                            <div class="form-group row">
                                <label for="note" class="col-md-4 col-form-label text-left">Note</label>
                                <div class="col-md-8">

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


                       @endif




                    </div>
                    <!-- /.form-box -->
                </div><!-- /.card -->
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

                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <livewire:login />
                        </form>


                        <button class="btn p-0 btn-link forget-password">I forgot my password</button><br>
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
        </div>
    </div>


</div>


