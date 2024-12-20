<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('Dashboard/assets/img/logo.png')}}" rel="icon">
  <link href="{{asset('Dashboard/assets/img/logo.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('Dashboard/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('Dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('Dashboard/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('Dashboard/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('Dashboard/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('Dashboard/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('Dashboard/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('Dashboard/assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    @yield('css')
</head>

<body>

  <!-- ======= Header ======= -->
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
                      <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
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
                      <a href="{{route('designer.notification')}}">Show all notifications</a>
                  </li>
              </ul><!-- End Notification Dropdown Items -->
          </li><!-- End Notification Nav -->


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

              <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

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

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link " href="index.html">
                  <i class="bi bi-grid"></i>
                  <span>لوحة التحكم</span>
              </a>
          </li><!-- End Dashboard Nav -->



          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-journal-text"></i><span>الطلبات</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{route('designer.approved.orders')}}">
                          <i class="bi bi-circle"></i><span>الطلبات التي قبلتها</span>
                      </a>
                  </li>

              </ul>
          </li><!-- End Forms Nav -->


      </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">



      @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">

    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->

    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('Dashboard/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('Dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('Dashboard/assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('Dashboard/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('Dashboard/assets/vendor/quill/quill.js')}}"></script>


  <!-- Template Main JS File -->
    <script src="{{asset('Dashboard/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('Dashboard/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('Dashboard/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('Dashboard/assets/js/main.js')}}"></script>

  @yield('script')
</body>

</html>
