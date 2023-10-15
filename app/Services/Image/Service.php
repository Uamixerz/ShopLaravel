<?php

namespace App\Services\Image;

use Illuminate\Support\Facades\Storage;

class Service
{

    function destroy($filename){
        $sizes = [50, 150, 300, 600, 1200];
        $dir = public_path('uploads');
        foreach ($sizes as $size) {
            $file_destroy = $dir.DIRECTORY_SEPARATOR.$size."_".$filename;
            if (is_file($file_destroy)) {
                unlink($file_destroy);
            }
        }
    }
    function store($file){
        $filename = uniqid().'.'.$file->getClientOriginalExtension();

        $dir = $_SERVER['DOCUMENT_ROOT'];
        $sizes = [50, 150, 300, 600, 1200];
        $this->createDirectory();

        foreach ($sizes as $size) {
            $file_save = $dir."/uploads/".$size."_".$filename;
            $this->image_resize($size,$size,$file_save, 'file');
        }
        return $filename;
    }

    function createDirectory(){
        $directory = 'public/uploads';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
    }

    function image_resize($width, $height, $path, $inputName)
    {
        list($w,$h)=getimagesize($_FILES[$inputName]['tmp_name']);
        $maxSize=0;
        if(($w>$h)and ($width>$height))
            $maxSize=$width;
        else
            $maxSize=$height;
        $width=$maxSize;
        $height=$maxSize;
        $ration_orig=$w/$h;
        if(1>$ration_orig)
            $width=ceil($height*$ration_orig);
        else
            $height=ceil($width/$ration_orig);
        //отримуємо файл
        $imgString=file_get_contents($_FILES[$inputName]['tmp_name']);
        $image=imagecreatefromstring($imgString);
        //нове зображення
        $tmp=imagecreatetruecolor($width,$height);
        imagecopyresampled($tmp, $image,
            0,0,
            0,0,
            $width, $height,
            $w, $h);
        //Зберегти зображення у файлову систему
        switch($_FILES[$inputName]['type'])
        {
            case 'image/jpeg':
                imagejpeg($tmp,$path,30);
                break;
            case 'image/png':
                imagepng($tmp,$path,0);
                break;
            case 'image/gif':
                imagegif($tmp, $path);
                break;
        }
        return $path;
        //очисчаємо память
        imagedestroy($image);
        imagedestroy($tmp);
    }
}
