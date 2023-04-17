<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;


use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait UploadImage
{
    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);
        //$image = Image::make($uploadedFile)->resize(250, 250)->encode('jpg');
        $image = Image::make($uploadedFile)->resize(200, 200)->encode('png');


        //TODO: rever tamanho das imagens e se possivel meter uma flag para ver se é foto e aplicar medidas em conformidade

        try {
            Storage::disk('public')->put($folder.'/'.$name, (string)$image);
        } catch (\Throwable $th) {
            logger($th);
            return false;
        }

        return true;
    }
}
