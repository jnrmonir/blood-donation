<div>

    @section('title')
    {{ Auth::user()->name }} show people requested blood to you
    @endsection

    @section('description')
    {{ Auth::user()->name }} show people requested blood to you
    @endsection

    @section('keywords')
    {{ Auth::user()->name }} show people requested blood to you
    @endsection

    <!-- Content Header (Page header) -->
    <div class="content-header bg-white shadow-sm">
        <div class="container clearfix">
            <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">People Requested Blood To You</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active">People Requested Blood To You</li>
            </ol>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container">
            <div class="card">
                <div class="row">
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
                </div>
                <div class="row">

                        <div class="col-12 text-center" wire:loading>
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
        </div><!-- /.container -->
    </div>
    <!-- /.content -->

</div>

