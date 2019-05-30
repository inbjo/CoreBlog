<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribesController extends Controller
{
    public function store(Request $request)
    {
        Subscribe::firstOrCreate(['email' => $request->input('email')]);
        return ['code' => 0, 'msg' => '订阅成功'];
    }
}
