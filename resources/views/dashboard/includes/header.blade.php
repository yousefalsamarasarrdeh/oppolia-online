<header id="header" class="header fixed-top d-flex align-items-center">


    <div class="d-flex align-items-center justify-content-between">
        <a href="mainlayout.blade.php" class="logo d-flex align-items-center">
            <img src="{{url('Dashboard/assets/img/Oppolia-logo-website.png')}}" alt="">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle" href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">{{ isset($notifications) ? $notifications->count() : 0 }}</span>
                </a><!-- End Notification Icon -->

                @if(isset($notifications) && $notifications->count())
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have {{ $notifications->count() }} new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                    @foreach ($notifications as $notification)
                        <!-- تحقق من وجود order_id -->
                            @if(isset($notification->data['order_id']))
                                <li class="notification-item">
                                    <a href="{{ route('admin.order.show', ['order' => $notification->data['order_id'], 'notificationId' => $notification->id]) }}">
                                        <i class="bi bi-exclamation-circle text-warning"></i>
                                        <div>
                                            <h4>{{ $notification->data['message'] }}</h4>
                                            <p>Order ID: {{ $notification->data['order_id'] }}</p>
                                            <p>{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <!-- تحقق من وجود join_as_designer_id -->
                            @elseif(isset($notification->data['join_as_designer_id']))
                                <li class="notification-item">
                                    <a href="{{ route('admin.joinasdesigner.showWhitNotficition', ['joinasdesigner' => $notification->data['join_as_designer_id'], 'notificationId' => $notification->id]) }}">
                                        <i class="bi bi-person-circle text-info"></i>
                                        <div>
                                            <h4>{{ $notification->data['message'] }}</h4>
                                            <p>Designer ID: {{ $notification->data['join_as_designer_id'] }}</p>
                                            <p>{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                        @endforeach

                        <li class="dropdown-footer">
                            <a href="{{ route('admin.notifications.index') }}">Show all notifications</a>
                        </li>
                    </ul><!-- End Notification Dropdown Items -->
                @else
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">

                        <li class="dropdown-footer">
                            <a href="{{ route('admin.notifications.index') }}">Show all notifications</a>
                        </li>
                    </ul>
                @endif
            </li><!-- End Notification Nav -->



            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                </a><!-- End Profile Image Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>

                    <li>

                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
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
