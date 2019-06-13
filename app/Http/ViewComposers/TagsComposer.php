<?php

namespace App\Http\ViewComposers;

use App\Models\Tag;
use Illuminate\View\View;

class TagsComposer
{
    protected $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function compose(View $view)
    {
        $view->with('top_tags', $this->tag::getTopHotTags(20));
    }
}
