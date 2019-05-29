<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Models\Link;

class LinksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('update', Link::class);
        $links = Link::paginate(12);
        return view('links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('update', Link::class);
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LinkRequest $request
     * @param Link $link
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(LinkRequest $request, Link $link)
    {
        $this->authorize('update', Link::class);
        $link->fill($request->all());
        $link->save();
        return redirect()->route('link.index')->with('success', '添加友链成功！');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Link $link
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Link $link)
    {
        $this->authorize('update', Link::class);
        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LinkRequest $request
     * @param Link $link
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(LinkRequest $request, Link $link)
    {
        $this->authorize('update', Link::class);
        $link->update($request->all());
        return redirect()->route('link.index')->with('success', '修改友链成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Link $link
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Link $link)
    {
        $this->authorize('update', Link::class);
        $link->delete();
        return ['code' => 0, 'msg' => '删除成功'];
    }
}
