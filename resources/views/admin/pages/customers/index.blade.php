@extends('admin.layouts.horizontal', ['title' => 'Customers', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <h4 class="header-title">Customers List</h4>
                        <form method="GET" action="{{ route('admin.customers') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search customer..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Search</button>
                                @if (request('search'))
                                    <a href="{{ route('admin.customers') }}" class="btn btn-secondary">Clear</a>
                                @endif
                            </div>
                        </form>
                    </div>
                    <a class="btn btn-primary" href="{{ route('admin.customers.create') }}" role="button">Create</a>
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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td><img src="{{ getAvatarUrl($user->avatar) }}" alt="Avatar"
                                                class="avatar-xs rounded"></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->is_verified }}</td>
                                        <td>
                                            <a href="{{ route('admin.customers.show', ['user' => $user->id]) }}"
                                                class="text-reset fs-16 px-1"> <i class="ri-eye-line text-info"></i></a>
                                            <a href="{{ route('admin.customers.edit', ['user' => $user->id]) }}"
                                                class="text-reset fs-16 px-1"> <i
                                                    class="ri-settings-3-line text-primary"></i></a>
                                            <form id="delete-form-{{ $user->id }}"
                                                action="{{ route('admin.customers.destroy', ['user' => $user->id]) }}"
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
                </div>
            </div>
        </div>
    </div>
@endsection
