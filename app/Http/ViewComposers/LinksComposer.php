<?php

namespace App\Http\ViewComposers;

use App\Models\Link;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class LinksComposer
{
    public function compose(View $view)
    {
        $links = Cache::rememberForever('links', function () {
            return Link::all();
        });
        $view->with('links', $links);
    }
}
