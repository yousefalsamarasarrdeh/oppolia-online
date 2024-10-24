@extends('layouts.designer.mainlayout')

@section('title', 'Survey for Order')

@section('content')
    <div class="pagetitle">
        <h1>Survey for Order #{{ $order->id }}</h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Survey Form</h5>

                        <!-- معلومات الطلب -->
                        <p><strong>User Name:</strong> {{ $order->user->name }}</p>
                        <p><strong>Phone Number:</strong> {{ $order->user->phone }}</p>
                        <p><strong>Kitchen Shape:</strong> {{ $order->kitchen_shape }}</p>
                        <p><strong>Processing Stage:</strong> {{ $order->processing_stage }}</p>

                        <!-- نموذج الاستبيان -->
                        <form method="POST" action="{{ route('designer.order.survey.store', ['order' => $order->id]) }}" enctype="multipart/form-data">
                        @csrf

                        <!-- كيف سمعت عن أوبوليا؟ -->
                            <div class="mb-3">
                                <label for="hear_about_oppolia" class="form-label">How did you hear about Oppolia?</label>
                                <input type="text" class="form-control" id="hear_about_oppolia" name="hear_about_oppolia">
                            </div>

                            <!-- وقت التسليم المتوقع -->
                            <div class="mb-3">
                                <label for="expected_delivery_time" class="form-label">Expected Delivery Time</label>
                                <input type="text" class="form-control" id="expected_delivery_time" name="expected_delivery_time">
                            </div>

                            <!-- ميزانية العميل -->
                            <div class="mb-3">
                                <label for="client_budget" class="form-label">Client Budget</label>
                                <input type="number" class="form-control" id="client_budget" name="client_budget">
                            </div>

                            <!-- حجم المطبخ -->
                            <div class="mb-3">
                                <label for="kitchen_room_size" class="form-label">Kitchen Room Size</label>
                                <input type="text" class="form-control" id="kitchen_room_size" name="kitchen_room_size">
                            </div>

                            <!-- استخدام المطبخ -->
                            <div class="mb-3">
                                <label for="kitchen_use" class="form-label">Kitchen Use</label>
                                <input type="text" class="form-control" id="kitchen_use" name="kitchen_use">
                            </div>

                            <!-- النمط المفضل للمطبخ -->
                            <div class="mb-3">
                                <label for="kitchen_style_preference" class="form-label">Preferred Kitchen Style</label>
                                <input type="text" class="form-control" id="kitchen_style_preference" name="kitchen_style_preference">
                            </div>

                            <!-- الأجهزة المطلوبة -->
                            <div class="mb-3">
                                <label for="appliances_needed" class="form-label">Appliances Needed</label>
                                <input type="text" class="form-control" id="appliances_needed" name="appliances_needed">
                            </div>

                            <!-- نوع الحوض -->
                            <div class="mb-3">
                                <label for="sink_type" class="form-label">Sink Type</label>
                                <input type="text" class="form-control" id="sink_type" name="sink_type">
                            </div>

                            <!-- نوع سطح العمل المفضل -->
                            <div class="mb-3">
                                <label for="worktop_preference" class="form-label">Preferred Worktop</label>
                                <input type="text" class="form-control" id="worktop_preference" name="worktop_preference">
                            </div>

                            <!-- معلومات عامة عن الموقع والبناء -->
                            <div class="mb-3">
                                <label for="general_info" class="form-label">General Info about Construction Site</label>
                                <textarea class="form-control" id="general_info" name="general_info" rows="3"></textarea>
                            </div>

                            <!-- تساؤلات أو مخاوف العميل -->
                            <div class="mb-3">
                                <label for="customer_concerns" class="form-label">Customer Concerns</label>
                                <textarea class="form-control" id="customer_concerns" name="customer_concerns" rows="3"></textarea>
                            </div>

                            <!-- الخطوات التالية واستراتيجيتك -->
                            <div class="mb-3">
                                <label for="next_steps_strategy" class="form-label">Next Steps & Strategy</label>
                                <textarea class="form-control" id="next_steps_strategy" name="next_steps_strategy" rows="3"></textarea>
                            </div>

                            <!-- تفاصيل التذكير -->
                            <div class="mb-3">
                                <label for="reminder_details" class="form-label">Reminder Details</label>
                                <input type="datetime-local" class="form-control" id="reminder_details" name="reminder_details">
                            </div>

                            <!-- احتمالية إتمام الصفقة (1-10) -->
                            <div class="mb-3">
                                <label for="deal_closing_likelihood" class="form-label">How likely are you to close the deal? (1-10)</label>
                                <input type="number" class="form-control" id="deal_closing_likelihood" name="deal_closing_likelihood" min="1" max="10">
                            </div>

                            <!-- رفع صور القياسات -->
                            <div class="mb-3">
                                <label for="measurements_images" class="form-label">Upload Measurement Images</label>
                                <input type="file" class="form-control" name="measurements_images[]" id="measurements_images" multiple>
                            </div>

                            <!-- زر إرسال الاستبيان -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Submit Survey</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
