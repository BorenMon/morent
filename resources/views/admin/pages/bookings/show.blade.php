@extends('admin.layouts.horizontal', ['title' => 'Booking Details', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-4">
                <div>
                    <h2>Booking ID: {{ $booking->id }}</h2>
                    <div class="d-flex mt-4">
                        <h4>Customer Name: {{ $booking->name }}</h4><a href="{{ route('admin.customers.show', ['user' => $booking->customer->id]) }}"><i class="ri-external-link-line ms-2"></i></a>
                    </div>
                    <div class="d-flex mt-2">
                        <h4>Car Model: {{ $booking->car->model }}</h4><a href="{{ route('admin.cars.show', ['car' => $booking->car->id]) }}"><i class="ri-external-link-line ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column gap-2">
                <a class="btn btn-primary" href="{{ route('admin.bookings') }}" role="button">List</a>
            </div>
        </div>
        <form action="{{ route('admin.bookings.update', ['booking' => $booking->id]) }}" method="POST" class="card-body">
            @csrf
            @method('PATCH')
            <div class="row row-cols-sm-2 row-cols-1">
                <div class="mb-2">
                    <label class="form-label">Phone</label>
                    <p>{{ $booking->phone }}</p>
                </div>
                <div class="mb-2">
                    <label class="form-label">Stage</label>
                    <p>{{ $booking->stage }}</p>
                </div>
                <div class="col-sm-12 mb-3">
                    <label class="form-label">Address</label>
                    <p>{{ $booking->address }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Payment Status</label>
                    <select class="form-select @error('payment_status') is-invalid @enderror" name="payment_status">
                        @foreach ($paymentStatusOptions as $option)
                            <option value="{{ $option }}"
                                {{ old('payment_status', $booking->payment_status) == $option ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                    @error('payment_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Progress Status</label>
                    <select class="form-select @error('progress_status') is-invalid @enderror" name="progress_status">
                        @foreach ($paymentProgressStatusOptions as $option)
                            <option value="{{ $option }}"
                                {{ old('progress_status', $booking->progress_status) == $option ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                    @error('progress_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Pick-up City</label>
                    <p>{{ $booking->pick_up_city }}</p>
                </div>
                <div class="mb-2">
                    <label class="form-label">Pick-up Datetime</label>
                    <p>{{ getDateTime($booking->pick_up_datetime) }}</p>
                </div>
                <div class="mb-2">
                    <label class="form-label">Drop-off City</label>
                    <p>{{ $booking->drop_off_city }}</p>
                </div>
                <div class="mb-2">
                    <label class="form-label">Drop-off Datetime</label>
                    <p>{{ getDateTime($booking->drop_off_datetime) }}</p>
                </div>
                <div class="mb-2">
                    <label class="form-label">Total Amount</label>
                    <p>${{ $booking->total_amount }}</p>
                </div>
            </div>
            <div class="d-flex float-end gap-2">
                <button class="btn btn-info mb-3" type="button">Invoice</button>
                <button class="btn btn-primary mb-3" type="submit">Change</button>
            </div>
            <div class="card col-sm-12">
                <div class="p-3">
                    <div class="card-widgets">
                        <a data-bs-toggle="collapse" href="#payment-proof" role="button" aria-expanded="false"
                                    aria-controls="payment-proof"><i class="ri-subtract-line"></i></a>
                    </div>
                    <h5 class="header-title mb-0">Payment Proof</h5>
                </div>
                <div id="payment-proof" class="collapse">
                    <div class="card-body">
                        <img src="{{ getAssetUrl($booking->payment_proof) }}" alt="" style="width: 100%; height: 300px; object-fit: contain; object-position: center;">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
