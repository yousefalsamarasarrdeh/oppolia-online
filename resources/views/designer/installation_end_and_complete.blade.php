@extends('layouts.designer.mainlayout')

@section('title', 'إنهاء التركيب وإتمام الطلب')

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
                <h4>إنهاء التركيب وإتمام الطلب</h4>
            </div>
            <div class="card-body">
                <p class="alert alert-info">
                    <strong>🎉 تم الانتهاء من التركيب بنجاح!</strong>
                    قم بتأكيد إنهاء الطلب حتى يتم تحديث حالته إلى "مكتمل".
                </p>

                <form id="completionForm" action="{{ route('installation.complete', ['order' => $order->id]) }}" method="POST">
                @csrf

                <!-- عرض رقم الطلب كـ Label فقط -->
                    <div class="form-group mb-3">
                        <label>رقم الطلب: <strong>{{ $order->id }}</strong></label>
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                    </div>

                    <!-- تأكيد انتهاء التركيب -->
                    <div class="form-group mb-3">
                        <label>هل تم إنهاء التركيب بنجاح؟</label>
                        <div class="form-check">
                            <input type="checkbox" id="installation_completed" name="installation_completed" class="form-check-input" value="yes">
                            <label class="form-check-label" for="installation_completed">نعم، تم الانتهاء</label>
                        </div>
                    </div>

                    <button type="button" class="btn button_Green" data-bs-toggle="modal" data-bs-target="#confirmationModal">
                        تأكيد إنهاء التركيب
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
                    <h5 class="modal-title" id="confirmationModalLabel">تأكيد إنهاء التركيب</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <p>أنت على وشك تأكيد انتهاء التركيب، هل أنت متأكد من ذلك؟</p>
                    <p class="text-success"><strong>✅ تأكد من فحص جميع التفاصيل قبل إنهاء الطلب.</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn button_Green" id="confirmCompletionSubmit">تأكيد إنهاء التركيب</button>
                </div>
            </div>
        </div>
    </div>

    <!-- إضافة Bootstrap JS لتحكم بالمودال -->
    <script>
        document.getElementById('confirmCompletionSubmit').addEventListener('click', function () {
            document.getElementById('completionForm').submit();
        });
    </script>

@endsection
