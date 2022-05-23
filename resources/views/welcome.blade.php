@extends('layouts.app')
@section('title')
    Home
@endsection

@section('description')
give blood save life blood bank home
@endsection

@section('keywords')
give blood save life blood bank home
@endsection

@section('content')
<!-- Content Header (Page header) -->
{{-- <div class="content-header bg-white shadow-sm mb-2">
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto text-center">

                <h1 class="text-info text-capitalize mb-0" style="font-size: 20px;">Give Blood , Give Life</h1>

            </div><!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</div> --}}
<!-- /.content-header -->
<div class="card bg-dark text-white">
    <img class="card-img img-fluid" src="{{ asset('images/banner6.jpg') }}" alt="Card image" style="height: 360px;">
    {{-- <div class="card-img-overlay">
        <div class="container">
      <h3 class="">Welcome Our Blood Bank Site</h3>
      <p>
        To give blood you need neither extra strength nor extra food, and you will save a life.” “If you're a blood donor, you're a hero to someone, somewhere, who received your gracious gift of life.” “A bottle of blood saved my life, was it yours.” “Every blood donor is a life saver
      </p>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto distinctio ab obcaecati, laudantium cum sint minima numquam dolore, deleniti iste corrupti suscipit et odio? Molestias architecto error cum dolorem ex.</p>
        </div>
    </div> --}}
