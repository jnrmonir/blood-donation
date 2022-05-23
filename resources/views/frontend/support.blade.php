@extends('layouts.app')
@section('title')
    Support Us
@endsection

@section('description')
support us
@endsection

@section('keywords')
support us
@endsection


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header bg-white shadow-sm">
        <div class="container clearfix">
            <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">Support Us</h1>
              <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active">Support Us</li>
              </ol>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
    <div class="content mt-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mx-auto mt-2 ">
                    <div class="card rounded-0">
                        <div class="card-body ">

                            <div class="row mb-3">
                                <div class="col-4">
                                    <ul class="mb-0 mt-2 ml-0 list-unstyled">
                                        <li><a href="#"><img class="rounded mx-auto d-block" src="{{ asset('images/rocket.png') }}" alt="support" style="height: 80px;"></a></li>
                                        <li><a href="#"><h5 class="text-center">Getting Started</h5></a></li>
                                        <li><p class="text-center">articles to get you up and running quick and easy.</p></li>
                                    </ul>
                                </div>

                                <div class="col-4">
                                    <ul class="mb-0 mt-2 ml-0 list-unstyled">
                                        <li><a href="#"><img class="rounded mx-auto d-block" src="{{ asset('images/account.png') }}" alt="support" style="height: 80px;"></a></li>
                                        <li><a href="#"><h5 class="text-center">My Account</h5></a></li>
                                        <li><p class="text-center">How to manage your account it's features.</p></li>
                                    </ul>
                                </div>

                                <div class="col-4">
                                    <ul class="mb-0 mt-2 ml-0 list-unstyled">
                                        <li><a href="#"><img class="rounded mx-auto d-block" src="{{ asset('images/copyright.jpg') }}" alt="support" style="height: 80px;"></a></li>
                                        <li><a href="#"><h5 class="text-center">Copyright & Legal</h5></a></li>
                                        <li><p class="text-center">Important information about how we handle your privacy and data.</p></li>
                                    </ul>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <ul class="mb-0 mt-2 ml-0 list-unstyled">
                                        <li><a href="#"><img class="rounded mx-auto d-block" src="{{ asset('images/developers.jpg') }}" alt="support" style="height: 80px;"></a></li>
                                        <li><a href="#"><h5 class="text-center">Developers</h5></a></li>
                                        <li><p class="text-center">Developers documentation and integration features.</p></li>
                                    </ul>
                                </div>

                                <div class="col-4">
                                    <ul class="mb-0 mt-2 ml-0 list-unstyled">
                                        <li><a href="#"><img class="rounded mx-auto d-block" src="{{ asset('images/share.png') }}" alt="support" style="height: 80px;"></a></li>
                                        <li><a href="#"><h5 class="text-center">Present & Share</h5></a></li>
                                        <li><p class="text-center">Share your masterpiece with the world.</p></li>
                                    </ul>
                                </div>

                                <div class="col-4">
                                    <ul class="mb-0 mt-2 ml-0 list-unstyled">
                                        <li><a href="#"><img class="rounded mx-auto d-block" src="{{ asset('images/app.png') }}" alt="support" style="height: 80px;"></a></li>
                                        <li><a href="#"><h5 class="text-center">Mobile App</h5></a></li>
                                        <li><p class="text-center">Documentation and truobleshooting our mobile app.</p></li>
                                    </ul>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
