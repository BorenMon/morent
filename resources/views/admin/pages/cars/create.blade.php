@extends('admin.layouts.horizontal', ['title' => 'Add Car', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title">Add Car</h4>
                    <a class="btn btn-primary" href="{{ route('admin.cars') }}" role="button">List</a>
                </div>

                <form class="card-body" method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-cols-sm-2 row-cols-1">
                        {{-- Name --}}
                        <div class="mb-2">
                            <label class="form-label" for="FullName">Name</label>
                            <input type="text" value="{{ old('name') }}" id="FullName"
                                class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label" for="Email">Email</label>
                            <input type="email" value="{{ old('email') }}" id="Email" name="email"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label class="form-label" for="Phone">Phone</label>
                            <input type="text" value="{{ old('phone') }}" id="Phone"
                                class="form-control @error('phone') is-invalid @enderror" name="phone">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Verification Status --}}
                        <div class="mb-3">
                            <label class="form-label" for="IsVerified">Is Verified</label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_verified" value="0">
                                <input type="checkbox" class="form-check-input" value="1" id="IsVerified" name="is_verified">
                            </div>
                            @error('is_verified')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div class="col-sm-12 mb-3">
                            <label class="form-label" for="address">Address</label>
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label class="form-label" for="confirmPassword">Confirm Password</label>
                            <input type="password" id="confirmPassword" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id-card" class="form-label">Identity Card</label>
                            <input type="file" id="id-card" class="form-control @error('id_card') is-invalid @enderror" name="id_card">
                            @error('id_card')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="driving-license" class="form-label">Driving License</label>
                            <input type="file" id="driving-license" class="form-control @error('driving_license') is-invalid @enderror" name="driving_license">
                            @error('driving_license')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary float-end">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
