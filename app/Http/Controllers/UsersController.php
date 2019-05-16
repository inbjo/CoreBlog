<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $posts = $user->posts()->with(['user', 'comments', 'tags'])->paginate(12);
        return view('users.show', compact('posts', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
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
                    return redirect()->back()->with('success', '头像上传成功！');
                } else {
                    return redirect()->back()->with('error', '头像上传失败！');
                }
            } else {
                return redirect()->back()->with('error', '非法请求！');
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
                'password' => 'required|string|min:6|confirmed',
            ]);
            $user->password = $request->password;
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
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update($request->all());
        return redirect()->back()->with('success', '资料更新成功！');
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
