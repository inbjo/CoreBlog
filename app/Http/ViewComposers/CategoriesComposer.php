<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CategoriesComposer
{
    public function compose(View $view)
    {
        $cats = Cache::rememberForever('categories', function () {
            return Category::all();
        });
        $view->with('cats', $cats);
    }
}
