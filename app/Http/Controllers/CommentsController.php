<?php

namespace App\Http\Controllers;

use App\Events\CommentChange;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\CommentWereMentioned;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store(Request $request)
    {
        //验证token是否有效
        $token = $request->input('token');
        $url = 'http://api.vaptcha.com/v2/validate';
        $client = new Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'id' => config('system.vaptcha_vid'),
                'secretkey' => config('system.vaptcha_key'),
                'scene' => '',
                'token' => $token,
                'ip' => $request->getClientIp()
            ]
        ]);
        $result = json_decode($response->getBody(), true);
        if (!isset($result['success']) || $result['success'] != 1) {
            return redirect()->back()->with('danger', '未通过人机验证!');
        }
        //评论内容xss过滤
        $content = clean($request->input('reply_content'), 'user_comment_body');
        $comment = Comment::create([
            'post_id' => $request->input('post_id'),
            'user_id' => Auth::id(),
            'content' => $content,
            'agent' => $request->userAgent(),
            'ip' => $request->getClientIp()
        ]);
        $comment->save();

        //@user 自动加超链接并发送通知
        preg_match_all('/@(\w+) /u', $content, $matches, PREG_PATTERN_ORDER);
        $names = $matches[1];
        $has_at = false;
        foreach ($names as $name) {
            $user = User::whereName($name)->first();
            if ($user) {
                $has_at = true;
                $replace = '<a href="' . route('user.show', $user->name) . '" target="_blank">@' . $name . '</a>';
                $content = str_replace('@' . $name, $replace, $content);
                //通知提醒
                $user->notify(new CommentWereMentioned($comment));
            }
        }
        if ($has_at) {
            $comment->content = $content;
            $comment->save();
        }

        event(new CommentChange($comment));

        return redirect()->back()->with('success', '发表评论成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        event(new CommentChange($comment));

        if ($comment->delete()) {
            return ['code' => 0, 'msg' => '删除成功'];
        } else {
            return ['code' => 1, 'msg' => '删除失败'];
        }
    }
}
