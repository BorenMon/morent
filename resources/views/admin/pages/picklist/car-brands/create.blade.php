@extends('admin.layouts.horizontal', ['title' => 'Add Car Brand', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title">Add Car Brand</h4>
                    <a class="btn btn-primary" href="{{ route('admin.car-brands') }}" role="button">List</a>
                </div>

                <form class="card-body" method="POST" action="{{ route('admin.car-brands.store') }}">
                    @csrf
                    <div class="row row-cols-sm-2 row-cols-1">
                        <div class="mb-2">
                            <label class="form-label" for="value">Value</label>
                            <input type="text" value="{{ old('value') }}" id="value"
                                class="form-control @error('value') is-invalid @enderror" name="value">
                            @error('value')
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
