<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="assets/plugins/OwlCarousel/css/owl.carousel.min.css" rel="stylesheet" />

    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>@yield('title')</title>>
</head>

<body>
<!--wrapper-->
<div class="wrapper">
    <!--start top header wrapper-->
    <div class="header-wrapper">
        <div class="top-menu">
            <div class="container">
                <nav class="navbar navbar-expand">
                    <div class="shiping-title d-none d-sm-flex">Welcome to our Shopingo store!</div>
                    <ul class="navbar-nav ms-auto d-none d-lg-flex">
                        <li class="nav-item"><a class="nav-link" href="order-tracking.html">Track Order</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="about-us.html">About</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="shop-categories.html">Our Stores</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="blog-post.html">Blog</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="contact-us.html">Contact</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="javascript:;">Help & FAQs</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">USD</a>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="#">USD</a>
                                </li>
                                <li><a class="dropdown-item" href="#">EUR</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                <div class="lang d-flex gap-1">
                                    <div><i class="flag-icon flag-icon-um"></i>
                                    </div>
                                    <div><span>ENG</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg-end">
                                <a class="dropdown-item d-flex allign-items-center" href="javascript:;"> <i class="flag-icon flag-icon-de me-2"></i><span>German</span>
                                </a>	<a class="dropdown-item d-flex allign-items-center" href="javascript:;"><i
                                        class="flag-icon flag-icon-fr me-2"></i><span>French</span></a>
                                <a class="dropdown-item d-flex allign-items-center" href="javascript:;"><i
                                        class="flag-icon flag-icon-um me-2"></i><span>English</span></a>
                                <a class="dropdown-item d-flex allign-items-center" href="javascript:;"><i
                                        class="flag-icon flag-icon-in me-2"></i><span>Hindi</span></a>
                                <a class="dropdown-item d-flex allign-items-center" href="javascript:;"><i
                                        class="flag-icon flag-icon-cn me-2"></i><span>Chinese</span></a>
                                <a class="dropdown-item d-flex allign-items-center" href="javascript:;"><i
                                        class="flag-icon flag-icon-ae me-2"></i><span>Arabic</span></a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav social-link ms-lg-2 ms-auto">
                        <li class="nav-item"> <a class="nav-link" href="javascript:;"><i class='bx bxl-facebook'></i></a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="javascript:;"><i class='bx bxl-twitter'></i></a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="javascript:;"><i class='bx bxl-linkedin'></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="header-content bg-warning">
            <div class="container">
                <div class="row align-items-center gx-4">
                    <div class="col-auto">
                        <div class="d-flex align-items-center gap-3">
                            <div class="mobile-toggle-menu d-inline d-xl-none" data-bs-toggle="offcanvas"
                                 data-bs-target="#offcanvasNavbar">
                                <i class="bx bx-menu"></i>
                            </div>
                            <div class="logo">
                                <a href="index.html">
                                    <img src="assets/images/logo-icon.png" class="logo-icon" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl order-4 order-xl-0">
                        <div class="input-group flex-nowrap pb-3 pb-xl-0">
                            <input type="text" class="form-control w-100 border-dark border border-3" placeholder="Search for Products">
                            <button class="btn btn-dark btn-ecomm border-3" type="button">Search</button>
                        </div>
                    </div>
                    <div class="col-auto d-none d-xl-flex">
                        <div class="d-flex align-items-center gap-3">
                            <div class="fs-1 text-content"><i class='bx bx-headphone'></i></div>
                            <div class="">
                                <p class="mb-0 text-content">CALL US NOW</p>
                                <h5 class="mb-0">+011 5827918</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="top-cart-icons">
                            <nav class="navbar navbar-expand">
                                <ul class="navbar-nav">
                                    <li class="nav-item"><a href="account-dashboard.html" class="nav-link cart-link"><i class='bx bx-user'></i></a>
                                    </li>
                                    <li class="nav-item"><a href="wishlist.html" class="nav-link cart-link"><i class='bx bx-heart'></i></a>
                                    </li>
                                    <li class="nav-item dropdown dropdown-large">
                                        <a href="#" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link" data-bs-toggle="dropdown">	<span class="alert-count">8</span>
                                            <i class='bx bx-shopping-bag'></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:;">
                                                <div class="cart-header">
                                                    <p class="cart-header-title mb-0">8 ITEMS</p>
                                                    <p class="cart-header-clear ms-auto mb-0">VIEW CART</p>
                                                </div>
                                            </a>
                                            <div class="cart-list">
                                                <a class="dropdown-item" href="javascript:;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="cart-product-title">Men White T-Shirt</h6>
                                                            <p class="cart-product-price">1 X $29.00</p>
                                                        </div>
                                                        <div class="position-relative">
                                                            <div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
                                                            </div>
                                                            <div class="cart-product">
                                                                <img src="assets/images/products/01.png" class="" alt="product image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item" href="javascript:;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="cart-product-title">Puma Sports Shoes</h6>
                                                            <p class="cart-product-price">1 X $29.00</p>
                                                        </div>
                                                        <div class="position-relative">
                                                            <div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
                                                            </div>
                                                            <div class="cart-product">
                                                                <img src="assets/images/products/05.png" class="" alt="product image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item" href="javascript:;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="cart-product-title">Women Red Sneakers</h6>
                                                            <p class="cart-product-price">1 X $29.00</p>
                                                        </div>
                                                        <div class="position-relative">
                                                            <div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
                                                            </div>
                                                            <div class="cart-product">
                                                                <img src="assets/images/products/17.png" class="" alt="product image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item" href="javascript:;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="cart-product-title">Black Headphone</h6>
                                                            <p class="cart-product-price">1 X $29.00</p>
                                                        </div>
                                                        <div class="position-relative">
                                                            <div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
                                                            </div>
                                                            <div class="cart-product">
                                                                <img src="assets/images/products/10.png" class="" alt="product image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item" href="javascript:;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="cart-product-title">Blue Girl Shoes</h6>
                                                            <p class="cart-product-price">1 X $29.00</p>
                                                        </div>
                                                        <div class="position-relative">
                                                            <div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
                                                            </div>
                                                            <div class="cart-product">
                                                                <img src="assets/images/products/08.png" class="" alt="product image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item" href="javascript:;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="cart-product-title">Men Leather Belt</h6>
                                                            <p class="cart-product-price">1 X $29.00</p>
                                                        </div>
                                                        <div class="position-relative">
                                                            <div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
                                                            </div>
                                                            <div class="cart-product">
                                                                <img src="assets/images/products/18.png" class="" alt="product image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item" href="javascript:;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="cart-product-title">Men Yellow T-Shirt</h6>
                                                            <p class="cart-product-price">1 X $29.00</p>
                                                        </div>
                                                        <div class="position-relative">
                                                            <div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
                                                            </div>
                                                            <div class="cart-product">
                                                                <img src="assets/images/products/04.png" class="" alt="product image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item" href="javascript:;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="cart-product-title">Pool Charir</h6>
                                                            <p class="cart-product-price">1 X $29.00</p>
                                                        </div>
                                                        <div class="position-relative">
                                                            <div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
                                                            </div>
                                                            <div class="cart-product">
                                                                <img src="assets/images/products/16.png" class="" alt="product image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <a href="javascript:;">
                                                <div class="text-center cart-footer d-flex align-items-center">
                                                    <h5 class="mb-0">TOTAL</h5>
                                                    <h5 class="mb-0 ms-auto">$189.00</h5>
                                                </div>
                                            </a>
                                            <div class="d-grid p-3 border-top">	<a href="javascript:;" class="btn btn-dark btn-ecomm">CHECKOUT</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
        <div class="primary-menu">
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
    <!--end top header wrapper-->
    <!--start slider section-->
    <section class="slider-section mb-4">
        <div class="first-slider p-0">

            <div class="banner-slider owl-carousel owl-theme">
                <div class="item">
                    <div class="position-relative">
                        <div class="position-absolute top-50 slider-content translate-middle">
                            <h3 class="h3 fw-bold d-none d-md-block">New Trending</h3>
                            <h1 class="h1 fw-bold">Women Fashion</h1>
                            <p class="fw-bold text-dark d-none d-md-block"><i>Last call for upto 15%</i></p>
                            <div class=""><a class="btn btn-dark btn-ecomm px-4" href="shop-grid.html">Shop Now</a>
                            </div>
                        </div>
                        <a href="javascript:;">
                            <img src="assets/images/banners/01.png" class="img-fluid" alt="...">
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="position-relative">
                        <div class="position-absolute top-50 slider-content translate-middle">
                            <h3 class="h3 fw-bold d-none d-md-block">New Trending</h3>
                            <h1 class="h1 fw-bold">Men Fashion</h1>
                            <p class="fw-bold text-dark d-none d-md-block"><i>Last call for upto 15%</i></p>
                            <div class=""><a class="btn btn-dark btn-ecomm px-4" href="shop-grid.html">Shop Now</a>
                            </div>
                        </div>
                        <a href="javascript:;">
                            <img src="assets/images/banners/02.png" class="img-fluid" alt="...">
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="position-relative">
                        <div class="position-absolute top-50 slider-content translate-middle">
                            <h3 class="h3 fw-bold d-none d-md-block">New Trending</h3>
                            <h1 class="h1 fw-bold">Kids Fashion</h1>
                            <p class="fw-bold text-dark d-none d-md-block"><i>Last call for upto 15%</i></p>
                            <div class=""><a class="btn btn-dark btn-ecomm px-4" href="shop-grid.html">Shop Now</a>
                            </div>
                        </div>
                        <a href="javascript:;">
                            <img src="assets/images/banners/04.png" class="img-fluid" alt="...">
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--end slider section-->
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start information-->
            <section class="py-4">
                <div class="container">

                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <div class="col">
                            <div class="d-flex align-items-center justify-content-center p-3 border">
                                <div class="fs-1 text-content"><i class='bx bx-taxi'></i>
                                </div>
                                <div class="info-box-content ps-3">
                                    <h6 class="mb-0 fw-bold">FREE SHIPPING &amp; RETURN</h6>
                                    <p class="mb-0">Free shipping on all orders over $49</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-flex align-items-center justify-content-center p-3 border">
                                <div class="fs-1 text-content"><i class='bx bx-dollar-circle'></i>
                                </div>
                                <div class="info-box-content ps-3">
                                    <h6 class="mb-0 fw-bold">MONEY BACK GUARANTEE</h6>
                                    <p class="mb-0">100% money back guarantee</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex align-items-center justify-content-center p-3 border">
                                <div class="fs-1 text-content"><i class='bx bx-support'></i>
                                </div>
                                <div class="info-box-content ps-3">
                                    <h6 class="mb-0 fw-bold">ONLINE SUPPORT 24/7</h6>
                                    <p class="mb-0">Awesome Support for 24/7 Days</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </section>
            <!--end information-->
            <!--start pramotion-->
            <section class="py-4">
                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-4">
                        <div class="col">
                            <div class="card rounded-0 shadow-none bg-info bg-opacity-25">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <img src="assets/images/promo/01.png" class="img-fluid" alt="" />
                                    </div>
                                    <div class="col">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase fw-bold">Men Wear</h5>
                                            <p class="card-text text-uppercase">Starting at $9</p>
                                            <a href="javascript:;" class="btn btn-outline-dark btn-ecomm">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-0 shadow-none bg-danger bg-opacity-25">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <img src="assets/images/promo/02.png" class="img-fluid" alt="" />
                                    </div>
                                    <div class="col">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase fw-bold">Women Wear</h5>
                                            <p class="card-text text-uppercase">Starting at $9</p>	<a href="javascript:;" class="btn btn-outline-dark btn-ecomm">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-0 shadow-none bg-warning bg-opacity-25">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <img src="assets/images/promo/03.png" class="img-fluid" alt="" />
                                    </div>
                                    <div class="col">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase fw-bold">Kids Wear</h5>
                                            <p class="card-text text-uppercase">Starting at $9</p><a href="javascript:;" class="btn btn-outline-dark btn-ecomm">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </section>
            <!--end pramotion-->
            <!--start Featured product-->
            <section class="py-4">
                <div class="container">
                    <div class="separator pb-4">
                        <div class="line"></div>
                        <h5 class="mb-0 fw-bold separator-title">FEATURED PRODUCTS</h5>
                        <div class="line"></div>
                    </div>
                    <div class="product-grid">
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-3 g-sm-4">
                            <div class="col">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/01.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/02.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/03.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/04.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/05.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/06.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/07.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/08.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/09.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/10.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->

                    </div>
                </div>
            </section>
            <!--end Featured product-->
            <!--start New Arrivals-->
            <section class="py-4">
                <div class="container">
                    <div class="separator pb-4">
                        <div class="line"></div>
                        <h5 class="mb-0 fw-bold separator-title">New Arrivals</h5>
                        <div class="line"></div>
                    </div>
                    <div class="product-grid">
                        <div class="new-arrivals owl-carousel owl-theme position-relative">
                            <div class="item">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/11.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/12.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/13.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/14.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/15.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/16.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/17.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="position-relative overflow-hidden">
                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                            <a href="javascript:;"><i class='bx bx-cart-add' ></i></a>
                                        </div>
                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewProduct">Quick View</a>
                                        </div>
                                        <a href="javascript:;">
                                            <img src="assets/images/products/18.png" class="img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">Topwear</p>
                                                <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer rating mt-2">
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                            <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">$59.00</div>
                                            <div class="h6 fw-bold">$48.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end New Arrivals-->
            <!--start Advertise banners-->
            <section class="py-4 bg-dark">
                <div class="container">
                    <div class="add-banner">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-4">
                            <div class="col d-flex">
                                <div class="card rounded-0 w-100 border-0 shadow-none">
                                    <img src="assets/images/promo/04.png" class="img-fluid" alt="...">
                                    <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">-10%</span>
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Sunglasses Sale</h5>
                                        <p class="card-text">See all Sunglasses and get 10% off at all Sunglasses</p> <a href="javascript:;" class="btn btn-dark btn-ecomm">SHOP BY GLASSES</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col d-flex">
                                <div class="card rounded-0 w-100 border-0 shadow-none">
                                    <img src="assets/images/promo/08.png" class="img-fluid" alt="...">
                                    <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">-80%</span>
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Cosmetics Sales</h5>
                                        <p class="card-text">Buy Cosmetics products and get 30% off at all Cosmetics</p> <a href="javascript:;" class="btn btn-dark btn-ecomm">SHOP BY COSMETICS</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col d-flex">
                                <div class="card rounded-0 w-100 border-0 shadow-none">
                                    <img src="assets/images/promo/06.png" class="img-fluid h-100" alt="...">
                                    <div class="card-img-overlay text-center top-20">
                                        <div class="border border-white border-2 py-3 bg-dark-3">
                                            <h5 class="card-title text-white">Fashion Summer Sale</h5>
                                            <p class="card-text text-uppercase fs-1 lh-1 mt-3 mb-2 text-white">Up to 80% off</p>
                                            <p class="card-text fs-5 text-white">On Top Fashion Brands</p>	<a href="javascript:;" class="btn btn-white btn-ecomm">SHOP BY FASHION</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col d-flex">
                                <div class="card rounded-0 w-100 border-0 shadow-none">
                                    <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">-50%</span>
                                    </div>
                                    <img src="assets/images/promo/07.png" class="img-fluid" alt="...">
                                    <div class="card-body text-center">
                                        <h5 class="card-title fs-2 fw-bold text-uppercase">Super Sale</h5>
                                        <p class="card-text text-uppercase fs-5 lh-1 mb-2">Up to 50% off</p>
                                        <p class="card-text">On All Electronic</p> <a href="javascript:;" class="btn btn-dark btn-ecomm">HURRY UP!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </section>
            <!--end Advertise banners-->
            <!--start categories-->
            <section class="py-4">
                <div class="container">
                    <div class="separator pb-4">
                        <div class="line"></div>
                        <h5 class="mb-0 fw-bold separator-title">Browse Catergory</h5>
                        <div class="line"></div>
                    </div>

                    <div class="product-grid">
                        <div class="browse-category owl-carousel owl-theme">
                            <div class="item">
                                <div class="card rounded-0">
                                    <div class="card-body p-0">
                                        <img src="assets/images/categories/01.png" class="img-fluid" alt="...">
                                    </div>
                                    <div class="card-footer text-center bg-transparent border">
                                        <h6 class="mb-0 text-uppercase fw-bold">Fashion</h6>
                                        <p class="mb-0 font-12 text-uppercase">10 Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0">
                                    <div class="card-body p-0">
                                        <img src="assets/images/categories/02.png" class="img-fluid" alt="...">
                                    </div>
                                    <div class="card-footer text-center bg-transparent border">
                                        <h6 class="mb-1 text-uppercase fw-bold">Watches</h6>
                                        <p class="mb-0 font-12 text-uppercase">8 Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0">
                                    <div class="card-body p-0">
                                        <img src="assets/images/categories/03.png" class="img-fluid" alt="...">
                                    </div>
                                    <div class="card-footer text-center bg-transparent border">
                                        <h6 class="mb-1 text-uppercase fw-bold">Shoes</h6>
                                        <p class="mb-0 font-12 text-uppercase">14 Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0">
                                    <div class="card-body p-0">
                                        <img src="assets/images/categories/04.png" class="img-fluid" alt="...">
                                    </div>
                                    <div class="card-footer text-center bg-transparent border">
                                        <h6 class="mb-1 text-uppercase fw-bold">Bags</h6>
                                        <p class="mb-0 font-12 text-uppercase">6 Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0">
                                    <div class="card-body p-0">
                                        <img src="assets/images/categories/05.png" class="img-fluid" alt="...">
                                    </div>
                                    <div class="card-footer text-center bg-transparent border">
                                        <h6 class="mb-1 text-uppercase fw-bold">Electronis</h6>
                                        <p class="mb-0 font-12 text-uppercase">6 Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0">
                                    <div class="card-body p-0">
                                        <img src="assets/images/categories/06.png" class="img-fluid" alt="...">
                                    </div>
                                    <div class="card-footer text-center bg-transparent border">
                                        <h6 class="mb-1 text-uppercase fw-bold">Headphones</h6>
                                        <p class="mb-0 font-12 text-uppercase">5 Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0">
                                    <div class="card-body p-0">
                                        <img src="assets/images/categories/07.png" class="img-fluid" alt="...">
                                    </div>
                                    <div class="card-footer text-center bg-transparent border">
                                        <h6 class="mb-1 text-uppercase fw-bold">Furniture</h6>
                                        <p class="mb-0 font-12 text-uppercase">20 Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0">
                                    <div class="card-body p-0">
                                        <img src="assets/images/categories/08.png" class="img-fluid" alt="...">
                                    </div>
                                    <div class="card-footer text-center bg-transparent border">
                                        <h6 class="mb-1 text-uppercase fw-bold">Jewelry</h6>
                                        <p class="mb-0 font-12 text-uppercase">16 Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0">
                                    <div class="card-body p-0">
                                        <img src="assets/images/categories/09.png" class="img-fluid" alt="...">
                                    </div>
                                    <div class="card-footer text-center bg-transparent border">
                                        <h6 class="mb-1 text-uppercase fw-bold">Sports</h6>
                                        <p class="mb-0 font-12 text-uppercase">28 Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0">
                                    <div class="card-body p-0">
                                        <img src="assets/images/categories/10.png" class="img-fluid" alt="...">
                                    </div>
                                    <div class="card-footer text-center bg-transparent border">
                                        <h6 class="mb-1 text-uppercase fw-bold">Vegetable</h6>
                                        <p class="mb-0 font-12 text-uppercase">15 Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0">
                                    <div class="card-body p-0">
                                        <img src="assets/images/categories/11.png" class="img-fluid" alt="...">
                                    </div>
                                    <div class="card-footer text-center bg-transparent border">
                                        <h6 class="mb-1 text-uppercase fw-bold">Medical</h6>
                                        <p class="mb-0 font-12 text-uppercase">24 Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0">
                                    <div class="card-body p-0">
                                        <img src="assets/images/categories/12.png" class="img-fluid" alt="...">
                                    </div>
                                    <div class="card-footer text-center bg-transparent border">
                                        <h6 class="mb-1 text-uppercase fw-bold">Sunglasses</h6>
                                        <p class="mb-0 font-12 text-uppercase">18 Products</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end categories-->
            <!--start support info-->
            <section class="py-5 bg-light">
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
                        <div class="col">
                            <div class="text-center border p-3 bg-white">
                                <div class="font-50 text-dark"><i class='bx bx-cart-add' ></i>
                                </div>
                                <h5 class="fs-5 text-uppercase mb-0 fw-bold">Free delivery</h5>
                                <p class="text-capitalize">Free delivery over $199</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center border p-3 bg-white">
                                <div class="font-50 text-dark"><i class='bx bx-credit-card'></i>
                                </div>
                                <h5 class="fs-5 text-uppercase mb-0 fw-bold">Secure payment</h5>
                                <p class="text-capitalize">We possess SSL / Secure сertificate</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center border p-3 bg-white">
                                <div class="font-50 text-dark">	<i class='bx bx-dollar-circle'></i>
                                </div>
                                <h5 class="fs-5 text-uppercase mb-0 fw-bold">Free returns</h5>
                                <p class="text-capitalize">We return money within 30 days</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center border p-3 bg-white">
                                <div class="font-50 text-dark">	<i class='bx bx-support'></i>
                                </div>
                                <h5 class="fs-5 text-uppercase mb-0 fw-bold">Customer Support</h5>
                                <p class="text-capitalize">Friendly 24/7 customer support</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </section>
            <!--end support info-->
            <!--start News-->
            <section class="py-4">
                <div class="container">
                    <div class="pb-4 text-center">
                        <h5 class="mb-0 fw-bold text-uppercase">Latest News</h5>
                    </div>
                    <div class="product-grid">
                        <div class="latest-news owl-carousel owl-theme">
                            <div class="item">
                                <div class="card rounded-0 product-card border">
                                    <div class="news-date">
                                        <div class="date-number">24</div>
                                        <div class="date-month">FEB</div>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="assets/images/blogs/01.png" class="card-img-top border-bottom" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <div class="news-title">
                                            <a href="javascript:;">
                                                <h5 class="mb-3 text-capitalize">Blog Short Title</h5>
                                            </a>
                                        </div>
                                        <p class="news-content mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...</p>
                                    </div>
                                    <div class="card-footer border-top bg-transparent">
                                        <a href="javascript:;" class="link-dark">0 Comments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0 product-card border">
                                    <div class="news-date">
                                        <div class="date-number">24</div>
                                        <div class="date-month">FEB</div>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="assets/images/blogs/02.png" class="card-img-top border-bottom" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <div class="news-title">
                                            <a href="javascript:;">
                                                <h5 class="mb-3 text-capitalize">Blog Short Title</h5>
                                            </a>
                                        </div>
                                        <p class="news-content mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...</p>
                                    </div>
                                    <div class="card-footer border-top bg-transparent">
                                        <a href="javascript:;" class="link-dark">0 Comments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0 product-card border">
                                    <div class="news-date">
                                        <div class="date-number">24</div>
                                        <div class="date-month">FEB</div>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="assets/images/blogs/03.png" class="card-img-top border-bottom" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <div class="news-title">
                                            <a href="javascript:;">
                                                <h5 class="mb-3 text-capitalize">Blog Short Title</h5>
                                            </a>
                                        </div>
                                        <p class="news-content mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...</p>
                                    </div>
                                    <div class="card-footer border-top bg-transparent">
                                        <a href="javascript:;" class="link-dark">0 Comments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0 product-card border">
                                    <div class="news-date">
                                        <div class="date-number">24</div>
                                        <div class="date-month">FEB</div>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="assets/images/blogs/04.png" class="card-img-top border-bottom" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <div class="news-title">
                                            <a href="javascript:;">
                                                <h5 class="mb-3 text-capitalize">Blog Short Title</h5>
                                            </a>
                                        </div>
                                        <p class="news-content mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...</p>
                                    </div>
                                    <div class="card-footer border-top bg-transparent">
                                        <a href="javascript:;" class="link-dark">0 Comments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0 product-card border">
                                    <div class="news-date">
                                        <div class="date-number">24</div>
                                        <div class="date-month">FEB</div>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="assets/images/blogs/05.png" class="card-img-top border-bottom" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <div class="news-title">
                                            <a href="javascript:;">
                                                <h5 class="mb-3 text-capitalize">Blog Short Title</h5>
                                            </a>
                                        </div>
                                        <p class="news-content mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...</p>
                                    </div>
                                    <div class="card-footer border-top bg-transparent">
                                        <a href="javascript:;" class="link-dark">0 Comments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0 product-card border">
                                    <div class="news-date">
                                        <div class="date-number">24</div>
                                        <div class="date-month">FEB</div>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="assets/images/blogs/06.png" class="card-img-top border-bottom" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <div class="news-title">
                                            <a href="javascript:;">
                                                <h5 class="mb-3 text-capitalize">Blog Short Title</h5>
                                            </a>
                                        </div>
                                        <p class="news-content mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...</p>
                                    </div>
                                    <div class="card-footer border-top bg-transparent">
                                        <a href="javascript:;" class="link-dark">0 Comments</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end News-->
            <!--start brands-->
            <section class="py-4">
                <div class="container">
                    <h3 class="d-none">Brands</h3>
                    <div class="brand-grid">
                        <div class="brands-shops owl-carousel owl-theme border">
                            <div class="item border-end">
                                <div class="p-4">
                                    <a href="javascript:;">
                                        <img src="assets/images/brands/01.png" class="img-fluid" alt="...">
                                    </a>
                                </div>
                            </div>
                            <div class="item border-end">
                                <div class="p-4">
                                    <a href="javascript:;">
                                        <img src="assets/images/brands/02.png" class="img-fluid" alt="...">
                                    </a>
                                </div>
                            </div>
                            <div class="item border-end">
                                <div class="p-4">
                                    <a href="javascript:;">
                                        <img src="assets/images/brands/03.png" class="img-fluid" alt="...">
                                    </a>
                                </div>
                            </div>
                            <div class="item border-end">
                                <div class="p-4">
                                    <a href="javascript:;">
                                        <img src="assets/images/brands/04.png" class="img-fluid" alt="...">
                                    </a>
                                </div>
                            </div>
                            <div class="item border-end">
                                <div class="p-4">
                                    <a href="javascript:;">
                                        <img src="assets/images/brands/05.png" class="img-fluid" alt="...">
                                    </a>
                                </div>
                            </div>
                            <div class="item border-end">
                                <div class="p-4">
                                    <a href="javascript:;">
                                        <img src="assets/images/brands/06.png" class="img-fluid" alt="...">
                                    </a>
                                </div>
                            </div>
                            <div class="item border-end">
                                <div class="p-4">
                                    <a href="javascript:;">
                                        <img src="assets/images/brands/07.png" class="img-fluid" alt="...">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end brands-->

            <!--start bottom products section-->
            <section class="py-4 border-top">
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                        <div class="col">
                            <div class="bestseller-list mb-3">
                                <h6 class="mb-3 text-uppercase fw-bold">Best Selling Products</h6>
                                <hr>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/01.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Men Casual Shirts</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/02.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Formal Coat Pant</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/03.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Women Blue Jeans</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/04.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Yellow Track Suit</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="featured-list mb-3">
                                <h6 class="mb-3 text-uppercase fw-bold">Featured Products</h6>
                                <hr>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/05.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Men Sports Shoes</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/06.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Black Sofa Set</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/07.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Sports Watch</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/08.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Women Blue Heels</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="new-arrivals-list mb-3">
                                <h6 class="mb-3 text-uppercase fw-bold">New arrivals</h6>
                                <hr>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="jproduct-details.html">
                                            <img src="assets/images/products/09.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Men Black Cap</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/10.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Orange Headphone</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/11.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Samsung Mobile</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/12.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Apple Notebook</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="top-rated-products-list mb-3">
                                <h6 class="mb-3 text-uppercase fw-bold">Top rated Products</h6>
                                <hr>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/13.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Ronaldo Football</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/14.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Red Fancy Sofa</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/15.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Sports Cycle</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bottom-product-img">
                                        <a href="product-details.html">
                                            <img src="assets/images/products/16.png" width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="ms-0">
                                        <h6 class="mb-0 fw-light mb-1 fw-bold">Circular Table</h6>
                                        <div class="rating"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <p class="mb-0 pro-price"><strong>$59.00</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </section>
            <!--end bottom products section-->
        </div>
    </div>
    <!--end page wrapper -->
    <!--start footer section-->
    <footer>
        <section class="py-5 border-top bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                    <div class="col">
                        <div class="footer-section1">
                            <h5 class="mb-4 text-uppercase fw-bold">Contact Info</h5>
                            <div class="address mb-3">
                                <h6 class="mb-0 text-uppercase fw-bold">Address</h6>
                                <p class="mb-0">123 Street Name, City, Australia</p>
                            </div>
                            <div class="phone mb-3">
                                <h6 class="mb-0 text-uppercase fw-bold">Phone</h6>
                                <p class="mb-0">Toll Free (123) 472-796</p>
                                <p class="mb-0">Mobile : +91-9910XXXX</p>
                            </div>
                            <div class="email mb-3">
                                <h6 class="mb-0 text-uppercase fw-bold">Email</h6>
                                <p class="mb-0">mail@example.com</p>
                            </div>
                            <div class="working-days mb-3">
                                <h6 class="mb-0 text-uppercase fw-bold">WORKING DAYS</h6>
                                <p class="mb-0">Mon - FRI / 9:30 AM - 6:30 PM</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-section2">
                            <h5 class="mb-4 text-uppercase fw-bold">Categories</h5>
                            <ul class="list-unstyled">
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Jeans</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> T-Shirts</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Sports</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Shirts & Tops</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Clogs & Mules</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Sunglasses</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Bags & Wallets</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Sneakers & Athletic</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Electronis</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Furniture</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-section3">
                            <h5 class="mb-4 text-uppercase fw-bold">Popular Tags</h5>
                            <div class="tags-box d-flex flex-wrap gap-2">
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Cloths</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Electronis</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Furniture</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Sports</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Men Wear</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Women Wear</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Laptops</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Formal Shirts</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Topwear</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Headphones</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Bottom Wear</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Bags</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Sofa</a>
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Shoes</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-section4">
                            <h5 class="mb-4 text-uppercase fw-bold">Stay informed</h5>
                            <div class="subscribe">
                                <input type="text" class="form-control" placeholder="Enter Your Email" />
                                <div class="mt-3 d-grid">
                                    <a href="javascript:;" class="btn btn-dark btn-ecomm">Subscribe</a>
                                </div>
                                <p class="mt-3 mb-0">Subscribe to our newsletter to receive early discount offers, updates and new products info.</p>
                            </div>
                            <div class="download-app mt-3">
                                <h6 class="mb-3 text-uppercase fw-bold">Download our app</h6>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="javascript:;">
                                        <img src="assets/images/icons/apple-store.png" class="" width="140" alt="" />
                                    </a>
                                    <a href="javascript:;">
                                        <img src="assets/images/icons/play-store.png" class="" width="140" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </section>

        <section class="footer-strip text-center py-3 border-top positon-absolute bottom-0">
            <div class="container">
                <div class="d-flex flex-column flex-lg-row align-items-center gap-3 justify-content-between">
                    <p class="mb-0">Copyright © 2022. All right reserved.</p>
                    <div class="payment-icon">
                        <div class="row row-cols-auto g-2 justify-content-end">
                            <div class="col">
                                <img src="assets/images/icons/visa.png" alt="" />
                            </div>
                            <div class="col">
                                <img src="assets/images/icons/paypal.png" alt="" />
                            </div>
                            <div class="col">
                                <img src="assets/images/icons/mastercard.png" alt="" />
                            </div>
                            <div class="col">
                                <img src="assets/images/icons/american-express.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    <!--end footer section-->


    <!--start quick view product-->
    <!-- Modal -->
    <div class="modal fade" id="QuickViewProduct">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-xl-down">
            <div class="modal-content rounded-0 border-0">
                <div class="modal-body">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                    <div class="row g-0">
                        <div class="col-12 col-lg-6">
                            <div class="image-zoom-section">
                                <div class="product-gallery owl-carousel owl-theme border mb-3 p-3" data-slider-id="1">
                                    <div class="item">
                                        <img src="assets/images/product-gallery/01.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="assets/images/product-gallery/02.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="assets/images/product-gallery/03.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="assets/images/product-gallery/04.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
                                    <button class="owl-thumb-item">
                                        <img src="assets/images/product-gallery/01.png" class="" alt="">
                                    </button>
                                    <button class="owl-thumb-item">
                                        <img src="assets/images/product-gallery/02.png" class="" alt="">
                                    </button>
                                    <button class="owl-thumb-item">
                                        <img src="assets/images/product-gallery/03.png" class="" alt="">
                                    </button>
                                    <button class="owl-thumb-item">
                                        <img src="assets/images/product-gallery/04.png" class="" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="product-info-section p-3">
                                <h3 class="mt-3 mt-lg-0 mb-0">Allen Solly Men's Polo T-Shirt</h3>
                                <div class="product-rating d-flex align-items-center mt-2">
                                    <div class="rates cursor-pointer font-13">	<i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                    </div>
                                    <div class="ms-1">
                                        <p class="mb-0">(24 Ratings)</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-3 gap-2">
                                    <h5 class="mb-0 text-decoration-line-through text-light-3">$98.00</h5>
                                    <h4 class="mb-0">$49.00</h4>
                                </div>
                                <div class="mt-3">
                                    <h6>Discription :</h6>
                                    <p class="mb-0">Virgil Abloh’s Off-White is a streetwear-inspired collection that continues to break away from the conventions of mainstream fashion. Made in Italy, these black and brown Odsy-1000 low-top sneakers.</p>
                                </div>
                                <dl class="row mt-3">	<dt class="col-sm-3">Product id</dt>
                                    <dd class="col-sm-9">#BHU5879</dd>	<dt class="col-sm-3">Delivery</dt>
                                    <dd class="col-sm-9">Russia, USA, and Europe</dd>
                                </dl>
                                <div class="row row-cols-auto align-items-center mt-3">
                                    <div class="col">
                                        <label class="form-label">Quantity</label>
                                        <select class="form-select form-select-sm">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Size</label>
                                        <select class="form-select form-select-sm">
                                            <option>S</option>
                                            <option>M</option>
                                            <option>L</option>
                                            <option>XS</option>
                                            <option>XL</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Colors</label>
                                        <div class="color-indigators d-flex align-items-center gap-2">
                                            <div class="color-indigator-item bg-primary"></div>
                                            <div class="color-indigator-item bg-danger"></div>
                                            <div class="color-indigator-item bg-success"></div>
                                            <div class="color-indigator-item bg-warning"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                                <div class="d-flex gap-2 mt-3">
                                    <a href="javascript:;" class="btn btn-dark btn-ecomm">	<i class="bx bxs-cart-add"></i>Add to Cart</a>	<a href="javascript:;" class="btn btn-light btn-ecomm"><i class="bx bx-heart"></i>Add to Wishlist</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
    <!--end quick view product-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
</div>
<!--end wrapper-->

<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/OwlCarousel/js/owl.carousel.min.js"></script>
<script src="assets/plugins/OwlCarousel/js/owl.carousel2.thumbs.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<!--app JS-->
<script src="assets/js/app.js"></script>
<script src="assets/js/index.js"></script>
</body>

</html>