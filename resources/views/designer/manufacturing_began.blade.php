@extends('layouts.designer.mainlayout')

@section('title', 'بدء التصنيع')

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

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>بدء التصنيع</h4>
            </div>
            <div class="card-body">
                <form id="manufactureForm" action="{{ route('manufacture.start', ['order' => $order->id]) }}" method="POST">
                @csrf

                <!-- عرض رقم الطلب كـ Label فقط -->
                    <div class="form-group mb-3">
                        <label>رقم الطلب: <strong>{{ $order->id }}</strong></label>
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                    </div>

                    <!-- سؤال هل تم بدء التصنيع؟ -->
                    <div class="form-group mb-3">
                        <label>هل تم بدء التصنيع؟</label>
                        <div class="form-check">
                            <input type="checkbox" id="manufacturing_started" name="manufacturing_started" class="form-check-input" value="yes">
                            <label class="form-check-label" for="manufacturing_started">نعم، تم</label>
                        </div>
                    </div>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmationModal">
                        إرسال
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- مودال التأكيد -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">تأكيد تعديل حالة الطلب</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <p>أنت على وشك تعديل حالة الطلب، هل أنت متأكد من ذلك؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-success" id="confirmSubmit">إرسال</button>
                </div>
            </div>
        </div>
    </div>

    <!-- إضافة Bootstrap JS لتحكم بالمودال -->
    <script>
        document.getElementById('confirmSubmit').addEventListener('click', function () {
            document.getElementById('manufactureForm').submit();
        });
    </script>

@endsection
