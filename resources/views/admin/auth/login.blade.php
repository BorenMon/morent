<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.shared/title-meta', ['title' => 'Log In'])

    @include('admin.layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])
</head>

<body class="authentication-bg position-relative">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-10">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6 d-none d-lg-block p-2">
                                <img src="/images/auth-img.jpg" alt="" class="img-fluid rounded h-100">
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand p-4">
                                        <a href="" class="logo-light">
                                            <img src="/images/logo.svg" alt="logo" height="22">
                                        </a>
                                        <a href="" class="logo-dark">
                                            <img src="/images/logo-dark.svg" alt="dark logo" height="22">
                                        </a>
                                    </div>
                                    <div class="p-4 my-auto">
                                        <h4 class="fs-20">Sign In</h4>
                                        <p class="text-muted mb-3">Enter your email address and password to access
                                            account.
                                        </p>

                                        <!-- form -->
                                        <form method="POST" action="/login">
                                            @csrf

                                            @if (sizeof($errors) > 0)
                                                @foreach ($errors->all() as $error)
                                                    <p class="text-danger">{{ $error }}</p>
                                                @endforeach
                                            @endif

                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email address</label>
                                                <input class="form-control" type="email" name="email"
                                                    id="emailaddress" placeholder="Enter your email"
                                                    value="test@test.com">
                                            </div>
                                            <div class="mb-3">
                                                <a href="{{ route('password.request') }}" class="text-muted float-end">
                                                <small>
                                                    Forgot your password?
                                                </small></a>
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" name="password"
                                                    id="password" placeholder="Enter your password" value="password">
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="checkbox-signin">
                                                    <label class="form-check-label" for="checkbox-signin">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit"><i
                                                        class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log
                                                        In</span> </button>
                                            </div>
                                        </form>
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            {{-- <div class="row">
                <div class="col-12 text-center">
                    <p class="text-dark-emphasis">Don't have an account? <a
                            href="{{ route('register') }}"
                            class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Sign up</b></a>
                    </p>
                </div> <!-- end col -->
            </div> --}}
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>
                document.write(new Date().getFullYear())
            </script> © MORENT
        </span>
    </footer>

    @include('admin.layouts.shared/footer-scripts')

</body>

</html>
