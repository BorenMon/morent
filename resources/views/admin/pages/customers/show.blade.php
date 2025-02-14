@extends('admin.layouts.horizontal', ['title' => 'Staff Profile', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="card mt-4">
        <h5 class="card-header bg-light-subtle d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-4">
                <img src="{{ getAvatarUrl($user->avatar) }}" alt="image" class="img-fluid avatar-xl rounded" />
                <div>
                    <h2>{{ $user->name }}</h2>
                    <h4>{{ $user->role }}</h4>
                </div>
            </div>
            <div>
                <a href="{{ route('admin.staffs.edit', ['user' => $user->id]) }}" class="text-reset fs-24 px-1"> <i class="ri-settings-3-line text-primary"></i></a>
                <form id="delete-form-{{ $user->id }}"
                    action="{{ route('admin.staffs.destroy', ['user' => $user->id]) }}" method="POST"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <a href="javascript:void(0);" class="text-reset fs-24 px-1 delete-btn" data-id="{{ $user->id }}">
                    <i class="ri-delete-bin-2-line text-danger"></i>
                </a>
            </div>
        </h5>
        <div class="card-body">
            <div class="row row-cols-sm-2 row-cols-1">
                <div class="mb-2">
                    <label class="form-label">Email</label>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="mb-2">
                    <label class="form-label">Phone</label>
                    <p>{{ $user->phone }}</p>
                </div>
                <div class="col-sm-12 mb-3">
                    <label class="form-label">Address</label>
                    <p>{{ $user->address }}</p>
                </div>
            </div>
        </div>
    </div> <!-- end card-body-->
    </div>
@endsection
