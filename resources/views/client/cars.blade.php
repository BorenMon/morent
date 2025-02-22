@extends('client.layout', ['title' => 'Cars'])

@section('css')
    @vite('resources/styles/client/pages/cars.css')
@endsection

@php
    $user = Auth::user();
@endphp

@section('meta')
    <meta name="payment-base-url" content="{{ optional($user)->role == 'CUSTOMER' || !$user ? route('client.payment', ['car' => '#']) : '#' }}" />
@endsection

@section('content')
    <div class="backdrop" id="filter-backdrop"></div>
    <div id="body-wrapper">
        <div id="body" class="container-fluid">
            <div id="filter" class="space-y-[56px]">
                <div>
                    <h4>
                        <div>TYPE</div>
                        <button type="button" class="rounded-md p-2.5 text-gray-700" id="close-filter">
                            <img src="/client/icons/close.svg" alt="" />
                        </button>
                    </h4>
                    <ul class="space-y-[32px]" id="types">
                        @foreach ($types as $t)
                        <li class="checkbox-item">
                            <input type="checkbox" id="{{ $t->id . $t->value }}" name="type" value="{{ $t->id }}" />
                            <label for="{{ $t->id . $t->value }}">{{ $t->value }} <span></span></label>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4>CAPACITY</h4>
                    <ul class="space-y-[32px]">
                        <li class="checkbox-item">
                            <input type="checkbox" id="2 Person" name="type" value="2" />
                            <label for="2 Person">2 Person <span></span></label>
                        </li>
                        <li class="checkbox-item">
                            <input type="checkbox" id="4 Person" name="type" value="4" />
                            <label for="4 Person">4 Person <span></span></label>
                        </li>
                        <li class="checkbox-item">
                            <input type="checkbox" id="6 Person" name="type" value="6" />
                            <label for="6 Person">6 Person <span></span></label>
                        </li>
                        <li class="checkbox-item">
                            <input type="checkbox" id="8 or More" name="type" value="8" />
                            <label for="8 or More">8 or More <span></span></label>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4>PRICE</h4>
                    <input type="range" name="price" min="1" max="300" value="100" id="max-price"
                        step="0.01" />
                    <div class="text-[20px] font-semibold text-[#596780] mt-[12px]">
                        Max. $<span class="text-[20px]" id="max-price-value">100.00</span>
                    </div>
                </div>
            </div>
            <div id="filter-button">
                <img src="/client/icons/filter.svg" alt="" class="icon" />
            </div>
            <div id="category">
                <div class="space-y-8" id="skeleton-loading">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="w-full p-4 border border-gray-200 rounded shadow animate-pulse md:p-6">
                            <div class="flex items-center justify-center h-48 mb-4 bg-gray-300 rounded">
                                <svg class="w-10 h-10 text-gray-200" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
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
                                <svg class="w-10 h-10 text-gray-200" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
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
                                <svg class="w-10 h-10 text-gray-200" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
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
                                <svg class="w-10 h-10 text-gray-200" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
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
                                <svg class="w-10 h-10 text-gray-200" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
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
                                <svg class="w-10 h-10 text-gray-200" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
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
                <div id="loaded" class="space-y-[32px] hidden">
                    <div id="cars">
                        <!-- Generate by JavaScript -->
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-1 justify-between sm:hidden">
                            <div id="prev-button"
                                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Previous
                            </div>
                            <div id="next-button"
                                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Next
                            </div>
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
                            id="pagination-container">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing
                                    <span class="font-medium" id="showing-from"></span>
                                    to
                                    <span class="font-medium" id="showing-to"></span>
                                    of
                                    <span class="font-medium" id="filter_count"></span>
                                    cars
                                </p>
                            </div>
                            <div>
                                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination"
                                    id="pagination"></nav>
                            </div>
                            <p>No matched car.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite('resources/js/client/pages/cars.js')
@endsection
