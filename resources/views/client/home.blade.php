@php
    $user = Auth::user()
@endphp

@extends('client.layout', ['title' => 'Home'])

@section('css')
    @vite(['resources/styles/client/pages/home.css'])
@endsection

@section('content')
Hello
    <div id="body-wrapper">
        <div id="body" class="container-fluid">
            <div>
                <section id="slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list" id="slide-wrapper">
                            <li class="splide__slide" style="background-image: url(/client/slides/slide1-bg.svg);">
                                <div class="text-white space-y-[16px]">
                                    <h2>The Best Platform for Car Rental</h2>
                                    <p>Ease of doing a car rental safely and reliably. Of course at a low price.</p>
                                    <button class="bg-[#3563E9] slide-button"><a
                                            href="{{ route('client.cars') }}">Rental Car</a></button>
                                </div>
                                <img src="/client/slides/slide1-car.png" loading="lazy" alt="" class="pl-[56px]">
                            </li>
                            <li class="splide__slide" style="background-image: url(/client/slides/slide2-bg.svg);">
                                <div class="text-white space-y-[16px]">
                                    <h2>Easy way to rent a car at a low price</h2>
                                    <p>Providing cheap car rental services and safe and comfortable facilities.</p>
                                    <button class="bg-[#54A6FF] slide-button"><a
                                            href="{{ route('client.cars') }}">Rental Car</a></button>
                                </div>
                                <img src="/client/slides/slide2-car.png" loading="lazy" alt="" class="pl-[56px]">
                            </li>
                        </ul>
                    </div>
                </section>
                <div class="flex items-center justify-between mb-[20px] mt-[36px] h-[44px] px-[20px]">
                    <h5 class="font-semibold text-[#90A3BF]">Popular Car</h5>
                    <a href="{{ route('client.cars') }}" class="text-[#3563E9] font-semibold">View All</a>
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
                                                {{ $car->type }}</div>
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
                                                <span>{{ $car->steering }}</span>
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
                                                <a href="{{ optional($user)->role == 'CUSTOMER' || !$user ? route('client.payment', ['car' => $car->id]) : '#' }}">Book Now</a>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <div class="flex items-center justify-between mb-[20px] mt-[36px] h-[44px] px-[20px]">
                    <h5 class="font-semibold text-[#90A3BF]">Recommendation Car</h5>
                </div>
                <div id="recommendation">
                    @foreach ($recommendedCars as $car)
                        <div class="car-card">
                            <div>
                                <div class="-mt-[5px]">
                                    <div class="text-[20px] font-bold text-[#1A202C]">{{ $car->model }}</div>
                                    <div class="text-[14px] font-bold text-[#90A3BF]">{{ $car->type }}
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('client.detail', ['car' => $car->id]) }}" aria-label="See more about car">
                                <img src="{{ getAssetUrl($car->card_image) }}" loading="lazy" alt="">
                            </a>

                            <div class="space-y-[24px]">
                                <div>
                                    <div>
                                        <img src="/client/icons/gas-station.svg" alt="" class="icon">
                                        <span>{{ $car->gasoline }}L</span>
                                    </div>
                                    <div>
                                        <img src="/client/icons/car.svg" alt="" class="icon">
                                        <span>{{ $car->steering }}</span>
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
                                        <a href="{{ optional($user)->role == 'CUSTOMER' || !$user ? route('client.payment', ['car' => $car->id]) : '#' }}">Book Now</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="my-[64px] flex ml-auto w-1/2 justify-between items-center">
                    <button class="-translate-x-1/2">
                        <a href="{{ route('client.cars') }}">Show more car</a>
                    </button>
                    <div class="font-medium text-[#90A3BF]">
                        <span id="cars-count">{{ $totalCars }}</span> Cars
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/client/pages/home.js'])
@endsection
