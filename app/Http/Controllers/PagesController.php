<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PagesController extends Controller
{
    public function sitemap()
    {
        $view = cache()->remember('generated.sitemap', null, function () {
            $posts = Post::all();
            // return generated xml (string) , cache whole file
            return view('pages.sitemap', compact('posts'))->render();
        });
        return response($view)->header('Content-Type', 'text/xml');
    }

    public function rss()
    {
        $view = cache()->remember('generated.rss', null, function () {
            $posts = Post::all();
            // return generated xml (string) , cache whole file
            return view('pages.rss', compact('posts'))->render();
        });
        return response($view)->header('Content-Type', 'text/xml');
    }

    public function search(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 12;

        // 构建查询
        $params = [
            'index' => 'posts',
            'type' => '_doc',
            'body' => [
                'from' => ($page - 1) * $perPage, // 通过当前页数与每页数量计算偏移值
                'size' => $perPage,
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'multi_match' => [
                                    'query' => $request->keyword,
                                    'fields' => [
                                        'title^4',
                                        'keyword^3',
                                        'description^2',
                                        'content',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $result = app('es')->search($params);
        $postIds = collect($result['hits']['hits'])->pluck('_id')->all();

        $posts = Post::query()
            ->whereIn('id', $postIds)
            ->get();

        $pager = new LengthAwarePaginator($posts, $result['hits']['total'], $perPage, $page, [
            'path' => route('post.search', $request->keyword), // 手动构建分页的 url
        ]);

        return view('pages.search', [
            'posts' => $pager,
            'total' => $result['hits']['total'],
            'keyword' => $request->keyword,
        ]);

    }

}
