<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;

trait StoreBlogImages
{
    public function moveImage($image, $path)
    {
        $image_name = Str::random(10).'.'.$image->getClientOriginalExtension();
        $path = $path;
        $image->move($path, $image_name);

        return $image_name;
    }
}