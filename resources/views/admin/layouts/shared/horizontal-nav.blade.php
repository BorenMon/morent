@php
    $user = Auth::user();
@endphp

<!-- ========== Horizontal Menu Start ========== -->
<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{ route('admin.dashboard') }}"
                            id="topnav-dashboards" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-dashboard-3-line"></i>Dashboards
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{ route('admin.bookings') }}" id="topnav-dashboards"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-draft-line"></i>Bookings
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{ route('admin.cars') }}" id="topnav-dashboards"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-roadster-line"></i>Cars
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{ route('admin.customers') }}" id="topnav-dashboards"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-group-2-line"></i>Customers
                        </a>
                    </li>
                    @can('manageStaffs', $user)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{ route('admin.staffs') }}" id="topnav-dashboards"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-group-line"></i>Staffs
                        </a>
                    </li>
                    @endcan
                    @if ($user->role == 'ADMIN')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-menu-line"></i>PickLists <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="{{ route('admin.car-brands') }}" class="dropdown-item">Car Brands</a>
                            <a href="{{ route('admin.car-types') }}" class="dropdown-item">Car Types</a>
                            <a href="{{ route('admin.car-steerings') }}" class="dropdown-item">Car Steerings</a>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ========== Horizontal Menu End ========== -->
