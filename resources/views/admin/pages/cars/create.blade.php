@extends('admin.layouts.horizontal', ['title' => 'Add Car', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title">Add Car</h4>
                    <a class="btn btn-primary" href="{{ route('admin.cars') }}" role="button">List</a>
                </div>

                <form class="card-body" method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-cols-sm-2 row-cols-1">
                        <div class="mb-2">
                            <label class="form-label" for="model">Model</label>
                            <input type="text" value="{{ old('model') }}" id="model"
                                class="form-control @error('model') is-invalid @enderror" name="model">
                            @error('model')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Brand</label>
                            <select class="form-select @error('brand_id') is-invalid @enderror" name="brand_id">
                                <option value="">Select</option>
                                @foreach ($brandOptions as $id => $name)
                                    <option value="{{ $id }}" {{ old('brand_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Steering</label>
                            <select class="form-select @error('steering_id') is-invalid @enderror" name="steering_id">
                                <option value="">Select</option>
                                @foreach ($steeringOptions as $id => $name)
                                    <option value="{{ $id }}" {{ old('steering_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('steering_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select class="form-select @error('type_id') is-invalid @enderror" name="type_id">
                                <option value="">Select</option>
                                @foreach ($typeOptions as $id => $name)
                                    <option value="{{ $id }}" {{ old('type_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gasoline-volume" class="form-label">Gasoline Volume</label>
                            <input class="form-control @error('gasoline') is-invalid @enderror" id="gasoline-volume" type="number" name="gasoline" step="1" value="{{ old('gasoline', 0) }}" min="0" step="1">
                            @error('gasoline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input class="form-control @error('capacity') is-invalid @enderror" id="capacity" type="number" name="capacity" step="1" value="{{ old('capacity', 1) }}" min="1">
                            @error('capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input class="form-control @error('price') is-invalid @enderror" id="price" type="number" name="price" step="1" value="{{ old('price', 0) }}" min="0">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="has-promotion">Has Promotion</label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="has_promotion" value="0">
                                <input type="checkbox" class="form-check-input" value="1" id="has-promotion" name="has_promotion">
                            </div>
                            @error('has_promotion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="promotion_price" class="form-label">Promotion Price</label>
                            <input class="form-control @error('promotion_price') is-invalid @enderror" id="promotion_price" type="number" name="promotion_price" value="{{ old('promotion_price') }}" min="0">
                            @error('promotion_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rent_times" class="form-label">Rent Times</label>
                            <input class="form-control @error('rent_times') is-invalid @enderror" id="rent_times" type="number" name="rent_times" value="{{ old('rent_times', 0) }}" step="1" min="0">
                            @error('rent_times')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input class="form-control @error('rating') is-invalid @enderror" id="rating" type="number" name="rating" value="{{ old('rating') }}"  min="0" max="5">
                            @error('rating')
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
