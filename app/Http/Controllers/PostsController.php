<?php

namespace App\Http\Controllers;

use App\Events\PostChange;
use App\Http\Requests\PostRequest;
use App\Models\Tag;
use App\Services\Upload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'search', 'unlock']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!alreadyInstalled()) {
            return redirect()->route('LaravelInstaller::welcome');
        }
        $page = $request->input('page', 1);
        $posts = Cache::tags(['index-post'])->rememberForever('post:list:' . $page, function () {
            return Post::gettype('published')->orderBy('id', 'desc')->with(['user', 'tags'])
                ->withCount(['comments', 'favorites'])->paginate(12);
        });
        return view('pages.index', compact('posts'));
    }

    /**
     * 文章管理
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list(Request $request)
    {
        $type = $request->input('type', 'all');
        switch ($type) {
            case 'all':
                $posts = Post::orderBy('id', 'desc')->paginate(12);
                break;
            case 'published':
                $posts = Post::gettype('published')->orderBy('id', 'desc')->paginate(12);
                break;
            case 'draft':
                $posts = Post::gettype('draft')->orderBy('id', 'desc')->paginate(12);
                break;
            case 'recycle':
                $posts = Post::onlyTrashed()->orderBy('id', 'desc')->paginate(12);
                break;
        }
        return view('posts.index', compact('posts', 'type'));
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
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(PostRequest $request)
    {
        $this->authorize('create', Post::class);
        //封面图处理
        $cover_path = '';
        if ($request->hasFile('cover')) {
            $result = Upload::file($request->file('cover'), 'cover');
            Upload::reduceSize($result['path'], 1024, null, true);
            if ($result) {
                $cover_path = $result['path'];
            }
        }

        if ($request->input('publish_time')) {
            $publish_time = strtotime($request->input('publish_time'));
        } else {
            $publish_time = 0;
        }

        //保存文章
        $post = Post::create([
            'title' => $request->input('title'),
            'keyword' => str_replace(' ', '', $request->input('tags')),
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'description' => $request->input('description'),
            'cover' => $cover_path,
            'publish_time' => $publish_time,
            'password' => $request->input('password'),
            'allow_comment' => $request->input('allow_comment'),
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id')
        ]);
        $post->save();
        //标签关联
        $tagIds = Tag::getTagIds($request->input('tags'));
        if (count($tagIds)) {
            $post->tags()->attach($tagIds);
        }
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
            $data = $post->load('user', 'tags', 'comments')->loadCount('favorites');
            $data->comments->load('user')->loadCount('favorites');
            return compact('post');
        });
        if (empty($post->password) || $this->authorize('update', $post)) {
            $post->visits()->increment();
            return view('posts.show', $data);
        } else {
            $unlock = session("post-{$post->id}", false);
            if ($unlock) {
                return view('posts.show', $data);
            }
            return view('posts.password', $data);
        }
    }

    /**
     * unlock the post
     * @param Post $post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlock(Post $post, Request $request)
    {
        $password = $request->input('password');
        if ($post->password == $password) {
            session(["post-{$post->id}" => true]);
            return redirect()->route('post.show', $post->slug);
        } else {
            return redirect()->back()->with('error', '访问密码不正确');
        }
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
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        //封面图处理
        if ($file = $request->cover) {
            // 保存图片到本地
            $result = Upload::file($request->file('cover'), 'cover');
            Upload::reduceSize($result['path'], 1024, null, true);
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
        if ($request->input('publish_time')) {
            $post->publish_time = strtotime($request->input('publish_time'));
        }
        $post->password = $request->input('password');
        $post->allow_comment = $request->input('allow_comment');
        $post->save();
        //标签关联
        $tagIds = Tag::getTagIds($request->input('tags'));
        $post->tags()->sync($tagIds);
        //文章更新事件
        event(new PostChange($post->id, 'update'));
        //返回结果
        return redirect()->route('post.show', $post->slug)->with('success', '文章修改成功！');
    }

    public function restore()
    {
        $post = Post::withTrashed()->findOrFail(request()->id);
        $this->authorize('update', $post);
        $post->restore();
        return ['code' => 0, 'msg' => '恢复成功'];
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
        $post = Post::withTrashed()->findOrFail($id);
        $this->authorize('update', $post);
        if (request()->force == 'true') {
            $tag_ids = $post->tags->pluck('id')->all();
            $post->tags()->detach();
            foreach ($tag_ids as $k => $v) {
                $tag = Tag::find($v);
                if ($tag->posts->count() == 0) {
                    $tag->delete();
                }
            }
            $post->comments()->delete();
            $post->forceDelete();
        } else {
            $post->delete();
            event(new PostChange($post->id, 'delete'));
        }
        return ['code' => 0, 'msg' => '删除成功'];
    }

    public function search(Request $request)
    {
        $page = $request->input('page', 1);
        $keyword = $request->keyword;
        $posts = Cache::remember('search:' . $keyword . ':' . $page, 3600, function () use ($keyword) {
            $lists = Post::search($keyword)->orderBy('id', 'desc')->paginate(12);
            $lists->load('user', 'tags')->loadCount(['comments', 'favorites']);
            return $lists;
        });
        return view('posts.search', compact('posts', 'keyword'));
    }

}
