<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Gravatar Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the Gravatar connections setup for your application.
    | See https://gravatar.com/site/implement/images/ for details.
    |
    | Possible Keys:
    |
    | url           The base URL:
    |                   https://secure.gravatar.com/avatar         (Default)
    |                   https://gravatar.cat.net/avatar            (China Mirror)
    |                   https://v2ex.assets.uxengine.net/gravatar  (China Mirror)
    | size / s      Avatar size in pixel, default is 80.
    | default / d   The default avatar image:
    |                   404, mm, identicon, monsterid, wavatar, retro,
    |                   robohash, blank, http://image/url
    | rating / r    The highest avatar rating, default is "g": g, pg, r, x.
    | forcedefault / f  If for some reason you wanted to force the default image
    |                   to always load, set this value to "y".
    |
    */

    'default' => [
        'size' => 120,
        'url' => 'https://cn.gravatar.com/avatar',
        'default' => 'identicon',
    ],

    'small' => [
        'size' => 40,
    ],

    'large' => [
        'size' => 460,
    ],

];
