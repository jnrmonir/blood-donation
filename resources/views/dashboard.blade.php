@extends('layouts.app')
@section('title')
   Profile
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header bg-white shadow-sm mb-2">
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto text-center">

                <h1 class="text-info text-capitalize" style="font-size: 20px">Profile</h1>

            </div><!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-maroon rounded-0">
                  <div class="inner">
                    <h3>{{ $total_blood_requests->total() }}</h3>

                    <p>Total Blood Request</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-cog "></i>
                  </div>
                  <a href="{{ route('auth.requested_blood',$user->slug) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-teal rounded-0">
                  <div class="inner">
                    <h3>{{  $total_blood_donations->count() }}</h3>

                    <p>Total Blood Donation</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-hand-holding-medical"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info rounded-0">
                  <div class="inner">
                    <h3> {{ $total_blood_donate_requests->count() }}</h3>

                    <p>Total Blood donate Request</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-medkit"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger rounded-0">
                  <div class="inner">
                    <h3> {{ $total_blood_donate_agreements->count() }}</h3>

                    <p>Total Blood donate agreement</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-check-square"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card rounded-0">
                    <div class="card-header">
                      <h3 class="card-title">People Blood Request To You</h3>

                      <div class="card-tools">
                        <span class="badge badge-danger">{{ $peopleRequestedBloods->total() }} Blood Request</span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <ul class="users-list clearfix">
                          @foreach ($peopleRequestedBloods as $peopleRequestedBlood)
                          <li>

                            @if ($peopleRequestedBlood->fromUser->profile_photo_path != null)
                                <img src="{{ Storage::url('images/avatars/'.$peopleRequestedBlood->fromUser->profile_photo_path) }}" alt="{{ $peopleRequestedBlood->fromUser->name }}" class="img-circle position-relative" style="height: 80px">
                            @else
                            <img src="{{ asset('images/avator.png') }}" alt="{{ $peopleRequestedBlood->fromUser->name }}" class="img-circle  position-relative " style="height: 80px;">
                            @endif


                            <a class="users-list-name" href="#">{{ $peopleRequestedBlood->fromUser->name }}</a>
                            <span class="users-list-date">{{ $peopleRequestedBlood->updated_at->diffForHumans() }}</span>
                          </li>
                          @endforeach
                      </ul>
                      <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                      <a href="{{ route('auth.people_requested_blood_to_you',$user->slug) }}">View All</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card rounded-0">
                    <div class="card-header">
                      <h3 class="card-title">Your Blood Request</h3>

                      <div class="card-tools">
                        <span class="badge badge-danger">{{ $total_blood_requests->total() }} Blood Request</span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                              <thead>
                              <tr>
                                <th>Need Blood</th>
                                <th>Need Bag</th>
                                <th>Donar count</th>
                                <th>Requested On</th>
                              </tr>
                              </thead>
                              <tbody>
                                  @foreach ($total_blood_requests as $total_blood_request)
                                  <tr>
                                    <td><a href="{{ route('single_requested_blood',$total_blood_request->slug) }}">{{ $total_blood_request->bloodGroup->full_name }}</a></td>
                                    <td>{{ $total_blood_request->blood_need_bag }}</td>
                                    <td><span class="text-success">{{ $total_blood_request->bloodRequestAgreement()->count() }}</span></td>
                                    <td>
                                      <div class="sparkbar">{{ $total_blood_request->updated_at->diffForHumans() }}</div>
                                    </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                            </table>
                          </div>
                      <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                      <a href="{{ route('auth.requested_blood',$user->slug) }}">View All</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
