@extends('layouts.app')
@section('title')
    privacy & policy
@endsection

@section('description')
 privacy and policy
@endsection

@section('keywords')
privacy and policy
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header bg-white shadow-sm">
    <div class="container clearfix">
        <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">Privacy and Policy</h1>
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">Privacy and policy</li>
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

                            <div>
                                <h3 class="mb-3">Your Privacy</h3>
                                <p class="mb-3 lead">Please read Privacy Policy</p>

                                <h3 class="mb-3">Reservation of Rights</h3>
                                <p class="mb-3 lead">We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>

                                <h3 class="mb-3">Removal of links from our website</h3>
                                <p class="mb-3 lead">If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>
                                <p class="mb-3 lead">We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>

                                <h3 class="mb-3">Disclaimer</h3>
                                <p class="mb-3 lead">To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>
                                <ul class="mb-3 lead">
                                    <li>limit or exclude our or your liability for death or personal injury;</li>
                                    <li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
                                    <li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
                                    <li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
                                    <p class="mb-3 lead">The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>
                                    <p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>
                                </ul>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
