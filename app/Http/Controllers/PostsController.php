<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Handlers\ImageUploadHandler;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, ImageUploadHandler $uploader)
    {
        //封面图处理
        $cover_path = '';
        if ($file = $request->cover) {
            // 保存图片到本地
            $result = $uploader->save($request->cover, 'posts', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $cover_path = $result['path'];
            }
        }
        //保存文章
        $post = Post::create([
            'title' => $request->input('title'),
            'keyword' => $request->input('tags'),
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'cover' => $cover_path,
            'status' => 1,
            'category_id' => $request->input('category_id')
        ]);
        $post->save();
        //标签关联
        $tagIds = Tag::getTagIds($request->input('tags'));
        $post->tags()->attach($tagIds);
        //返回结果
        return redirect()->route('post.show', $post->hash_id)->with('success', '文章发表成功！');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments = $post->comments()->with(['user'])->get();
        return view('posts.show', compact('comments', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $tags = $post->tags->implode('name', ', ');
        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
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
        $post->keyword = $request->input('keyword');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        $post->status = 1;
        $post->save();
        //标签关联
        $tagIds = Tag::getTagIds($request->input('tags'));
        $post->tags()->sync($tagIds);
        //返回结果
        return redirect()->route('post.show', $post->hash_id)->with('success', '文章修改成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return array
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
//        $this->authorize('update', $post);
        $post->delete();
        return ['code' => 0, 'msg' => '删除成功'];
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success' => false,
            'msg' => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'posts', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg'] = "上传成功!";
                $data['success'] = true;
            }
        }
        return $data;
    }
}
