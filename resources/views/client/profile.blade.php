@php
    $user = Auth::user();
@endphp

@extends('client.layout', ['title' => 'Profile'])

@section('meta')
    <meta name="user-id" content="{{ auth()->id() }}">
@endsection

@section('css')
    @vite('resources/styles/client/pages/profile.css')
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
            <div id="loaded" class="hidden">
                <div class="mb-8 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center space-x-[24px]" id="default-tab"
                        data-tabs-toggle="#default-tab-content" role="tablist">
                        <li role="presentation">
                            <div class="inline-block py-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer font-semibold tab"
                                id="profile-settings-tab" data-tabs-target="#profile-settings" role="tab"
                                aria-controls="profile-settings" aria-selected="false">
                                Profile Setting
                            </div>
                        </li>
                        <li role="presentation">
                            <div class="inline-block py-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer font-semibold tab"
                                id="bookings-tab" data-tabs-target="#bookings" role="tab" aria-controls="bookings"
                                aria-selected="false">
                                Booking
                            </div>
                        </li>
                        <li role="presentation">
                            <div class="inline-block py-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer font-semibold tab"
                                id="rentings-tab" data-tabs-target="#rentings" role="tab" aria-controls="rentings"
                                aria-selected="false">
                                Renting
                            </div>
                        </li>
                        <li role="presentation">
                            <div class="inline-block py-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer font-semibold tab"
                                id="history-tab" data-tabs-target="#history" role="tab" aria-controls="history"
                                aria-selected="false">
                                History
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="default-tab-content">
                    <div class="hidden" id="profile-settings" role="tabpanel" aria-labelledby="profile-settings-tab">
                        <div class="grid grid-cols-1 xl:grid-cols-3 xl:gap-4">
                            <div class="col-span-full xl:col-auto">
                                <div
                                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 relative">
                                    <div id="status"></div>
                                    <div
                                        class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
                                        <img class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0"
                                            src="{{ getAvatarUrl($user->avatar) }}" alt="Profile picture"
                                            id="profile-pic" />
                                        <div>
                                            <h3 class="mb-1 text-xl font-bold text-gray-900">
                                                Profile Picture
                                            </h3>
                                            <div class="mb-4 text-gray-500 text-xs">
                                                JPG, GIF or PNG. Max size of 2 MB
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <button class="flex items-center" id="upload-save-profile">
                                                    Change
                                                </button>
                                                <input type="file" id="upload-profile" class="hidden" accept="image/*" />
                                                <button id="remove-cancel-profile"
                                                    style="background-color: #ccc !important">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2">
                                    <h3 class="mb-4 text-xl font-semibold">Documents</h3>

                                    <div id="accordion-flush" data-accordion="collapse"
                                        data-active-classes="bg-white text-gray-900" data-inactive-classes="text-gray-500">
                                        <h2 id="accordion-flush-heading-1">
                                            <div class="flex items-center justify-between w-full font-medium rtl:text-right text-gray-500 border-b border-gray-200 gap-3 select-none"
                                                data-accordion-target="#accordion-flush-body-1" aria-expanded="false"
                                                aria-controls="accordion-flush-body-1">
                                                <div class="flex items-center justify-between gap-2 w-full">
                                                    <div class="flex items-center gap-2">
                                                        <img src="/client/images/id-card.png" alt="" width="55"
                                                            class="me-[8px]" />
                                                        <div class="grid gap-1">
                                                            <h4 class="text-gray-900 font-semibold">
                                                                Identity Card
                                                            </h4>
                                                            <h5 class="text-gray-400 text-xs font-normal leading-[18px]">
                                                                Front and Back Photos of Identity Card
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                </svg>
                                            </div>
                                        </h2>
                                        <div id="accordion-flush-body-1" class="hidden"
                                            aria-labelledby="accordion-flush-heading-1">
                                            <input type="file" class="filepond" name="id-card" multiple
                                                data-max-file-size="3MB" data-max-files="2" />
                                        </div>
                                        <h2 id="accordion-flush-heading-2">
                                            <div class="flex items-center justify-between w-full font-medium rtl:text-right text-gray-500 border-b border-gray-200 gap-3 select-none"
                                                data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
                                                aria-controls="accordion-flush-body-2">
                                                <div class="flex items-center justify-between gap-2 w-full">
                                                    <div class="flex items-center gap-2">
                                                        <img src="/client/images/driver-license.png" alt=""
                                                            width="55" class="me-[8px]" />
                                                        <div class="grid gap-1">
                                                            <h4 class="text-gray-900 font-semibold">
                                                                Driver License
                                                            </h4>
                                                            <h5 class="text-gray-400 text-xs font-normal leading-[18px]">
                                                                Front and Back Photos of Driver License
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                </svg>
                                            </div>
                                        </h2>
                                        <div id="accordion-flush-body-2" class="hidden"
                                            aria-labelledby="accordion-flush-heading-2">
                                            <input type="file" class="filepond" name="driver-license" multiple
                                                data-max-file-size="3MB" data-max-files="2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <div
                                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 sm:p-6">
                                    <h3 class="mb-4 text-xl font-semibold">
                                        General Information
                                    </h3>
                                    <div>
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="first-name" class="block mb-2 font-medium text-gray-900">Name <span class="text-red-500">*</span></label>
                                                <input type="text" name="name" id="name"
                                                    class="shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5 focus:outline-0"
                                                    autocomplete="on" value="{{ $user->name }}" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="address" class="block mb-2 font-medium text-gray-900">Address
                                                    <span class="text-red-500">*</span></label>
                                                <input type="text" name="address" id="address"
                                                    class="shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5 focus:outline-0"
                                                    autocomplete="on" value="{{ $user->address }}" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="email"
                                                    class="block mb-2 font-medium text-gray-900">Email</label>
                                                <input type="email" name="email" id="email"
                                                    class="shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5 focus:outline-0 select-none"
                                                    disabled autocomplete="off" value="{{ $user->email }}" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="phone-number"
                                                    class="block mb-2 font-medium text-gray-900">Phone Number
                                                    <span class="text-red-500">*</span></label>
                                                <input type="text" name="phone" id="phone-number"
                                                    class="shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5 focus:outline-0"
                                                    autocomplete="on" value="{{ $user->phone }}" />
                                            </div>
                                            <div class="col-span-6 sm:col-full">
                                                <button id="save-general-info" class="disabled-button">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 sm:p-6">
                                    <h3 class="mb-4 text-xl font-semibold">Change Password</h3>
                                    <div>
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="current-password"
                                                    class="block mb-2 font-medium text-gray-900">Current password
                                                    <span class="text-red-500">*</span></label>
                                                <input type="password" name="current_password" id="current-password"
                                                    class="shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5 focus:outline-0"
                                                    placeholder="••••••••" required />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3"></div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="password" class="block mb-2 font-medium text-gray-900">New
                                                    password
                                                    <span class="text-red-500">*</span></label>
                                                <input type="password" id="password" name="new_password"
                                                    class="bg-gray-50 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="••••••••" required />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="confirm-password"
                                                    class="block mb-2 font-medium text-gray-900">Confirm password
                                                    <span class="text-red-500">*</span></label>
                                                <input type="password" name="confirm_password" id="confirm-password"
                                                    class="shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5 focus:outline-0"
                                                    placeholder="••••••••" required />
                                            </div>
                                            <div class="col-span-6 sm:col-full">
                                                <button id="change-password" class="disabled-button">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden p-[24px] rounded-lg bg-white border border-gray-200 shadow-sm" id="bookings"
                        role="tabpanel" aria-labelledby="bookings-tab">
                        <div class="flex justify-between items-center mb-[32px]">
                            <h2 class="text-lg font-semibold">Recent Bookings</h2>
                            <a href="" class="text-sm text-blue-500">View All</a>
                        </div>
                        <img src="/client/images/loading.svg" width="100" style="margin: 0 auto;" class="hidden">
                        <ul class="grid-cols-1 gap-[32px] min-[1000px]:grid-cols-2 hidden"></ul>
                    </div>
                    <div class="hidden p-[24px] rounded-lg bg-white border border-gray-200 shadow-sm" id="rentings"
                        role="tabpanel" aria-labelledby="rentings-tab">
                        <div class="flex justify-between items-center mb-[32px]">
                            <h2 class="text-lg font-semibold">Renting Car</h2>
                        </div>
                        <img src="/client/images/loading.svg" width="100" style="margin: 0 auto;" class="hidden">
                        <div class="cursor-pointer py-[12px] flex hidden" id="renting-car"></div>
                    </div>
                    <div class="hidden p-[24px] rounded-lg bg-white border border-gray-200 shadow-sm" id="history"
                        role="tabpanel" aria-labelledby="history-tab">
                        <div class="flex justify-between items-center mb-[32px]">
                            <h2 class="text-lg font-semibold">History</h2>
                            <a href="" class="text-sm text-blue-500">View All</a>
                        </div>
                        <img src="/client/images/loading.svg" width="100" style="margin: 0 auto;" class="hidden">
                        <ul class="grid grid-cols-1 gap-[32px] min-[1000px]:grid-cols-2 hidden"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite('resources/js/client/pages/profile.js')
@endsection
