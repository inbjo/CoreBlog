<?php


namespace App\Handlers;


use Illuminate\Support\Str;

class FileUploadHandler
{
    const FORBID_EXT = ["php", "js", "asp", 'jsp', 'htm', 'html'];
    const IMAGE_EXT = ["jpg", "gif", "png", 'jpeg', 'bmp', 'webp', 'tif'];
    const DOCUMENT_EXT = ['txt', 'doc', 'rtf', 'pdf', 'docx', 'xlsx', 'ppt', 'pptx'];
    const ARCHIVE_EXT = ['rar', 'zip', 'gz', '7z'];
    const AUDIO_EXT = ['mp3', 'wav', 'aac'];
    const VIDEO_EXT = ['avi', 'mp4', 'mov', 'rm', 'rmvb', 'flv'];

    public static function save($file, $folder = 'file')
    {
        $folder_name = "uploads/$folder/" . date("Ym/d/", time());
        $upload_path = public_path() . '/' . $folder_name;
        $extension = strtolower($file->getClientOriginalExtension()) ?: '';
        $size = $file->getClientSize();
        $filename = time() . '_' . Str::random(10) . '.' . $extension;

        if (in_array($extension, self::FORBID_EXT)) {
            return false;
        }

        $file->move($upload_path, $filename);

        return [
            'link' => config('app.url') . '/' . $folder_name . $filename,
            'path' => '/' . $folder_name . $filename,
            'ext' => $extension,
            'size' => $size,
            'filename' => $filename,
        ];
    }
}