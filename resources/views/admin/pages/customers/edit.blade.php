@extends('admin.layouts.horizontal', ['title' => 'Edit Customer', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-4">
                        <img src="{{ getAvatarUrl($user->avatar) }}" alt="image" class="img-fluid avatar-xl rounded" />
                        <div>
                            <h2>{{ $user->name }}</h2>
                            <h4>{{ $user->role }}</h4>
                        </div>
                    </div>
                    <a class="btn btn-primary" href="{{ route('admin.customers') }}" role="button">List</a>
                </div>

                <form class="card-body" method="POST"
                    action="{{ route('admin.customers.update', ['user' => $user->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="row row-cols-sm-2 row-cols-1">
                        {{-- Name --}}
                        <div class="mb-2">
                            <label class="form-label" for="FullName">Name</label>
                            <input type="text" value="{{ old('name', $user->name) }}" id="FullName"
                                class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label" for="Email">Email</label>
                            <input type="email" value="{{ old('email', $user->email) }}" id="Email" name="email"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label class="form-label" for="Phone">Phone</label>
                            <input type="text" value="{{ old('phone', $user->phone) }}" id="Phone"
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
                                <input type="checkbox" class="form-check-input" id="IsVerified" name="is_verified"
                                    value="1" @checked(old('is_verified', $user->is_verified))>
                            </div>
                            @error('is_verified')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div class="col-sm-12 mb-3">
                            <label class="form-label" for="address">Address</label>
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary float-end mb-3">Edit</button>
                    <div class="card col-sm-12 mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Identity Card</h5>
                        </div>
                        <div id="id-card" class="collapse show">
                            <div class="card-body">
                                <img src="{{ getAssetUrl($user->id_card) }}" alt=""
                                    style="width: 100%; height: 300px;object-fit: contain; object-position: center;">
                            </div>
                        </div>
                    </div>
                    <div class="card col-sm-12 mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Driving License</h5>
                        </div>
                        <div id="driving-license" class="collapse show">
                            <div class="card-body">
                                <img src="{{ getAssetUrl($user->driving_license) }}" alt=""
                                    style="width: 100%; height: 300px;object-fit: contain; object-position: center;">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
