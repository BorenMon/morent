@php
    $user = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="MORENT - Your
    Trusted Car Rental Partner in Cambodia" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/client/icons/favicon.svg" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    @vite('resources/styles/client/main.css')
    <script src="/tailwind.js"></script>

    @yield('meta')
    @yield('css')

    <title>{{ $title }}</title>
</head>

<body>
    <header>
        <nav class="container-fluid">
            <div class="lg:flex" id="logo">
                <a href="/" id="logo-link">
                    <img class="logo-img" src="/images/logo-dark.svg" alt="Logo Image" />
                </a>
            </div>
            <div id="menu-icon-wrapper">
                <button type="button" class="inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                    id="menu-icon">
                    <img src="/client/icons/menu.svg" alt="" />
                </button>
            </div>
            <div id="search-box-1" class="rounded-full">
                <img src="/client/icons/search-normal.svg" alt="" class="icon ml-[18px] search-icon" />
                <input type="text" class="placeholder:text-gray-400 search-input" name="search"
                    placeholder="Search something here" />
            </div>
            <div id="icons-wrapper" class="space-x-[20px]">
                @if (!$user)
                    <a href="/auth#login" id="login" class="font-semibold" style="height: 44px;">
                        Login&nbsp;<img src="/client/icons/login.svg" alt="" class="icon" />
                    </a>
                @else
                    <div class="relative inline-block text-left" id="profile">
                        <img src="{{ getAvatarUrl($user->avatar) }}" alt="Profile" id="nav-profile" class="shadow-md" />
                        <div class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                    role="menuitem" tabindex="-1" id="menu-item-0">Profile Setting</a>
                                <div class="block px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer logout"
                                    role="menuitem" tabindex="-1">
                                    Logout
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </nav>
        <nav class="container-fluid">
            <div class="space-x-[16px] w-[492px] flex">
                <div id="search-box-2">
                    <img src="/client/icons/search-normal.svg" alt="" class="icon ml-[18px] search-icon" />
                    <input type="text" class="placeholder:text-gray-400 search-input" name="search"
                        placeholder="Search something here" />
                </div>
            </div>
        </nav>

        <div class="backdrop" id="nav-backdrop"></div>
        <!-- Mobile menu, show/hide based on menu open state. -->
        <div id="mobile-menu" class="w-full bg-white px-6 py-6 sm:w-full">
            <div class="flex items-center justify-between">
                <a href="/" id="logo-link">
                    <img class="logo-img" src="/images/logo-dark.svg" alt="Logo Image" />
                </a>
                <button type="button" class="rounded-md p-2.5 text-gray-700" id="close-icon">
                    <img src="/client/icons/close.svg" alt="" />
                </button>
            </div>
            <div class="mt-6 flow-root" id="mobile-nav">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <a href="{{ route('client.home') }}"
                            class="{{ Route::is('client.home') ? 'active' : '' }}">Home</a>
                        <a
                            href="{{ route('client.cars') }}"class="{{ Route::is('client.cars') ? 'active' : '' }}">Cars</a>
                    </div>
                    <div class="space-y-2 py-6">
                        <a href="/favorites">Favorites</a>
                    </div>
                    <div class="py-6 !hidden" id="mobile-login">
                        <a href="/auth">Login</a>
                    </div>
                    <div class="space-y-2 py-6 !hidden" id="mobile-profile">
                        <a href="/profile">Profile Setting</a>
                        <a class="logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <ul id="nav" class="container-fluid space-x-[32px]">
            <li class="{{ Route::is('client.home') ? 'active' : '' }}"><a href="{{ route('client.home') }}">Home</a>
            </li>
            <li class="{{ Route::is('client.cars') ? 'active' : '' }}"><a href="{{ route('client.cars') }}">Cars</a>
            </li>
        </ul>
    </header>

    @yield('content')

    <footer>
        <div id="footer" class="container-fluid">
            <div>
                <div class="space-y-[16px] mr-[48px] mt-[20px]">
                    <img src="/images/logo-dark.svg" alt="Logo" class="logo-img" />
                    <p>
                        Whether it's for business or leisure, we're dedicated to making
                        your ride comfortable, convenient, and affordable.
                    </p>
                </div>
                <div>
                    <div class="mr-[60px] mt-[20px]">
                        <h6>About</h6>
                        <ul class="space-y-[20px]">
                            <li><a href="#">How it works</a></li>
                            <li><a href="#">Features</a></li>
                            <li><a href="#">Partnership</a></li>
                            <li><a href="#">Bussiness Relation</a></li>
                        </ul>
                    </div>
                    <div class="mt-[20px]">
                        <h6>Socials</h6>
                        <ul class="space-y-[20px]">
                            <li><a href="#">Tik Tok</a></li>
                            <li><a href="#">Instagram</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Facebook</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr />
            <div>
                <h6>©2025 MORENT. All rights reserved</h6>
                <div class="space-x-[28px]">
                    <a href="#">Privacy & Policy</a>
                    <a href="#">Terms & Condition</a>
                </div>
            </div>
        </div>
    </footer>

    @yield('script')
    @vite('resources/js/client/main.js')
</body>

</html>
