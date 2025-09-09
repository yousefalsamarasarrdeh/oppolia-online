@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة رسائل اتصل بنا')

@section('css')
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">

    <style>
        .status-unread {
            background-color: #d0e7ff; /* لون أزرق فاتح */
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
        <h1>تواصل معنا</h1>

        <div style="overflow-x: auto; width: 100%;">
            <table class="table datatable">
                <thead>
                <tr>
                    <th>رقم التعريف</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>رقم الهاتف</th>
                    <th>المدينة</th>
                    <th>الرسالة</th>
                    <th>الإجراءات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($contacts as $contact)
                    <tr class="{{ ($contact->status ?? '') === 'unread' ? 'status-unread' : '' }}">
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->subRegion->name_ar ?? '-' }}</td>
                        <td>{{ Str::limit($contact->message, 40) }}</td>
                        <td class="text-nowrap">
                            {{-- عرض --}}
                            <a href="{{ route('dashboard.contact_us.show', $contact->id) }}"
                               class="btn p-0 border-0 bg-transparent" title="عرض">
                                <img class="action-icon" src="{{ asset('Dashboard/assets/images/view.png') }}" alt="عرض">
                            </a>

                            {{-- حذف عبر Modal بدون JS مخصص --}}
                            <button type="button"
                                    class="btn border-0 bg-transparent"
                                    title="حذف"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $contact->id }}">
                                <img class="action-icon" src="{{ asset('Dashboard/assets/images/delete.png') }}" alt="حذف">
                            </button>

                            {{-- مودال تأكيد الحذف لكل سطر --}}
                            <div class="modal fade" id="deleteModal{{ $contact->id }}" tabindex="-1"
                                 aria-labelledby="deleteLabel{{ $contact->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteLabel{{ $contact->id }}">تأكيد الحذف</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                                        </div>
                                        <div class="modal-body" style="text-align: start;">
                                            هل تريد بالتأكيد حذف هذه الرسالة؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                            <form action="{{ route('dashboard.contact_us.delete', $contact->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">نعم، حذف</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- نهاية المودال --}}
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

    {{-- لا يوجد SweetAlert أو JS مخصص؛ الاعتماد فقط على Bootstrap Modal --}}
@endsection
