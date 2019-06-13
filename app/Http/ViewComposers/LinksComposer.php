<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use App\Models\Link;
use Illuminate\View\View;

class LinksComposer
{
    protected $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function compose(View $view)
    {
        $view->with('links', $this->link->all());
    }
}
