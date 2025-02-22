@extends('admin.layouts.horizontal', ['title' => 'Bookings', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <h4 class="header-title">Bookings List</h4>
                        <form method="GET" action="{{ route('admin.bookings') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search booking..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Search</button>
                                @if (request('search'))
                                    <a href="{{ route('admin.bookings') }}" class="btn btn-secondary">Clear</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @if ($bookings->count() > 0)
                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
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
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>
                                            {{ $booking->name }}
                                        </td>
                                        <td>{{ getDateTime($booking->pick_up_datetime) }}</td>
                                        <td>{{ getDatetime($booking->drop_off_datetime) }}</td>
                                        <td><span class="badge {{ statusBadge($booking->payment_status) }}">
                                            {{ $booking->payment_status }}
                                        </span></td>
                                        <td>
                                            <a href="{{ route('admin.bookings.show', ['booking' => $booking->id]) }}"
                                                class="text-reset fs-16 px-1"> <i class="ri-eye-line text-info"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $bookings->links('pagination::bootstrap-5') }}
                    @else
                        <div class="text-center">No data found.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
