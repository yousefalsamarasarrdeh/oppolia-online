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
      <div class="container" >
          <h1 style="direction: rtl">تقديم طلب مطبخ</h1>
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
        <input  class="form-control" type="text" name="kitchen_shape" id="kitchen_shape" value="{{ old('kitchen_shape') }}">
        @error('kitchen_shape')
        <p style="color: red;">{{ $message }}</p>
        @enderror

              </div>
          </div>

        <label for="kitchen_type">نوع المطبخ:</label>
        <select class="form-control" name="kitchen_type" id="kitchen_type">
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
        <input class="form-control" type="text" name="kitchen_style" id="kitchen_style" value="{{ old('kitchen_style') }}">
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

        <!-- إضافة خريطة Google -->
        <label>اختر موقع المطبخ على الخريطة:</label>
        <div id="map" style="width: 100%; height: 400px;"></div>

        <!-- حقول مخفية لتخزين خطوط الطول والعرض -->
        <input type="hidden" name="length_step" id="length_step" value="{{ old('length_step') }}">
        <input type="hidden" name="width_step" id="width_step" value="{{ old('width_step') }}">

        @error('length_step')
        <p style="color: red;">{{ $message }}</p>
        @enderror
        @error('width_step')
        <p style="color: red;">{{ $message }}</p>
        @enderror

        <br>
       <div class="align-items-center" style="text-align: center">
        <button type="submit" style="text-align: center" >تقديم الطلب</button>
       </div>
       </div>
    </form>

    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
            async defer></script>

        <script>

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 24.7136, lng: 46.6753}, // مركز الخريطة على السعودية
                zoom: 8
            });

            var marker;

            // إضافة حدث النقر على الخريطة لتحديد الموقع
            map.addListener('click', function(e) {
                placeMarkerAndPanTo(e.latLng, map);
            });

            function placeMarkerAndPanTo(latLng, map) {
                if (marker) {
                    marker.setPosition(latLng);
                } else {
                    marker = new google.maps.Marker({
                        position: latLng,
                        map: map
                    });
                }

                // تخزين إحداثيات خطوط الطول والعرض في الحقول المخفية
                document.getElementById('length_step').value = latLng.lat();
                document.getElementById('width_step').value = latLng.lng();
            }
        }
    </script>

@endsection
