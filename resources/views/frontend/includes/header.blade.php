<div class="header-wrapper  sticky-top navbar-inverse">

    <div class="header-content bg-warning">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-3">
                        <div class="mobile-toggle-menu d-inline d-xl-none" data-bs-toggle="offcanvas"
                             data-bs-target="#offcanvasNavbar">
                            <i class="bx bx-menu"></i>
                        </div>
                        <div class="d-none d-xl-flex my_nav_backgrond1">
                            @if(app()->getLocale() == 'ar')
                                <a href="{{ url('set/lang/en') }}" class="border-3 mx-2 myfont_2">EN</a>
                            @else
                                <a href="{{ url('set/lang/ar') }}" class="border-3 mx-2 myfont_2">AR</a>
                            @endif
                            <a href="register.html" class="border-3 mx-2 myfont_3">@lang('home.Join Us')</a>
                            <?php if(auth()->check()): ?>
                        <!-- إذا كان المستخدم مسجل دخول -->
                            <a href="account-dashboard.html" class="nav-link">
                                <img src="{{asset('Frontend/assets/images/icons/person.png')}}" alt="User Icon" class="img-fluid" >
                            </a>
                            <?php else: ?>
                        <!-- إذا لم يكن المستخدم مسجل دخول -->
                            <a href="#" class="border-3 mx-2 myfont_3" data-bs-toggle="modal" data-bs-target="#phoneModal">
                                @lang('home.Login')
                            </a>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>



                <div class="col-12 col-xl order-4 order-xl-0">
                    <div class="d-none d-lg-flex justify-content-center pb-3 pb-xl-0"  style="direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                        <a href="{{ route('welcome') }}"
                           class="myfont_1 border-3 mx-2 {{ Route::currentRouteName() == 'welcome' ? 'myfont_2' : '' }}">
                            @lang('home.Home')
                        </a>
                        <a href="{{ route('home.about') }}" class="myfont_1  border-3 mx-2">@lang('home.About')</a>
                        <a href="shop.html" class="myfont_1  border-3 mx-2">@lang('home.Product')</a>
                        <a href="services.html" class="myfont_1  border-3 mx-2">@lang('home.Designers')</a>
                        <a href="{{ route('home.contact') }}" class="myfont_1  border-3 mx-2">@lang('home.Contact')</a>

                    </div>
                </div>

                <div class="col-auto ms-auto">
                    <div class="top-cart-icons">
                        <nav class="navbar navbar-expand">
                            <ul class="navbar-nav padding-10">
                                <img src="{{asset('Frontend/assets/images/icons/AR Logo.png')}}">


                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="primary-menu d-sm-none">
        <nav class="navbar navbar-expand-xl w-100 navbar-dark container mb-0 p-0">
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <div class="offcanvas-logo"><img src="assets/images/logo-icon.png" width="100" alt="">
                    </div>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body primary-menu">
                    <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="tv-shows.html"
                               data-bs-toggle="dropdown">
                                Categories
                            </a>
                            <div class="dropdown-menu dropdown-large-menu">
                                <div class="row">
                                    <div class="col-12 col-xl-4">
                                        <h6 class="large-menu-title">Fashion</h6>
                                        <ul class="list-unstyled">
                                            <li><a href="javascript:;">Casual T-Shirts</a>
                                            </li>
                                            <li><a href="javascript:;">Formal Shirts</a>
                                            </li>
                                            <li><a href="javascript:;">Jackets</a>
                                            </li>
                                            <li><a href="javascript:;">Jeans</a>
                                            </li>
                                            <li><a href="javascript:;">Dresses</a>
                                            </li>
                                            <li><a href="javascript:;">Sneakers</a>
                                            </li>
                                            <li><a href="javascript:;">Belts</a>
                                            </li>
                                            <li><a href="javascript:;">Sports Shoes</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end col-3 -->
                                    <div class="col-12 col-xl-4">
                                        <h6 class="large-menu-title">Electronics</h6>
                                        <ul class="list-unstyled">
                                            <li><a href="javascript:;">Mobiles</a>
                                            </li>
                                            <li><a href="javascript:;">Laptops</a>
                                            </li>
                                            <li><a href="javascript:;">Macbook</a>
                                            </li>
                                            <li><a href="javascript:;">Televisions</a>
                                            </li>
                                            <li><a href="javascript:;">Lighting</a>
                                            </li>
                                            <li><a href="javascript:;">Smart Watch</a>
                                            </li>
                                            <li><a href="javascript:;">Galaxy Phones</a>
                                            </li>
                                            <li><a href="javascript:;">PC Monitors</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end col-3 -->
                                    <div class="col-12 col-xl-4 d-none d-xl-block">
                                        <div class="pramotion-banner1">
                                            <img src="assets/images/gallery/menu-img.jpg" class="img-fluid" alt="" />
                                        </div>
                                    </div>
                                    <!-- end col-3 -->
                                </div>
                                <!-- end row -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                Shop <i class='bx bx-chevron-down ms-1'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item dropdown"><a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret" href="#">Shop Layouts <i class='bx bx-chevron-right float-end'></i></a>
                                    <ul class="submenu dropdown-menu">
                                        <li><a class="dropdown-item" href="shop-grid-left-sidebar.html">Shop Grid - Left Sidebar</a>
                                        </li>
                                        <li><a class="dropdown-item" href="shop-grid-right-sidebar.html">Shop Grid - Right Sidebar</a>
                                        </li>
                                        <li><a class="dropdown-item" href="shop-list-left-sidebar.html">Shop List - Left Sidebar</a>
                                        </li>
                                        <li><a class="dropdown-item" href="shop-list-right-sidebar.html">Shop List - Right Sidebar</a>
                                        </li>
                                        <li><a class="dropdown-item" href="shop-grid-filter-on-top.html">Shop Grid - Top Filter</a>
                                        </li>
                                        <li><a class="dropdown-item" href="shop-list-filter-on-top.html">Shop List - Top Filter</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="product-details.html">Product Details</a>
                                </li>
                                <li><a class="dropdown-item" href="shop-cart.html">Shop Cart</a>
                                </li>
                                <li><a class="dropdown-item" href="shop-categories.html">Shop Categories</a>
                                </li>
                                <li><a class="dropdown-item" href="checkout-details.html">Billing Details</a>
                                </li>
                                <li><a class="dropdown-item" href="checkout-shipping.html">Checkout Shipping</a>
                                </li>
                                <li><a class="dropdown-item" href="checkout-payment.html">Payment Method</a>
                                </li>
                                <li><a class="dropdown-item" href="checkout-review.html">Order Review</a>
                                </li>
                                <li><a class="dropdown-item" href="checkout-complete.html">Checkout Complete</a>
                                </li>
                                <li><a class="dropdown-item" href="order-tracking.html">Order Tracking</a>
                                </li>
                                <li><a class="dropdown-item" href="product-comparison.html">Product Comparison</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="about-us.html">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact-us.html">Contact</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="shop-categories.html">Our Store</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                Account
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="account-dashboard.html">Dashboard</a>
                                </li>
                                <li><a class="dropdown-item" href="account-downloads.html">Downloads</a>
                                </li>
                                <li><a class="dropdown-item" href="account-orders.html">My Orders</a>
                                </li>
                                <li><a class="dropdown-item" href="account-user-details.html">User Details</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="authentication-login.html">Login</a></li>
                                <li><a class="dropdown-item" href="authentication-register.html">Register</a></li>
                                <li><a class="dropdown-item" href="authentication-reset-password.html">Password</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                Blog
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="blog-post.html">Blog Post</a></li>
                                <li><a class="dropdown-item" href="blog-read.html">Blog Read</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
