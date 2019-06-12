<?php

namespace App\Http\Controllers;

use App\Handlers\FileUploadHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $result = FileUploadHandler::upload($request->file('editormd-image-file'), 'posts/' . Auth::id());
        return [
            'success' => 1,
            'url' => $result['path'],
            'message' => '上传成功'
        ];
    }

}
