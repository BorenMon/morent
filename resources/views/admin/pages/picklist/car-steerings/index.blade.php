@extends('admin.layouts.horizontal', ['title' => 'Car Steerings', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <h4 class="header-title">Car Steerings List</h4>
                    </div>
                    <a class="btn btn-primary" href="{{ route('admin.car-steerings.create') }}" role="button">Add</a>
                </div>
                <div class="card-body">
                    @if ($steerings->count() > 0)
                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($steerings as $steering)
                                    <tr>
                                        <td>{{ $steering->id }}</td>
                                        <th>{{ $steering->value }}</th>
                                        <td>
                                            <form id="delete-form-{{ $steering->id }}"
                                                action="{{ route('admin.car-steerings.destroy', ['carSteering' => $steering->id]) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="javascript:void(0);" class="text-reset fs-16 px-1 delete-btn"
                                            data-id="{{ $steering->id }}">
                                                <i class="ri-delete-bin-2-line text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center">No data found.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
