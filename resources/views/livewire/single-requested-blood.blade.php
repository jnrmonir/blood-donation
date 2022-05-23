<div>
    @section('title')
    Requested By {{ $requestedBlood->fromUser->name ?? '' }} Blood {{ $requestedBlood->bloodGroup->full_name }}
    @endsection

    @section('description')
        Requested By {{ $requestedBlood->fromUser->name ?? '' }} Blood {{ $requestedBlood->bloodGroup->full_name }}
    @endsection

    @section('keywords')
    Requested By {{ $requestedBlood->fromUser->name ?? '' }} Blood {{ $requestedBlood->bloodGroup->full_name }}
    @endsection

    <!-- Content Header (Page header) -->
    <div class="content-header bg-white shadow-sm">
        <div class="container clearfix">
            <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">Requested Blood Details</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('requested_blood') }}"><i class="fa fa-dashboard"></i> Requested Bloods</a></li>
                <li class="breadcrumb-item active">{{ $requestedBlood->slug }}</li>
            </ol>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content mt-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                  <div class="card rounded-0">
                    <div class="card-header ">
                      <h4 class="modal-title text-uppercase">Required Blood <b class="text-indigo"> {{ $requestedBlood->bloodGroup->full_name }}</b></h4>


                    </div>
                    <div class="card-body hoverable-card">

                            <div class="row">
                                <div class="col-md-4">
                                      <p class="text-left mb-0">
                                        <span class="text-dark font-weight-20">Blood Needed Date : </span>
                                         <b class="text-gray">{{ $requestedBlood->blood_need_date }}</b>
                                      </p>
                                      <p class="text-left mb-0">
                                        <span class="text-dark font-weight-20">Message : </span>
                                         <b class="text-gray">{{ $requestedBlood->note}}</b>
                                      </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="text-left mb-0">
                                        <span class="text-dark font-weight-20">Address : </span>
                                        <b class="text-gray">{{ $requestedBlood->address }}</b>
                                      </p>
                                      <p class="text-left mb-0">
                                        <span class="text-dark font-weight-20">Primary Contact : </span>
                                         <b class="text-gray">{{ $requestedBlood->primary_contact_number }}</b>
                                       </p>
                                      <p class="text-left mb-0">
                                        <span class="text-dark font-weight-20">Optional Contact : </span>
                                         <b
                                          class="text-gray">{{ $requestedBlood->optional_contact_number }}
                                        </b>
                                      </p>
                                </div>


                                <div class="col-md-4 ">
                                    <div class="float-right">
                                    @if ($requestedBlood->fromUser->profile_photo_path != null)
                                        <img src="{{ Storage::url('images/avatars/'.$requestedBlood->fromUser->profile_photo_path) }}" alt="{{ $requestedBlood->fromUser->name }}" class="img-circle position-relative" style="height: 80px">
                                    @else
                                    <img src="{{ asset('images/avator.png') }}" alt="{{ $requestedBlood->fromUser->name }}" class="img-circle  position-relative " style="height: 80px;">
                                    @endif

                                    @if(Cache::has('user-is-online-' . $requestedBlood->fromUser->id))
                                        <span style="right: 22px; width: 12px; position: absolute; height: 12px; background-color: #00ff3a; border-radius: 50%; box-shadow: #022d17 0 -1px 7px 1px, inset #12ff66 0 -1px 9px, #000 0 2px 12px;"></span>

                                    @else

                                    <span style="right: 22px; width: 12px; position: absolute; height: 12px; background-color: #232523; border-radius: 50%; box-shadow: #ffffff 0 -1px 7px 1px, inset #b7c7bd 0 -1px 9px, #634747 0 2px 12px;"></span>

                                    @endif
                                    </div>



                                    <p class="mb-0">
                                        <span class="text-dark font-weight-20">Blood Requested By : </span>
                                        <b class="text-gray text-capitalize">{{ $requestedBlood->fromUser->name }}</b>
                                      </p>
                                      <p class="mb-0">
                                        <span class="text-dark font-weight-20">Requested On : </span>
                                         <b class="text-gray">{{ $requestedBlood->updated_at->diffForHumans() }}</b>
                                       </p>
                                      <p class="mb-0">
                                        <span class="text-dark font-weight-20">Total View : </span>
                                         <b
                                          class="text-gray">{{ $requestedBlood->view_count }}
                                        </b>
                                      </p>
                                </div>
                            </div>
                            <hr>


                            @if($requestedBlood->from_user_id == Auth::id())
                            <strong class="text-center mt-0">Want To Donate Blood <span class="text-danger">{{ $donar_want_doantes->count() }}</span> Donar. Agreement With <span class="text-danger">{{ $agreement_with_donars->count() }}</span> Donar.</strong>
                            @else
                            <div class="clearfix">
                                <strong class="text-left mt-0">Want To Donate Blood <span class="text-danger">{{ $donar_want_doantes->count() }}</span> Donar. Agreement With <span class="text-danger">{{ $agreement_with_donars->count() }}</span> Donar.</strong>
                                <button class="btn btn-sm btn-default font-weight-bold float-right mt-0"  data-toggle="modal" data-target="#modal-default">
                                    <i class="fa fa-comments text-pink"></i> I want to blood donate
                                </button>
                            </div>


                            @endif

                            <hr>
                            {{-- agreement with donar --}}
                            <h3>Agreement With Donar <b>{{ $agreement_with_donars->count() }}</b></h3>
                            <div class="row">

                            @foreach($agreement_with_donars as $bloodRequestAgreement)

                            <div class="col-md-6">
                                <div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header text-left mb-0 pb-0">
                                    <h3 class="widget-user-username text-capitalize mb-0">{{ $bloodRequestAgreement->bloodDonar->name }}</h3>
                                    <div class="float-right">
                                        @if ($bloodRequestAgreement->bloodDonar->profile_photo_path != null)
                                            <img src="{{ Storage::url('images/avatars/'.$bloodRequestAgreement->bloodDonar->profile_photo_path) }}" alt="{{ $bloodRequestAgreement->bloodDonar->name }}" class="img-circle elevation-2" style="height: 60px;">
                                        @else
                                            <img src="{{ asset('images/avator.png') }}" alt="{{ $bloodRequestAgreement->bloodDonar->name }}" class="img-circle elevation-2" style="height: 60px">
                                        @endif



                                    </div>

                                    @if(Cache::has('user-is-online-'.$bloodRequestAgreement->bloodDonar->id))
                                    <span style="right: 22px; width: 12px; position: absolute; height: 12px; background-color: #00ff3a; border-radius: 50%; box-shadow: #022d17 0 -1px 7px 1px, inset #12ff66 0 -1px 9px, #000 0 2px 12px;"></span>


                                    @else

                                    <span style="right: 22px; width: 12px; position: absolute; height: 12px; background-color: #232523; border-radius: 50%; box-shadow: #ffffff 0 -1px 7px 1px, inset #b7c7bd 0 -1px 9px, #634747 0 2px 12px;"></span>

                                    @endif
                                    <p class="mb-0"> Address : <b> {{ $bloodRequestAgreement->bloodDonar->profile->present_address }}</b></p>

                                    <p class="mb-0"> Message : <b> {{ $bloodRequestAgreement->message }}</b></p>
                                </div>




                                <div class="card-footer p-0 mt-0">
                                    <div class="row">
                                    <div class="col-4 border-right">
                                        <div class="description-block m-0">
                                        <h5 class="description-header">{{ $bloodRequestAgreement->created_at->diffForHumans() }}</h5>
                                        <span class="description-text" style="font-size: 12px">Request On</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4 border-right">
                                        <div class="description-block m-0">
                                        <h5 class="description-header">{{ $bloodRequestAgreement->blood_give_date }}</h5>
                                        <span class="description-text" style="font-size: 12px">Blood Give Date</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <div class="description-block m-0">
                                        <h5 class="description-header">{{ $bloodRequestAgreement->updated_at->diffForHumans() }}</h5>
                                        <span class="description-text" style="font-size: 12px">Agreement On</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                </div>
                            </div>
                            @endforeach

                            </div>
                          <hr>


                          {{-- want to donate --}}
                            <h3>Want to Donate <b>{{ $donar_want_doantes->count() }}</b> Donar </h3>
                            <div class="row">

                            @foreach($donar_want_doantes as $bloodRequestAgreement)

                            <div class="col-md-6">
                                <div class="card card-widget widget-user">
                                    @if($requestedBlood->from_user_id == Auth::id())
                                    <div class="position-absolute top-0 left-100" style="right:0px">

                                        @if($bloodRequestAgreement->approved == 0)
                                            <button wire:click="approvedBloodDonar('{{ $bloodRequestAgreement->id }}')" type="button" class="btn btn-default">
                                                <span wire:loading.remove wire:target="approvedBloodDonar{{ $bloodRequestAgreement->id }}">Yes I will received your blood</span>
                                                <span wire:loading wire:target="approvedBloodDonar{{ $bloodRequestAgreement->id  }}">Loading...</span>
                                            </button>
                                        @endif
                                    </div>
                                    @endif
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header text-left mb-0 pb-0">
                                    <h3 class="widget-user-username text-capitalize mb-0">{{ $bloodRequestAgreement->bloodDonar->name }}</h3>
                                    <div class="float-right">
                                        @if ($bloodRequestAgreement->bloodDonar->profile_photo_path != null)
                                            <img src="{{ Storage::url('images/avatars/'.$bloodRequestAgreement->bloodDonar->profile_photo_path) }}" alt="{{ $bloodRequestAgreement->bloodDonar->name }}" class="img-circle elevation-2" style="height: 60px;">
                                        @else
                                            <img src="{{ asset('images/avator.png') }}" alt="{{ $bloodRequestAgreement->bloodDonar->name }}" class="img-circle elevation-2" style="height: 60px">
                                        @endif



                                    </div>

                                    @if(Cache::has('user-is-online-'.$bloodRequestAgreement->bloodDonar->id))
                                    <span style="right: 22px; width: 12px; position: absolute; height: 12px; background-color: #00ff3a; border-radius: 50%; box-shadow: #022d17 0 -1px 7px 1px, inset #12ff66 0 -1px 9px, #000 0 2px 12px;"></span>


                                    @else

                                    <span style="right: 22px; width: 12px; position: absolute; height: 12px; background-color: #232523; border-radius: 50%; box-shadow: #ffffff 0 -1px 7px 1px, inset #b7c7bd 0 -1px 9px, #634747 0 2px 12px;"></span>

                                    @endif
                                    <p class="mb-0"> Address : <b> {{ $bloodRequestAgreement->bloodDonar->profile->present_address }}</b></p>

                                    <p class="mb-0"> Message : <b> {{ $bloodRequestAgreement->message }}</b></p>
                                </div>




                                <div class="card-footer p-0 mt-0">
                                    <div class="row">
                                    <div class="col-4 border-right">
                                        <div class="description-block m-0">
                                        <h5 class="description-header">{{ $bloodRequestAgreement->created_at->diffForHumans() }}</h5>
                                        <span class="description-text" style="font-size: 12px">Request On</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4 border-right">
                                        <div class="description-block m-0">
                                        <h5 class="description-header">{{ $bloodRequestAgreement->blood_give_date }}</h5>
                                        <span class="description-text" style="font-size: 12px">Blood Give Date</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <div class="description-block m-0">
                                        <h5 class="description-header">{{ $bloodRequestAgreement->updated_at->diffForHumans() }}</h5>
                                        <span class="description-text" style="font-size: 12px">Modify At</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                </div>
                            </div>
                            @endforeach
                            </div>

                            <hr>


                            {{-- request ot donar --}}
                            @if($requestedBlood->from_user_id == Auth::id())
                            <h3>Request To Donar</h3>
                            <div class="row">

                            @foreach($request_to_donars as $request_to_donar)
                             @if($agreement_with_donars->count() > 0)
                              @if($request_to_donar->id != $requestedBlood->bloodRequestAgreement()->where('approved',1)->where('status',1)->first()->blood_donar_id)
                              <div class="col-md-6">
                                <div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header text-left mb-0 pb-0">
                                    <h3 class="widget-user-username text-capitalize mb-0">{{ $request_to_donar->name }}</h3>
                                    <div class="float-right">
                                        @if ($request_to_donar->profile_photo_path != null)
                                            <img src="{{ Storage::url('images/avatars/'.$request_to_donar->profile_photo_path) }}" alt="{{ $request_to_donar->name }}" class="img-circle elevation-2" style="height: 60px;">
                                        @else
                                            <img src="{{ asset('images/avator.png') }}" alt="{{ $request_to_donar->name }}" class="img-circle elevation-2" style="height: 60px">
                                        @endif



                                    </div>

                                    @if(Cache::has('user-is-online-'.$request_to_donar->id))
                                    <span style="right: 22px; width: 12px; position: absolute; height: 12px; background-color: #00ff3a; border-radius: 50%; box-shadow: #022d17 0 -1px 7px 1px, inset #12ff66 0 -1px 9px, #000 0 2px 12px;"></span>


                                    @else

                                    <span style="right: 22px; width: 12px; position: absolute; height: 12px; background-color: #232523; border-radius: 50%; box-shadow: #ffffff 0 -1px 7px 1px, inset #b7c7bd 0 -1px 9px, #634747 0 2px 12px;"></span>

                                    @endif
                                    <p class="mb-0"> Address : <b> {{ $request_to_donar->profile->present_address }}</b></p>

                                    <p class="mb-0"> Message : <b> {{ $request_to_donar->pivot->message ?? '' }}</b></p>
                                    {{-- <p class="mb-0"> Request On : <b> {{ $request_to_donar->pivot->updated_at->diffForHumans() ?? '' }}</b></p> --}}
                                </div>

                                </div>
                              </div>
                              @endif
                              @else
                              <div class="col-md-6">
                                <div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header text-left mb-0 pb-0">
                                    <h3 class="widget-user-username text-capitalize mb-0">{{ $request_to_donar->name }}</h3>
                                    <div class="float-right">
                                        @if ($request_to_donar->profile_photo_path != null)
                                            <img src="{{ Storage::url('images/avatars/'.$request_to_donar->profile_photo_path) }}" alt="{{ $request_to_donar->name }}" class="img-circle elevation-2" style="height: 60px;">
                                        @else
                                            <img src="{{ asset('images/avator.png') }}" alt="{{ $request_to_donar->name }}" class="img-circle elevation-2" style="height: 60px">
                                        @endif



                                    </div>

                                    @if(Cache::has('user-is-online-'.$request_to_donar->id))
                                    <span style="right: 22px; width: 12px; position: absolute; height: 12px; background-color: #00ff3a; border-radius: 50%; box-shadow: #022d17 0 -1px 7px 1px, inset #12ff66 0 -1px 9px, #000 0 2px 12px;"></span>


                                    @else

                                    <span style="right: 22px; width: 12px; position: absolute; height: 12px; background-color: #232523; border-radius: 50%; box-shadow: #ffffff 0 -1px 7px 1px, inset #b7c7bd 0 -1px 9px, #634747 0 2px 12px;"></span>

                                    @endif
                                    <p class="mb-0"> Address : <b> {{ $request_to_donar->profile->present_address }}</b></p>

                                    <p class="mb-0"> Message : <b> {{ $request_to_donar->pivot->message ?? '' }}</b></p>
                                    {{-- <p class="mb-0"> Request On : <b> {{ $request_to_donar->pivot->updated_at->diffForHumans() ?? '' }}</b></p> --}}
                                </div>

                                </div>
                            </div>
                             @endif


                            @endforeach

                            </div>
                            @endif


                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>


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
                        @if (session()->has('wrong'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Holy guacamole!</strong> {{ session('wrong') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        @if (session()->has('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                             {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        @auth
                        @if(App\Models\BloodRequestAgreement::where('blood_donar_id',Auth::id())->where('blood_request_id',$requestedBlood->id)->exists())
                           <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              Oppss !!. Sorry Sir You Have Already Apply This Request
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @else
                            @if(Auth::id() == $requestedBlood->from_user_id)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Oppss !!. Something went to wrong, That is your requested blood!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @else
                                <h4 class="text-center">Do you want to donate <b class="text-maroon text-capitalize">{{ $requestedBlood->bloodGroup->full_name }}</b> Blood For
                                    <b class="text-purple text-capitalize">{{ $requestedBlood->fromUser->name }}?</b> in the area <b class="text-gray">{{ $requestedBlood->address }}</b>
                                </h4>

                                <div class="card">
                                    <div class="card-body register-card-body">

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

                                                        <textarea class="form-control @error('note') is-invalid @enderror"  name="note" wire:model.lazy="note"></textarea>

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
                                                    <button wire:click="submit" type="button" @if($validationStatus == false) disabled @endif class="btn btn-success btn-block">
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
                                <button class="btn p-0 btn-link register">Register a new membership</button>
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

              @push('js')
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
              @endpush


        </div><!-- /.container -->
    </div>
    <!-- /.content -->

</div>
