@extends('layouts.Dashboard.mainlayout')

@section('title', 'تفاصيل رسالة اتصل بنا')

@section('content')
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
