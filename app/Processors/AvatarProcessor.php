<?php


namespace App\Processors;


use Illuminate\Support\Str;

class AvatarProcessor
{
    public static function get($model)
    {
        $file = $model->file()->first();

        if (is_null($file)) {
            if (!empty($model->slug)) {
                return 'https://avatars.dicebear.com/v2/initials/' . $model->slug . '.svg';
                //return asset('images/no_image.jpg');
            }
            if (!empty($model->name)) {
                return 'https://avatars.dicebear.com/v2/initials/' .Str::slug($model->name) . '.svg';
                //return asset('images/no_image.jpg');
            }
            return null;
        }

        return $file->fullPath;
    }
}
