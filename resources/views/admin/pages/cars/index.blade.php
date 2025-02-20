@extends('admin.layouts.horizontal', ['title' => 'Cars', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <h4 class="header-title">Cars List</h4>
                        <form method="GET" action="{{ route('admin.cars') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search car..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Search</button>
                                @if (request('search'))
                                    <a href="{{ route('admin.cars') }}" class="btn btn-secondary">Clear</a>
                                @endif
                            </div>
                        </form>
                    </div>
                    <a class="btn btn-primary" href="{{ route('admin.cars.create') }}" role="button">Create</a>
                </div>
                <div class="card-body">
                    @if ($cars->count() > 0)
                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Model</th>
                                    <th>Brand</th>
                                    <th>Rent Times</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                    <tr>
                                        <td>
                                            <img src="{{ getAssetUrl($car->card_image) }}" alt="Avatar" class="rounded"
                                                style="object-fit: contain; width: 80px; height: 40px;">
                                        </td>
                                        <td>{{ $car->model }}</td>
                                        <td>{{ optional($car->brand)->value }}</td>
                                        <td>{{ $car->rent_times }}</td>
                                        <td>
                                            <a href="{{ route('admin.cars.show', ['car' => $car->id]) }}"
                                                class="text-reset fs-16 px-1"> <i class="ri-eye-line text-info"></i></a>
                                            <a href="{{ route('admin.cars.edit', ['car' => $car->id]) }}"
                                                class="text-reset fs-16 px-1"> <i
                                                    class="ri-settings-3-line text-primary"></i></a>
                                            <form id="delete-form-{{ $car->id }}"
                                                action="{{ route('admin.cars.destroy', ['car' => $car->id]) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="javascript:void(0);" class="text-reset fs-16 px-1 delete-btn"
                                                data-id="{{ $car->id }}">
                                                <i class="ri-delete-bin-2-line text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $cars->links('pagination::bootstrap-5') }}
                    @else
                        <div class="text-center">No data found.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
