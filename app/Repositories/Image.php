<?php

namespace App\Repositories;

class Image
{
    public function handleUploadImage($image)
    {
        $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        \Image::make($image)->resize(300, 300)->save(public_path('img/') . $name);
        return $name;

    }

    public function uploadBinaryImage($file)
    {

        $path = $file->getClientOriginalName();
       
        \Image::make($file)->resize(300, 300)->save(public_path('img/') . $path);
        // $request->merge(['photo' => $name]);
        return $path;
    }
}
