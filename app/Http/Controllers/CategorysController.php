<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategorysController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('update', Category::class);
        $categorys = Category::paginate(12);
        return view('categorys.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('update', Category::class);
        return view('categorys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', Category::class);
        $category->fill($request->all());
        $category->save();
        return redirect()->route('category.index')->with('success', '添加分类成功！');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return void
     */
    public function show(Category $category)
    {
        $posts = $category->posts()->with(['user', 'comments', 'tags'])->paginate(12);
        return view('categorys.show', compact('posts', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $this->authorize('update', Category::class);
        $category = Category::findOrFail($id);
        return view('categorys.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->authorize('update', Category::class);
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('category.index')->with('success', '修改分类成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize('update', Category::class);
        $category = Category::findOrFail($id);
        //判断该分类下是否还有文章
        if ($category->post_count > 0) {
            return ['code' => 1, 'msg' => '该分类下还有文章'];
        }
        $category->delete();
        return ['code' => 0, 'msg' => '删除成功'];
    }
}
