@php
    $user = auth()->user();
@endphp

@extends('client.layout', ['title' => 'Car Detail'])

@section('css')
    @vite('resources/styles/client/pages/detail.css')
@endsection

@section('content')
    <div id="body-wrapper">
        <div id="body" class="container-fluid">
            <div class="space-y-[32px]">
                <div id="details">
                    <div id="images">
                        <div id="big-image">
                            <img src="{{ getAssetUrl($car->card_image) }}" />
                        </div>
                        <section id="images-carousel" class="splide">
                            <div class="splide__track">
                                <ul class="splide__list" id="images-carousel-wrapper">
                                    <li class="splide__slide image active main">
                                        <div>
                                            <img src="{{ getAssetUrl($car->card_image) }}">
                                        </div>
                                    </li>
                                    @foreach ($car->image_urls as $image)
                                        <li class="splide__slide image">
                                            <div style="background-image: url({{ $image['full_url'] }});"></div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    </div>
                    <div id="info" class="space-y-[24px]">
                        <div class="flex justify-between">
                            <div class="-mt-[5px]">
                                <div class="text-[32px] font-bold text-[#1A202C]">{{ $car->model }}</div>
                            </div>
                        </div>

                        <p class="text-[20px] text-[#596780]">
                            {{ $car->description ?? 'No description.' }}
                        </p>

                        <div id="spec">
                            <div class="space-y-[12px]">
                                <div class="space-x-[12px]">
                                    <img src="/client/icons/car-body.svg" alt="" class="icon" />
                                    <span class="name">Type</span>
                                    <span>{{ optional($car->type)->value }}</span>
                                </div>
                                <div class="space-x-[12px]">
                                    <img src="/client/icons/car.svg" alt="" class="icon" />
                                    <span class="name">Steering</span>
                                    <span>{{ optional($car->steering)->value }}</span>
                                </div>
                                <div class="space-x-[12px]">
                                    <img src="/client/icons/profile-2user.svg" alt="" class="icon" />
                                    <span class="name">Capacity</span>
                                    <span>{{ $car->capacity }} People</span>
                                </div>
                                <div class="space-x-[12px]">
                                    <img src="/client/icons/gas-station.svg" alt="" class="icon" />
                                    <span class="name">Gasoline</span>
                                    <span>{{ $car->gasoline }}L</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div class="font-bold">
                                <div>
                                    <span class="text-[28px] text-[#1A202C]">
                                        ${{ number_format($car->has_promotion ? $car->promotion_price : $car->price, 2) }}/
                                    </span>
                                    <span class="text-[#90A3BF] text-[14px]">day</span>
                                </div>
                                @if ($car->has_promotion)
                                    <s class="text-[16px] text-[#90A3BF]">
                                        ${{ number_format($car->price, 2) }}
                                    </s>
                                @endif
                            </div>
                            <button class="h-[66px] w-[134px]">
                                <a href="{{ $user->role == 'CUSTOMER' ? route('client.payment', ['car' => $car->id]) : '#' }}">Book Now</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-[20px] mt-[32px] h-[44px] px-[20px]">
                    <h5 class="font-semibold text-[#90A3BF]">Popular Cars</h5>
                    <a href="/cars" class="text-[#3563E9] font-semibold">View All</a>
                </div>
                <section id="popular" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list" id="popular-wrapper">
                            @foreach ($popularCars as $car)
                                <li class="splide__slide car-card">
                                    <div>
                                        <div class="-mt-[5px]">
                                            <div class="text-[20px] font-bold text-[#1A202C]">{{ $car->model }}</div>
                                            <div class="text-[14px] font-bold text-[#90A3BF]">
                                                {{ optional($car->type)->value }}</div>
                                        </div>
                                    </div>
                                    <a href="{{ route('client.detail', ['car' => $car->id]) }}"
                                        aria-label="See more about car"><img src="{{ getAssetUrl($car->card_image) }}"
                                            loading="lazy" alt=""></a>
                                    <div class="space-y-[24px]">
                                        <div>
                                            <div>
                                                <img src="/client/icons/gas-station.svg" alt="" class="icon">
                                                <span>{{ $car->gasoline }}L</span>
                                            </div>
                                            <div>
                                                <img src="/client/icons/car.svg" alt="" class="icon">
                                                <span>{{ optional($car->steering)->value }}</span>
                                            </div>
                                            <div>
                                                <img src="/client/icons/profile-2user.svg" alt="" class="icon">
                                                <span>{{ $car->capacity }} People</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">
                                                <div>
                                                    <span class="text-[20px] text-[#1A202C]">
                                                        ${{ number_format($car->has_promotion ? $car->promotion_price : $car->price, 2) }}/
                                                    </span>
                                                    <span class="text-[#90A3BF] text-[14px]">day</span>
                                                </div>
                                                @if ($car->has_promotion)
                                                    <s class="text-[14px] text-[#90A3BF]">
                                                        ${{ number_format($car->price, 2) }}
                                                    </s>
                                                @endif
                                            </div>
                                            <button>
                                                <a href="{{ $user->role == 'CUSTOMER' ? route('client.payment', ['car' => $car->id]) : '#' }}">Book Now</a>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite('resources/js/client/pages/detail.js')
@endsection
