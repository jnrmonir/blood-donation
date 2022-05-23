<nav class="main-header navbar navbar-expand-md navbar-dark  border-bottom-0">
    <div class="container-fluid">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('frontend') }}/assets/img/AdminLTELogo.png" alt="Blood Bank Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <!-- <span class="brand-text font-weight-light"></span> -->
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                @auth
                <li class="nav-item">
                    <h5 class="mb-0"><a href="{{ route('profile') }}" class="nav-link custom-link @if(Request::is('profile') || Request::is('home')) custom-link-active @endif">Profile</a></h5>
                </li>

                @endauth
                @guest
                <li class="nav-item">
                    <h5 class="mb-0"><a href="{{ route('home') }}" class="nav-link custom-link @if(Request::is('/')) custom-link-active @endif">Home</a></h5>
                </li>
                @endguest
                <li class="nav-item">
                    <h5 class="mb-0"><a href="{{ route('request_for_blood') }}" class="nav-link custom-link  @if(Request::is('request-for-blood')) custom-link-active @endif">Request For Blood</a></h5>
                </li>
                <li class="nav-item">
                    <h5 class="mb-0"><a href="{{ route('requested_blood') }}" class="nav-link custom-link @if(Request::is('requested-bloods')) custom-link-active @endif">Requested Blood</a></h5>
                </li>
                <li class="nav-item">
                    <h5 class="mb-0"><a href="{{ route('blood_donar') }}" class="nav-link custom-link @if(Request::is('blood-donars')) custom-link-active @endif">Blood Donar</a></h5>
                </li>
                <li class="nav-item">
                    <h5 class="mb-0"><a href="{{ route('blog') }}" class="nav-link custom-link @if(Request::is('blog')) custom-link-active @endif">Blog</a></h5>
                </li>
            </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        @auth
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comment"></i>
                    <span class="badge badge-warning navbar-badge">{{ $user_messages->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                    <span class="dropdown-header">{{ $user_messages->count() }} New Message</span>
                    <div class="dropdown-divider"></div>
                    @foreach ($user_messages as $user_message)
                        <div class="">
                        <a href="{{ route('chat',$user_message->fromUser->slug) }}" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i>
                            <small><b>{{ $user_message->fromUser->name }}</b></small>
                            <span class="float-right text-muted text-sm">{{ $user_message->updated_at->diffForHumans() }}</span>
                            <small class="ml-3 d-block">{{ $user_message->body }}</small>

                        </a>
                        </div>
                        <div class="dropdown-divider"></div>
                    @endforeach
                     @if($user_messages->count() > 0)
                        <a href="{{ route('chat') }}" class="dropdown-item dropdown-footer">See All Messages</a>
                     @endif
                </div>
            </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">{{ $user_notifications->total() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                        <span class="dropdown-header">{{ $user_notifications->total() }} New Notifications</span>
                        <div class="dropdown-divider"></div>
                        @foreach ($user_notifications as $user_notification)
                            <div class="@if($user_notification->status == 0) bg-light @endif">
                            <a href="@if($user_notification->blood_request_id > 0) {{ route('single_requested_blood',$user_notification->bloodRequest->slug) }} @endif" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i>
                                @if($user_notification->notification_type == 1)
                                  <small><b>New BLood Request For You </b></small>
                                  @elseif($user_notification->notification_type == 2)
                                  <small><b> New Donar Donate Blood For You</b></small>
                                @else
                                  <small><b> Blood Donate Request Agreement</b></small>
                                @endif
                                <span class="float-right text-muted text-sm">{{ $user_notification->updated_at->diffForHumans() }}</span>

                            </a>
                            <small class="ml-3 d-block">{{ $user_notification->notification }}</small>
                            </div>
                            <div class="dropdown-divider"></div>
                        @endforeach
                         @if($user_notifications->total() > 0)
                            <a href="{{ route('auth.notifications',Auth::user()->slug) }}" class="dropdown-item dropdown-footer">See All Notifications</a>
                         @endif
                    </div>
                </li>
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-user-alt"></i>

                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                @if (Auth::user()->profile_photo_path != null)
                                <img src="{{ Storage::url('images/avatars/'.Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="img-size-50 mr-3 img-circle">
                                @endif
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{ Auth::user()->name }}

                                    </h3>
                                    <p class="text-sm">Manage  Your Profile</p>

                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile.show') }}" class="dropdown-item">
                            <i class="fa fa-cog mr-2"></i> Settings
                        </a>

                        <div class="dropdown-divider"></div>
                        <a href="{{ route('auth.requested_blood',Auth::user()->slug) }}" class="dropdown-item">
                            <i class="fa fa-medkit mr-2"></i>Your Requested Blood
                        </a>
                        <div class="dropdown-divider"></div>

                        <a href="{{ route('auth.people_requested_blood_to_you',Auth::user()->slug) }}" class="dropdown-item">
                            <i class="fa fa-hand-holding-medical mr-2"></i>People Requested Blood To You
                        </a>

                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                <i class="fa fa-power-off mr-2"></i>
                                {{ __('Logout') }}

                            </a>
                        </form>
                    </div>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <h5 class="d-flex">
                        <a class="nav-link custom-link" href="{{ route('login') }}">

                            Login
                        </a>
                        <a class="nav-link custom-link" href="{{ route('register') }}">

                            Register
                        </a>
                    </h5>
                </li>
            @endguest
        </ul>
    </div>
</nav>
