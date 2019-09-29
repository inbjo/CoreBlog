<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Upload;
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
                ];
                sysConfig('SITE_NAME', $request->input('SITE_NAME'));
                sysConfig('SITE_SLOGAN', $request->input('SITE_SLOGAN'));
                sysConfig('SITE_KEYWORD', $request->input('SITE_KEYWORD'));
                sysConfig('SITE_DESCRIPTION', $request->input('SITE_DESCRIPTION'));
                sysConfig('SITE_ICP', $request->input('SITE_ICP'));
                sysConfig('SITE_POLICE', $request->input('SITE_POLICE'));
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
            case 'redis':
                $data = [
                    'REDIS_HOST' => $request->input('REDIS_HOST'),
                    'REDIS_PASSWORD' => empty($request->input('REDIS_PASSWORD')) ? 'null' : $request->input('REDIS_PASSWORD'),
                    'REDIS_PORT' => $request->input('REDIS_PORT'),
                ];
                break;
            case 'pay':
                sysConfig('ALI_APP_ID', $request->input('ALI_APP_ID'));
                sysConfig('ALI_PUBLIC_KEY', $request->input('ALI_PUBLIC_KEY'));
                sysConfig('ALI_PRIVATE_KEY', $request->input('ALI_PRIVATE_KEY'));
                sysConfig('WECHAT_APP_ID', $request->input('WECHAT_APP_ID'));
                sysConfig('WECHAT_MCH_ID', $request->input('WECHAT_MCH_ID'));
                sysConfig('WECHAT_KEY', $request->input('WECHAT_KEY'));
                break;
            case 'other':
                sysConfig('AllOW_USER_CREATE_POST', $request->input('AllOW_USER_CREATE_POST'));
                sysConfig('VERIFY_COMMENT', $request->input('VERIFY_COMMENT'));
                sysConfig('STAT_CODE', $request->input('STAT_CODE'));
                sysConfig('VAPTCHA_VID', $request->input('VAPTCHA_VID'));
                sysConfig('VAPTCHA_KEY', $request->input('VAPTCHA_KEY'));
                sysConfig('WATERMARK', $request->input('WATERMARK'));
                if ($request->file('WATERMARK_IMAGE')) {
                    $result = Upload::file($request->file('WATERMARK_IMAGE'), 'system');
                    sysConfig('WATERMARK_IMAGE', $result['path']);
                }
                break;
        }
        if (isset($data)) {
            modifyEnv($data);
            clearCache();
        }
        return redirect()->route('setting.index')->with('success', '保存配置成功！');
    }

    public function clear()
    {
        clearCache();
        return redirect()->back()->with('success', '清除缓存成功！');
    }
}
