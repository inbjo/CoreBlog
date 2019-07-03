<?php

namespace App\Http\ViewComposers;

use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HotTagsComposer
{
    public function compose(View $view)
    {
        $top_tags = Cache::remember('top:tags', 3600, function () {
            return Tag::getTopHotTags(20);
        });
        $view->with('top_tags', $top_tags);
    }
}
