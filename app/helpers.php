<?php


use Illuminate\Support\Str;

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function make_description($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return Str::limit($excerpt, $length, ' ...');
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

function modifyEnv(array $data)
{
    $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';

    $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));

    $contentArray->transform(function ($item) use ($data) {
        foreach ($data as $key => $value) {
            if (Str::contains($item, $key)) {
                $value = Str::contains($value, ' ') ? '"' . $value . '"' : $value;
                return $key . '=' . $value;
            }
        }

        return $item;
    });

    $content = implode($contentArray->toArray(), "\n");

    \File::put($envPath, $content);
}

function getPoliceNumber()
{
    $str = config('system.police');
    if (preg_match('/\d+/', $str, $arr)) {
        echo $arr[0];
    }
}

function generateAvatar($email, $size = 64)
{
    $filename = md5($email) . '.png';
    $path = public_path() . '/images/avatar/' . $filename;
    if (!file_exists($path)) {
        app('identicon')->saveAvatar($email, $size, $path);
    }
    return '/images/avatar/' . $filename;
}
