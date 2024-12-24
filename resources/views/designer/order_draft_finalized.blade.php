@extends('layouts.designer.mainlayout')
@section('title', 'المسودات المعتمدة للطلب')
@section('content')
    <div class="container" dir="rtl">
        <h2>المسودات المعتمدة للطلب #{{ $order->id }}</h2>
        @if($approvedDrafts->isEmpty())
            <p>لا توجد مسودات معتمدة لهذا الطلب.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>السعر</th>
                    <th>الصور</th>
                    <th>PDF</th>
                </tr>
                </thead>
                <tbody>
                @foreach($approvedDrafts as $draft)
                    <tr>
                        <td>{{ $draft->price }}</td>
                        <td>
                            @foreach(json_decode($draft->images) as $image)
                                <img src="{{ asset('storage/'.$image) }}" alt="صورة" style="width: 100px;">
                            @endforeach
                        </td>
                        <td><a href="{{ asset('storage/'.$draft->pdf) }}" target="_blank">تحميل PDF</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="container" dir="rtl">
        <h2>إنشاء مسودة طلب نهائية</h2>
        <form action="{{ route('designer.order_draft_finalized.store', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="price">السعر</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="images">رفع الصور</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple required>
            </div>
            <div class="form-group">
                <label for="pdf">رفع PDF</label>
                <input type="file" name="pdf" id="pdf" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="state">الحالة</label>
                <select name="state" id="state" class="form-control" required>
                    <option value="finalized">نهائي</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">إرسال</button>
        </form>
    </div>
@endsection
