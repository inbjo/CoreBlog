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

    public static function upload($file, $folder = 'file')
    {
        $folder_name = "uploads/$folder/";
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

    public static function getList($folderPath, $thumbPath = null)
    {

        if (empty($thumbPath)) {
            $thumbPath = $folderPath;
        }

        // Array of image objects to return.
        $response = array();

        $absoluteFolderPath = public_path() . $folderPath;

        // Image types.
        $image_types = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png', 'image/svg+xml');

        // Filenames in the uploads folder.
        $fnames = scandir($absoluteFolderPath);

        // Check if folder exists.
        if ($fnames) {
            // Go through all the filenames in the folder.
            foreach ($fnames as $name) {
                // Filename must not be a folder.
                if (!is_dir($name)) {
                    // Check if file is an image.

                    if (in_array(mime_content_type($absoluteFolderPath . $name), $image_types)) {
                        // Build the image.
                        $img = new \StdClass;
                        $img->url = $folderPath . $name;
                        $img->thumb = $thumbPath . $name;
                        $img->name = $name;

                        // Add to the array of image.
                        array_push($response, $img);
                    }
                }
            }
        } // Folder does not exist, respond with a JSON to throw error.
        else {
            throw new Exception('Images folder does not exist!');
        }

        return $response;
    }
}
