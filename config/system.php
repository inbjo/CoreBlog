<?php

return [
    'name' => env('SITE_NAME', '酷博'),
    'slogan' => env('SITE_SLOGAN', '一款优雅的博客系统'),
    'keyword' => env('SITE_KEYWORD', 'CoreBlog,酷博'),
    'description' => env('SITE_DESCRIPTION', '酷博,一款优雅的博客系统,CoreBlog an elegant blog'),
    'icp' => env('SITE_ICP', '京ICP证030173号'),
    'police' => env('SITE_POLICE', '京公网安备11000002000001号'),
    'allow_user_post' => env('AllOW_USER_POST', false),
    'verify_comment' => env('VERIFY_COMMENT', false),
    'vaptcha_vid' => env('VAPTCHA_VID', ''),
    'vaptcha_key' => env('VAPTCHA_KEY', ''),
];

