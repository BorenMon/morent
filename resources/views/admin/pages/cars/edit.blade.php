@extends('admin.layouts.horizontal', ['title' => 'Edit Car', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="car-id" content="{{ $car->id }}">
    <meta name="car-images" content='@json($car->image_urls)'>
@endsection

@section('css')
    @vite([
        'resources/styles/client/modules/filepond.min.css',
        // 'node_modules/filepond/dist/filepond.min.css',
        'node_modules/cropper/dist/cropper.min.css'
    ])
    <style>
        .filepond--item {
            width: 250px;
            height: auto;
            border-radius: 0.5rem;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: #f9f9f9;
        }
    </style>
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-4">
                        <img src="{{ getAssetUrl($car->card_image) }}" alt="image" class="img-fluid rounded"
                            style="width: 300px; height: 200px; object-fit: contain; object-position: center;" id="car-image" />
                        <div>
                            <h2>{{ $car->model }}</h2>
                            <h4>{{ $car->brand->value }}</h4>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <a class="btn btn-primary" href="{{ route('admin.cars') }}" role="button">List</a>
                        <button type="button" class="btn btn-soft-danger" data-bs-toggle="modal"
                            data-bs-target="#image-cropper-modal">
                            <i class="ri-settings-2-line align-text-bottom me-1 fs-16 lh-1"></i>
                            Edit Image
                        </button>
                    </div>
                </div>

                <form class="card-body" method="POST" action="{{ route('admin.cars.update', ['car' => $car->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="row row-cols-sm-2 row-cols-1">
                        <div class="mb-2">
                            <label class="form-label" for="model">Model</label>
                            <input type="text" value="{{ old('model', $car->model) }}" id="model"
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
                                    <option value="{{ $id }}"
                                        {{ old('brand_id', $car->brand_id) == $id ? 'selected' : '' }}>
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
                                    <option value="{{ $id }}"
                                        {{ old('steering_id', $car->steering_id) == $id ? 'selected' : '' }}>
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
                                    <option value="{{ $id }}"
                                        {{ old('type_id', $car->type_id) == $id ? 'selected' : '' }}>
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
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $car->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gasoline-volume" class="form-label">Gasoline Volume</label>
                            <input class="form-control @error('gasoline') is-invalid @enderror" id="gasoline-volume"
                                type="number" name="gasoline" step="1"
                                value="{{ old('gasoline', $car->gasoline ?? 0) }}" min="0" step="1">
                            @error('gasoline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                                type="number" name="capacity" step="1"
                                value="{{ old('capacity', $car->capacity ?? 1) }}" min="1">
                            @error('capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input class="form-control @error('price') is-invalid @enderror" id="price" type="number"
                                name="price" step="1" value="{{ old('price', $car->price ?? 0) }}" min="0">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="has-promotion">Has Promotion</label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="has_promotion" value="0">
                                <input type="checkbox" class="form-check-input" value="1" id="has-promotion"
                                    name="has_promotion" @checked(old('has_promotion', $car->has_promotion))>
                            </div>
                            @error('has_promotion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="promotion_price" class="form-label">Promotion Price</label>
                            <input class="form-control @error('promotion_price') is-invalid @enderror"
                                id="promotion_price" type="number" name="promotion_price"
                                value="{{ old('promotion_price', $car->promotion_price) }}" min="0">
                            @error('promotion_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rent_times" class="form-label">Rent Times</label>
                            <input class="form-control @error('rent_times') is-invalid @enderror" id="rent_times"
                                type="number" name="rent_times" value="{{ old('rent_times', $car->rent_times ?? 0) }}"
                                step="1" min="0">
                            @error('rent_times')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input class="form-control @error('rating') is-invalid @enderror" id="rating"
                                type="number" name="rating" value="{{ old('rating', $car->rating) }}" min="0"
                                max="5">
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary float-end mb-3">Edit</button>
                </form>
                <div class="card col-sm-12 mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Images</h5>
                    </div>
                    <div class="collapse show">
                        <div class="card-body">
                            <input type="file" class="filepond" name="car-images" multiple data-max-file-size="2MB" data-max-files="8" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="image-cropper-modal" class="
            modal
            fade
        " tabindex="-1" role="dialog"
        aria-labelledby="standard-modalLabel" aria-hidden="
            true
        ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Image Editor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image" src="{{ getAssetUrl($car->card_image) }}" alt="Picture"
                            class="img-fluid">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title">Dropzone Image Upload</h4>
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
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite('resources/js/admin/pages/cars/edit.js')
@endsection
