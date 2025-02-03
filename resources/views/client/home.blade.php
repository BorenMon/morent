@extends('client.layout', ['title' => 'Home'])

@section('css')
    @vite(['resources/scss/client/pages/home.css'])
@endsection

@section('content')
    <div id="body-wrapper">
        <div id="body" class="container-fluid">
            <div class="space-y-8" id="skeleton-loading">
                <div class="space-y-8 animate-pulse md:space-y-0 md:space-x-8 md:flex md:items-center">
                    <div class="items-center justify-center w-full h-[360px] bg-gray-300 rounded hidden md:flex md:w-1/2">
                        <svg class="w-10 h-10 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                        </svg>
                    </div>
                    <div class="flex items-center justify-center w-full h-[360px] bg-gray-300 rounded md:w-1/2">
                        <svg class="w-10 h-10 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                        </svg>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div class="w-full p-4 border border-gray-200 rounded shadow animate-pulse md:p-6">
                        <div class="flex items-center justify-center h-48 mb-4 bg-gray-300 rounded">
                            <svg class="w-10 h-10 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 16 20">
                                <path
                                    d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z" />
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                            </svg>
                        </div>
                        <div class="h-2.5 bg-gray-200 rounded-full w-48 mb-4"></div>
                        <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
                        <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
                        <div class="h-2 bg-gray-200 rounded-full"></div>
                    </div>
                    <div class="w-full p-4 border border-gray-200 rounded shadow animate-pulse md:p-6">
                        <div class="flex items-center justify-center h-48 mb-4 bg-gray-300 rounded">
                            <svg class="w-10 h-10 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 16 20">
                                <path
                                    d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z" />
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                            </svg>
                        </div>
                        <div class="h-2.5 bg-gray-200 rounded-full w-48 mb-4"></div>
                        <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
                        <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
                        <div class="h-2 bg-gray-200 rounded-full"></div>
                    </div>
                    <div class="w-full p-4 border border-gray-200 rounded shadow animate-pulse md:p-6">
                        <div class="flex items-center justify-center h-48 mb-4 bg-gray-300 rounded">
                            <svg class="w-10 h-10 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 16 20">
                                <path
                                    d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z" />
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                            </svg>
                        </div>
                        <div class="h-2.5 bg-gray-200 rounded-full w-48 mb-4"></div>
                        <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
                        <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
                        <div class="h-2 bg-gray-200 rounded-full"></div>
                    </div>
                    <div class="w-full p-4 border border-gray-200 rounded shadow animate-pulse md:p-6">
                        <div class="flex items-center justify-center h-48 mb-4 bg-gray-300 rounded">
                            <svg class="w-10 h-10 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 16 20">
                                <path
                                    d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z" />
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                            </svg>
                        </div>
                        <div class="h-2.5 bg-gray-200 rounded-full w-48 mb-4"></div>
                        <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
                        <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
                        <div class="h-2 bg-gray-200 rounded-full"></div>
                    </div>
                </div>
            </div>
            <div id="loaded" class="hidden">
                <section id="slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list" id="slide-wrapper">
                            <!-- Generate by JavaScript -->
                        </ul>
                    </div>
                </section>
                <div class="flex items-center justify-between mb-[20px] mt-[36px] h-[44px] px-[20px]">
                    <h5 class="font-semibold text-[#90A3BF]">Popular Car</h5>
                    <a href="/pages/category.html" class="text-[#3563E9] font-semibold">View All</a>
                </div>
                <section id="popular" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list" id="popular-wrapper">
                            <!-- Generate by JavaScript -->
                        </ul>
                    </div>
                </section>
                <div class="flex items-center justify-between mb-[20px] mt-[36px] h-[44px] px-[20px]">
                    <h5 class="font-semibold text-[#90A3BF]">Recommendation Car</h5>
                </div>
                <div id="recommendation">
                    <!-- Generate by JavaScript -->
                </div>
                <div class="my-[64px] flex ml-auto w-1/2 justify-between items-center">
                    <button class="-translate-x-1/2">
                        <a href="/pages/category.html">Show more car</a>
                    </button>
                    <div class="font-medium text-[#90A3BF]">
                        <span id="cars-count"></span> Car
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/client/pages/home.js'])
@endsection
