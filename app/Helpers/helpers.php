<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('getAvatarUrl')) {
    function getAvatarUrl($avatar)
    {
        return $avatar ? Storage::url($avatar) : asset('images/default-profile.jpg');
    }
}
