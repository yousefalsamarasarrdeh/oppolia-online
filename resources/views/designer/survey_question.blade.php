@extends('layouts.designer.mainlayout')

@section('title', 'استبيان الطلب')

@section('content')
    <div class="pagetitle" dir="rtl">
        <h1>استبيان الطلب رقم #{{ $order->id }}</h1>
    </div>

    <section class="section dashboard" dir="rtl">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">نموذج الاستبيان</h5>

                        <!-- معلومات الطلب -->
                        <p><strong>اسم المستخدم:</strong> {{ $order->user->name }}</p>
                        <p><strong>رقم الهاتف:</strong> {{ $order->user->phone }}</p>
                        <p><strong>شكل المطبخ:</strong> {{ $order->kitchen_shape }}</p>
                        <p><strong>مرحلة المعالجة:</strong> {{ $order->processing_stage }}</p>

                        <!-- نموذج الاستبيان -->
                        <form method="POST" action="{{ route('designer.order.survey.store', ['order' => $order->id]) }}" enctype="multipart/form-data">
                        @csrf

                        <!-- كيف سمعت عن أوبوليا؟ -->
                            <div class="mb-3">
                                <label for="hear_about_oppolia" class="form-label">كيف علمت عن اوبوليا اونلاين؟
                                </label>
                                <select class="form-select" id="hear_about_oppolia" name="hear_about_oppolia">

                                    <option value="إعلانات">إعلانات</option>
                                    <option value="مراجعات العملاء">مراجعات العملاء</option>
                                    <option value="وسائل التواصل الاجتماعي">وسائل التواصل الاجتماعي</option>
                                    <option value="أصدقاء أو عائلة">أصدقاء أو عائلة</option>
                                    <option value="محركات البحث">محركات البحث</option>
                                    <option value="أخرى">أخرى</option>
                                </select>
                            </div>

                            <!-- وقت التسليم المتوقع -->
                            <div class="mb-3">
                                <label for="expected_delivery_time" class="form-label">وقت التسليم المتوقع؟</label>
                                <input type="date" class="form-control" id="expected_delivery_time" name="expected_delivery_time">
                            </div>

                            <!-- ميزانية العميل -->
                            <div class="mb-3">
                                <label for="client_budget" class="form-label">ما هي ميزانية الزبون؟ </label>
                                <input type="number" class="form-control" id="client_budget" name="client_budget">
                            </div>

                            <!-- حجم المطبخ -->
                            <div class="mb-3">
                                <label for="kitchen_room_size" class="form-label">ما هي أبعاد المطبخ المطلوب تصميمه؟ </label>
                                <input type="text" class="form-control" id="kitchen_room_size" name="kitchen_room_size">
                            </div>

                            <!-- استخدام المطبخ -->
                            <div class="mb-3">
                                <label class="form-label">ما هو مغزى المطبخ؟</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="kitchen_use_1" name="kitchen_use[]" value="الطهي">
                                    <label class="form-check-label" for="kitchen_use_1">الطهي</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="kitchen_use_2" name="kitchen_use[]" value="الاستضافة">
                                    <label class="form-check-label" for="kitchen_use_2">الاستضافة</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="kitchen_use_3" name="kitchen_use[]" value="التخزين">
                                    <label class="form-check-label" for="kitchen_use_3">التخزين</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="kitchen_use_4" name="kitchen_use[]" value="الترفيه">
                                    <label class="form-check-label" for="kitchen_use_4">الترفيه</label>
                                </div>
                            </div>

                            <!-- النمط المفضل للمطبخ -->
                            <div class="mb-3">
                                <label for="kitchen_style_preference" class="form-label">ما هو نوع المطبخ الذي طلبه الزبون؟</label>
                                <select class="form-select" id="kitchen_style_preference" name="kitchen_style_preference">
                                    <option value="حديث">حديث</option>
                                    <option value="تقليدي">تقليدي</option>
                                    <option value="ريفي">ريفي</option>
                                    <option value="معدني">معدني</option>
                                    <option value="مفتوح">مفتوح</option>
                                    <option value="آخر">آخر</option>
                                </select>
                            </div>

                            <!-- الأجهزة المطلوبة -->
                            <div class="mb-3">
                                <label class="form-label">ما هي المستلزمات اللازمة للزبون؟</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="appliance_1" name="appliances_needed[]" value="ميكروويف">
                                    <label class="form-check-label" for="appliance_1">ميكروويف</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="appliance_2" name="appliances_needed[]" value="غسالة صحون">
                                    <label class="form-check-label" for="appliance_2">غسالة صحون</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="appliance_3" name="appliances_needed[]" value="ثلاجة">
                                    <label class="form-check-label" for="appliance_3">ثلاجة</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="appliance_4" name="appliances_needed[]" value="غسالة ملابس">
                                    <label class="form-check-label" for="appliance_4">غسالة ملابس</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="appliance_5" name="appliances_needed[]" value="محمصة خبز">
                                    <label class="form-check-label" for="appliance_5">محمصة خبز</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="appliance_6" name="appliances_needed[]" value="خلاط">
                                    <label class="form-check-label" for="appliance_6">خلاط</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="appliance_7" name="appliances_needed[]" value="آخر">
                                    <label class="form-check-label" for="appliance_7">آخر</label>
                                </div>
                            </div>


                            <!-- نوع الحوض -->
                            <div class="mb-3">
                                <label for="sink_type" class="form-label">ما هو نوع المغسلة التي طلبها الزبون؟</label>
                                <select class="form-select" id="sink_type" name="sink_type">
                                    <option value="مغسلة فردية">مغسلة فردية</option>
                                    <option value="مغسلة مزدوجة">مغسلة مزدوجة</option>
                                    <option value="مغسلة بقاعدة">مغسلة بقاعدة</option>
                                    <option value="مغسلة على سطح الطاولة">مغسلة على سطح الطاولة</option>
                                    <option value="مغسلة تحت سطح الطاولة">مغسلة تحت سطح الطاولة</option>
                                    <option value="مغسلة زاوية">مغسلة زاوية</option>
                                    <option value="آخر">آخر</option>
                                </select>
                            </div>


                            <!-- نوع سطح العمل المفضل -->
                            <div class="mb-3">
                                <label for="worktop_preference" class="form-label">ما نوع الكاونتر التي طلبها الزبون؟</label>
                                <select class="form-select" id="worktop_preference" name="worktop_preference">
                                    <option value="رخام">رخام</option>
                                    <option value="غرانيت">غرانيت</option>
                                    <option value="خشب">خشب</option>
                                    <option value="كوارتز">كوارتز</option>
                                    <option value="فولاذ مقاوم للصدأ">فولاذ مقاوم للصدأ</option>
                                    <option value="زجاج">زجاج</option>
                                    <option value="آخر">آخر</option>
                                </select>
                            </div>


                            <!-- معلومات عامة عن الموقع والبناء -->
                            <div class="mb-3">
                                <label for="general_info" class="form-label">معلومات عامة عن مكان العمل, المنزل, الزبون, الأمور المالية, الأمور العائلية؟ </label>
                                <textarea class="form-control" id="general_info" name="general_info" rows="3"></textarea>
                            </div>

                            <!-- تساؤلات أو مخاوف العميل -->
                            <div class="mb-3">
                                <label for="customer_concerns" class="form-label">أي سؤال أو استفسار تم توجيهه من الزبون؟ </label>
                                <textarea class="form-control" id="customer_concerns" name="customer_concerns" rows="3"></textarea>
                            </div>

                            <!-- الخطوات التالية واستراتيجيتك -->
                            <div class="mb-3">
                                <label for="next_steps_strategy" class="form-label">الخطوات القادمة و مخططاتك؟ </label>
                                <textarea class="form-control" id="next_steps_strategy" name="next_steps_strategy" rows="3"></textarea>
                            </div>

                            <!-- تفاصيل التذكير -->
                            <div class="mb-3">
                                <label for="reminder_details" class="form-label">تاريخ التذكير</label>
                                <input type="datetime-local" class="form-control" id="reminder_details" name="reminder_details">
                            </div>

                            <!-- احتمالية إتمام الصفقة (1-10) -->
                            <div class="mb-3">
                                <label for="deal_closing_likelihood" class="form-label">ما حتمية انهاء هذا المشروع مع هذا الزبون بالتحديد؟ من 1 إلى 10</label>
                                <input type="number" class="form-control" id="deal_closing_likelihood" name="deal_closing_likelihood" min="1" max="10">
                            </div>

                            <!-- رفع صور القياسات -->
                            <div class="mb-3">
                                <label for="measurements_images" class="form-label">رفع صور القياسات</label>
                                <input type="file" class="form-control" name="measurements_images[]" id="measurements_images" multiple>
                            </div>

                            <!-- زر إرسال الاستبيان -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">إرسال الاستبيان</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
