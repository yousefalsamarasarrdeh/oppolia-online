<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{route('welcome')}}" class="logo d-flex align-items-center">
            <img src="{{url('Dashboard/assets/images/logo.png')}}" alt="">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">{{ $notifications->count() }}</span>
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have {{ $notifications->count() }} new notifications
                        <a href="{{route('designer.notification')}}"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li><hr class="dropdown-divider"></li>

                    @foreach ($notifications as $notification)
                        <li class="notification-item">
                            <a href="{{ route('designer.order.show', ['order' => $notification->data['order_id'], 'notificationId' => $notification->id]) }}">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                                <div>
                                    <h4>{{ $notification->data['message'] }}</h4>
                                    <p>Order ID: {{ $notification->data['order_id'] }}</p>
                                    <p>{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    @endforeach

                    <li class="dropdown-footer">

                    </li>
                </ul><!-- End Notification Dropdown Items -->
            </li><!-- End Notification Nav -->


            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">



                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>تسجيل الخروج</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
