<?php

namespace App\Http\Controllers;

use App\Events\PostChange;
use App\Http\Requests\PostRequest;
use App\Handlers\ImageUploadHandler;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
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
        return view('pages.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        try {
            $this->authorize('create', Post::class);
            $tags = Tag::all()->pluck('name')->toJson(JSON_UNESCAPED_UNICODE);
            return view('posts.create', compact('tags'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '管理员未开放普通用户发表文章功能！');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @param ImageUploadHandler $uploader
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(PostRequest $request, ImageUploadHandler $uploader)
    {
        $this->authorize('create', Post::class);
        //封面图处理
        $cover_path = '';
        if ($file = $request->cover) {
            // 保存图片到本地
            $result = $uploader->save($request->cover, 'posts', Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $cover_path = $result['path'];
            }
        }
        //保存文章
        $post = Post::create([
            'title' => $request->input('title'),
            'keyword' => str_replace(' ', '', $request->input('tags')),
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'description' => $request->input('description'),
            'cover' => $cover_path,
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id')
        ]);
        $post->save();
        //标签关联
        $tagIds = Tag::getTagIds($request->input('tags'));
        $post->tags()->attach($tagIds);
        //文章发布事件
        event(new PostChange($post->id, 'create'));
        //返回结果
        return redirect()->route('post.show', $post->slug)->with('success', '文章发表成功！');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Post $post)
    {
        $this->authorize('show', $post);
        $data = Cache::rememberForever('post:' . $post->id, function () use ($post) {
            $data = $post->load('user', 'tags', 'comments');
            $data->comments->load('user');
            return compact('post');
        });
        $post->visits()->increment();
        return view('posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $tags = $post->tags->implode('name', ', ');
        $alltags = Tag::all()->pluck('name')->toJson(JSON_UNESCAPED_UNICODE);
        return view('posts.edit', compact('post', 'tags', 'alltags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     * @param ImageUploadHandler $uploader
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Post $post, ImageUploadHandler $uploader)
    {
        $this->authorize('update', $post);
        //封面图处理
        if ($file = $request->cover) {
            // 保存图片到本地
            $result = $uploader->save($request->cover, 'posts', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $post->cover = $result['path'];
            }
        }

        //更新文章
        $post->title = $request->input('title');
        $post->keyword = str_replace(' ', '', $request->input('tags'));
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        $post->status = $request->input('status');
        $post->save();
        //标签关联
        $tagIds = Tag::getTagIds($request->input('tags'));
        $post->tags()->sync($tagIds);
        //文章更新事件
        event(new PostChange($post->id, 'update'));
        //返回结果
        return redirect()->route('post.show', $post->slug)->with('success', '文章修改成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);
        $post->delete();
        //文章删除事件
        event(new PostChange($post->id, 'delete'));
        return ['code' => 0, 'msg' => '删除成功'];
    }

    public function search(Request $request)
    {
        $page = $request->input('page', 1);
        $keyword = $request->keyword;
        $posts = Cache::remember('search:' . $keyword . ':' . $page, 3600, function () use ($keyword) {
            $lists = Post::search($keyword)->orderBy('id', 'desc')->paginate(12);
            $lists->load('user', 'tags');
            return $lists;
        });
        return view('posts.search', compact('posts', 'keyword'));
    }

}
