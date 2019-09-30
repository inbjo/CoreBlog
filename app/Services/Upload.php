<?php


namespace App\Services;

use App\Models\Resource;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Upload
{
    /**
     * 上传文件处理
     * @param $file
     * @param string $type
     * @return array
     */
    public static function file($file, $type = 'file')
    {
        $hash = sha1_file($file->path());
        $extension = $file->extension();
        $size = $file->getClientSize();

        //判断是否上传重复文件
        $res = Resource::where('hash', $hash)->first();
        if ($res) {
            return [
                'link' => config('app.url') . $res['path'],
                'path' => $res['path'],
                'ext' => $res['extend']->ext,
                'size' => $res['extend']->size,
                'hash' => $res['hash']
            ];
        }

        //保存文件
        $path = Storage::putFile($type, $file);

        Resource::create([
            'type' => $type,
            'path' => Storage::url($path),
            'hash' => $hash,
            'extend' => [
                'ext' => $extension,
                'size' => $size
            ],
            'user_id' => auth()->id()
        ]);

        return [
            'link' => config('app.url') . Storage::url($path),
            'path' => Storage::url($path),
            'ext' => $extension,
            'size' => $size,
            'hash' => $hash
        ];
    }

    /**
     * 调整图片大小
     * @param $file_path
     * @param $max_width
     * @param $max_height
     */
    public static function reduceSize($file_path, $max_width, $max_height = null, $watermark = false)
    {
        $path = storage_path('app/public') . str_replace('/storage', '', $file_path);
        $image = Image::make($path);

        $image->resize($max_width, $max_height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        if ($watermark && sysConfig('WATERMARK') == 'true' && sysConfig('WATERMARK_IMAGE')) {
            $image->insert(public_path() . sysConfig('WATERMARK_IMAGE'), 'bottom-right', 10, 10);
        }

        $image->save();
    }
}
