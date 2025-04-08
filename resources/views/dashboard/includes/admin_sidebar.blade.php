<aside id="sidebar" class="sidebar">

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
        </li><!-- نهاية قسم المستخدمين -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>الفئات</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="bi bi-circle"></i><span>عرض جميع الفئات</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.categories.create')}}">
                        <i class="bi bi-circle"></i><span>إضافة فئة جديدة</span>
                    </a>
                </li>
            </ul>
        </li><!-- نهاية قسم الفئات -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>المنتجات</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.products.index') }}">
                        <i class="bi bi-circle"></i><span>عرض جميع المنتجات</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.products.create')}}">
                        <i class="bi bi-circle"></i><span>إضافة منتج جديد</span>
                    </a>
                </li>
            </ul>
        </li><!-- نهاية قسم المنتجات -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.regions')}}">
                <i class="bi bi-card-list"></i>
                <span>المناطق</span>
            </a>
        </li><!-- نهاية المناطق -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.joinasdesigner.index')}}">
                <i class="bi bi-card-list"></i>
                <span>انضم كمصمم</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.orders.index') }}">
                <i class="bi bi-card-list"></i>
                <span>الطلبات</span>
                @if(isset($orderCount) && $orderCount > 0)
                    <span class="badge bg-primary ms-2">{{ $orderCount }}</span> <!-- عرض عدد الطلبات فقط إذا كان أكبر من صفر -->
                @endif
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('dashboard.sales.index')}}">
                <i class="bi bi-card-list"></i>
                <span>المبيعات </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('dashboard.contact_us.index')}}">
                <i class="bi bi-card-list"></i>
                <span>تواصل معنا</span>
            </a>
        </li>

    </ul>

</aside><!-- نهاية القائمة الجانبية -->
