<div>
    <div wire:ignore.self class="modal fade" id="rmodal-default{{ $requestedBlood->id }}">
        <div class="modal-dialog modal-xl">
          <div class="modal-content text-dark">
            <div class="modal-header ">
              <h4 class="modal-title text-uppercase">Required Blood <b class="text-indigo"> {{ $requestedBlood->bloodGroup->full_name }}</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>

            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <p class="text-left mb-0">
                                <span class="text-dark font-weight-20">Blood Needed Bag : </span>
                                <b class="text-gray">{{ $requestedBlood->blood_need_bag }}</b>
                              </p>
                              <p class="text-left mb-0">
                                <span class="text-dark font-weight-20">Blood Needed Date : </span>
                                 <b class="text-gray">{{ $requestedBlood->blood_need_date }}</b>
                               </p>
                              <p class="text-left mb-0">
                                <span class="text-dark font-weight-20">Blood Needed Time : </span>
                                 <b
                                  class="text-gray">{{ $requestedBlood->blood_need_time }}
                                </b>
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

                        <div class="col-md-4">
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


                            <p class="mb-0 text-left">
                                <span class="text-dark font-weight-20">Blood Requested By : </span>
                                <b class="text-gray text-capitalize">{{ $requestedBlood->fromUser->name }}</b>
                              </p>
                              <p class="mb-0 text-left">
                                <span class="text-dark font-weight-20">Requested On : </span>
                                 <b class="text-gray">{{ $requestedBlood->updated_at->diffForHumans() }}</b>
                               </p>
                              <p class="mb-0 text-left">
                                <span class="text-dark font-weight-20">Total View : </span>
                                 <b
                                  class="text-gray">{{ $requestedBlood->view_count }}
                                </b>
                              </p>
                        </div>
                    </div>
                    <hr>


                    @if($requestedBlood->from_user_id == Auth::id())
                    <strong class="text-center mt-0">Want To Donate <span class="text-danger">{{ $requestedBlood->bloodRequestAgreement->count() }}</span> Donar. Agreement With <span class="text-danger">{{ $requestedBlood->bloodRequestAgreement()->where('approved',1)->count() }}</span> Donar. And Pending <span class="text-danger">{{ $requestedBlood->bloodRequestAgreement()->where('approved',0)->count() }}</span> Donar.</strong>
                    @else
                    <div class="clearfix">
                        <strong class="text-left mt-0">Want To Donate <span class="text-danger">{{ $requestedBlood->bloodRequestAgreement->count() }}</span> Donar. Agreement With <span class="text-danger">{{ $requestedBlood->bloodRequestAgreement()->where('approved',1)->count() }}</span> Donar. And Pending <span class="text-danger">{{ $requestedBlood->bloodRequestAgreement()->where('approved',0)->count() }}</span> Donar.</strong>
                        <button class="btn btn-sm btn-default font-weight-bold float-right mt-0"  data-toggle="modal" data-target="#modal-default{{ $requestedBlood->id }}">
                            <i class="fa fa-comments text-pink"></i> I want to blood donate
                        </button>
                    </div>

                    @endif

                    <hr>
                <div class="row">
                    @php
                        $bloodRequestedAgreements = $requestedBlood->bloodRequestAgreement()->with('bloodDonar')->get()
                    @endphp
                @foreach($bloodRequestedAgreements as $bloodRequestAgreement)

                  <div class="col-md-6">
                    <div class="card card-widget widget-user">
                        @if($requestedBlood->from_user_id == Auth::id())
                        <div class="position-absolute top-0 left-100" style="right:0px">
                            @if($status)
                            <button type="button" class="btn btn-default" disabled>Agreement Approved
                            </button>
                            @else
                            @if($bloodRequestAgreement->approved == 0)
                                <button wire:click="approvedBloodDonar('{{ $bloodRequestAgreement->id }}')" type="button" class="btn btn-default">
                                    <span wire:loading.remove>Yes I will received your blood</span>
                                    <span wire:loading>Loading...</span>
                                </button>
                            @else
                                <button type="button" class="btn btn-outline-default text-success" disabled>Agreement Approved
                                </button>
                            @endif
                            @endif
                        </div>
                        @else
                        <div class="position-absolute top-0 left-100" style="right:0px">
                            @if(App\Models\BloodRequestAgreement::where('blood_request_id',$bloodRequestAgreement->blood_request_id)->where('blood_donar_id',$bloodRequestAgreement->blood_donar_id)->where('approved',1)->exists())
                             <strong class="bg-success p-1"><i class="fa fa-check"></i> Approved</strong>
                             @else
                             <strong class="bg-primary p-1"> Pending..</strong>

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
                        <p class="mb-0"> Phone : <b> {{ $bloodRequestAgreement->bloodDonar->phone }}</b></p>
                        <p class="mb-0"> Message : <b> {{ $bloodRequestAgreement->message }}</b></p>
                      </div>




                      <div class="card-footer p-0 mt-0">
                        <div class="row">
                          <div class="col-sm-4 border-right">
                            <div class="description-block m-0">
                              <h5 class="description-header">{{ $bloodRequestAgreement->created_at->diffForHumans() }}</h5>
                              <span class="description-text" style="font-size: 12px">Request On</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4 border-right">
                            <div class="description-block m-0">
                              <h5 class="description-header">{{ $bloodRequestAgreement->blood_give_date }}</h5>
                              <span class="description-text" style="font-size: 12px">Blood Give Date</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4">
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
