<?php

function getAvatarUrl($avatarPath)
{
    return $avatarPath ? env('AWS_URL') . '/' . env('AWS_BUCKET') . '/' . $avatarPath : asset('images/default-profile.jpg');
}

function getAssetUrl($path)
{
    return $path ? env('AWS_URL') . '/' . env('AWS_BUCKET') . '/' . $path : asset('images/no-image.png');
}
