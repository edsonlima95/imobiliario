<?php


namespace App\Support;


use phpDocumentor\Reflection\Types\Collection;

class Cropper
{

    public static function thumb(string $path, int $width, int $heigth = null)
    {
        $cropper = new \CoffeeCode\Cropper\Cropper('../public/storage/cache');
        $pathThumb = $cropper->make(config('filesystems.disks.public.root') . '/' . $path, $width, $heigth);

        $file = 'cache/' . collect(explode('/', $pathThumb))->last();
        return $file;
    }

    public static function flush(?string $path)
    {
        $cropper = new \CoffeeCode\Cropper\Cropper('../public/storage/cache');
        if (!empty($path)){
            $cropper->flush($path);
        }else{
            $cropper->flush();
        }
    }

}
