@extends('layouts.Frontend.mainlayoutfrontend')
@section('title', 'انشاء طلب')
@section('css')
    <style>
        label {
            font-size: 20px;
        }
        /* الحاوية الرئيسية للدوائر */
        .steps-container {
            gap: 8px;
        }
        /* الدائرة */
        .circle {
            width: 21.55px;
            height: 21.55px;
            border-radius: 50%;
            background-color: #ccc;
            color: #0A4740;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: default;
        }
        /* الدائرة الحالية */
        .circle.active {
            background-color: #0A4740;
            color: #fff;
        }
        /* الدائرة غير النشطة */
        .circle.inactive {
            background-color: #ccc;
            color: #0A4740;
        }
        /* إخفاء جميع الخطوات افتراضياً */
        .form-step {
            display: none;
        }
        /* تنسيق صور الاختيار */
        .radio-image input[type="radio"] {
            display: none;
        }
        .radio-image img {
            border: 2px solid transparent;
            cursor: pointer;
            transition: border 0.3s ease;
            width: 100%;
            height: auto;
        }
        .radio-image input[type="radio"]:checked + img {
            border: 2px solid #0A4740;
        }
        .Dark_Green:hover {
            color:#509F96;
        }
    </style>
    <style>
        /* تنسيق عناصر النموذج */
        /* تنسيق عناصر النموذج */
        .radio-options {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .radio-container {
            background-color: #f3f3f3;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            flex-grow: 1;
            margin-inline: 10px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .radio-container:not(:last-child) {
            margin-right: 10px;
        }

        .radio-container input[type="radio"] {
            display: none;
        }

        .radio-container .radio-label {
            font-size: 16px;
            color: #333; /* اللون الأساسي */
        }

        /* عند اختيار الخيار، يتغير لون الخلفية بالكامل ويتحول لون النص إلى الأبيض */
        .radio-container.selected {
            background-color: #0A4740 !important;
            color: white !important;
        }

        /* التأكد من أن النص داخل الصندوق أيضًا يصبح أبيض عند التحديد */
        .radio-container.selected .radio-label {
            color: white !important;
        }



    </style>
@endsection
@section('content')

    @php
        // تحديد الخطوات بناءً على وجود اسم المستخدم
        $steps = [];
        $hasName = !empty(auth()->user()->name);

        // إذا لم يكن للمستخدم اسم مسجل، نضيف خطوة المعلومات الأساسية
        if(!$hasName) {
            $steps[] = 'المعلومات الأساسية';
        }
        $steps[] = 'مساحة وشكل المطبخ';
        $steps[] = 'نوع المطبخ والتكلفة';
        $steps[] = 'المدة الزمنية وستايل المطبخ';
        $steps[] = 'وقت اللقاء والموقع';

        $totalSteps = count($steps);

        // إعداد خيارات المدة الزمنية (القيم النصية)
    $locale = app()->getLocale();

    $timeOptions = $locale === 'ar'
        ? ["شهر", "شهرين", "ثلاثة أشهر", "أربعة أشهر", "خمسة أشهر", "ستة أشهر"]
        : ["One Month", "Two Months", "Three Months", "Four Months", "Five Months", "Six Months"];
        // افتراضيًا نختار أول خيار (يمكنك تغييره)
        $defaultTime = old('time_range');
        $defaultTimeIndex = 0;
        if($defaultTime) {
            $found = array_search($defaultTime, $timeOptions);
            $defaultTimeIndex = ($found !== false) ? $found : 0;
        }
    @endphp

    <div style="background-color: #f3f3f3" class="pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center pt-5 pb-5" style="border-radius: 28px;background-color: white;margin: auto">
                <div class="col-md-8 col-sm-12 col-lg-8">

                    <!-- مؤشر الخطوات (Stepper) -->
                    <div class="steps-container d-flex justify-content-center mb-4" id="stepsContainer">
                        @foreach($steps as $index => $stepLabel)
                            <div class="circle inactive mx-1" id="step-circle-{{ $index }}">
                                {{ $index + 1 }}
                            </div>
                        @endforeach
                    </div>
                    <!-- نهاية مؤشر الخطوات -->

                    <!-- رسائل النجاح والأخطاء -->
                    @if (session('success'))
                        <div style="color: green;" dir="rtl">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div style="color: red;" dir="rtl">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div style="color: red;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <!-- الخطوة 1: المعلومات الأساسية (تظهر فقط إذا لم يكن للمستخدم اسم) -->
                        @if(!$hasName)
                            <div class="form-step" id="form-step-0">
                                <div class="mb-3">
                                    <label for="name">@lang('order.username')</label>
                                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                                    @error('name')
                                    <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email">@lang('order.email')</label>
                                    <input class="form-control" type="text" name="email" id="email" value="{{ old('email') }}">
                                    @error('email')
                                    <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a type="button" onclick="nextPrev(1)" class="Dark_Green">
                                        @lang('order.next_button')
                                    </a>
                                </div>
                            </div>
                    @endif

                    <!-- الخطوة 2: مساحة وشكل المطبخ (مع 4 صور لاختيار شكل المطبخ) -->
                        <div class="form-step" id="form-step-{{ $hasName ? 0 : 1 }}">
                            <h5 class="text-center mb-3">@lang('order.kitchen_area_and_shape')</h5>

                            <div class="mb-3">
                                <label for="kitchen_area">@lang('order.kitchen_area'):</label>
                                <input type="range" name="kitchen_area" id="kitchen_area"
                                       value="{{ old('kitchen_area') ?? 6 }}" min="1" max="100" style="accent-color: #0A4740;">
                                <span id="kitchen_area_value">{{ old('kitchen_area') ?? 6 }}m</span>
                                @error('kitchen_area')
                                <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>@lang('order.kitchen_shape'):</label>
                                <div class="row">
                                    <div class="col-6 col-md-3 text-center mb-2">
                                        <label class="radio-image">
                                            <input type="radio" name="kitchen_shape" value="مطبخ له شكل حرف L" {{ old('kitchen_shape')=='مطبخ له شكل حرف L' ? 'checked' : '' }}>
                                            @php
                                                $locale = app()->getLocale();
                                                $img = $locale === 'ar' ? 'حرف l.png' : 'L-shaped kitchen.png';
                                                $img2 = $locale === 'ar' ? 'حرف u.png' : 'U-shaped kitchen.png';
                                                $img3 = $locale === 'ar' ? 'مستقيم.png' : 'Linear kitchen.png';
                                                $img4 = $locale === 'ar' ? 'متوازي.png' : 'Parallel kitchen.png';
                                            @endphp
                                            <img src="{{ asset('Frontend/assets/images/gallery/' . $img) }}" alt="@lang('order.kitchen_shapes.مطبخ له شكل حرف L')">
                                        </label>
                                    </div>
                                    <div class="col-6 col-md-3 text-center mb-2">
                                        <label class="radio-image">
                                            <input type="radio" name="kitchen_shape" value="مطبخ له شكل حرف U" {{ old('kitchen_shape')=='مطبخ له شكل حرف U' ? 'checked' : '' }}>
                                            <img src="{{ asset('Frontend/assets/images/gallery/'.$img2) }}" alt="@lang('order.kitchen_shapes.مطبخ له شكل حرف U')">
                                        </label>
                                    </div>
                                    <div class="col-6 col-md-3 text-center mb-2">
                                        <label class="radio-image">
                                            <input type="radio" name="kitchen_shape" value="مستقيم" {{ old('kitchen_shape')=='مستقيم' ? 'checked' : '' }}>
                                            <img src="{{ asset('Frontend/assets/images/gallery/'.$img3) }}" alt="@lang('order.kitchen_shapes.مستقيم')">
                                        </label>
                                    </div>
                                    <div class="col-6 col-md-3 text-center mb-2">
                                        <label class="radio-image">
                                            <input type="radio" name="kitchen_shape" value="متوازي" {{ old('kitchen_shape')=='متوازي' ? 'checked' : '' }}>
                                            <img src="{{ asset('Frontend/assets/images/gallery/'.$img4) }}" alt="@lang('order.kitchen_shapes.متوازي')">
                                        </label>
                                    </div>
                                </div>
                                @error('kitchen_shape')
                                <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                @if(!$hasName)
                                    <a type="button" onclick="nextPrev(-1)" class="Dark_Green" style="justify-self: start;">@lang('order.back_button')</a>
                                @endif
                                <a type="button" onclick="nextPrev(1)" class="Dark_Green" style="justify-self: end;">@lang('order.next_button')</a>
                            </div>
                        </div>


                        <!-- الخطوة 3: نوع المطبخ والتكلفة (مع خيارات للكلفة) -->


                        <div class="form-step" id="form-step-{{ $hasName ? 1 : 2 }}">
                            <h5 class="text-center mb-3">@lang('order.kitchen_type_and_cost')</h5>

                            <!-- Kitchen Type -->
                            <div class="mb-3">
                                <label>@lang('order.select_kitchen_type'):</label>
                                <div class="radio-options" id="kitchen-type-options">
                                    <label class="radio-container">
                                        <input type="radio" name="kitchen_type" value="قديم" {{ old('kitchen_type') == '1' ? 'checked' : '' }}>
                                        <span class="radio-label">@lang('order.kitchen_type_old')</span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" name="kitchen_type" value="جديد" {{ old('kitchen_type') == '2' ? 'checked' : '' }}>
                                        <span class="radio-label">@lang('order.kitchen_type_new')</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Expected Cost -->
                            <div class="mb-3">
                                <label>@lang('order.select_expected_cost'):</label>
                                <div class="radio-options" id="cost-options">
                                    <label class="radio-container">
                                        <input type="radio" name="expected_cost" value="20000" {{ old('expected_cost') == '20000' ? 'checked' : '' }}>
                                        <span class="radio-label">@lang('order.cost_below_20')</span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" name="expected_cost" value="40000" {{ old('expected_cost') == '40000' ? 'checked' : '' }}>
                                        <span class="radio-label">@lang('order.cost_20_40')</span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" name="expected_cost" value="60000" {{ old('expected_cost') == '60000' ? 'checked' : '' }}>
                                        <span class="radio-label">@lang('order.cost_above_40')</span>
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a type="button" onclick="nextPrev(-1)" class="Dark_Green">@lang('order.back_button')</a>
                                <a type="button" onclick="nextPrev(1)" class="Dark_Green">@lang('order.next_button')</a>
                            </div>
                        </div>





                        <!-- الخطوة 4: المدة الزمنية وستايل المطبخ (مع صور لاختيار ستايل المطبخ) -->
                        <div class="form-step" id="form-step-{{ $hasName ? 2 : 3 }}">
                            <h5 class="text-center mb-3">@lang('order.time_and_style')</h5>

                            <!-- Time Range --><div class="mb-3">
                                <label for="time_range_slider">@lang('order.time_range'):</label>
                                <input type="range" id="time_range_slider" min="0" max="5" step="1" value="{{ $defaultTimeIndex }}" style="accent-color: #0A4740;">

                                <!-- يعرض حسب اللغة الحالية -->
                                <span id="time_range_value">
        @if(app()->getLocale() == 'ar')
                                        {{ ["شهر", "شهرين", "ثلاثة أشهر", "أربعة أشهر", "خمسة أشهر", "ستة أشهر"][$defaultTimeIndex] }}
                                    @else
                                        {{ ["One Month", "Two Months", "Three Months", "Four Months", "Five Months", "Six Months"][$defaultTimeIndex] }}
                                    @endif
    </span>

                                <!-- التخزين دائمًا بالعربية -->
                                <input type="hidden" name="time_range" id="time_range_hidden" value="{{ ["شهر", "شهرين", "ثلاثة أشهر", "أربعة أشهر", "خمسة أشهر", "ستة أشهر"][$defaultTimeIndex] }}">

                                @error('time_range')
                                <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kitchen Style -->
                            <div class="mb-3">
                                <label>@lang('order.select_kitchen_style'):</label>
                                <div class="row">
                                    <div class="col-6 col-md-3 text-center mb-2">
                                        <label class="radio-image">
                                            <input type="radio" name="kitchen_style" value="عصري" {{ old('kitchen_style') == 'عصري' ? 'checked' : '' }}>
                                            @php

                                                $img5 = $locale === 'ar' ? 'عصري.png' : 'Modern.png';
                                                $img6 = $locale === 'ar' ? 'كلاسيكي.png' : 'Classic.png';
                                                $img7 = $locale === 'ar' ? 'انيق.png' : 'Elegant.png';
                                                $img8 = $locale === 'ar' ? 'مريح.png' : 'Comfortable.png';
                                            @endphp
                                            <img src="{{ asset('Frontend/assets/images/gallery/'.$img5) }}" alt="@lang('order.kitchen_styles.عصري')">
                                        </label>
                                    </div>
                                    <div class="col-6 col-md-3 text-center mb-2">
                                        <label class="radio-image">
                                            <input type="radio" name="kitchen_style" value="كلاسيكي" {{ old('kitchen_style') == 'كلاسيكي' ? 'checked' : '' }}>
                                            <img src="{{ asset('Frontend/assets/images/gallery/'.$img6) }}" alt="@lang('order.kitchen_styles.كلاسيكي')">
                                        </label>
                                    </div>
                                    <div class="col-6 col-md-3 text-center mb-2">
                                        <label class="radio-image">
                                            <input type="radio" name="kitchen_style" value="أنيق" {{ old('kitchen_style') == 'أنيق' ? 'checked' : '' }}>
                                            <img src="{{ asset('Frontend/assets/images/gallery/'.$img7) }}" alt="@lang('order.kitchen_styles.انيق')">
                                        </label>
                                    </div>
                                    <div class="col-6 col-md-3 text-center mb-2">
                                        <label class="radio-image">
                                            <input type="radio" name="kitchen_style" value="مريح" {{ old('kitchen_style') == 'مريح' ? 'checked' : '' }}>
                                            <img src="{{ asset('Frontend/assets/images/gallery/'.$img8) }}" alt="@lang('order.kitchen_styles.مريح')">
                                        </label>
                                    </div>
                                </div>
                                @error('kitchen_style')
                                <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a type="button" onclick="nextPrev(-1)" class="Dark_Green">@lang('order.back_button')</a>
                                <a type="button" onclick="nextPrev(1)" class="Dark_Green">@lang('order.next_button')</a>
                            </div>
                        </div>


                        <!-- الخطوة 5: وقت اللقاء والموقع -->
                        <div class="form-step" id="form-step-{{ $hasName ? 3 : 4 }}">
                            <h5 class="text-center mb-3">@lang('order.meeting_and_location')</h5>

                            <div class="mb-3">
                                <label for="meeting_time">@lang('order.meeting_time'):</label>
                                <input class="form-control" type="datetime-local" name="meeting_time" id="meeting_time" value="{{ old('meeting_time') }}">
                                @error('meeting_time')
                                <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>@lang('order.select_kitchen_location'):</label>
                                <div id="map" style="width: 100%; height: 300px;"></div>
                            </div>

                            <input type="hidden" name="length_step" id="length_step" value="{{ old('length_step') }}">
                            <input type="hidden" name="width_step" id="width_step" value="{{ old('width_step') }}">
                            <input type="hidden" name="region_name" id="region_name" value="{{ old('region_name') }}">
                            <input type="hidden" name="geocode_string" id="geocode_string" value="{{ old('geocode_string') }}">

                            <div class="mb-3">
                                <label for="search_map">@lang('order.search_location'):</label>
                                <input id="search_map" type="text" placeholder="@lang('order.search_here_placeholder')" class="form-control">
                            </div>

                            <div class="d-flex justify-content-between">
                                <a type="button" onclick="nextPrev(-1)" class="Dark_Green">@lang('order.back_button')</a>
                                <button type="submit" class="btn button_Dark_Green">@lang('order.submit_request')</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var currentStepIndex = 0;
        var totalSteps = {{ $totalSteps }};
        var allFormSteps = document.getElementsByClassName('form-step');

        // إخفاء جميع الخطوات أولاً
        for (var i = 0; i < allFormSteps.length; i++) {
            allFormSteps[i].style.display = 'none';
        }
        // عرض أول خطوة
        showStep(currentStepIndex);

        function showStep(n) {
            for (var i = 0; i < allFormSteps.length; i++) {
                allFormSteps[i].style.display = 'none';
            }
            allFormSteps[n].style.display = 'block';
            updateStepper(n);

            // إعادة تهيئة الخريطة إذا كانت الخطوة الأخيرة وتوجد الخريطة
            if (n === totalSteps - 1 && typeof map !== 'undefined') {
                google.maps.event.trigger(map, 'resize');
            }
        }

        function nextPrev(direction) {
            currentStepIndex += direction;
            if (currentStepIndex < 0) currentStepIndex = 0;
            if (currentStepIndex >= totalSteps) currentStepIndex = totalSteps - 1;
            showStep(currentStepIndex);
        }

        function updateStepper(stepIndex) {
            for (var i = 0; i < totalSteps; i++) {
                var circle = document.getElementById('step-circle-' + i);
                if (i === stepIndex) {
                    circle.classList.add('active');
                    circle.classList.remove('inactive');
                } else {
                    circle.classList.remove('active');
                    circle.classList.add('inactive');
                }
            }
        }
    </script>

    <!-- تضمين خرائط جوجل -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=geometry,places&callback=initMap" async defer></script>
    <script>
        let map;
        let marker;
        let geocoder;
        let autocomplete;

        function initMap() {
            // أول شيء نحاول نجيب موقع المستخدم
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        const userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        initMapAtLocation(userLocation, 15);
                        document.getElementById('length_step').value = userLocation.lat;
                        document.getElementById('width_step').value = userLocation.lng;
                        geocodeLatLng(userLocation);

                        const regionName = getRegionNameFromLatLng(userLocation, map);
                        if (regionName) {
                            document.getElementById('region_name').value = regionName;
                        }

                        placeMarker(userLocation, map);
                    },
                    function () {
                        console.warn("لم يتم السماح بالحصول على الموقع.");
                        initMapAtDefaultLocation(); // في حال الرفض
                    }
                );
            } else {
                alert("المتصفح لا يدعم تحديد الموقع الجغرافي.");
                initMapAtDefaultLocation();
            }
        }

        function initMapAtDefaultLocation() {
            const defaultLocation = { lat: 24.7136, lng: 46.6753 }; // الرياض
            initMapAtLocation(defaultLocation, 8);
        }

        function initMapAtLocation(center, zoomLevel) {
            map = new google.maps.Map(document.getElementById('map'), {
                center: center,
                zoom: zoomLevel
            });
            geocoder = new google.maps.Geocoder();

            // تحميل الحدود الإدارية للسعودية
            map.data.loadGeoJson('/saudi-arabia-with-regions_1509.geojson', null, function (features) {
                map.data.addListener('click', function (event) {
                    const regionName = event.feature.getProperty('name');
                    document.getElementById('region_name').value = regionName;
                    placeMarker(event.latLng, map);
                    geocodeLatLng(event.latLng);
                });
            });

            // الضغط على الخريطة
            map.addListener('click', function (e) {
                checkRegionAndPlaceMarker(e.latLng, map);
            });

            // البحث عبر العنوان
            const input = document.getElementById('search_map');
            autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);
            autocomplete.addListener('place_changed', function () {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    alert("لا توجد تفاصيل للعنصر: '" + place.name + "'");
                    return;
                }
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                placeMarker(place.geometry.location, map);
                geocodeLatLng(place.geometry.location);
            });
        }

        function getRegionNameFromLatLng(latLng, map) {
            let regionName = null;
            map.data.forEach(function (feature) {
                const geometry = feature.getGeometry();
                if (google.maps.geometry.poly.containsLocation(latLng, geometry)) {
                    regionName = feature.getProperty('name');
                }
            });
            return regionName;
        }

        function checkRegionAndPlaceMarker(latLng, map) {
            let isInsideRegion = false;
            let regionName = "";
            map.data.forEach(function (feature) {
                const geometry = feature.getGeometry();
                if (google.maps.geometry.poly.containsLocation(latLng, geometry)) {
                    isInsideRegion = true;
                    regionName = feature.getProperty('name');
                }
            });
            if (isInsideRegion) {
                placeMarkerAndPanTo(latLng, map, regionName);
                geocodeLatLng(latLng);
            } else {
                alert('لا يمكنك اختيار نقطة خارج مناطق السعودية.');
            }
        }

        function placeMarker(location, map) {
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
            document.getElementById('length_step').value = location.lat();
            document.getElementById('width_step').value = location.lng();
        }

        function placeMarkerAndPanTo(latLng, map, regionName) {
            placeMarker(latLng, map);
        }

        function geocodeLatLng(latLng) {
            geocoder.geocode({ location: latLng }, function (results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        document.getElementById('geocode_string').value = results[0].formatted_address;
                    } else {
                        alert('لم يتم العثور على عنوان.');
                    }
                } else {
                    alert('فشل الـ Geocoder بسبب: ' + status);
                }
            });
        }
    </script>


    <!-- كود تحديث عرض قيمة الشريط لحجم المطبخ -->
    <script>
        var kitchenRange = document.getElementById('kitchen_area');
        var kitchenValue = document.getElementById('kitchen_area_value');
        if(kitchenRange && kitchenValue){
            kitchenValue.innerText = kitchenRange.value + 'm';
            kitchenRange.addEventListener('input', function(){
                kitchenValue.innerText = this.value + 'm';
            });
        }
    </script>

    <!-- كود تحديث عرض قيمة شريط المدة الزمنية وتعيين القيمة النصية في الحقل المخفي -->
    <script>
        const timeOptions = @json($timeOptions);
        var timeSlider = document.getElementById('time_range_slider');
        var timeDisplay = document.getElementById('time_range_value');
        var timeHidden = document.getElementById('time_range_hidden');
        if(timeSlider && timeDisplay && timeHidden){
            timeDisplay.innerText = timeOptions[timeSlider.value];
            timeHidden.value = timeOptions[timeSlider.value];
            timeSlider.addEventListener('input', function(){
                timeDisplay.innerText = timeOptions[this.value];
                timeHidden.value = timeOptions[this.value];
            });
        }
    </script>

    <!-- تنسيق الدوائر (Stepper) وتنسيق اختيار الصور -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // إدارة تغييرات نوع المطبخ
            setupRadioSelection('kitchen-type-options');

            // إدارة تغييرات التكلفة المتوقعة
            setupRadioSelection('cost-options');

            function setupRadioSelection(groupId) {
                var radios = document.querySelectorAll('#' + groupId + ' input[type="radio"]');

                radios.forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        resetBackgrounds(groupId);
                        if (radio.checked) {
                            radio.parentNode.classList.add('selected'); // أضف الفئة لتغيير اللون
                        }
                    });

                    // تعيين الخيار المختار مسبقًا عند تحميل الصفحة
                    if (radio.checked) {
                        radio.parentNode.classList.add('selected');
                    }
                });
            }

            function resetBackgrounds(groupId) {
                document.querySelectorAll('#' + groupId + ' .radio-container').forEach(function(container) {
                    container.classList.remove('selected');
                });
            }
        });
    </script>
    <script>
        // مشان ازا كبس انتر بالخريطة
        document.getElementById('search_map').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // منع إرسال الفورم
            }
        });
        var input = document.getElementById('search_map');
        autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                alert("لا توجد تفاصيل للعنصر: '" + place.name + "'");
                return;
            }
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            placeMarker(place.geometry.location, map);
            geocodeLatLng(place.geometry.location);
        });
    </script>


    <script>
        // تعريف القيم بلغتين
        const timeRanges = {
            ar: ["شهر", "شهرين", "ثلاثة أشهر", "أربعة أشهر", "خمسة أشهر", "ستة أشهر"],
            en: ["One Month", "Two Months", "Three Months", "Four Months", "Five Months", "Six Months"]
        };

        // القيم العربية للتخزين (نفس القيم العربية)
        const arabicValues = timeRanges.ar;

        const slider = document.getElementById('time_range_slider');
        const valueDisplay = document.getElementById('time_range_value');
        const hiddenInput = document.getElementById('time_range_hidden');

        // تحديد لغة الصفحة من Laravel
        const currentLang = "{{ app()->getLocale() }}"; // 'ar' أو 'en'

        slider.addEventListener('input', function() {
            const index = parseInt(this.value);
            valueDisplay.textContent = timeRanges[currentLang][index]; // يعرض حسب اللغة
            hiddenInput.value = arabicValues[index]; // يخزن بالعربية دائمًا
        });
    </script>


@endsection
