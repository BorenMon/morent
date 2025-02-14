@php
    $user = Auth::user();
@endphp

@extends('admin.layouts.horizontal', ['title' => 'Profile', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->id() }}">
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-sm-12">
            <div style="height: 150px;"></div>
            <!-- meta -->
            <div class="profile-user-box">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="profile-user-img">
                            <img src="{{ getAvatarUrl($user->avatar) }}" alt="" class="avatar-lg rounded-circle">
                        </div>
                        <div class="">
                            <h4 class="mt-4 fs-17 ellipsis">{{ $user->name }}</h4>
                            <p class="font-13">{{ $user->role }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex justify-content-end align-items-center gap-2">
                            <button type="button" class="btn btn-soft-danger" data-bs-toggle="modal" id="edit-profile-btn"
                                data-bs-target="#profile-cropper-modal">
                                <i class="ri-settings-2-line align-text-bottom me-1 fs-16 lh-1"></i>
                                Edit Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ meta -->
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card p-0">
                <div class="card-body p-0">
                    <div class="profile-content">
                        <ul class="nav nav-underline nav-justified gap-0">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" data-bs-target="#aboutme"
                                    type="button" role="tab" aria-controls="home" aria-selected="true" href="#aboutme"
                                    href="#profile">About</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" data-bs-target="#edit-profile"
                                    type="button" role="tab" aria-controls="home" aria-selected="true"
                                    href="#edit-profile" href="#settings">Settings</a></li>
                        </ul>

                        <div class="tab-content m-0 p-4">
                            <div class="tab-pane active" id="aboutme" role="tabpanel" aria-labelledby="home-tab"
                                tabindex="0">
                                <div class="profile-desk">
                                    <h5 class="fs-17 text-dark">Contact Information</h5>
                                    <table class="table table-condensed mb-0 border-top">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Email</th>
                                                <td>
                                                    <a href="" class="ng-binding">
                                                        {{ $user->email }}
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Phone</th>
                                                <td class="ng-binding">{{ $user->phone }}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Address</th>
                                                <td class="ng-binding">{{ $user->address }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div> <!-- end profile-desk -->
                            </div> <!-- about-me -->

                            <!-- settings -->
                            <div id="edit-profile" class="tab-pane">
                                <div class="user-profile-content">
                                    <h5 class="fs-17 text-dark">Information</h5>
                                    <form action="{{ route('users.info', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
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

                                            {{-- Email (read-only) --}}
                                            <div class="mb-3">
                                                <label class="form-label" for="Email">Email</label>
                                                <input type="email" value="{{ old('name', $user->email) }}" id="Email"
                                                    class="form-control @error('name') is-invalid @enderror" name="email">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Phone --}}
                                            <div class="mb-3">
                                                <label class="form-label" for="Phone">Phone</label>
                                                <input type="text" value="{{ old('phone', $user->phone) }}"
                                                    id="Phone" class="form-control @error('phone') is-invalid @enderror"
                                                    name="phone">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Role (read-only) --}}
                                            <div class="mb-3">
                                                <label class="form-label" for="Role">Role</label>
                                                <input type="text" id="example-readonly" class="form-control" readonly
                                                    value="{{ $user->role }}">
                                            </div>

                                            {{-- Address --}}
                                            <div class="col-sm-12 mb-3">
                                                <label class="form-label" for="address">Address</label>
                                                <textarea style="height: 125px;" id="address" class="form-control @error('address') is-invalid @enderror"
                                                    name="address">{{ old('address', $user->address) }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Submit Button --}}
                                        <button class="btn btn-primary" type="submit">
                                            <i class="ri-save-line me-1 fs-16 lh-1"></i> Save
                                        </button>
                                    </form>
                                    <hr class="my-4 " />
                                    <h5 class="fs-17 text-dark">Password</h5>
                                    <form action="{{ route('users.password', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <div class="row row-cols-sm-2 row-cols-1">
                                            {{-- Current Password --}}
                                            <div class="mb-2">
                                                <label class="form-label" for="currentPassword">Current Password</label>
                                                <input type="password" id="currentPassword"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    name="current_password" value="{{ old('current_password') }}">
                                                @error('current_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div></div> {{-- Spacer for grid alignment --}}

                                            {{-- New Password --}}
                                            <div class="mb-3">
                                                <label class="form-label" for="newPassword">New Password</label>
                                                <input type="password" id="newPassword"
                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                    name="new_password" value="{{ old('new_password') }}">
                                                @error('new_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Confirm Password --}}
                                            <div class="mb-3">
                                                <label class="form-label" for="confirmPassword">Confirm Password</label>
                                                <input type="password" id="confirmPassword"
                                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                    name="new_password_confirmation"
                                                    value="{{ old('new_password_confirmation') }}">
                                                @error('new_password_confirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Submit Button --}}
                                        <button class="btn btn-primary" type="submit">
                                            <i class="ri-save-line me-1 fs-16 lh-1"></i> Change
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    </div>
    <!-- end row -->

    <!-- Profile Cropper Modal-->
    <div id="profile-cropper-modal" class="
            modal
            fade
        " tabindex="-1" role="dialog"
        aria-labelledby="standard-modalLabel" aria-hidden="
            true
        ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Profile Editor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="profile-image" src="{{ getAvatarUrl($user->avatar) }}" alt="Picture"
                            class="img-fluid">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title">Dropzone Profile Upload</h4>
                                </div>
                                <div class="card-body">
                                    <form action="/" method="post" class="dropzone" id="myAwesomeDropzone"
                                        data-plugin="dropzone" data-previews-container="#file-previews"
                                        data-upload-preview-template="#uploadPreviewTemplate">
                                        <div class="fallback">
                                            <input name="file" type="file" />
                                        </div>

                                        <div class="dz-message needsclick">
                                            <i class="h1 text-muted ri-upload-cloud-2-line"></i>
                                            <h3>Drop file here or click to upload.</h3>
                                        </div>
                                    </form>

                                    <!-- Preview -->
                                    <div class="dropzone-previews mt-3" id="file-previews"></div>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- file preview template -->
                            <div class="d-none" id="uploadPreviewTemplate">
                                <div class="card mt-1 mb-0 shadow-none border">
                                    <div class="p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light"
                                                    alt="">
                                            </div>
                                            <div class="col ps-0">
                                                <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                                                <p class="mb-0" data-dz-size></p>
                                            </div>
                                            <div class="col-auto">
                                                <!-- Button -->
                                                <a href="" class="btn btn-link btn-lg text-danger" data-dz-remove>
                                                    <i class="ri-close-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- end card-->
                        </div>
                        <!-- end col-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="upload-cropped-image">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('css')
    @vite(['node_modules/cropper/dist/cropper.min.css'])
@endsection

@section('script')
    @vite(['resources/js/admin/pages/profile.js'])
@endsection
