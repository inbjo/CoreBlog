<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends Controller
{

    public function index()
    {
        $this->authorize('manage', User::class);
        return view('settings.index');
    }

    public function update(Request $request)
    {
        $this->authorize('manage', User::class);
        $type = $request->input('type');
        switch ($type) {
            case 'basic':
                $data = [
                    'APP_URL' => $request->input('APP_URL'),
                    'SITE_NAME' => $request->input('SITE_NAME'),
                    'SITE_SLOGAN' => $request->input('SITE_SLOGAN'),
                    'SITE_KEYWORD' => $request->input('SITE_KEYWORD'),
                    'SITE_DESCRIPTION' => $request->input('SITE_DESCRIPTION'),
                    'SITE_ICP' => $request->input('SITE_ICP'),
                    'SITE_POLICE' => $request->input('SITE_POLICE'),
                    'AllOW_USER_POST' => $request->input('AllOW_USER_POST'),
                ];
                break;
            case 'mail':
                $data = [
                    'MAIL_DRIVER' => $request->input('MAIL_DRIVER'),
                    'MAIL_FROM_ADDRESS' => $request->input('MAIL_FROM_ADDRESS'),
                    'MAIL_FROM_NAME' => $request->input('MAIL_FROM_NAME'),
                    'MAIL_HOST' => $request->input('MAIL_HOST'),
                    'MAIL_PORT' => $request->input('MAIL_PORT'),
                    'MAIL_USERNAME' => $request->input('MAIL_USERNAME'),
                    'MAIL_PASSWORD' => $request->input('MAIL_PASSWORD'),
                    'MAIL_ENCRYPTION' => $request->input('MAIL_ENCRYPTION'),
                ];
                break;
            case 'pay':
                $data = [
                    'ALI_APP_ID' => $request->input('ALI_APP_ID'),
                    'ALI_PUBLIC_KEY' => $request->input('ALI_PUBLIC_KEY'),
                    'ALI_PRIVATE_KEY' => $request->input('ALI_PRIVATE_KEY'),
                    'WECHAT_APP_ID' => $request->input('WECHAT_APP_ID'),
                    'WECHAT_MCH_ID' => $request->input('WECHAT_MCH_ID'),
                    'WECHAT_KEY' => $request->input('WECHAT_KEY'),
                ];
                break;
            case 'other':
                $data = [
                    'VAPTCHA_VID' => $request->input('VAPTCHA_VID'),
                    'VAPTCHA_KEY' => $request->input('VAPTCHA_KEY'),
                    'REDIS_HOST' => $request->input('REDIS_HOST'),
                    'REDIS_PASSWORD' => empty($request->input('REDIS_PASSWORD')) ? 'null' : $request->input('REDIS_PASSWORD'),
                    'REDIS_PORT' => $request->input('REDIS_PORT'),
                ];
                break;
        }
        modifyEnv($data);
        return redirect()->route('setting.index')->with('success', '保存配置成功！');
    }

    public function clear()
    {
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:cache');
        Artisan::call('config:cache');
        return redirect()->back()->with('success', '清除缓存成功！');
    }
}
