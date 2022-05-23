<div>
    @section('title')
    Admin Dashboard
    @endsection
    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h4 class="m-0 text-dark">Welcome Our Admin Panel {{ Auth::user()->name }}</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item ">Dashboard</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>

        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-4 col-xl-3 col-6">
              <!-- small box -->
              <div class="small-box bg-teal">
                <div class="inner">
                  <h3>{{ $total_users }}</h3>

                  <p>Total Users</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('admin.all_users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xl-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $total_donars }}</h3>

                  <p>Total Blood Donar</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-alt"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xl-3 col-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3>{{ $total_blood_requests }}</h3>

                  <p>Total Blood Requests</p>
                </div>
                <div class="icon">
                  <i class="fas fa-hand-holding-medical"></i>
                </div>
                <a href="{{ route('admin.all_requested_blood') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xl-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $total_posts }}</h3>

                  <p>Total Posts</p>
                </div>
                <div class="icon">
                  <i class="fa fa-book"></i>
                </div>
                <a href="{{ route('admin.all_posts') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-4 col-xl-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{ $total_categories }}</h3>

                    <p>Total Category</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-folder-open"></i>
                  </div>
                  <a href="{{ route('admin.all_category') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-lg-4 col-xl-3 col-6">
                <!-- small box -->
                <div class="small-box bg-olive">
                  <div class="inner">
                    <h3>{{ $total_comments }}</h3>

                    <p>Total Comments</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-comments"></i>
                  </div>
                  <a href="{{ route('admin.all_comments') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-lg-4 col-xl-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{ $total_reports }}</h3>

                    <p>Total Reports</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-file"></i>
                  </div>
                  <a href="{{ route('admin.all_reports') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-lg-4 col-xl-3 col-6">
                <!-- small box -->
                <div class="small-box bg-indigo">
                  <div class="inner">
                    <h3>{{ $total_feedbacks }}</h3>

                    <p>Total Feedbacks</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-reply"></i>
                  </div>
                  <a href="{{ route('admin.all_feedback') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-lg-4 col-xl-3 col-6">
                <!-- small box -->
                <div class="small-box bg-pink">
                  <div class="inner">
                    <h3>{{ $total_countries }}</h3>

                    <p>Total Country</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-flag"></i>
                  </div>
                  <a href="{{ route('admin.all_country') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-lg-4 col-xl-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gray">
                  <div class="inner">
                    <h3>{{ $total_states }}</h3>

                    <p>Total State</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-globe"></i>
                  </div>
                  <a href="{{ route('admin.all_states') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-lg-4 col-xl-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{ $total_cities }}</h3>

                    <p>Total City</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-city"></i>
                  </div>
                  <a href="{{ route('admin.all_city') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-lg-4 col-xl-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{ $total_messages }}</h3>

                    <p>Total Messages</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-city"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
</div>
