<?php

namespace App\Http\Controllers;

use App\Handlers\FileUploadHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $response = FileUploadHandler::getList('/uploads/posts/' . Auth::id() . '/');
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $result = FileUploadHandler::upload($request->file('file'), 'posts/' . Auth::id());
        return ['link' => $result['path']];
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return array
     */
    public function destroy(Request $request)
    {
        $url = parse_url($request->link);
        $delete = unlink(public_path() . $url['path']);
        if ($delete) {
            return ['msg' => '删除成功'];
        } else {
            return ['msg' => '删除失败'];
        }
    }
}
