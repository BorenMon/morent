@extends('admin.layouts.horizontal', ['title' => 'Car Details', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-4">
                <img src="{{ getAssetUrl($car->card_image) }}" alt="image" class="img-fluid rounded"
                    style="width: 300px; height: 200px; object-fit: contain; object-position: center;" id="car-image" />
                <div>
                    <h2>{{ $car->model }}</h2>
                    <h4>{{ optional($car->brand)->value }}</h4>
                </div>
            </div>
            <div class="d-flex flex-column gap-2">
                <div>
                    <a href="{{ route('admin.cars.edit', ['car' => $car->id]) }}" class="text-reset fs-24 px-1"> <i
                            class="ri-settings-3-line text-primary"></i></a>
                    <form id="delete-form-{{ $car->id }}"
                        action="{{ route('admin.cars.destroy', ['car' => $car->id]) }}" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="javascript:void(0);" class="text-reset fs-24 px-1 delete-btn" data-id="{{ $car->id }}">
                        <i class="ri-delete-bin-2-line text-danger"></i>
                    </a>
                </div>
                <a class="btn btn-primary" href="{{ route('admin.cars') }}" role="button">List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row row-cols-sm-2 row-cols-1">
                <div class="mb-2">
                    <label class="form-label" for="model">Model</label>
                    <p>{{ $car->model }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Brand</label>
                    <p>{{ optional($car->brand)->value }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Steering</label>
                    <p>{{ $car->steering }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <p>{{ $car->type }}</p>
                </div>
                <div class="col-sm-12 mb-3">
                    <label class="form-label" for="description">Description</label>
                    <p>{{ $car->description }}</p>
                </div>
                <div class="mb-3">
                    <label for="gasoline-volume" class="form-label">Gasoline Volume</label>
                    <p>{{ $car->gasoline }}</p>
                </div>
                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacity</label>
                    <p>{{ $car->capacity }}</p>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <p>${{ $car->price }}/day</p>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="has-promotion">Has Promotion</label>
                    <div class="form-check form-switch">
                        <input type="hidden" name="has_promotion" value="0">
                        <input type="checkbox" class="form-check-input" value="1" id="has-promotion"
                            name="has_promotion" @checked($car->has_promotion) disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="promotion_price" class="form-label">Promotion Price</label>
                    <p>{{ $car->promotion_price }}</p>
                </div>
                <div class="mb-3">
                    <label for="rent_times" class="form-label">Rent Times</label>
                    <p>{{ $car->rent_times }}</p>
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <p>{{ $car->rating }}</p>
                </div>
                <div class="card col-sm-12 mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Images</h5>
                    </div>
                    <div id="id-card" class="collapse show">
                        <div class="card-body d-flex gap-4 flex-wrap">
                            @if ($car->images)
                                @foreach ($car->images as $image)
                                    <img src="{{ getAssetUrl($image) }}" alt=""
                                        style="height: 200px; object-fit: contain; object-position: center;">
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
