<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('Frontend/assets/images/favicon-32x32.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{asset('Frontend/assets/plugins/OwlCarousel/css/owl.carousel.min.css')}}" rel="stylesheet" />

    <link href="{{asset('Frontend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('Frontend/assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('Frontend/assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('Frontend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{asset('Frontend/assets/css/app.css')}}" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link href="{{asset('Frontend/assets/css/icons.css')}}" rel="stylesheet">
    <title>@yield('title')</title>


    @yield('css')
</head>

 <body>

<!--wrapper-->
<div class="wrapper">
    <!--start top header wrapper-->
    <div class="header-wrapper">
        <div class="top-menu">
            <div class="container">
                <nav class="navbar navbar-expand">
                    <div class="shiping-title d-none d-sm-flex">Welcome to opoolia online!</div>


                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end" style="color: white">
                                @auth
                                    <a style="color:white!important"
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a style="color:white!important"
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a style="color:white!important"
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </ul>

                </nav>
            </div>
        </div>


    </div>
    <!--end top header wrapper-->
    <!--start slider section-->

    <!--end slider section-->
    <!--start page wrapper -->




    <!--end page wrapper -->
    <!--start footer section-->

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
@yield('content')
<!-- Bootstrap JS -->
<script src="{{asset('Frontend/assets/vendor/apexcharts/apexcharts.min.js')}}assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="{{asset('Frontend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('Frontend/assets/plugins/OwlCarousel/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('Frontend/assets/plugins/OwlCarousel/js/owl.carousel2.thumbs.min.js')}}"></script>
<script src="{{asset('Frontend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<!--app JS-->
<script src="{{asset('Frontend/assets/js/app.js')}}"></script>
<script src="{{asset('Frontend/assets/js/index.js')}}"></script>
</body>

</html>
