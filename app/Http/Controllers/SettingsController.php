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

    public function store(){
        $arr = [
            'name' => '裤裆老湿',
            'slogan' => '一个全栈老司机',
            'keyword' => '裤裆老湿,博客,全栈,老司机',
            'description' => '裤裆老湿博客是一个全栈老司机的博客',
        ];
        $cache_content = '<?php return ' . var_export($arr, true) . ';';
        Storage::disk('local')->put('settings.php', $cache_content);
    }
}
