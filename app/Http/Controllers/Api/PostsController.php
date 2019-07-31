<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class PostsController extends Controller
{
    public function recent(Request $request)
    {
        $count = $request->input('count', 5);
        $recent_posts = Cache::remember('recent:posts', 3600, function () use ($count) {
            return Post::getTopBy('id', $count);
        });
        return $recent_posts;
    }

    public function hot(Request $request)
    {
        $count = $request->input('count', 3);
        $hot_posts = Cache::remember('hot:posts', 3600, function () use ($count) {
            return Post::getTopBy('view_count', $count);
        });
        return $hot_posts;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $posts = Cache::tags(['index-post'])->rememberForever('post:list:' . $page, function () {
            return Post::published()->orderBy('id', 'desc')->with(['user:id,name', 'tags'])->paginate(12);
        });
        return $posts;
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
