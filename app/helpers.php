<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function is_allow_username($username)
{
    $black_list = [
        'admin', 'administrator', 'guest', 'root', 'test', 'system', 'blog', '10000'
    ];
    if (in_array($username, $black_list)) {
        return false;
    } else {
        return true;
    }
}