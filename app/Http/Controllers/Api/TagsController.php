<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
    public function hot()
    {
        $tags = Cache::remember('top:tags', 3600, function () {
            return Tag::getTopHotTags(20);
        });
        return $tags;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Cache::remember('tags', 3600, function () {
            return Tag::all();
        });
        return $tags;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag, Request $request)
    {
        $page = $request->input('page', 1);
        $posts = Cache::tags(['tag-post'])->rememberForever('tag:' . $tag->id . ':' . $page, function () use ($tag) {
            return $tag->posts()->with(['user', 'comments', 'tags'])->paginate(12);
        });
        return compact('posts', 'tag');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
