@extends('layouts.Dashboard.mainlayout')

@section('title', 'انضم كمصمم')

@section('css')
    {{-- DataTables CSS (اختياري) --}}
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">

    <style>
        .status-unread td {
            background-color: #7db8b1 !important; /* لون مميز للطلبات غير المقروءة */
        }
        .action-icon {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5" dir="rtl">
        <h1>طلبات الانضمام كمصمم</h1>

        <div style="overflow-x: auto; width: 100%;">
            <table class="table datatable">
                <thead>
                <tr>
                    <th>الرقم</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الهاتف</th>
                    <th>المدينة</th>
                    <th>الإجراءات</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($designerRequests as $request)
                    <tr class="{{ $request->status === 'unread' ? 'status-unread' : '' }}">
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->name }}</td>
                        <td>{{ $request->email_address }}</td>
                        <td>{{ $request->phone_number }}</td>
                        <td>{{ $request->subRegion->name_ar }}</td>

                        <td class="text-nowrap">
                            {{-- عرض --}}
                            <a href="{{ route('admin.joinasdesigner.show', $request->id) }}"
                               class="btn p-0 border-0 bg-transparent" title="عرض">
                                <img class="action-icon" src="{{ asset('Dashboard/assets/images/view.png') }}" alt="عرض">
                            </a>

                            {{-- حذف عبر Modal بدون JS مخصص --}}
                            <button type="button"
                                    class="btn border-0 bg-transparent"
                                    title="حذف"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $request->id }}">
                                <img class="action-icon" src="{{ asset('Dashboard/assets/images/delete.png') }}" alt="حذف">
                            </button>

                            {{-- المودال الخاص بكل صف --}}
                            <div class="modal fade" id="deleteModal{{ $request->id }}" tabindex="-1"
                                 aria-labelledby="deleteLabel{{ $request->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteLabel{{ $request->id }}">تأكيد الحذف</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                                        </div>
                                        <div class="modal-body" style="text-align: start;">
                                            هل تريد بالتأكيد الحذف  ؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                            <form action="{{ route('admin.joinasdesigner.delete', $request->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">نعم، حذف</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- نهاية مودال الصف --}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    {{-- DataTables JS (اختياري) --}}
    <script src="{{ asset('path/to/datatables.js') }}"></script>
    {{-- لا يوجد أي JS مخصص للحذف؛ الـ Modal يعتمد على Bootstrap فقط --}}
@endsection
