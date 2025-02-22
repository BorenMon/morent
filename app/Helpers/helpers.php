<?php

use Carbon\Carbon;

function getAvatarUrl($avatarPath)
{
    return $avatarPath ? env('AWS_URL') . '/' . env('AWS_BUCKET') . '/' . $avatarPath : asset('images/default-profile.jpg');
}

function getAssetUrl($path)
{
    return $path ? env('AWS_URL') . '/' . env('AWS_BUCKET') . '/' . $path : asset('images/no-image.png');
}

function getDateTime($dateTime)
{
    return $dateTime? Carbon::parse($dateTime)->format('F d, Y h:i A') : null;
}

function statusBadge($status)
{
    $statuses = [
        'PENDING'   => 'bg-warning-subtle text-warning',
        'PAID'      => 'bg-success-subtle text-success',
        'REFUNDING' => 'bg-danger-subtle text-danger',
        'REFUNDED'  => 'bg-secondary-subtle text-secondary',
    ];

    return $statuses[$status] ?? 'bg-dark-subtle text-dark';
}
