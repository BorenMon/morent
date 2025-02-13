@extends('admin.layouts.horizontal', ['title' => 'Staffs', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title">Staffs List</h4>
                    <a class="btn btn-primary" href="{{ route('admin.staffs.create') }}" role="button">Create</a>
                </div>
                <div class="card-body">
                    @if ($users->count() > 0)
                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td><img src="{{ getAvatarUrl($user->avatar) }}" alt="Avatar" class="avatar-xs rounded"></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <a href="{{ route('admin.staffs.show', ['user' => $user->id]) }}" class="text-reset fs-16 px-1"> <i
                                                    class="ri-eye-line text-info"></i></a>
                                            <a href="{{ route('admin.staffs.edit', ['user' => $user->id]) }}" class="text-reset fs-16 px-1"> <i
                                                    class="ri-settings-3-line text-primary"></i></a>
                                            <form id="delete-form-{{ $user->id }}"
                                                action="{{ route('admin.staffs.destroy', ['user' => $user->id]) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="javascript:void(0);" class="text-reset fs-16 px-1 delete-btn"
                                                data-id="{{ $user->id }}">
                                                <i class="ri-delete-bin-2-line text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links('pagination::bootstrap-5') }}
                    @else
                        <div class="text-center">No data found.</div>
                    @endif
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->
@endsection
