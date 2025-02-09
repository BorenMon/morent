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
    <!-- Loading Overlay -->
    <div id="loading-overlay"
        class="d-none position-fixed top-0 left-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center" style="z-index: 9999;">
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

</body>

</html>
