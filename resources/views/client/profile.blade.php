@php
    $user = Auth::user();
@endphp

@extends('client.layout', ['title' => 'Profile'])

@section('meta')
    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="id-card" content="{{ $user->id_card }}">
    <meta name="id-card-url" content="{{ getAssetUrl($user->id_card) }}">
    <meta name="driving-license" content="{{ $user->driving_license }}">
    <meta name="driving-license-url" content="{{ getAssetUrl($user->driving_license) }}">
@endsection

@section('css')
    @vite('resources/styles/client/pages/profile.css')
@endsection

@section('content')
    <div id="body-wrapper">
        <div id="body" class="container-fluid">
            <div>
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
                                    <div id="status">
                                        @if ($user->is_verified)
                                        <img src="client/icons/verified.svg" alt="">&nbsp;
                                        Verified
                                        @else
                                        <img src="client/icons/unverified.svg" alt="">&nbsp;
                                        Unverified
                                        @endif
                                    </div>
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
                                                data-max-file-size="3MB" data-max-files="1" />
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
                                    <form action="{{ route('users.info', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="name" class="block mb-2 font-medium text-gray-900">Name
                                                    <span class="text-red-500">*</span></label>
                                                <input type="text" name="name" id="name"
                                                    class="shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5 focus:outline-0"
                                                    autocomplete="on" value="{{ old('name', $user->name) }}" />
                                                @error('name')
                                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="address" class="block mb-2 font-medium text-gray-900">Address
                                                    <span class="text-red-500">*</span></label>
                                                <input type="text" name="address" id="address"
                                                    class="shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5 focus:outline-0"
                                                    autocomplete="on" value="{{ old('address', $user->address) }}" />
                                                @error('address')
                                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="email" class="block mb-2 font-medium text-gray-900">Email
                                                    <span class="text-red-500">*</span></label>
                                                <input type="email" name="email" id="email"
                                                    class="shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5 focus:outline-0 select-none"
                                                    autocomplete="off" value="{{ old('email', $user->email) }}" />
                                                @error('email')
                                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="phone-number"
                                                    class="block mb-2 font-medium text-gray-900">Phone Number <span
                                                        class="text-red-500">*</span></label>
                                                <input type="text" name="phone" id="phone-number"
                                                    class="shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5 focus:outline-0"
                                                    autocomplete="on" value="{{ old('phone', $user->phone) }}" />
                                                @error('phone')
                                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-span-6 sm:col-full">
                                                <button id="save-general-info" class="disabled-button" type="submit">
                                                    @if (session('message') == 'Info updated successfully!')
                                                        Saved
                                                    @else
                                                        Save
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div
                                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 sm:p-6">
                                    <h3 class="mb-4 text-xl font-semibold">Change Password</h3>
                                    <form action="{{ route('users.password', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="current-password" class="block mb-2 font-medium text-gray-900">Current password
                                                    <span class="text-red-500">*</span></label>
                                                <input type="password" name="current_password" id="current-password"
                                                    class="shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5 focus:outline-0"
                                                    placeholder="••••••••" required />
                                                @error('current_password')
                                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-span-6 sm:col-span-3"></div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="password" class="block mb-2 font-medium text-gray-900">New password
                                                    <span class="text-red-500">*</span></label>
                                                <input type="password" id="password" name="new_password"
                                                    class="bg-gray-50 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="••••••••" required />
                                                @error('new_password')
                                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="confirm-password" class="block mb-2 font-medium text-gray-900">Confirm password
                                                    <span class="text-red-500">*</span></label>
                                                <input type="password" name="new_password_confirmation" id="confirm-password"
                                                    class="shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5 focus:outline-0"
                                                    placeholder="••••••••" required />
                                                @error('new_password_confirmation')
                                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-full">
                                                <button id="change-password" class="disabled-button" type="submit">
                                                    @if (session('message') == 'Password updated successfully!')
                                                        Saved
                                                    @else
                                                        Save
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </form>
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