</div>



    <!-- Main content -->
    <div class="content">
        <div class="">
            {{-- <livewire:get-blood-group /> --}}

            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="pl-3 text-dark" >
                                {{-- <img class="card-img" src="{{ asset('images/emar.jpg') }}" alt="Card image" style="height: 262px;"> --}}
                                {{-- <div class="card-img-overlay mt-0 pt-0"> --}}
                                  <h1 class="h3 mt-0 pt-0" style="color: #000000">Every blood donor is a life saver</h1>
                                  <p class="card-text lead">
                                    To give blood you need neither extra strength nor extra food, and you will save a life.” “If you're a blood donor, you're a hero to someone, somewhere, who received your gracious gift of life.” “A bottle of blood saved my life, was it yours.” “Every blood donor is a life saver.
                                  </p>

                                {{-- </div> --}}
                              </div>
                        </div>
                        <div class="col-lg-5">
                            <div id="accordion" class="myaccordion">
                                <div class="card p-0 m-0 rounded-0">
                                  <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                      <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        How does a blood bank work?
                                        <span class="fa-stack fa-sm">
                                          <i class="fas fa-circle fa-stack-2x"></i>
                                          <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                        </span>
                                      </button>
                                    </h2>
                                  </div>
                                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi, repellat iure reprehenderit illo porro ut ipsum aliquam mollitia, rem laboriosam ab exercitationem explicabo quam id quae repudiandae quas quod corporis.</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="card m-0 p-0 rounded-0">
                                  <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                      <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        What is meant by blood bank?
                                        <span class="fa-stack fa-2x">
                                          <i class="fas fa-circle fa-stack-2x"></i>
                                          <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                        </span>
                                      </button>
                                    </h2>
                                  </div>
                                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi, repellat iure reprehenderit illo porro ut ipsum aliquam mollitia, rem laboriosam ab exercitationem explicabo quam id quae repudiandae quas quod corporis.</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="card m-0 p-0 rounded-0">
                                  <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                      <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Who should not donate blood?
                                        <span class="fa-stack fa-2x">
                                          <i class="fas fa-circle fa-stack-2x"></i>
                                          <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                        </span>
                                      </button>
                                    </h2>
                                  </div>
                                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi, repellat iure reprehenderit illo porro ut ipsum aliquam mollitia, rem laboriosam ab exercitationem explicabo quam id quae repudiandae quas quod corporis.</p>
                                    </div>
                                  </div>
                                </div>

                                <div class="card m-0 p-0 rounded-0">
                                    <div class="card-header" id="headingFour">
                                      <h2 class="mb-0">
                                        <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                          What is the purest blood?
                                          <span class="fa-stack fa-2x">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                          </span>
                                        </button>
                                      </h2>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                      <div class="card-body">
                                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi, repellat iure reprehenderit illo porro ut ipsum aliquam mollitia, rem laboriosam ab exercitationem explicabo quam id quae repudiandae quas quod corporis.</p>
                                      </div>
                                    </div>
                                </div>

                                <div class="card m-0 p-0 rounded-0">
                                    <div class="card-header" id="headingFive">
                                      <h2 class="mb-0">
                                        <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                         What do blood banks test for?
                                          <span class="fa-stack fa-2x">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                          </span>
                                        </button>
                                      </h2>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                      <div class="card-body">
                                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi, repellat iure reprehenderit illo porro ut ipsum aliquam mollitia, rem laboriosam ab exercitationem explicabo quam id quae repudiandae quas quod corporis.</p>
                                      </div>
                                    </div>
                                </div>

                              </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">

                        @forelse ($posts as $key => $post)

                         <div class="col-lg-6 mb-2">
                            <div class="card rounded-0 hoverable-card h-100 pb-0">
                                <a href="{{ route('single_blog',$post->slug) }}"><div class="hover-zoom text-center" style="background-image: url({{ Storage::url('images/posts/'.$post->thumbnail)  }})">
                                </div></a>
                            <div class="card-body pb-0">
                                <h5 class="card-title mb-0 pb-0"><a href="{{ route('single_blog',$post->slug) }}" class="text-capitalize">{{ $post->title }}</a></h5>

                                {{-- <p class="card-text"><small calss="text-muted">Last updated {{ $post->updated_at->diffForHumans() }}</small></p> --}}
                            </div>
                            </div>
                        </div>

                        @break($key == 1)

                        @empty
                        <div class="col-md-12">
                            <div class="card">
                                <h2 class="text-center text-danger text-capitalize mb-0">Post Does Not Found</h2>
                            </div>
                        </div>

                        @endforelse

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card rounded-0 mb-0 pb-0">
                        <div class="card-header pb-0">
                            <h5 class="mb-0 text-capitalize text-dark">We are the connector with the blood Donor and the patient</h5>
                            <p class="text-gray mt-2 lead"><small>We have upcoming lot of user who will donate the blood and can take blood when they will need. In any circumstance you can collect blood from us. We have a dedicated team to help you.</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <h2 class="font-weight-bold mb-2">Our Team</h2>
            <p class="font-italic text-muted mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>

            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <!-- Card-->
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body p-0"><img src="https://res.cloudinary.com/mhmd/image/upload/v1570799922/profile-1_dewapk.jpg" alt="" class="w-100 card-img-top">
                            <div class="p-4">
                                <h5 class="mb-0">Mizanur Rahman</h5>
                                <p class="small text-muted">CEO - Consultant</p>
                                <ul class="social mb-0 list-inline mt-3">
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-twitter"></i></a></li>
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-instagram"></i></a></li>
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <!-- Card-->
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body p-0"><img src="https://res.cloudinary.com/mhmd/image/upload/v1570799922/profile-3_ybnq8v.jpg" alt="" class="w-100 card-img-top">
                            <div class="p-4">
                                <h5 class="mb-0">Md Shumon</h5>
                                <p class="small text-muted">CEO - Consultant</p>
                                <ul class="social mb-0 list-inline mt-3">
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-twitter"></i></a></li>
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-instagram"></i></a></li>
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <!-- Card-->
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body p-0"><img src="https://res.cloudinary.com/mhmd/image/upload/v1570799924/profile-4_s3fort.jpg" alt="" class="w-100 card-img-top">
                            <div class="p-4">
                                <h5 class="mb-0">Alamin</h5>
                                <p class="small text-muted">CEO - Consultant</p>
                                <ul class="social mb-0 list-inline mt-3">
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-twitter"></i></a></li>
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-instagram"></i></a></li>
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <!-- Card-->
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body p-0"><img src="https://res.cloudinary.com/mhmd/image/upload/v1570799922/profile-2_ujssbj.jpg" alt="" class="w-100 card-img-top">
                            <div class="p-4">
                                <h5 class="mb-0">Md Monir</h5>
                                <p class="small text-muted">CEO - Consultant</p>
                                <ul class="social mb-0 list-inline mt-3">
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-twitter"></i></a></li>
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-instagram"></i></a></li>
                                    <li class="list-inline-item m-0"><a href="#" class="social-link"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="font-weight-bold mb-2">Blog Posts</h2>
            <p class="font-italic text-muted mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>

            <!-- /.row -->
            <div class="row mt-3">
                @forelse ($posts as $post)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="card rounded-0 hoverable-card h-100">
                        <a href="{{ route('single_blog',$post->slug) }}"><div class="hover-zoom text-center" style="background-image: url({{ Storage::url('images/posts/'.$post->thumbnail)  }})">
                        </div></a>
                      <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('single_blog',$post->slug) }}" class="text-capitalize">{{ $post->title }}</a></h5>
                        <p class="card-text">
                           {{ Str::limit($post->content, 80, '...') }}
                        </p>
                        <p class="card-text"><small class="text-muted">Last updated {{ $post->updated_at->diffForHumans() }}</small></p>
                      </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12">
                    <div class="card">
                        <h2 class="text-center text-danger text-capitalize mb-0">Post Does Not Found</h2>
                    </div>
                </div>
                @endforelse

            </div>
            <!-- /.row -->
        </div><!-- /.container -->
    </div>
    <!-- /.content -->


@endsection
