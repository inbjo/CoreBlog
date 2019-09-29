<?php


use Illuminate\Support\Facades\Redis as RedisManager;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Zxing\QrReader;

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function make_description($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return Str::limit($excerpt, $length, ' ...');
}

function modifyEnv(array $data)
{
    $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';
    $content = file_get_contents($envPath);
    $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
    $appendStr = '';

    foreach ($data as $key => $value) {
        $value = Str::contains($value, ' ') ? '"' . $value . '"' : $value;
        if (Str::contains($content, $key)) {
            $contentArray->transform(function ($item) use ($key, $value) {
                if (Str::contains($item, $key)) {
                    return $key . '=' . $value;
                }

                return $item;
            });
        } else {
            $appendStr .= PHP_EOL . "$key=$value";
        }
    }

    $content = implode($contentArray->toArray(), "\n");
    $content .= $appendStr;

    File::put($envPath, $content);
}

function getPoliceNumber()
{
    $str = sysConfig('SITE_POLICE');
    if (preg_match('/\d+/', $str, $arr)) {
        echo $arr[0];
    }
}

function generateAvatar($email, $size = 64)
{
    $filename = md5($email) . '.png';
    if (!is_dir(storage_path() . '/app/public/avatar/')) {
        mkdir(storage_path() . '/app/public/avatar/');
    }
    $path = storage_path() . '/app/public/avatar/' . $filename;
    if (!file_exists($path)) {
        app('identicon')->saveAvatar($email, $size, $path);
    }
    return '/storage/avatar/' . $filename;
}

function clearCache($key = null)
{
    if ($key === null) {
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:cache');
        Artisan::call('config:cache');
    } else {
        Cache::forget($key);
    }
}

function alreadyInstalled()
{
    return file_exists(storage_path('installed'));
}

function OcrQrcode($path)
{
    $qrcode = new QrReader($path);
    $text = $qrcode->text();
    if ($text == null) {
        return false;
    }
    return $text;
}

function merge_obj()
{
    foreach (func_get_args() as $a) {
        $objects[] = (array)$a;
    }
    return (object)call_user_func_array('array_merge', $objects);
}

function sysConfig($key = null, $value = 'undefined')
{
    if (alreadyInstalled()) {
        if ($value != 'undefined') {
            RedisManager::hset('settins', $key, $value);
            App\Models\Setting::updateOrCreate(
                ['key' => $key],
                [
                    'key' => $key,
                    'value' => $value
                ]
            );
            return true;
        }
        if (RedisManager::EXISTS('settins')) {
            if ($key == null) {
                return RedisManager::hgetall('settins');
            }
            if (RedisManager::hexists('settins', $key)) {
                return RedisManager::hget('settins', $key);
            } else {
                $setting = App\Models\Setting::where('key', $key)->first();
                if ($setting) RedisManager::hset('settins', $key, $setting->value);
                return $setting->value ?? null;
            }
        } else {
            $settings = App\Models\Setting::all(['key', 'value']);
            $settings->each(function ($item) {
                RedisManager::hset('settins', $item->key, $item->value);
            });
            return sysConfig($key);
        }
    } else {
        if ($value != 'undefined') return false;
        $config = config('system');
        if (array_key_exists($key, $config)) {
            return $config[$key];
        } else {
            return null;
        }
    }
}
