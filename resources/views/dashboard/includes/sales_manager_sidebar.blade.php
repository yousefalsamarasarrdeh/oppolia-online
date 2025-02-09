<aside id="sidebar" class="sidebar" >

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>لوحة التحكم</span>
            </a>
        </li><!-- نهاية لوحة التحكم -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>المستخدمون</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.users.index.main') }}">
                        <i class="bi bi-circle"></i><span>عرض جميع المستخدمين</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.designers.index')}}">
                        <i class="bi bi-circle"></i><span>عرض المصممين</span>
                    </a>
                </li>
            </ul>
        </li><!-- نهاية قائمة المستخدمين -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.regions')}}">
                <i class="bi bi-card-list"></i>
                <span>المناطق</span>
            </a>
        </li><!-- نهاية قائمة المناطق -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.joinasdesigner.index')}}">
                <i class="bi bi-card-list"></i>
                <span>طلبات الانضمام كمصمم</span>
            </a>
        </li><!-- نهاية طلبات الانضمام كمصمم -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.orders.index') }}">
                <i class="bi bi-card-list"></i>
                <span>الطلبات</span>
                @if(isset($orderCount) && $orderCount > 0)
                    <span class="badge bg-primary ms-2">{{ $orderCount }}</span> <!-- عرض عدد الطلبات فقط إذا كان أكبر من صفر -->
                @endif
            </a>
        </li><!-- نهاية قائمة الطلبات -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('dashboard.sales.index')}}">
                <i class="bi bi-card-list"></i>
                <span>المبيعات </span>
            </a>
        </li>

    </ul>

</aside><!-- نهاية الشريط الجانبي -->
