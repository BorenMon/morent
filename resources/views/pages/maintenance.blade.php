<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => 'Maintenance'])

    @include('layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])
</head>

<body class="authentication-bg position-relative">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 col-12">
                    <div class="mb-4">
                        <img src="/images/svg/under_maintenance.png" alt="" class="img-fluid">
                    </div>
                    <div class="text-center">
                        <h2 class="mb-3 text-muted">Sorry we are under maintenance</h2>
                        <p class="text-dark-emphasis fs-15 mb-1">Our website currently undergoing maintenance.</p>
                        <p class="text-dark-emphasis fs-15 mb-4">We should be a back shotly. thankyou for patience.</p>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark-emphasis">
            <script>
                document.write(new Date().getFullYear())
            </script> © Velonic - Theme by Techzaa
        </span>
    </footer>

    @include('layouts.shared/footer-scripts')

    <!-- App js -->
    <script src="/js/app.min.js"></script>

</body>

</html>
