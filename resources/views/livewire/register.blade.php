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
                    <label  class="">Blood Group</label>
                    <div class="">
                        <div class="input-group mb-3">
                            <select  name="newbloodgroup" class="form-control @error('newbloodgroup') is-invalid  @enderror" wire:model="newbloodgroup" style="width: 100%;">
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
                    <label  class="">Country</label>
                    <div class="">
                        <div class="input-group mb-3">
                            <select class="form-control @error('newcountry') is-invalid @enderror" name="newcountry" wire:model="newcountry" style="width: 100%;">
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
                    <label  class="">State</label>
                    <div class="">
                        <div class="input-group mb-3">
                            <select   class="form-control @error('newstate') is-invalid @enderror" name="newstate"  wire:model="newstate" style="width: 100%;">
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
                    <label  class="">City</label>
                    <div class="">
                        <div class="input-group mb-3">
                            <select   class="form-control @error('newcity') @enderror" name="newcity"  wire:model="newcity" style="width: 100%;">
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
                    <label class="">Address</label>
                    <div class="">
                        <div class="input-group mb-3">
                            <input   type="text" wire:model.lazy="address" name="address" class="form-control @error('address') @enderror" placeholder="Full name">
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

                <div>
                    <p>By clicking Sign Up, you agree to our <a href="{{ route('terms') }}">Terms & Condition</a>, and <a href="{{ route('privacy') }}">Privacy & Policy</a>. You may receive SMS notifications from us and can opt out at any time.</p>
                </div>

                <div class="row">
                    <div class="col-6 text-left">
                        <div class="icheck-primary">
                            <input type="checkbox" wire:model="terms" class="@error('terms') is-invalid @enderror"  name="terms" value="agree">
                            <label for="agreeTerms" class="text-gray">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                        @error('terms')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <button wire:click="register" type="button" @if($validationStatus == false) disabled @endif class="btn btn-danger btn-block">
                            <span wire:loading class="text-left">
                                <span class="spinner-border spinner-border-sm text-success" role="status">
                                    <span class="sr-only">Loading..</span>
                                </span>
                             Loading..
                            </span>
                            @if($status)
                            <span>
                                <span class="spinner-border spinner-border-sm text-success" role="status">
                                    <span class="sr-only">Loading..</span>
                                </span>
                                Loading..
                            </span>
                            @else
                            <span wire:loading.remove class="text-right">Register</span>
                            @endif
                        </button>
                    </div>
                    <!-- /.col -->
                </div>

</div>

