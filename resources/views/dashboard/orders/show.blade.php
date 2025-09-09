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
        .accordion-button::after {
            margin-left: 0;          /* إزالة الهامش الأيسر */
            margin-right: auto;      /* دفع السهم إلى اليمين */
            content: url('/Dashboard/assets/images/Add.svg');
            background-image: none !important; /* Remove Bootstrap arrow */
        }
        .accordion-item {
            margin-bottom: 10px;
        }
        .accordion-button {
            background-color: white;
            color: rgba(28, 28, 28, 1);
        }
        .accordion-button:not(.collapsed) {

            background-color: rgba(0, 0, 0, 0.13);
            color: black;
        }
        .accordion-button[aria-expanded="true"]::after {
            content: url('/Dashboard/assets/images/Minus.svg'); /* - icon */
        }
        .accordion-body {
            background-color: #f8f9fa;
        }
        .order-info, .user-info, .designer-info, .survey-questions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .order-info p, .user-info p, .designer-info p, .survey-questions p {
            flex: 1 1 30%;
            padding: 10px;
            border-radius: 21.33px;
            background: var(--Primary-Color, #509F96);
            justify-items: center;
            color: white;
        }
        .order-info p strong, .user-info p strong, .designer-info p strong, .survey-questions p strong {
            display: block;
            margin-bottom: 5px;
        }
        .badge.bg-purple {
            background-color: #6f42c1 !important;
            color: white !important;
        }

        .img-thumbnail {
            transition: transform 0.2s;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(80, 159, 150, 0.1);
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

        <div class="accordion" id="orderAccordion">
            <!-- تفاصيل الطلب -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        تفاصيل الطلب
                    </button>
                </h2>
                <div id="collapseOne" class="collapse accordion-collapse show" aria-labelledby="headingOne" data-bs-parent="#orderAccordion">
                    <div class="accordion-body">
                        <div class="order-info">
                            <p class="text-center">رقم الطلب <strong>{{ $order->id }} </strong></p>
                            <p class="text-center">مساحة المطبخ <strong>{{ $order->kitchen_area }} متر مربع  </strong></p>
                            <p class="text-center">شكل المطبخ<strong>{{ $order->kitchen_shape }} </strong></p>
                            <p class="text-center">التكلفة المتوقعة <strong>{{ $order->expected_cost }} SAR </strong></p>
                            <p class="text-center">حالة الطلب
                                <strong>
                                    @switch($order->order_status)
                                        @case('accepted')
                                        مقبول
                                        @break
                                        @case('rejected')
                                        مرفوض
                                        @break
                                        @case('closed')
                                        مغلق
                                        @break
                                        @case('pending')
                                        قيد الانتظار
                                        @break
                                        @default
                                        غير معروف
                                    @endswitch
                                </strong>
                            </p>
                            <p class="text-center">منطقة الطلب <strong>{{ $order->region->name_ar}} </strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- تفاصيل العميل -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        تفاصيل العميل
                    </button>
                </h2>
                <div id="collapseTwo" class="collapse accordion-collapse" aria-labelledby="headingTwo" data-bs-parent="#orderAccordion">
                    <div class="accordion-body">
                        <div class="user-info">
                            <p class="text-center">الاسم <strong>{{ $order->user->name }} </strong></p>
                            <p class="text-center">البريد الإلكتروني <strong>{{ $order->user->email }} </strong></p>
                            <p class="text-center">رقم الهاتف <strong>{{ $order->user->phone }} </strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- تفاصيل زيارة المصمم -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        تفاصيل زيارة المصمم
                    </button>
                </h2>
                <div id="collapseThree" class="collapse accordion-collapse" aria-labelledby="headingThree" data-bs-parent="#orderAccordion">
                    <div class="accordion-body">
                        <div class="designer-info">
                            @isset($order->approved_designer_id)
                                <p class="text-center">اسم المصمم<strong>{{ $order->designer->user->name }} </strong> </p>

                                @if ($order->designerMeeting)
                                    <p class="text-center">تاريخ الزيارة <strong>{{ $order->designerMeeting->meeting_time }} </strong></p>
                                @else
                                    <p class="text-center">لم يتم تحديد موعد زيارة المصمم بعد.</p>
                                @endif
                            @endisset
                        </div>
                    </div>
                </div>
            </div>

            <!-- أسئلة الاستبيان -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        أسئلة الاستبيان
                    </button>
                </h2>
                <div id="collapseFour" class="collapse accordion-collapse" aria-labelledby="headingFour" data-bs-parent="#orderAccordion">
                    <div id="collapseFour" class="collapse accordion-collapse" aria-labelledby="headingFour" data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                            <div class="survey-questions">
                                @if ($order->surveyQuestion)
                                    <p class="text-center">كيف علمت عن اوبوليا اونلاين؟ <strong>{{ $order->surveyQuestion->hear_about_oppolia }}</strong></p>
                                    <p class="text-center">متى التاريخ المتوقع للتوصيل؟ <strong>{{ $order->surveyQuestion->expected_delivery_time }}</strong></p>
                                    <p class="text-center">ما هي ميزانية الزبون؟ <strong>SAR{{ $order->surveyQuestion->client_budget }}</strong></p>
                                    <p class="text-center">ما هي أبعاد المطبخ المطلوب تصميمه؟ <strong>{{ $order->surveyQuestion->kitchen_room_size }} متر مربع</strong></p>
                                    <p class="text-center">ما هو مغزى المطبخ؟ <strong>{{ $order->surveyQuestion->kitchen_use }}</strong></p>
                                    <p class="text-center">ما هو نوع المطبخ الذي طلبه الزبون؟ <strong>{{ $order->surveyQuestion->kitchen_style_preference }}</strong></p>
                                    <p class="text-center">ما هي المستلزمات اللازمة للزبون؟ <strong>{{ $order->surveyQuestion->appliances_needed }}</strong></p>
                                    <p class="text-center">ما هو نوع المغسلة التي طلبها الزبون؟ <strong>{{ $order->surveyQuestion->sink_type }}</strong></p>
                                    <p class="text-center">ما نوع الكاونتر التي طلبها الزبون؟ <strong>{{ $order->surveyQuestion->worktop_preference }}</strong></p>
                                    <p class="text-center">معلومات عامة عن مكان العمل, المنزل, الزبون, الأمور المالية, الأمور العائلية؟ <strong>{{ $order->surveyQuestion->general_info }}</strong></p>
                                    <p class="text-center">أي سؤال أو استفسار تم توجيهه من الزبون؟ <strong>{{ $order->surveyQuestion->customer_concerns }}</strong></p>
                                    <p class="text-center">الخطوات القادمة و مخططاتك؟ <strong>{{ $order->surveyQuestion->next_steps_strategy }}</strong></p>
                                    <p class="text-center">تفاصيل التذكير <strong>{{ $order->surveyQuestion->reminder_details }}</strong></p>
                                    <p class="text-center">احتمالية إغلاق الصفقة <strong>{{ $order->surveyQuestion->deal_closing_likelihood }}</strong></p>

                            </div>
                            @if(!empty($order->surveyQuestion->measurements_images))
                                <ul style="list-style: none; padding: 0; text-align: center; gap: 10px; flex-wrap: wrap;">
                                    @foreach (json_decode($order->surveyQuestion->measurements_images, true) as $index => $imagePath)
                                        <li >
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#lightboxModal{{ $index }}">
                                                <img src="{{ asset('storage/' . $imagePath) }}"
                                                     alt="صورة المسودة"
                                                     class="img-thumbnail"
                                                     style="width: 400px; height: 400px; object-fit: cover; cursor: pointer;">
                                            </a>
                                        </li>

                                        <!-- Modal لكل صورة -->
                                        <div class="modal fade" id="lightboxModal{{ $index }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content bg-transparent border-0">
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/' . $imagePath) }}" class="img-fluid rounded shadow">
                                                    </div>
                                                    <div class="modal-footer justify-content-center border-0">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                            @else
                                <p>لا توجد صور تم تحميلها لهذا الطلب.</p>
                            @endif
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <!-- مسودات الطلب -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        مسودات الطلب
                    </button>
                </h2>
                <div id="collapseFive" class="collapse accordion-collapse" aria-labelledby="headingFive" data-bs-parent="#orderAccordion">
                    <div class="accordion-body">
                        @if ($order->orderDraft->count() > 0)
                            <div style="overflow-x: auto; width: 100%;">
                                <table class="table table-bordered table-hover"  style="min-width: 800px;">
                                    <thead class="thead-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="15%">السعر</th>
                                        <th width="30%">الصور</th>
                                        <th width="20%">PDF</th>
                                        <th width="15%">الحالة</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($order->orderDraft as $draft)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ number_format($draft->price, 2) }} ر.س</td>
                                            <td>
                                                @if (!empty($draft->images))
                                                    @php $images = json_decode($draft->images, true) ?? []; @endphp

                                                    <div class="d-flex flex-wrap gap-2">
                                                    @foreach ($images as $idx => $image)
                                                        <!-- Thumbnail يفتح المودال على الشريحة المناسبة -->
                                                            <a href="#"
                                                               class="d-inline-block"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#draftLightboxModal{{ $draft->id }}"
                                                               data-bs-slide-to="{{ $idx }}">
                                                                <img src="{{ asset('storage/' . $image) }}"
                                                                     alt="صورة المسودة"
                                                                     class="img-thumbnail"
                                                                     style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;">
                                                            </a>
                                                        @endforeach
                                                    </div>

                                                    <!-- Modal + Carousel لكل مسودة -->
                                                    <!-- Modal + Carousel لكل مسودة -->
                                                    <div class="modal fade" id="draftLightboxModal{{ $draft->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content bg-transparent border-0 shadow-none">
                                                                <div class="modal-body p-0 d-flex justify-content-center align-items-center">
                                                                    <div id="draftCarousel{{ $draft->id }}" class="carousel slide" data-bs-ride="false">
                                                                        <div class="carousel-inner">
                                                                            @foreach ($images as $i => $image)
                                                                                <div class="carousel-item {{ $i === 0 ? 'active' : '' }} text-center">
                                                                                    <img src="{{ asset('storage/' . $image) }}"
                                                                                         class="img-fluid rounded"
                                                                                         alt="صورة المسودة"
                                                                                         style="max-height: 85vh; object-fit: contain;">
                                                                                </div>
                                                                            @endforeach
                                                                        </div>

                                                                        <!-- أزرار التنقّل -->
                                                                        <button class="carousel-control-prev" type="button"
                                                                                data-bs-target="#draftCarousel{{ $draft->id }}" data-bs-slide="prev">
                                                                            <span class="carousel-control-prev-icon"></span>
                                                                            <span class="visually-hidden">السابق</span>
                                                                        </button>
                                                                        <button class="carousel-control-next" type="button"
                                                                                data-bs-target="#draftCarousel{{ $draft->id }}" data-bs-slide="next">
                                                                            <span class="carousel-control-next-icon"></span>
                                                                            <span class="visually-hidden">التالي</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <!-- زر الإغلاق أعلى اليمين -->
                                                                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @else
                                                    <span class="text-muted">لا توجد صور</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @if ($draft->pdf)
                                                    <a href="{{ asset('storage/' . $draft->pdf) }}"
                                                       target="_blank"
                                                       class="btn button_Green ">
                                                        <i class="fas fa-file-pdf"></i> عرض PDF
                                                    </a>
                                                @else
                                                    <span class="text-muted">لا يوجد ملف</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $stateClasses = [
                                                        'draft' => 'badge bg-secondary',
                                                        'finalized' => 'badge bg-success',
                                                        'approved' => 'badge bg-primary',
                                                        'rejected' => 'badge bg-danger',
                                                        'designer_changed' => 'badge bg-warning text-dark',
                                                        'redesign' => 'badge bg-info',
                                                        'modified' => 'badge bg-purple'
                                                    ];
                                                @endphp

                                                <span class="{{ $stateClasses[$draft->state] ?? 'badge bg-light text-dark' }}">
                        @switch($draft->state)
                                                        @case('draft') مسودة @break
                                                        @case('finalized') نهائي @break
                                                        @case('approved') معتمد @break
                                                        @case('rejected') مرفوض @break
                                                        @case('designer_changed') تعديل المصمم @break
                                                        @case('redesign') إعادة تصميم @break
                                                        @case('modified') معدل @break
                                                        @default غير معروف
                                                    @endswitch
                    </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>لا توجد مسودات لهذا الطلب.</p>
                        @endif
                    </div>
                </div>
            </div>

            @php
                $installments = $order->sale?->installments ?? collect();
            @endphp




            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                    <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        المبيعات
                    </button>
                </h2>

                    <div id="collapseSix" class="collapse accordion-collapse" aria-labelledby="headingSix" data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                            @if($installments->isNotEmpty())
                                <div class="mt-4">
                                    <h4>الدفعات  السابقة</h4>
                                    <div style="overflow-x: auto; width: 100%;">
                                        <table class="table table-bordered" style="min-width: 800px;">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>المبلغ</th>
                                                <th>النسبة</th>
                                                <th>تاريخ الاستحقاق</th>
                                                <th>الحالة</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($installments as $installment)
                                                <tr>
                                                    <td>{{ $installment->installment_number }}</td>
                                                    <td>{{ number_format($installment->installment_amount, 2) }}</td>
                                                    <td>{{ $installment->percentage }}%</td>
                                                    <td>{{ $installment->due_date }}</td>
                                                    <td> @switch($installment->status)
                                                            @case('pending')
                                                            <span class="badge bg-warning text-dark">قيد الانتظار</span>
                                                            @break

                                                            @case('paid')
                                                            <span class="badge bg-success">مدفوع</span>
                                                            @break

                                                            @case('overdue')
                                                            <span class="badge bg-danger">متأخر</span>
                                                            @break

                                                            @case('awaiting_customer_payment')
                                                            <span class="badge bg-info text-dark">بانتظار دفع العميل</span>
                                                            @break

                                                            @case('receipt_uploaded')
                                                            <span class="badge bg-primary">تم رفع الإيصال</span>
                                                            @break

                                                            @default
                                                            <span class="badge bg-secondary">{{ $installment->status }}</span>
                                                        @endswitch</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <p>لا توجد دفعات  حتى الآن.</p>
                            @endif
                        </div>
                    </div>

            </div>



        </div>

        <!-- عرض الخريطة -->
        <div id="map"></div>
    </div>
@endsection

@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initMap" async defer></script>
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


    <script>
        document.addEventListener('click', function (e) {
            const trigger = e.target.closest('[data-bs-target][data-bs-slide-to]');
            if (!trigger) return;

            const modalSelector = trigger.getAttribute('data-bs-target');
            const slideTo = parseInt(trigger.getAttribute('data-bs-slide-to'), 10);

            // عندما يُفتح المودال، نوجّه الكاروسيل إلى الشريحة المطلوبة
            const modalEl = document.querySelector(modalSelector);
            if (!modalEl) return;

            modalEl.addEventListener('shown.bs.modal', function onShown() {
                const carouselEl = modalEl.querySelector('.carousel');
                if (!carouselEl) return;
                const carousel = bootstrap.Carousel.getOrCreateInstance(carouselEl, { interval: false });
                carousel.to(slideTo);
                modalEl.removeEventListener('shown.bs.modal', onShown);
            }, { once: true });
        }, false);
    </script>
@endsection
