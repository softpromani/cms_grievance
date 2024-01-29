<?php
use App\Models\Media;
use App\Model;

if (!function_exists('uploadFile')) {
    function uploadFile($filemodel,$path, $file)
    {
        // return $filemodel;
        $file_type=$file->getMimeType();
        $file_size=$file->getSize();
        $imagePath = $file->store($path, 'public'); 
        $file_name= $path.'/'.$imagePath;
        $media=$filemodel->media()->create([
            'media_type'=>$file_type,
            'file_name'=>$file_name,
            'file_path'=>$imagePath,
            'file_size'=>$file_size,
        ]);
        return $media;

    }
}
?>