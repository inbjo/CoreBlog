<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{

    public function index()
    {
        return view('settings.index');
    }

    public function update(Request $request)
    {
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
            case 'other':
                $data = [
                    'REDIS_HOST' => $request->input('REDIS_HOST'),
                    'REDIS_PASSWORD' => empty($request->input('REDIS_PASSWORD')) ? 'null' : $request->input('REDIS_PASSWORD'),
                    'REDIS_PORT' => $request->input('REDIS_PORT'),
                ];
                break;
        }
        modifyEnv($data);
        return redirect()->route('setting.index')->with('success', '保存配置成功！');
    }
}
