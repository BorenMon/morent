@extends('admin.layouts.horizontal', ['title' => 'Pricing', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('admin.layouts.shared/page-title', ['sub_title' => 'Pages', 'page_title' => 'Pricing'])

    <div class="row justify-content-center">
        <div class="col-xxl-10">

            <!-- Pricing Title-->
            <div class="text-center">
                <h3 class="mb-2">Our <b>Plans</b></h3>
                <p class="text-muted mb-5">
                    We have plans and prices that fit your business perfectly. Make your <br> client site a success with our
                    products.
                </p>
            </div>

            <!-- Plans -->
            <div class="row justify-content-center my-3">
                <div class="col-lg-3">
                    <div
                        class="card rounded-top-0 border-3 border-end-0 border-start-0 border-bottom-0 border-top border-success">
                        <div class="card-body border-bottom p-3">
                            <span
                                class="badge bg-success-subtle rounded-1 text-success text-uppercase fs-12 fw-semibold px-2 py-1 mb-3">Professional
                                Pack</span>
                            <h2 class="mb-4 text-dark">$19 <span class="text-uppercase fs-14 ">/ Month</span></h2>

                            <ul class="list-unstyled d-grid gap-2">
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>10 GB Storage</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>500 GB Bandwidth
                                </li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>No Domain</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>1 User</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>Email Support</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>24x7 Support</li>
                            </ul>

                            <button class="btn btn-success w-100">Change Plan</button>
                        </div>
                    </div> <!-- end Pricing_card -->
                </div> <!-- end col -->

                <div class="col-lg-3">
                    <div
                        class="card rounded-top-0 border-3 border-end-0 border-start-0 border-bottom-0 border-top border-primary">
                        <div class="card-body border-bottom p-3">
                            <span
                                class="badge bg-primary-subtle rounded-1 text-primary text-uppercase fs-12 fw-semibold px-2 py-1 mb-3">Business
                                Pack</span>
                            <h2 class="mb-4 text-dark">$29 <span class="text-uppercase fs-14 ">/ Month</span></h2>

                            <ul class="list-unstyled d-grid gap-2">
                                <li class="fs-15"><i class="ri-shield-check-fill text-primary me-2"></i>50 GB Storage</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-primary me-2"></i>900 GB Bandwidth
                                </li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-primary me-2"></i>2 Domain</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-primary me-2"></i>10 User</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-primary me-2"></i>Email Support</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-primary me-2"></i>24x7 Support</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-primary me-2"></i>Sharing permission
                                </li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-primary me-2"></i>Admin Tools</li>
                            </ul>

                            <button class="btn btn-primary w-100">Current Plan</button>
                        </div>
                    </div> <!-- end Pricing_card -->
                </div> <!-- end col -->

                <div class="col-lg-3">
                    <div
                        class="card rounded-top-0 border-3 border-end-0 border-start-0 border-bottom-0 border-top border-success">
                        <div class="card-body border-bottom p-3">
                            <span
                                class="badge bg-success-subtle rounded-1 text-success text-uppercase fs-12 fw-semibold px-2 py-1 mb-3">Enterprise
                                Pack</span>
                            <h2 class="mb-4 text-dark">$39 <span class="text-uppercase fs-14 ">/ Month</span></h2>

                            <ul class="list-unstyled d-grid gap-2">
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>100 GB Storege</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>Unlimited Bandwidth
                                </li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>10 Domain</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>Unlimited User</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>Email Support</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>24x7 Support</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>Sharing permission
                                </li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>Admin Tools</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>Reporting and
                                    analytic</li>
                                <li class="fs-15"><i class="ri-shield-check-fill text-success me-2"></i>Account Manager
                                </li>
                            </ul>

                            <button class="btn btn-success w-100">Change Plan</button>
                        </div>
                    </div> <!-- end Pricing_card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- end col-->
    </div>
    <!-- end row -->
@endsection
