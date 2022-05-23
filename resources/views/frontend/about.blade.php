@extends('layouts.app')
@section('title')
    About Us
@endsection

@section('description')
About us blood bank 24
@endsection

@section('keywords')
about us blood bank 24
@endsection

@section('content')

   <!-- Content Header (Page header) -->
   <div class="content-header bg-white shadow-sm">
    <div class="container clearfix">
        <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">About Us</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active">About Us</li>
            </ol>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
    <div class="content mt-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 mx-auto">
                    <div class="card">
                        <div class="card-body ">

                            <div class="card-header border-bottom-0">
                                <h3 class="mb-3">What is this all about?</h3>
                                <p class="lead">Our Project is an innovative approach to address global health. We provide immediate access to blood donors hole world, 24 hours a day, 7 days a week! Our project is one of several community organizations working together as a network that respond to disasters or emergency situations in an efficient manner.</p>
                            </div>

                            <div class="card-header border-bottom-0">
                                <h3 class="mb-3">What we do?</h3>
                                <p class="lead">The ultimate goal of this project is to provide an easy-to-use, easy-to-access, efficient, and reliable way to get life-saving blood, free of cost. It works with network partners to connect blood donors and recipients through an automated SMS (text messaging) service or our mobile application. Our network of volunteer blood donors are ready to help save lives any time, any place.</p>
                            </div>

                            <div class="card-header border-bottom-0">
                                <h3 class="mb-3">How it works?</h3>
                                <p class="lead">Our automated system works efficiently whenever someone needs a blood transfusion. Simply post a blood a request within our system, either on this website. As soon as a new blood request is raised, it is routed among our local volunteer blood donors. We know time matters! So we keep you updated with real-time notifications sent directly to you via SMS (text message). Instead of having to search all over for a blood donor in an emergency situation, you can spend your time consoling the patient. We keep you updated at each step of the request process, from when a volunteer has been found to when blood is on its way.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
