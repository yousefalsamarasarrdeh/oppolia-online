

<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.users.index.main') }}">
                        <i class="bi bi-circle"></i><span>Show all Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.designers.index')}}">
                        <i class="bi bi-circle"></i><span>Show Designer</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Forms Nav -->



        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.orders.index') }}">
                <i class="bi bi-card-list"></i>
                <span>orders</span>
                @if(isset($orderCount) && $orderCount > 0)
                    <span class="badge bg-primary ms-2">{{ $orderCount }}</span> <!-- عرض عدد الطلبات فقط إذا كان أكبر من صفر -->
                @endif
            </a>
        </li>



    </ul>

</aside><!-- End Sidebar-->