<!DOCTYPE html>
<html lang="en" data-layout="topnav" data-menu-color="{{ $menuColor ?? 'light' }}"
    data-topbar-color="{{ $topbarColor ?? 'light' }}">

<head>
    @yield('meta')
    @include('admin.layouts.shared/title-meta', ['title' => $title])
    @yield('css')
    @include('admin.layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])
</head>

<body>
    @if (session('message'))
        @php
            $type = session('message_type') ?? 'info';
            $bootstrapClasses = [
                'primary' => 'alert-primary',
                'secondary' => 'alert-secondary',
                'success' => 'alert-success',
                'danger' => 'alert-danger',
                'warning' => 'alert-warning',
                'info' => 'alert-info',
                'pink' => 'alert-pink',
                'purple' => 'alert-purple',
                'light' => 'alert-light',
                'dark' => 'alert-dark',
            ];
        @endphp

        <div id="flashMessage" class="alert {{ $bootstrapClasses[$type] ?? 'alert-info' }} alert-dismissible fade show"
            role="alert"
            style="position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 250px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
            <i class="ri-{{ $type == 'success' ? 'check-line' : ($type == 'error' ? 'close-line' : 'alert-line') }}"></i>
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Loading Overlay -->
    <div id="loading-overlay"
        class="d-none position-fixed top-0 left-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center"
        style="z-index: 9999;">
        <div class="spinner-border avatar-lg text-primary" role="status"></div>
    </div>

    <!-- Begin page -->
    <div class="wrapper">

        @include('admin.layouts.shared/topbar')
        @include('admin.layouts.shared/horizontal-nav')

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container -->

            </div>
            <!-- content -->

            @include('admin.layouts.shared/footer')
        </div>

    </div>
    <!-- END wrapper -->

    @yield('modal')

    @include('admin.layouts.shared/right-sidebar')

    @include('admin.layouts.shared/footer-scripts')

    @vite(['resources/js/admin/layout.js', 'resources/js/admin/main.js'])

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let flashMessage = document.getElementById("flashMessage");
            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.classList.remove("show"); // Bootstrap fade out
                    setTimeout(() => flashMessage.remove(), 500); // Remove after animation
                }, 3000); // 3 seconds delay
            }
        });
    </script>

</body>

</html>
