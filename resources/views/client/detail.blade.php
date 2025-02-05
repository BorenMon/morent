@extends('client.layout', ['title' => 'Car Detail'])

@section('css')
    @vite('resources/scss/client/pages/detail.css')
@endsection

@section('content')
    <div id="body-wrapper">
        <div id="body" class="container-fluid">
            <div id="skeleton-loading">
                <div role="status"
                    class="space-y-8 animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center">
                    <div class="flex items-center justify-center w-full h-48 bg-gray-300 rounded sm:w-96">
                        <svg class="w-10 h-10 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                        </svg>
                    </div>
                    <div class="w-full">
                        <div class="h-2.5 bg-gray-200 rounded-full w-48 mb-4"></div>
                        <div class="h-2 bg-gray-200 rounded-full max-w-[480px] mb-2.5"></div>
                        <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
                        <div class="h-2 bg-gray-200 rounded-full max-w-[440px] mb-2.5"></div>
                        <div class="h-2 bg-gray-200 rounded-full max-w-[460px] mb-2.5"></div>
                        <div class="h-2 bg-gray-200 rounded-full max-w-[360px]"></div>
                    </div>
                </div>
            </div>
            <div id="loaded" class="hidden space-y-[32px]">
                <div id="details">
                    <div id="images">
                        <div id="big-image">
                            <img src="#" />
                        </div>
                        <section id="images-carousel" class="splide">
                            <div class="splide__track">
                                <ul class="splide__list" id="images-carousel-wrapper">
                                    <!-- Generate by JavaScript -->
                                </ul>
                            </div>
                        </section>
                    </div>
                    <div id="info" class="space-y-[24px]">
                        <!-- Generate by JavaScript -->
                    </div>
                </div>
                <div class="flex items-center justify-between mb-[20px] mt-[32px] h-[44px] px-[20px]">
                    <h5 class="font-semibold text-[#90A3BF]">Popular Cars</h5>
                    <a href="/cars" class="text-[#3563E9] font-semibold">View All</a>
                </div>
                <section id="popular" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list" id="popular-wrapper">
                            <!-- Generate by JavaScript -->
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
