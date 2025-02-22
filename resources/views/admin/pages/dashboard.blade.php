@extends('admin.layouts.horizontal', ['title' => 'Dashboard', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    {{-- @include('admin.layouts.shared/page-title', ['sub_title' => 'Menu', 'page_title' => 'admin.dashboard']) --}}
    <br />
    <div class="row">
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-purple">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-wallet-2-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Income</h6>
                    <h2 class="my-2">${{ $totalRevenue }}</h2>
                    <p class="mb-0">
                        <span class="badge bg-white bg-opacity-10 me-1">{{ $revenuePercentageChange }}%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div> <!-- end col-->

        <a href="{{ route('admin.cars') }}" class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-pink">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-roadster-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Cars</h6>
                    <h2 class="my-2">{{ $carsCount }}</h2>
                    <p class="mb-0">
                        <span class="badge bg-white bg-opacity-10 me-1">{{ $carsPercentageChange }}%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </a> <!-- end col-->

        <a href="{{ route('admin.bookings') }}" class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-info">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-draft-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Bookings</h6>
                    <h2 class="my-2">{{ $bookingsCount }}</h2>
                    <p class="mb-0">
                        <span class="badge bg-white bg-opacity-25 me-1">{{ $bookingsPercentageChange }}%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </a> <!-- end col-->

        <a href="{{ route('admin.customers') }}" class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-primary">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-group-2-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Customers</h6>
                    <h2 class="my-2">{{ $customersCount }}</h2>
                    <p class="mb-0">
                        <span class="badge bg-white bg-opacity-10 me-1">{{ $customersPercentageChange }}%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </a> <!-- end col-->
    </div>

    <div class="row">
        {{-- <div class="col-xl-4">
            <!-- Chat-->
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3">
                        <div class="card-widgets">
                            <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                            <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button"
                                aria-expanded="false" aria-controls="yearly-sales-collapse"><i
                                    class="ri-subtract-line"></i></a>
                            <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                        </div>
                        <h5 class="header-title mb-0">Chat</h5>
                    </div>

                    <div id="yearly-sales-collapse" class="collapse show">
                        <div class="chat-conversation mt-2">
                            <div class="card-body py-0 mb-3" data-simplebar style="height: 322px;">
                                <ul class="conversation-list">
                                    <li class="clearfix">
                                        <div class="chat-avatar">
                                            <img src="/images/users/avatar-5.jpg" alt="male">
                                            <i>10:00</i>
                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <i>Geneva</i>
                                                <p>
                                                    Hello!
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="clearfix odd">
                                        <div class="chat-avatar">
                                            <img src="/images/users/avatar-1.jpg" alt="Female">
                                            <i>10:01</i>
                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <i>Thomson</i>
                                                <p>
                                                    Hi, How are you? What about our next meeting?
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="chat-avatar">
                                            <img src="/images/users/avatar-5.jpg" alt="male">
                                            <i>10:01</i>
                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <i>Geneva</i>
                                                <p>
                                                    Yeah everything is fine
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="clearfix odd">
                                        <div class="chat-avatar">
                                            <img src="/images/users/avatar-1.jpg" alt="male">
                                            <i>10:02</i>
                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <i>Thomson</i>
                                                <p>
                                                    Wow that's great
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body pt-0">
                                <form class="needs-validation" novalidate name="chat-form" id="chat-form">
                                    <div class="row align-items-start">
                                        <div class="col">
                                            <input type="text" class="form-control chat-input"
                                                placeholder="Enter your text" required>
                                            <div class="invalid-feedback">
                                                Please enter your messsage
                                            </div>
                                        </div>
                                        <div class="col-auto d-grid">
                                            <button type="submit"
                                                class="btn btn-danger chat-send waves-effect waves-light">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div> <!-- end .chat-conversation-->
                    </div>
                </div>

            </div> <!-- end card-->
        </div> <!-- end col--> --}}

        <div class="col-xl-12">
            <!-- Todo-->
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3">
                        <div class="card-widgets">
                            {{-- <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a> --}}
                            <a data-bs-toggle="collapse" href="#bookings-collapse" role="button" aria-expanded="false"
                                aria-controls="bookings-collapse"><i class="ri-subtract-line"></i></a>
                            {{-- <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a> --}}
                        </div>
                        <h5 class="header-title mb-0">Recent Bookings</h5>
                    </div>

                    <div id="bookings-collapse" class="collapse show">

                        <div class="table-responsive">
                            <table class="table table-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Pick-up Date</th>
                                        <th>Drop-off Date</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentBookings as $b)
                                        <tr>
                                            <td>{{ $b->name }}</td>
                                            <td>{{ getDateTime($b->pick_up_datetime) }}</td>
                                            <td>{{ getDateTime($b->drop_off_datetime) }}</td>
                                            <td>
                                                <span class="badge {{ statusBadge($b->payment_status) }}">
                                                    {{ $b->payment_status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.bookings.show', ['booking' => $b->id]) }}" class="text-reset fs-16 px-1"> <i
                                                        class="ri-eye-line text-info"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row -->
@endsection

@section('script')
    {{-- @vite(['resources/js/admin/demo/dashboard.js']) --}}
@endsection
