@extends('layouts.app')
@section('content')

    <!-- عرض رسالة النجاح -->
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- عرض رسالة الخطأ -->
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <!-- عرض رسائل التحقق من الأخطاء لكل حقل -->
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
        <div class="container">
            <h1 style="direction: rtl">تقديم طلب مطبخ</h1>
            <div class="row">
                <!-- Name Input (only if not set for the authenticated user) -->
                @if (empty(auth()->user()->name))
                    <div class="col-6">
                        <label for="name">اسم المستخدم:</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

            <!-- Email Input (only if not set for the authenticated user) -->
                @if (empty(auth()->user()->email))
                    <div class="col-6">
                        <label for="email">البريد الإلكتروني:</label>
                        <input class="form-control" type="text" name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="kitchen_area">مساحة المطبخ:</label>
                    <input class="form-control" type="text" name="kitchen_area" id="kitchen_area" value="{{ old('kitchen_area') }}">
                    @error('kitchen_area')
                    <p style="color: red;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="kitchen_shape">شكل المطبخ:</label>
                    <select class="form-select" name="kitchen_shape" id="kitchen_shape">
                        <option value="مطبخ له شكل حرف L" {{ old('kitchen_shape') == 'مطبخ له شكل حرف L' ? 'selected' : '' }}>مطبخ له شكل حرف L</option>
                        <option value="مطبخ له شكل حرف U" {{ old('kitchen_shape') == 'مطبخ له شكل حرف U' ? 'selected' : '' }}>مطبخ له شكل حرف U</option>
                        <option value="مستقيم" {{ old('kitchen_shape') == 'مستقيم' ? 'selected' : '' }}>مستقيم</option>
                        <option value="متوازي" {{ old('kitchen_shape') == 'متوازي' ? 'selected' : '' }}>متوازي</option>
                    </select>
                    @error('kitchen_shape')
                    <p style="color: red;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <label for="kitchen_type">نوع المطبخ:</label>
            <select class="form-select" name="kitchen_type" id="kitchen_type">
                <option value="قديم" {{ old('kitchen_type') == 'قديم' ? 'selected' : '' }}>قديم</option>
                <option value="جديد" {{ old('kitchen_type') == 'جديد' ? 'selected' : '' }}>جديد</option>
            </select>
            @error('kitchen_type')
            <p style="color: red;">{{ $message }}</p>
            @enderror

            <br>

            <label for="expected_cost">الكلفة المتوقعة:</label>
            <input class="form-control" type="text" name="expected_cost" id="expected_cost" value="{{ old('expected_cost') }}">
            @error('expected_cost')
            <p style="color: red;">{{ $message }}</p>
            @enderror

            <br>

            <label for="time_range">المدة الزمنية:</label>
            <input class="form-control" type="text" name="time_range" id="time_range" value="{{ old('time_range') }}">
            @error('time_range')
            <p style="color: red;">{{ $message }}</p>
            @enderror

            <br>

            <label for="kitchen_style">ستايل المطبخ:</label>
            <select class="form-select" name="kitchen_style" id="kitchen_style">
                <option value="حديث" {{ old('kitchen_style') == 'حديث' ? 'selected' : '' }}>حديث</option>
                <option value="كلاسيكي" {{ old('kitchen_style') == 'كلاسيكي' ? 'selected' : '' }}>كلاسيكي</option>
            </select>
            @error('kitchen_style')
            <p style="color: red;">{{ $message }}</p>
            @enderror

            <br>


            <label for="meeting_time">وقت اللقاء:</label>
            <input class="form-control" type="datetime-local" name="meeting_time" id="meeting_time" value="{{ old('meeting_time') }}">
            @error('meeting_time')
            <p style="color: red;">{{ $message }}</p>
            @enderror

            <br>

            <!-- Search Box for Google Maps -->


            <label>اختر موقع المطبخ على الخريطة:</label>
            <div id="map" style="width: 100%; height: 400px;"></div>

            <!-- Hidden fields for longitude, latitude, and region name -->
            <input type="hidden" name="length_step" id="length_step" value="{{ old('length_step') }}">
            <input type="hidden" name="width_step" id="width_step" value="{{ old('width_step') }}">
            <input type="hidden" name="region_name" id="region_name" value="{{ old('region_name') }}">

            <br>

            <!-- Geocode address field -->
            <label for="geocode_string">العنوان الجغرافي:</label>
            <input type="text" name="geocode_string" id="geocode_string" class="form-control" value="{{ old('geocode_string') }}" readonly>
            @error('geocode_string')
            <p style="color: red;">{{ $message }}</p>
            @enderror

            <br>

            <div class="align-items-center" style="text-align: center">
                <button type="submit" style="text-align: center">تقديم الطلب</button>
            </div>
        </div>
    </form>
    <label for="search_map">ابحث عن موقع:</label>
    <input id="search_map" type="text" placeholder="ابحث هنا..." class="form-control">
    <!-- Google Maps JavaScript -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB26-DMf-q42W0p3QnByFi50YLB0urKDPQ&libraries=geometry,places&callback=initMap" async defer></script>

    <script>
        var map, marker, geocoder, autocomplete;

        function initMap() {
            // Initialize map
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 24.7136, lng: 46.6753 },
                zoom: 8
            });

            geocoder = new google.maps.Geocoder();

            // Load GeoJSON data for Saudi Arabia regions
            map.data.loadGeoJson('/saudi-arabia-with-regions_1509.geojson', null, function (features) {
                console.log('GeoJSON loaded successfully.');

                map.data.addListener('click', function (event) {
                    var regionName = event.feature.getProperty('name');
                    var coordinates = event.latLng;
                    alert('Clicked on region: ' + regionName);
                    document.getElementById('region_name').value = regionName;
                    placeMarker(event.latLng, map);
                    geocodeLatLng(event.latLng);
                });
            });

            // Map click event for setting location outside GeoJSON
            map.addListener('click', function (e) {
                checkRegionAndPlaceMarker(e.latLng, map);
            });

            // Initialize Places Autocomplete for search
            var input = document.getElementById('search_map');
            autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    alert("No details available for input: '" + place.name + "'");
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

        function checkRegionAndPlaceMarker(latLng, map) {
            let isInsideRegion = false;
            let regionName = "";

            map.data.forEach(function (feature) {
                var geometry = feature.getGeometry();
                if (google.maps.geometry.poly.containsLocation(latLng, geometry)) {
                    isInsideRegion = true;
                    regionName = feature.getProperty('name');
                    console.log('Point is inside a Saudi region:', regionName);
                }
            });

            if (isInsideRegion) {
                placeMarkerAndPanTo(latLng, map, regionName);
                geocodeLatLng(latLng);
            } else {
                alert('You cannot place a marker outside Saudi regions.');
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
            console.log("Coordinates:", latLng.lat(), latLng.lng());
            console.log("Region:", regionName);
            alert('Point is in region: ' + regionName);
        }

        function geocodeLatLng(latLng) {
            geocoder.geocode({ 'location': latLng }, function (results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        document.getElementById('geocode_string').value = results[0].formatted_address;
                    } else {
                        alert('No address found.');
                    }
                } else {
                    alert('Geocoder failed due to: ' + status);
                }
            });
        }
    </script>

@endsection
