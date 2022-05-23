<div>


    @section('title')
    chat
    @endsection

    @section('keywords')
    chat
    @endsection

    @section('description')
    chat
    @endsection
    <!-- Content Header (Page header) -->
    <div class="content-header bg-white shadow-sm">
        <div class="container clearfix">
            <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">Chat</h1>
              <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active">Chat</li>
              </ol>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mt-2">
                    <div class="card direct-chat direct-chat-primary rounded-0">
                        <div class="card-header">
                          <h3 class="card-title">Select Blood Donar</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <!-- Conversations are loaded here -->
                          <div class="direct-chat-messages">
                            @foreach ($donars as $donar)
                            <div class="card rounded-0 hoverable-card"  wire:click="selectDonar('{{ $donar->id }}')" style="cursor: pointer;" wire:loading.remove >
                                <div class="d-flex flex-row mx-2 my-2 ">

                                   {{-- user profile photo --}}
                                    @if ($donar->profile_photo_path != null)
                                    <img src="{{ Storage::url('images/avatars/'.$donar->profile_photo_path) }}" width="70" height="70" class="rounded-circle" alt="{{ $donar->name }}">
                                    @else
                                    <img src="{{ asset('images/avator.png') }}" width="70" height="70" class="rounded-circle" alt="{{ $donar->name }}">
                                    @endif

                                    {{-- user activity status --}}
                                    @if(Cache::has('user-is-online-'.$donar->id))
                                    <span style="right: auto; left:57px; width: 10px; position: absolute; height: 10px; background-color: #00ff3a; border-radius: 50%; box-shadow: #022d17 0 -1px 7px 1px, inset #12ff66 0 -1px 9px, #000 0 2px 12px;"></span>
                                    @else
                                    <span style="right: auto; left:57px; width: 10px; position: absolute; height: 10px; background-color: #232523; border-radius: 50%; box-shadow: #ffffff 0 -1px 7px 1px, inset #b7c7bd 0 -1px 9px, #634747 0 2px 12px;"></span>
                                    @endif

                                    {{-- user information --}}
                                    <div class="d-flex flex-column ml-2">
                                        <h5 class="mb-0"><a class="text-capitalize">{{ $donar->name }}</a></h5>
                                        <span class="text-gray text-capitalize">{{ $donar->bloodGroup->full_name }} </span>
                                        <small class="text-black-50"><i class="fa fa-map-marker text-danger"></i> {{ $donar->profile->present_address }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                            <div wire:loading>
                                Loading...
                            </div>

                          </div>

                          <!--/.direct-chat-messages-->

                          <!-- /.direct-chat-pane -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          <form action="#" method="post">
                            <div class="input-group">
                              <input type="text" wire:model="search" placeholder="Search blood Donar ..." class="form-control">
                            </div>
                          </form>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>

                <div class="col-md-8 mt-2">
                    @if($to_id)
                    @livewire('chat.chat-box', ['id' => $to_id], key($to_id))
                    @endif
                </div>
            </div>
        </div>
    </div>




    </div>
