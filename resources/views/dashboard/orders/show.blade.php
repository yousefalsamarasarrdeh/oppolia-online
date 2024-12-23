@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة الطلبات')

@section('css')
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
    <style>
        /* تنسيق الخريطة */
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
@endsection

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($order->approved_designer_id == null && $order->orderDraft && $order->processing_stage =='change_designer')
        <p><strong>ملاحظة:</strong> العميل طلب تغيير المصمم.</p>

        <form action="{{ route('dashboard.orders.changeDesigner', $order->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="designer_id"><strong>اختر المصمم:</strong></label>
                <select name="designer_id" id="designer_id" class="form-control" required>
                    <option value="" disabled selected>اختر المصمم</option>
                    @foreach($designers as $designer)
                        @if($designer->user)
                            <option value="{{ $designer->id }}">{{ $designer->user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">تغيير المصمم</button>
        </form>
    @endif



    <div class="container" dir="rtl">
        <h1>تفاصيل الطلب</h1>

        <div class="order-info">
            <p><strong>رقم الطلب:</strong> {{ $order->id }}</p>
            <p><strong>مساحة المطبخ:</strong> {{ $order->kitchen_area }} متر مربع</p>
            <p><strong>شكل المطبخ:</strong> {{ $order->kitchen_shape }}</p>
            <p><strong>التكلفة المتوقعة:</strong> ${{ $order->expected_cost }}</p>
            <p><strong>حالة الطلب:</strong> {{ $order->order_status }}</p>

            <p><strong>منطقة الطلب :</strong> {{ $order->region->name_ar}}</p>
        </div>

        <div class="user-info">
            <h2>تفاصيل العميل</h2>
            <p><strong>الاسم:</strong> {{ $order->user->name }}</p>
            <p><strong>البريد الإلكتروني:</strong> {{ $order->user->email }}</p>
            <p><strong>رقم الهاتف:</strong> {{ $order->user->phone }}</p> <!-- تأكد من أن لديك حقل 'phone_number' في جدول المستخدم -->
        </div>

        <!-- عرض الخريطة -->
        <div id="map"></div>

        @php
            // الحصول على المصمم المرتبط بالمستخدم المسجل
            $designer = auth()->user()->designer;
        @endphp

        <div class="designer-info">
            @isset($order->approved_designer_id)
                <p><strong>اسم المصمم:</strong> {{ $order->designer->user->name }}</p>

            @if ($order->designerMeeting)
                <h2>تفاصيل زيارة المصمم</h2>
                <p><strong>اسم المصمم:</strong> {{ $order->designerMeeting->order->designer->user->name }}</p>
                <p><strong>تاريخ الزيارة:</strong> {{ $order->designerMeeting->meeting_time }}</p>
            @else
                <p>لم يتم تحديد موعد زيارة المصمم بعد.</p>
            @endif
            @endisset
        </div>

        <div class="survey-questions">
            @if ($order->surveyQuestion)
                <h2>أسئلة الاستبيان</h2>
                <p><strong>كيف علمت عن اوبوليا اونلاين؟ </strong> {{ $order->surveyQuestion->hear_about_oppolia }}</p>
                <p><strong>متى التاريخ المتوقع للتوصيل؟ </strong> {{ $order->surveyQuestion->expected_delivery_time }}</p>
                <p><strong>ما هي ميزانية الزبون؟ </strong>SAR{{ $order->surveyQuestion->client_budget }}</p>
                <p><strong>ما هي أبعاد المطبخ المطلوب تصميمه؟ </strong> {{ $order->surveyQuestion->kitchen_room_size }} متر مربع</p>
                <p><strong>ما هو مغزى المطبخ؟</strong> {{ $order->surveyQuestion->kitchen_use }}</p>
                <p><strong>ما هو نوع المطبخ الذي طلبه الزبون؟ </strong> {{ $order->surveyQuestion->kitchen_style_preference }}</p>
                <p><strong>ما هي المستلزمات اللازمة للزبون؟ </strong> {{ $order->surveyQuestion->appliances_needed }}</p>
                <p><strong>ما هو نوع المغسلة التي طلبها الزبون؟</strong> {{ $order->surveyQuestion->sink_type }}</p>
                <p><strong>ما نوع الكاونتر التي طلبها الزبون؟ </strong> {{ $order->surveyQuestion->worktop_preference }}</p>
                <p><strong>معلومات عامة عن مكان العمل, المنزل, الزبون, الأمور المالية, الأمور العائلية؟ </strong> {{ $order->surveyQuestion->general_info }}</p>
                <p><strong>أي سؤال أو استفسار تم توجيهه من الزبون؟ </strong> {{ $order->surveyQuestion->customer_concerns }}</p>
                <p><strong>الخطوات القادمة و مخططاتك؟ </strong> {{ $order->surveyQuestion->next_steps_strategy }}</p>
                <p><strong>تفاصيل التذكير:</strong> {{ $order->surveyQuestion->reminder_details }}</p>
                <p><strong>احتمالية إغلاق الصفقة:</strong> {{ $order->surveyQuestion->deal_closing_likelihood }}</p>

                @if(!empty($order->surveyQuestion->measurements_images))
                    <p><strong>صور القياسات:</strong></p>
                    <ul>
                        @foreach (json_decode($order->surveyQuestion->measurements_images, true) as $imagePath)
                            <li>
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="صورة القياس" style="max-width: 100px;">
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>لا توجد صور تم تحميلها لهذا الطلب.</p>
                @endif
            @endif
        </div>

    </div>

    @if ($order->orderDraft->count() > 0)
        <h2>مسودات الطلب</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>السعر</th>
                <th>الصور</th>
                <th>PDF</th>
                <th>الحالة</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($order->orderDraft as $draft)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $draft->price }}SAR</td>
                    <td>
                        @if (!empty($draft->images))
                            <ul>
                                @foreach (json_decode($draft->images, true) as $image)
                                    <li>
                                        <img src="{{ asset('storage/' . $image) }}" alt="صورة" style="max-width: 100px;">
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>لا توجد صور.</p>
                        @endif
                    </td>
                    <td>
                        @if ($draft->pdf)
                            <a href="{{ asset('storage/' . $draft->pdf) }}" target="_blank">عرض PDF</a>
                        @else
                            <p>لا يوجد ملف PDF.</p>
                        @endif
                    </td>
                    <td>{{ $draft->state }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else

        @endif
        </div>
@endsection

@section('script')

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXpR8r4gwAG_7XnPYERxSug_XqXxeVnGE&callback=initMap" async defer></script>

    <script>
        function initMap() {
            var lengthStep = {{ $order->length_step ?? 24.7136 }};
            var widthStep = {{ $order->width_step ?? 46.6753 }};
            var orderLocation = {lat: lengthStep, lng: widthStep};

            var map = new google.maps.Map(document.getElementById('map'), {
                center: orderLocation,
                zoom: 14
            });

            var marker = new google.maps.Marker({
                position: orderLocation,
                map: map
            });
        }
    </script>
@endsection
