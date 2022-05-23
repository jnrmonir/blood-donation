<div>
    @section('title')
    Requested Bloods
    @endsection

    @section('description')
    Requested Bloods
    @endsection

    @section('keywords')
    Requested Bloods
    @endsection

  <!-- Content Header (Page header) -->
  <div class="content-header bg-white shadow-sm">
    <div class="container clearfix">
        <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">Requested Blood</h1>
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">Requested Blood</li>
          </ol>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


    <!-- Main content -->
    <div class="content mt-2">
        <div class="container">
            <div class="card mb-0 rounded-0">
                <div class="card-header mt-0 mb-0">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                            <select class="form-control" style="width: 100%;" wire:model="selectedbloodgroup">
                                <option selected="selected" disabled>Choose Blood Group</option>
                                <option value="0">All</option>
                                @foreach ($bloodgroups as $bloodgroup)
                                    <option value="{{ $bloodgroup->id }}" class="text-uppercase">{{ $bloodgroup->full_name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-1">
                            <select class="form-control" style="width: 100%;" wire:model="selectedcountry">
                                <option selected value="0">Choose Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"  >{{ $country->name }}</option>
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

            {{-- <div class="card"> --}}
            {{-- <div class="row" wire:loading.remove wire:target="selectedbloodgroup,selectedcountry,selectedstate,selectedcity,nextPage,previousPage,gotoPage">
                @forelse ($requestedBloods as $requestedBlood)

                <div class="col-md-12 mb-1" >
                  <!-- new requested blood content -->
                  <div class="card my-0 py-0 hoverable-card rounded-0">
                    <div class="card-header border-bottom-0">
                      <a href="{{ route('single_requested_blood',$requestedBlood->slug) }}" class="text-uppercase text-maroon text-left blood-group" style="letter-spacing: 2px;">{{ $requestedBlood->bloodGroup->full_name }}</a>

                      <small class="text-capitalize text-gray float-right">Requested On : <b>{{ $requestedBlood->updated_at->diffForHumans() }}</b></small>

                    </div>
                    <!-- cardbody -->
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-4">
                          <ul class="mb-0 ml-0 list-unstyled">
                            <li><span class="text-dark font-weight-20">Blood Request By: </span> <b class="text-gray text-capitalize">{{ $requestedBlood->fromUser->name }}</b>
                            </li>
                            <li><span class="text-dark font-weight-20">Blood Needed Date : </span> <b class="text-gray">{{ $requestedBlood->blood_need_date }}</b></li>

                          </ul>
                        </div>
                        <div class="col-4">

                            <ul class="mb-0 ml-0 list-unstyled">

                                <li class=""><span class="text-dark font-weight-20">Address : </span><small class="text-dark">{{ $requestedBlood->address }}</small></li>

                                <li><span class="text-dark font-weight-20">Request Want to Donate : </span> <b class="text-gray">{{ $requestedBlood->blood_request_agreement_count }}</b> Donar
                                </li>
                                <li><span class="text-dark font-weight-20">Agreement With Donar : </span> <b
                                  class="text-gray">{{ $requestedBlood->bloodRequestAgreement()->where('approved',1)->count() }}</b> Donar
                                </li>
                              </ul>
                        </div>
                        <div class="col-4 text-right">
                           <a href="tel:{{ $requestedBlood->primary_contact_number }}" class="btn btn-sm btn-default font-weight-bold"><i class="fa fa-phone text-pink"></i> + {{ $requestedBlood->primary_contact_number }}</a>
                           <br>

                           @if($requestedBlood->from_user_id != Auth::id())
                           <button wire:click="bloodDonate('{{ $requestedBlood->id }}')" class="btn btn-sm btn-default font-weight-bold mt-2"  data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-comments text-pink"></i> I want to blood donate
                          </button>
                          @endif

                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- ./ new request blood content -->
                  <hr class="my-0 py-0">
                </div>

                @empty
                <div class="col-md-12">
                    <div class="card">
                        <h2 class="text-center text-danger text-capitalize mb-0">Blood Request Doesn't Found here</h2>
                    </div>
                </div>
                @endforelse
            </div> --}}

            <div class="row mt-1" wire:loading.remove wire:target="selectedbloodgroup,selectedcountry,selectedstate,selectedcity,nextPage,previousPage,gotoPage">
                @forelse ($requestedBloods as $requestedBlood)

                <div class="col-md-6 col-lg-4">
                    <div class="card  py-2 px-3 rounded-0">
                        <div class="credits"><h2 class="text-black-50 h5 mb-0"><a href="{{ route('single_requested_blood',$requestedBlood->slug) }}" class="text-capitalize">{{ $requestedBlood->bloodGroup->full_name }}</a></h2></div>
                        <h3 class="mt-2 mb-0 h6"><span class="text-dark font-weight-20">Blood Request By: </span> <b class="text-gray text-capitalize">{{ $requestedBlood->fromUser->name }}</b></h3>
                        <h4 class="mt-2 mb-0 h6"><span class="text-dark font-weight-20">Blood Need Date: </span> <b class="text-gray text-capitalize">{{ $requestedBlood->blood_need_date }}</b></h4>

                        <span class=" mb-0">Phone : <a href="tel:{{ $requestedBlood->primary_contact_number }}" class="text-success">{{ $requestedBlood->primary_contact_number }}</a></span>

                        <small class="text-black-50"><i class="fa fa-map-marker text-danger"></i> {{ $requestedBlood->address }}</small>
                        <div class="d-flex justify-content-between stats pt-1">
                            <small><i class="fa fa-calendar"></i><span class="ml-2">{{ $requestedBlood->updated_at->diffForHumans() }}</span></small>
                            @if($requestedBlood->from_user_id != Auth::id())
                            <div class="d-flex flex-row align-items-center">
                                <span class="text-info" style="cursor: pointer;" wire:click="bloodDonate('{{ $requestedBlood->id }}')" data-toggle="modal" data-target="#modal-default"><i class="fa fa-comments text-pink"></i> I want to donte</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                @empty
                <div class="col-md-12">
                    <div class="card">
                        <h2 class="text-center text-danger text-capitalize mb-0">Blood Request Doesn't Found here</h2>
                    </div>
                </div>
                @endforelse
            </div>
            {{-- </div> --}}
            <div class="row">

                    <div class="col-12 text-center" wire:loading wire:target="selectedbloodgroup,selectedcountry,selectedstate,selectedcity,nextPage,previousPage,gotoPage">
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
                    {{ $requestedBloods->links() }}
                </div>
            </div>


            <div>
                <div wire:ignore.self class="modal fade" id="modal-default">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content text-dark">
                        <div class="modal-header ">
                          <h4 class="modal-title text-indigo text-capitalize">  Blood Donate Form</h4>
                          <div class="spinner-grow text-danger" role="status" wire:loading wire:target="bloodDonate">
                            <span class="sr-only">Loading...</span>
                          </div>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>

                        </div>
                        <div class="modal-body" wire:loading.remove wire:target="bloodDonate">
                            @if($single_requested_blood != null)
                                @auth
                                @if(App\Models\BloodRequestAgreement::where('blood_donar_id',Auth::id())->where('blood_request_id',$single_requested_blood->id)->exists())

                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Oppss !!. Sorry Sir You Have Already Apply This Request
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @else
                                    @if(Auth::id() == $single_requested_blood->from_user_id)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Oppss !!. Something went to wrong, That is your requested blood!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @else
                                    <h4 class="text-center">Do you want to donate <b class="text-maroon text-capitalize">{{ $single_requested_blood->bloodGroup->full_name }}</b> Blood For
                                        <b class="text-purple text-capitalize">{{ $single_requested_blood->fromUser->name }}?</b> in the area <b class="text-gray">{{ $single_requested_blood->address }}</b>
                                    </h4>

                                    <div class="card">
                                        <div class="card-body register-card-body">
                                            @if (session()->has('wrong'))

                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('wrong') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            @endif
                                            <form>
                                                {{-- <div class="form-group row">
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
                                                </div> --}}






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
                                                        <button wire:click="submit" type="button" @if($validationStatus == false) disabled @endif class="btn btn-success btn-block">
                                                            <span wire:loading wire:target="submit">
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
                                                            <span wire:loading.remove wire:target="submit">Apply Blood Donate</span>
                                                            @endif
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                @endif


                                @endauth
                                @guest

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

                            @endif
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
            </div>

        </div><!-- /.container -->
    </div>
    <!-- /.content -->

</div>
