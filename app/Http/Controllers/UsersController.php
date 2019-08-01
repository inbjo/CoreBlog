<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\UserRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function index(Request $request)
    {
        $post_id = $request->id;
        $name = $request->q;
        $users = Comment::commented($post_id)->distinct('user_id')->pluck('user_id')->toArray();
        $lists = User::whereIn('id', $users)->where('name', 'like', $name . "%")->get();
        $results = [];
        foreach ($lists as $list) {
            $results[] = [
                'key' => $list->name,
                'value' => $list->name,
            ];
        }
        return response()->json($results);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {
        $page = $request->input('page', 1);
        $posts = Cache::tags(['user-post'])->rememberForever('user:' . $user->id . ':' . $page, function () use ($user) {
            return $user->posts()->with(['user', 'comments', 'tags'])->paginate(12);
        });
        return view('users.show', compact('posts', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function avatar(AvatarRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        if ($request->isMethod('put')) {
            if ($request->avatar) {
                $result = $uploader->save($request->avatar, 'avatars', $user->id, 128, 128);
                if ($result) {
                    $user->avatar = $result['path'];
                    $user->save();
                    return ['code' => 0, 'msg' => '头像上传成功'];
                } else {
                    return ['code' => 0, 'msg' => '头像上传失败！'];
                }
            } else {
                return ['code' => 0, 'msg' => '非法请求！'];
            }
        } else {
            return view('users.avatar', compact('user'));
        }
    }

    public function password(Request $request, User $user)
    {
        $this->authorize('update', $user);
        if ($request->isMethod('put')) {
            $validatedData = $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->back()->with('success', '密码修改成功！');
        } else {
            return view('users.password', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update($request->all());
        return redirect()->back()->with('success', '资料更新成功！');
    }

    public function binding(Request $request, User $user)
    {
        $this->authorize('update', $user);
        if ($request->isMethod('put')) {
            $user->extend = $request->extend;
            $user->save();
            return redirect()->back()->with('success', '资料更新成功！');
        } else {
            return view('users.binding', compact('user'));
        }
    }

}
