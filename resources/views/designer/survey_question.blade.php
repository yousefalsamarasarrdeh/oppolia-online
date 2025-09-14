@extends('layouts.designer.mainlayout')

@section('title', 'استبيان الطلب')

@section('content')

    <style>
        .form-check-input:checked {
            background-color: #0A4740;
            border-color: #0A4740;
        }
    </style>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            <strong>خطأ:</strong> {{ session('error') }}
        </div>
    @endif

    <div class="pagetitle" dir="rtl">
        <h1>استبيان الطلب رقم #{{ $order->id }}</h1>
    </div>

    <section class="section dashboard" dir="rtl">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-4">

                        <!-- معلومات الطلب -->
                        <p><strong>اسم المستخدم:</strong> {{ $order->user->name }}</p>
                        <p><strong>رقم الهاتف:</strong> {{ $order->user->phone }}</p>
                        <p><strong>شكل المطبخ:</strong> {{ $order->kitchen_shape }}</p>
                        <p><strong>مرحلة المعالجة:</strong> {{ $order->processing_stage }}</p>

                        <!-- نموذج الاستبيان -->
                        <form method="POST" action="{{ route('designer.order.survey.store', ['order' => $order->id]) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- كيف علمت -->
                                <div class="mb-3 col-md-6">
                                    <label for="hear_about_oppolia" class="form-label">كيف علمت عن اوبوليا اونلاين؟</label>
                                    <select class="form-select" id="hear_about_oppolia" name="hear_about_oppolia">
                                        @foreach(['إعلانات','مراجعات العملاء','وسائل التواصل الاجتماعي','أصدقاء أو عائلة','محركات البحث','أخرى'] as $opt)
                                            <option value="{{ $opt }}" {{ old('hear_about_oppolia', $order->hear_about_oppolia ?? '') === $opt ? 'selected' : '' }}>
                                                {{ $opt }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- وقت التسليم -->
                                <div class="mb-3 col-md-6">
                                    <label for="expected_delivery_time" class="form-label">وقت التسليم المتوقع؟</label>
                                    <input min="{{ now()->format('Y-m-d') }}" type="date" class="form-control" id="expected_delivery_time" name="expected_delivery_time"
                                           value="{{ old('expected_delivery_time', optional($order->expected_delivery_time ?? null)->format('Y-m-d')) }}">
                                </div>

                                <!-- الميزانية -->
                                <div class="mb-3 col-md-6">
                                    <label for="client_budget" class="form-label">ما هي ميزانية الزبون؟</label>
                                    <input type="number" class="form-control" id="client_budget" name="client_budget"
                                           value="{{ old('client_budget', $order->client_budget ?? '') }}">
                                </div>

                                <!-- أبعاد المطبخ -->
                                <div class="mb-3 col-md-6">
                                    <label for="kitchen_room_size" class="form-label">ما هي أبعاد المطبخ المطلوب تصميمه؟</label>
                                    <input type="text" class="form-control" id="kitchen_room_size" name="kitchen_room_size"
                                           value="{{ old('kitchen_room_size', $order->kitchen_room_size ?? '') }}">
                                </div>

                                <!-- نوع المطبخ -->
                                <div class="mb-3 col-md-6">
                                    <label for="kitchen_style_preference" class="form-label">نوع المطبخ</label>
                                    <select class="form-select" id="kitchen_style_preference" name="kitchen_style_preference">
                                        @foreach(['حديث','تقليدي','ريفي','معدني','مفتوح','آخر'] as $opt)
                                            <option value="{{ $opt }}" {{ old('kitchen_style_preference', $order->kitchen_style_preference ?? '') === $opt ? 'selected' : '' }}>
                                                {{ $opt }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- المغسلة -->
                                <div class="mb-3 col-md-6">
                                    <label for="sink_type" class="form-label">نوع المغسلة</label>
                                    <select class="form-select" id="sink_type" name="sink_type">
                                        @foreach(['مغسلة فردية','مغسلة مزدوجة','مغسلة بقاعدة','على سطح الطاولة','تحت سطح الطاولة','مغسلة زاوية','آخر'] as $opt)
                                            <option value="{{ $opt }}" {{ old('sink_type', $order->sink_type ?? '') === $opt ? 'selected' : '' }}>
                                                {{ $opt }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- الكاونتر -->
                                <div class="mb-3 col-md-6">
                                    <label for="worktop_preference" class="form-label">نوع الكاونتر</label>
                                    <select class="form-select" id="worktop_preference" name="worktop_preference">
                                        @foreach(['رخام','غرانيت','خشب','كوارتز','فولاذ مقاوم للصدأ','زجاج','آخر'] as $opt)
                                            <option value="{{ $opt }}" {{ old('worktop_preference', $order->worktop_preference ?? '') === $opt ? 'selected' : '' }}>
                                                {{ $opt }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- احتمال الصفقة -->
                                <div class="mb-3 col-md-6">
                                    <label for="deal_closing_likelihood" class="form-label">احتمالية إتمام الصفقة (1-10)</label>
                                    <input type="number" class="form-control" name="deal_closing_likelihood" min="1" max="10"
                                           value="{{ old('deal_closing_likelihood', $order->deal_closing_likelihood ?? '') }}">
                                </div>

                                <!-- التذكير -->
                                <div class="mb-3 col-md-6">
                                    <label for="reminder_details" class="form-label">تاريخ التذكير</label>
                                    <input min="{{ now()->format('Y-m-d\TH:i') }}" type="datetime-local" class="form-control" id="reminder_details" name="reminder_details"
                                           value="{{ old('reminder_details', optional($order->reminder_details ?? null)->format('Y-m-d\TH:i')) }}">
                                </div>

                                <!-- الاستخدام والأجهزة -->
                                <div class="col-12">
                                    <!-- استخدام المطبخ -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold mb-3">استخدام المطبخ</label>
                                        <div class="row g-3">
                                            @php $oldUses = old('kitchen_use', $order->kitchen_use ?? []); @endphp
                                            @foreach(['الطهي','الاستضافة','التخزين','الترفيه'] as $use)
                                                <div class="col-6 col-md-3">
                                                    <div class="card p-2 border">
                                                        <div class="form-check d-flex align-items-center gap-2 m-0 p-2">
                                                            <input type="checkbox" class="form-check-input m-0"
                                                                   id="use_{{ $loop->index }}" name="kitchen_use[]" value="{{ $use }}"
                                                                {{ in_array($use, (array) $oldUses, true) ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-medium m-0" for="use_{{ $loop->index }}">{{ $use }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- المستلزمات -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold mb-3">المستلزمات المطلوبة</label>
                                        <div class="row g-3">
                                            @php $oldAppliances = old('appliances_needed', $order->appliances_needed ?? []); @endphp
                                            @foreach(['ميكروويف','غسالة صحون','ثلاجة','غسالة ملابس','محمصة خبز','خلاط','آخر'] as $item)
                                                <div class="col-6 col-md-3">
                                                    <div class="card p-2 border">
                                                        <div class="form-check d-flex align-items-center gap-2 m-0 p-2">
                                                            <input type="checkbox" class="form-check-input m-0"
                                                                   id="appliance_{{ $loop->index }}" name="appliances_needed[]" value="{{ $item }}"
                                                                {{ in_array($item, (array) $oldAppliances, true) ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-medium m-0" for="appliance_{{ $loop->index }}">{{ $item }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- ملاحظات -->
                                <div class="mb-3">
                                    <label class="form-label">معلومات عامة عن الزبون والموقع</label>
                                    <textarea name="general_info" class="form-control" rows="3">{{ old('general_info', $order->general_info ?? '') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">استفسارات الزبون</label>
                                    <textarea name="customer_concerns" class="form-control" rows="3">{{ old('customer_concerns', $order->customer_concerns ?? '') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">الخطوات القادمة</label>
                                    <textarea name="next_steps_strategy" class="form-control" rows="3">{{ old('next_steps_strategy', $order->next_steps_strategy ?? '') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">رفع صور القياسات</label>
                                    <input type="file" class="form-control" name="measurements_images[]" multiple required>
                                    @error('measurements_images')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- زر الإرسال -->
                            <div class="text-center m-2">
                                <button type="submit" class="btn text-white px-5 py-2 button_Green">حفظ الاستبيان</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        document.getElementById('expected_delivery_time').addEventListener('focus', function() {
            this.showPicker(); // مدعومة بكروم وإيدج فقط
        });
        document.getElementById('reminder_details').addEventListener('focus', function() {
            this.showPicker(); // مدعومة بكروم وإيدج فقط
        });
    </script>
@endsection
