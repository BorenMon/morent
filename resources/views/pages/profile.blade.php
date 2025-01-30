@php
    $user = Auth::user();
@endphp

@extends('layouts.horizontal', ['title' => 'Profile', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="profile-bg-picture" style="background-image:url('/images/bg-profile.jpg'); background-size: cover;">
                <span class="picture-bg-overlay"></span>
                <!-- overlay -->
            </div>
            <!-- meta -->
            <div class="profile-user-box">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="profile-user-img"><img src="/images/default-profile.jpg" alt=""
                                class="avatar-lg rounded-circle"></div>
                        <div class="">
                            <h4 class="mt-4 fs-17 ellipsis">{{ $user->name }}</h4>
                            <p class="font-13">{{ $user->role }}</p>
                            <p class="text-muted mb-0"><small>{{ $user->address }}</small></p>
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
                                    type="button" role="tab" aria-controls="home" aria-selected="true"
                                    href="#aboutme">About</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" data-bs-target="#edit-profile"
                                    type="button" role="tab" aria-controls="home" aria-selected="true"
                                    href="#edit-profile">Settings</a></li>
                        </ul>

                        <div class="tab-content m-0 p-4">
                            <div class="tab-pane active" id="aboutme" role="tabpanel" aria-labelledby="home-tab"
                                tabindex="0">
                                <div class="profile-desk">
                                    <h5 class="text-uppercase fs-17 text-dark">{{ $user->name }}</h5>
                                    <div class="designation mb-4">{{ $user->role }}</div>

                                    <h5 class="mt-4 fs-17 text-dark">Contact Information</h5>
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

                                        </tbody>
                                    </table>
                                </div> <!-- end profile-desk -->
                            </div> <!-- about-me -->

                            <!-- settings -->
                            <div id="edit-profile" class="tab-pane">
                                <div class="user-profile-content">
                                    <form>
                                        <div class="row row-cols-sm-2 row-cols-1">
                                            <div class="mb-2">
                                                <label class="form-label" for="FullName">Full
                                                    Name</label>
                                                <input type="text" value="John Doe" id="FullName" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="Email">Email</label>
                                                <input type="email" value="first.last@example.com" id="Email"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="Password">Password</label>
                                                <input type="password" placeholder="6 - 15 Characters" id="Password"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="RePassword">Re-Password</label>
                                                <input type="password" placeholder="6 - 15 Characters" id="RePassword"
                                                    class="form-control">
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <label class="form-label" for="address">Address</label>
                                                <textarea style="height: 125px;" id="address" class="form-control">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</textarea>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit"><i
                                                class="ri-save-line me-1 fs-16 lh-1"></i> Save</button>
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
    <div id="profile-cropper-modal"
        class="
            modal
            {{-- fade --}}
            show d-block
        "
        tabindex="-1" role="dialog"
        aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Profile Editor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="profile-image" src="{{ getAvatarUrl($user->avatar) }}" alt="Picture" class="img-fluid">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title">Dropzone Profile Upload</h4>
                                </div>
                                <div class="card-body">
                                    <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone"
                                        data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                                        <div class="fallback">
                                            <input name="file" type="file" />
                                        </div>

                                        <div class="dz-message needsclick">
                                            <i class="h1 text-muted ri-upload-cloud-2-line"></i>
                                            <h3>Drop file here or click to upload.</h3>
                                            <span class="text-muted fs-13">(This is just a demo dropzone. Selected files are
                                                <strong>not</strong> actually uploaded.)</span>
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
                                                <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
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
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('css')
    @vite(['node_modules/cropper/dist/cropper.min.css'])
@endsection

@section('script')
    @vite(['resources/js/pages/profile.js'])
@endsection
