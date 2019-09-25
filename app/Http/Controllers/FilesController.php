<?php

namespace App\Http\Controllers;

use App\Handlers\FileUploadHandler;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\Upload;

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
        $result = Upload::file($request->file('editormd-image-file'), 'image');
        Upload::reduceSize($result['path'], 1024, null, true);
        return [
            'success' => 1,
            'url' => $result['path'],
            'message' => '上传成功'
        ];
    }

}
