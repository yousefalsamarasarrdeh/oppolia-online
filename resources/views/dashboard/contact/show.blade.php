@extends('layouts.Dashboard.mainlayout')

@section('title', 'تفاصيل رسالة اتصل بنا')

@section('content')

    @php
        // تنظيف الرقم: أرقام فقط
        $rawPhone = $contact->phone ?? '';
        $digits   = preg_replace('/\D+/', '', $rawPhone);

        // محاولة توليد رقم دولي بسيط +XXXXXXXX (تقدر تعدّل حسب دولتك)
        $intlPhone = $digits ? ('+' . ltrim($digits, '0')) : '';

        // نص الرسالة الافتراضي
        $mailSubject = 'رد على رسالتك من موقعنا';
        $mailBody    = "مرحباً {$contact->name},\n\nشكراً لتواصلك معنا. سنقوم بالرد عليك في أقرب وقت ممكن.\n\nتحياتنا";

        // روابط أساسية
        $telHref     = $intlPhone ? "tel:{$intlPhone}" : null;
        $mailtoHref  = $contact->email
            ? 'mailto:' . $contact->email
              . '?subject=' . rawurlencode($mailSubject)
              . '&body='    . rawurlencode($mailBody)
            : null;

        // بدائل ويب (تعمل بالمتصفح)
        $gmailCompose = $contact->email
            ? 'https://mail.google.com/mail/?view=cm&to=' . rawurlencode($contact->email)
              . '&su=' . rawurlencode($mailSubject)
              . '&body=' . rawurlencode($mailBody)
            : null;

        $whatsAppUrl = $intlPhone
            ? 'https://wa.me/' . ltrim($intlPhone, '+')
            : null;
    @endphp

    <div class="container mt-5" dir="rtl">
        <h2 class="mb-4">تفاصيل الرسالة</h2>

        <div class="card p-4">
            <div class="mb-3">
                <strong>الاسم الكامل:</strong>
                <p>{{ $contact->name }}</p>
            </div>

            <div class="mb-3">
                <strong>البريد الإلكتروني:</strong>
                <p>{{ $contact->email }}</p>
            </div>

            <div class="mb-3">
                <strong>رقم الهاتف:</strong>
                <p>{{ $contact->phone ?? '-' }}</p>
            </div>

            <div class="mb-3">
                <strong>المدينة:</strong>
                <p>{{ $contact->subRegion->name_ar ?? '-' }}</p>
            </div>

            <div class="mb-3">
                <strong>نص الرسالة:</strong>
                <div class="alert alert-light border">
                    {{ $contact->message }}
                </div>
            </div>

            <div class="mb-3">
                <strong>تاريخ الإرسال:</strong>
                <p>{{ $contact->created_at->format('Y-m-d H:i') }}</p>
            </div>

            <div class="mt-4 d-flex justify-content-start gap-2">

                @if($telHref)
                    <a href="{{ $telHref }}" class="btn btn-success" role="button">
                         اتصال
                    </a>
                    {{-- بديل واتساب في حال ما اشتغل tel --}}
                    <a href="{{ $whatsAppUrl }}" target="_blank" rel="noopener" class="btn btn-outline-success">
                        واتساب
                    </a>
                @endif

                {{-- رد عبر البريد --}}
                @if($mailtoHref)
                    <a href="{{ $mailtoHref }}" class="btn btn-primary" role="button">
                         رد عبر البريد
                    </a>
                    {{-- بديل Gmail ويب في حال ما اشتغل mailto --}}
                    <a href="{{ $gmailCompose }}" target="_blank" rel="noopener" class="btn btn-outline-primary">
                        فتح في Gmail
                    </a>
                @endif
                {{-- زر يفتح مودال التأكيد --}}


                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSingleModal">
                    حذف
                </button>
            </div>
        </div>
    </div>

    {{-- Modal تأكيد الحذف (بدون JS مخصص) --}}
    <div class="modal fade" id="deleteSingleModal" tabindex="-1" aria-labelledby="deleteSingleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSingleLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    هل تريد بالتأكيد حذف هذه الرسالة؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form action="{{ route('dashboard.contact_us.delete', $contact->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">نعم، حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- لا تستخدم SweetAlert هنا. يكفي سكربتات Bootstrap الأساسية المضمنة في لياوتك --}}
@endsection
