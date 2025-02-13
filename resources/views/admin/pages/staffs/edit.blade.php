@extends('admin.layouts.horizontal', ['title' => 'Edit Staff', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

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
                    <a class="btn btn-primary" href="{{ route('admin.staffs') }}" role="button">List</a>
                </div>

                <form class="card-body" method="POST" action="{{ route('admin.staffs.store') }}">
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

                        {{-- Role --}}
                        <div class="mb-3">
                            <label class="form-label" for="Role">Role</label>
                            <select name="role" id="Role" class="form-control @error('role') is-invalid @enderror">
                                @if (Auth::user()->role === 'ADMIN')
                                    <option value="STAFF" {{ old('role') == 'STAFF' ? 'selected' : '' }}>Staff</option>
                                    <option value="MANAGER" {{ old('role') == 'MANAGER' ? 'selected' : '' }}>Manager
                                    </option>
                                    <option value="ADMIN" {{ old('role') == 'ADMIN' ? 'selected' : '' }}>Admin
                                    </option>
                                @else
                                    <option value="STAFF" {{ old('role') == 'STAFF' ? 'selected' : '' }}>Staff</option>
                                @endif
                            </select>
                            @error('role')
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
                    </div>
                    <button class="btn btn-primary float-end">Save</button>
                </form>

            </div>
        </div>
    </div>
@endsection
