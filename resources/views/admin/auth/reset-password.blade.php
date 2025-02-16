<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.shared/title-meta', ['title' => 'Reset Password'])

    @include('admin.layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])
</head>

<body class="authentication-bg">

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
                                        <a href="{{ route('admin.dashboard') }}" class="logo-light">
                                            <img src="/images/logo.svg" alt="logo" height="22">
                                        </a>
                                        <a href="{{ route('admin.dashboard') }}" class="logo-dark">
                                            <img src="/images/logo-dark.svg" alt="dark logo" height="22">
                                        </a>
                                    </div>
                                    <div class="p-4 my-auto">
                                        <div class="text-center w-75 m-auto">
                                            <img src="{{ getAvatarUrl($avatar) }}" height="64" alt="user-image"
                                                class="rounded-circle img-fluid img-thumbnail avatar-xl">
                                            <h4 class="text-center mt-3 fw-bold fs-20">Hi ! {{ $name }} </h4>
                                            <p class="text-muted mb-4">Enter your new password to reset.</p>
                                        </div>

                                        <!-- form -->
                                        <form action="{{ route('password.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="email" value="{{ $request->email }}">
                                            <input type="hidden" name="token" value="{{ $request->token }}">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" name="password"
                                                    id="password" required placeholder="Enter your new password">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Confirm
                                                    Password</label>
                                                <input class="form-control" type="password" name="password_confirmation"
                                                    id="password_confirmation" required
                                                    placeholder="Confirm your new password">
                                            </div>

                                            @if ($errors->has('token'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('token') }}
                                                </div>
                                            @endif

                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit"><i
                                                        class="ri-login-circle-fill me-1"></i> <span
                                                        class="fw-bold">Reset Password</span> </button>
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
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark-emphasis">
            <script>
                document.write(new Date().getFullYear())
            </script> © MORENT
        </span>
    </footer>

    @include('admin.layouts.shared/footer-scripts')
</body>

</html>
