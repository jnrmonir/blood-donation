<div>

    @section('title')
    Notifications of {{ Auth::user()->name }}
    @endsection

    @section('description')
    notifications {{ Auth::user()->name }}
    @endsection

    @section('keywords')
    notifications {{ Auth::user()->name }}
    @endsection

<!-- Content Header (Page header) -->
<div class="content-header bg-white shadow-sm">
    <div class="container clearfix">
        <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">All Notifications</h1>
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            {{-- <li class="breadcrumb-item"><a href="{{ route('profile') }}"><i class="fa fa-dashboard"></i> Home</a></li> --}}
            <li class="breadcrumb-item active">Notifications</li>
          </ol>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


    <div class="content mt-2">
        <div class="container">
            <div class="card rounded-0 mb-0 pb-0">
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="mailbox-controls">
                    <div class="btn-group">
                      <button wire:click="deleted" type="button" class="btn btn-default rounded-0"><i class="far fa-trash-alt"></i></button>
                      <button wire:click="$refresh" type="button" class="btn btn-default rounded-0"><i class="fas fa-sync-alt"></i></button>
                    </div>
                    <!-- /.btn-group -->

                    <div class="float-right">
                      {{ $notifications->links() }}
                      <!-- /.btn-group -->
                    </div>
                    <!-- /.float-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">

                    <table class="table table-hover" wire:loading.remove >
                      <tbody>
                      @foreach ($notifications as $notification)
                      <tr class="@if($notification->status == 0) bg-light @endif">
                        <td>
                          <div class="icheck-primary">
                            <input type="checkbox" wire:model="checked" value="{{ $notification->id }}" id="check1">
                            <label for="check1"></label>
                          </div>

                        </td>
                        <td class="mailbox-name">
                            <a wire:click="submit({{ $notification->id }})" href="@if($notification->blood_request_id > 0) {{ route('single_requested_blood',$notification->bloodRequest->slug) }} @endif" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i>
                                @if($notification->notification_type == 1)
                                    <small><b>New BLood Request For You </b></small>
                                    @elseif($notification->notification_type == 2)
                                    <small><b> New Donar Donate Blood For You</b></small>
                                @else
                                    <small><b> Blood Donate Request Agreement</b></small>
                                @endif
                            </a>
                        </td>
                        <td class="mailbox-subject">
                             <small class="ml-3 d-block">{{ $notification->notification }}</small>
                        </td>

                        <td class="mailbox-date">
                            <span class="float-right text-muted text-sm">{{ $notification->updated_at->diffForHumans() }}</span>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
                    <!-- /.table -->

                  </div>
                  <!-- /.mail-box-messages -->


                </div>
                <!-- /.card-body -->
            </div>

            <div wire:loading>
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
        </div><!-- /.container -->
    </div>
    <!-- /.content -->

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
