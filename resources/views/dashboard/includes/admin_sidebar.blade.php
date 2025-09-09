<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- لوحة التحكم --}}
        <li class="nav-item" style="background-color: white">
            <a class="nav-link "style="background-color: white"
              >
                <img class="dashboard-icon" src="{{ asset('Dashboard/assets/images/House.png') }}">
                <span class="dashboard-title">لوحة التحكم</span>
            </a>
        </li><!-- نهاية لوحة التحكم -->

        {{-- المستخدمون --}}
        @php
            $isUsersSection = request()->routeIs([
                'admin.users.*',   // جميع المستخدمين (index/main)
                'users.*',         // صفحات التعديل/تحديث/حذف للمستخدم
                'admin.designers.*', // صفحة قائمة المصممين
                'designer.*'       // عرض/تعديل مصمم
            ]);
        @endphp

        <li class="nav-item">
            <a class="nav-link {{ $isUsersSection ? 'active' : 'collapsed' }}"
               data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <img src="{{ asset('Dashboard/assets/images/Users.png') }}" class="dashboard-icon">
                <span class="dashboard-title">المستخدمون</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="forms-nav" class="nav-content collapse {{ $isUsersSection ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.users.index.main') }}"
                       class="{{ request()->routeIs('admin.users.index.main') ? 'active' : '' }}">
                        <i class="bi bi-circle text-black"></i>
                        <span class="dashboard-title">جميع المستخدمين</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.designers.index') }}"
                       class="{{ request()->routeIs('admin.designers.index') ? 'active' : '' }}">
                        <i class="bi bi-circle text-black"></i>
                        <span class="dashboard-title">المصممين</span>
                    </a>
                </li>
            </ul>
        </li>


        {{-- الفئات --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : 'collapsed' }}"
               data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <img class="dashboard-icon" src="{{ asset('Dashboard/assets/images/CirclesFour.png') }}">
                <span class="dashboard-title">الفئات</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse {{ request()->routeIs('admin.categories.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                        <i class="bi bi-circle text-black"></i><span class="dashboard-title">جميع الفئات</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.create') }}" class="{{ request()->routeIs('admin.categories.create') ? 'active' : '' }}">
                        <i class="bi bi-circle text-black"></i><span class="dashboard-title">إضافة فئة جديدة</span>
                    </a>
                </li>
            </ul>
        </li><!-- نهاية قسم الفئات -->

        {{-- المنتجات --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : 'collapsed' }}"
               data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <img class="dashboard-icon" src="{{ asset('Dashboard/assets/images/Bathtub.png') }}">
                <span class="dashboard-title">المنتجات</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse {{ request()->routeIs('admin.products.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                        <i class="bi bi-circle text-black"></i><span class="dashboard-title">جميع المنتجات</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.create') }}" class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                        <i class="bi bi-circle text-black"></i><span class="dashboard-title">إضافة منتج جديد</span>
                    </a>
                </li>
            </ul>
        </li><!-- نهاية قسم المنتجات -->

        {{-- المناطق --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.regions') ? 'active' : 'collapsed' }}" href="{{ route('admin.regions') }}">
                <img class="dashboard-icon" src="{{ asset('Dashboard/assets/images/Group.png') }}">
                <span class="dashboard-title">المناطق</span>
            </a>
        </li><!-- نهاية المناطق -->

        {{-- انضم كمصمم --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.joinasdesigner.*') ? 'active' : 'collapsed' }}"
               href="{{ route('admin.joinasdesigner.index') }}">
                <img src="{{ asset('Dashboard/assets/images/Handshake.png') }}" class="dashboard-icon">
                <span class="dashboard-title">انضم كمصمم</span>
            </a>
        </li>

        {{-- الطلبات --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : 'collapsed' }}"
               href="{{ route('admin.orders.index') }}">
                <img class="dashboard-icon" src="{{ asset('Dashboard/assets/images/Bill.png') }}">
                <span class="dashboard-title">الطلبات</span>
                @if(isset($orderCount) && $orderCount > 0)
                    <span class="badge bg-primary ms-2">{{ $orderCount }}</span>
                @endif
            </a>
        </li>

        {{-- المبيعات --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard.sales.*') ? 'active' : 'collapsed' }}"
               href="{{ route('dashboard.sales.index') }}">
                <img class="dashboard-icon" src="{{ asset('Dashboard/assets/images/Sales.png') }}">
                <span class="dashboard-title">المبيعات</span>
            </a>
        </li>

        {{-- تواصل معنا --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard.contact_us.*') ? 'active' : 'collapsed' }}"
               href="{{ route('dashboard.contact_us.index') }}">
                <img class="dashboard-icon" src="{{ asset('Dashboard/assets/images/contact.png') }}">
                <span class="dashboard-title">تواصل معنا</span>
            </a>
        </li>

    </ul>

</aside><!-- نهاية القائمة الجانبية -->
