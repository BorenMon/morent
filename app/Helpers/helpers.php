<?php

function getAvatarUrl($avatarPath)
{
    return $avatarPath ? env('AWS_ENDPOINT') . '/morent\/' . $avatarPath : asset('images/default-profile.jpg');
}
