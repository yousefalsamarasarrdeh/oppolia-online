<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <!-- <a class="nav-link " href="index.html"> -->
            <img class="dashboard-icon" src="{{asset('Dashboard/assets/images/House.png') }}">
            <span class="dashboard-title">لوحة التحكم</span>
            </a>
        </li><!-- نهاية لوحة التحكم -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <img src="{{asset('Dashboard/assets/images/Users.png') }}" class="dashboard-icon"><span class="dashboard-title">المستخدمون</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.users.index.main') }}">
                        <i class="bi bi-circle text-black"></i><span class="dashboard-title">جميع المستخدمين</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.designers.index')}}">
                        <i class="bi bi-circle text-black"></i><span class="dashboard-title">المصممين</span>
                    </a>
                </li>
            </ul>
        </li><!-- نهاية قسم المستخدمين -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <img class="dashboard-icon" src="{{asset('Dashboard/assets/images/CirclesFour.png') }}"><span class="dashboard-title">الفئات</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="bi bi-circle text-black"></i><span class="dashboard-title">جميع الفئات</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.categories.create')}}">
                        <i class="bi bi-circle text-black"></i><span class="dashboard-title">إضافة فئة جديدة</span>
                    </a>
                </li>
            </ul>
        </li><!-- نهاية قسم الفئات -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <img class="dashboard-icon" src="{{asset('Dashboard/assets/images/Bathtub.png') }}"></i><span class="dashboard-title">المنتجات</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.products.index') }}">
                        <i class="bi bi-circle text-black"></i><span class="dashboard-title">جميع المنتجات</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.products.create')}}">
                        <i class="bi bi-circle text-black"></i><span class="dashboard-title">إضافة منتج جديد</span>
                    </a>
                </li>
            </ul>
        </li><!-- نهاية قسم المنتجات -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.regions')}}">
                <img class="dashboard-icon" src=" {{ asset('Dashboard/assets/images/Group.png') }}">
                <span class="dashboard-title">المناطق</span>
            </a>
        </li><!-- نهاية المناطق -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.joinasdesigner.index')}}">
                <img src="{{asset('Dashboard/assets/images/Handshake.png') }}" class="dashboard-icon">
                <span class="dashboard-title">انضم كمصمم</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.orders.index') }}">
                <img class="dashboard-icon" src="{{asset('Dashboard/assets/images/Bill.png') }}">
                <span class="dashboard-title">الطلبات</span>
                @if(isset($orderCount) && $orderCount > 0)
                    <span class="badge bg-primary ms-2">{{ $orderCount }}</span> <!-- عرض عدد الطلبات فقط إذا كان أكبر من صفر -->
                @endif
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('dashboard.sales.index')}}">
                <img class="dashboard-icon" src="{{asset('Dashboard/assets/images/Sales.png') }}">
                <span class="dashboard-title">المبيعات</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('dashboard.contact_us.index')}}">
                <img class="dashboard-icon" src="{{asset('Dashboard/assets/images/contact.png') }}">
                <span class="dashboard-title">تواصل معنا</span>
            </a>
        </li>

    </ul>

</aside><!-- نهاية القائمة الجانبية -->
