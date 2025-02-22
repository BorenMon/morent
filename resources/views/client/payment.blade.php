@php
    $user = auth()->user();
@endphp

@extends('client.layout', ['title' => 'Payment'])

@section('meta')
    <meta name="price-per-day" content="{{ $car->has_promotion ? $car->promotion_price : $car->price }}">
@endsection

@section('css')
    @vite(['node_modules/viewerjs/dist/viewer.min.css', 'resources/styles/client/pages/payment.css'])
@endsection

@section('content')
    <div id="body-wrapper">
        <div class="container-fluid" id="payment">
            <form action="{{ route('client.book') }}" method="POST" class="payment-main" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="customer_id" value="{{ $user->id }}">
                <input type="hidden" name="car_id" value="{{ $car->id }}">
                <input type="file" name="payment_proof" class="hidden">
                <!-- Billing -->
                <div class="pay" style="grid-area: pay">
                    <div id="form" style="display: grid; gap: 25px">
                        <!-- billing info -->
                        <div class="billing-info">
                            <p style="font-weight: bold; font-size: large">Billing Info</p>
                            <div class="pay_step">
                                <p style="color: rgb(173, 170, 170)">
                                    Please enter your billing info
                                </p>
                                <p style="color: rgb(173, 170, 170)">Step 1 of 4</p>
                            </div>
                            <!-- input -->
                            <div class="bill_input">
                                <div class="bill_input_div">
                                    <label style="font-weight: bold">Name <span class="text-red-500">*</span></label>
                                    <input type="text"
                                        style="
                    padding: 16px;
                    outline: none;
                    background-color: whitesmoke;
                    border-radius: 10px;
                  "
                                        placeholder="Your name" id="name-input" value="{{ old('name', $user->name) }}"
                                        name="name" />
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!--  -->
                                <div class="bill_input_div">
                                    <label style="font-weight: bold">Phone Number <span
                                            class="text-red-500">*</span></label>
                                    <input type="tel"
                                        style="
                    padding: 16px;
                    outline: none;
                    background-color: whitesmoke;
                    border-radius: 10px;
                  "
                                        placeholder="Phone number" id="phone-input" value="{{ old('phone', $user->phone) }}"
                                        name="phone" />
                                    @error('phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="bill_input">
                                <div class="bill_input_div">
                                    <label style="font-weight: bold">Address <span class="text-red-500">*</span></label>
                                    <input type="text"
                                        style="
                    padding: 16px;
                    outline: none;
                    background-color: whitesmoke;
                    border-radius: 10px;
                  "
                                        placeholder="Address" id="address-input"
                                        value="{{ old('address', $user->address) }}" name="address" />
                                    @error('address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <p style="font-weight: bold; font-size: large">Rental Info</p>
                            <div class="pay_step">
                                <p style="color: rgb(173, 170, 170)">
                                    Please select your rental date
                                </p>
                                <p style="color: rgb(173, 170, 170)">Step 2 of 4</p>
                            </div>
                            <p
                                style="
                font-weight: bold;
                margin-top: 24px;
                color: rgb(59, 89, 205);
                font-size: large;
              ">
                                Pick-Up
                            </p>
                            <div class="booking-container" id="pick-up">
                                <div class="bill_input">
                                    <div class="bill_input_div">
                                        <label style="font-weight: bold">Location <span
                                                class="text-red-500">*</span></label>
                                        <div
                                            style="
                      padding: 16px;
                      outline: none;
                      background-color: whitesmoke;
                      border-radius: 10px;
                    ">
                                            <select class="city" name="pick_up_city"></select>
                                        </div>
                                        @error('pick_up_city')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="bill_input_div">
                                        <label style="font-weight: bold">Date <span class="text-red-500">*</span></label>
                                        <input type="datetime-local"
                                            style="
                      padding: 16px;
                      outline: none;
                      background-color: whitesmoke;
                      border-radius: 10px;
                    "
                                            class="date" name="pick_up_datetime" value="{{ old('pick_up_datetime') }}" />

                                        @error('pick_up_datetime')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <p
                                style="
                font-weight: bold;
                margin-top: 24px;
                color: rgb(59, 89, 205);
                font-size: large;
              ">
                                Drop-Off
                            </p>
                            <div class="booking-container" id="drop-off">
                                <div class="bill_input">
                                    <div style="display: grid; width: 100%; gap: 10px">
                                        <label style="font-weight: bold">Location <span
                                                class="text-red-500">*</span></label>
                                        <div
                                            style="
                      padding: 16px;
                      outline: none;
                      background-color: whitesmoke;
                      border-radius: 10px;
                    ">
                                            <select class="city" name="drop_off_city"></select>
                                        </div>
                                        @error('drop_off_city')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div style="display: grid; width: 100%; gap: 10px">
                                        <label style="font-weight: bold">Date <span class="text-red-500">*</span></label>
                                        <input type="datetime-local"
                                            style="
                      padding: 16px;
                      outline: none;
                      background-color: whitesmoke;
                      border-radius: 10px;
                    "
                                            class="date" name="drop_off_datetime"
                                            value="{{ old('drop_off_datetime') }}" />
                                        @error('drop_off_datetime')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- confirmation -->
                        <div class="">
                            <p style="font-weight: bold; font-size: large">Confirmation</p>
                            <div class="pay_step">
                                <p style="color: rgb(173, 170, 170)">
                                    We are getting to the end. Just few clicks and your rental
                                    is ready!
                                </p>
                                <p style="color: rgb(173, 170, 170)">Step 4 of 4</p>
                            </div>

                            <div id="pay-choice">
                                <input type="checkbox" id="option2" name="marketing" value="Bitcoin"
                                    style="cursor: pointer" class="shrink-0" />
                                <label for="option2" style="font-weight: 600">
                                    I agree with sending an Marketing and newsletter emails. No
                                    spam, promissed!
                                </label>
                            </div>
                            <div id="pay-choice">
                                <input type="checkbox" id="option2" name="terms" style="cursor: pointer"
                                    class="shrink-0" />
                                <label for="option2" style="font-weight: 600">I agree with our terms and conditions and
                                    privacy
                                    policy.</label>
                            </div>
                            <button style="margin: 32px 0; border-radius: 10px;" class="disabled-button"
                                id="book-button">
                                Book Now
                            </button>
                            <img src="/client/icons/safe-icon.svg" alt="" class="mb-[12px]" />
                            <div>
                                <p style="font-weight: bold; font-size: medium">
                                    All your data are safe
                                </p>
                                <p style="font-size: 12px; color: rgb(173, 170, 170)">
                                    We are using the most advanced security to provide you the
                                    best experience ever.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- car pic -->
                <div class="pic" style="grid-area: pic">
                    <div id="car_pic">
                        <div>
                            <p style="font-weight: bold; font-size: large">
                                Rental Summary
                            </p>
                            <p style="color: rgb(173, 170, 170)">
                                Prices may change depending on the length of the rental and
                                the price of your rental car.
                            </p>
                        </div>
                        <!-- image -->
                        <div class="car_img flex items-center">
                            <div id="car_card">
                                <img src="{{ getAssetUrl($car->card_image) }}" alt="" width="80%"
                                    id="image" />
                            </div>
                            <div>
                                <p style="font-weight: bold; font-size: x-large" id="model">{{ $car->model }}</p>
                                <div class="flex items-center font-medium text-[#596780] text-[14px]">
                                    {{ optional($car->brand)->value }}</div>
                            </div>
                        </div>
                        <hr class="my-[24px]" />
                        <div class="space-y-[20px]">
                            <div class="pay_step">
                                <p style="color: rgb(173, 170, 170)" class="text-[16px]">
                                    Duration
                                </p>
                                <p style="font-weight: 800" class="text-[16px]" id="duration">
                                </p>
                            </div>
                            <div class="pay_step">
                                <p style="color: rgb(173, 170, 170)" class="text-[16px]">
                                    Subtotal
                                </p>
                                <p style="font-weight: 800" class="text-[16px]" id="sub-total">
                                </p>
                            </div>
                            <div class="pay_step">
                                <p style="color: rgb(173, 170, 170)" class="text-[16px]">
                                    Tax
                                </p>
                                <p style="font-weight: 800" class="text-[16px]" id="tax"></p>
                            </div>
                            <div class="pay_step">
                                <div>
                                    <p style="font-weight: bold; font-size: 20px">
                                        Total Rental Price
                                    </p>
                                    <p style="color: rgb(173, 170, 170)">
                                        Overall price and includes rental discount
                                    </p>
                                </div>
                                <div>
                                    <p style="font-size: 32px; font-weight: 800" id="total"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="car_pic" class="mt-8">
                        <div>
                            <p style="font-weight: bold; font-size: large">Payment Info</p>
                            <div class="pay_step">
                                <p style="color: rgb(173, 170, 170)">
                                    Please pay via KHQR and upload your payment proof here.
                                </p>
                                <p style="color: rgb(173, 170, 170)">Step 3 of 4</p>
                            </div>
                            <div id="khqr" class="cursor-pointer">
                                <img src="/client/khqr-payment.png" class="mt-8"
                                    style="object-fit: contain; object-position: center; width: 100%; height: 210px;">
                            </div>
                            <div class="custom-file-container" data-upload-id="payment-proof"></div>
                            @error('payment_proof')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    @vite('resources/js/client/pages/payment.js')
@endsection
