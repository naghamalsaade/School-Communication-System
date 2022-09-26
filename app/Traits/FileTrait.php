<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

Trait FileTrait
{
    public function saveFile($file , $folder)
    {
        $file_extension = $file  -> getClientOriginalExtension();

        $file_name = $file  -> getClientOriginalName();

        //$new_file_name = $file_name. time().'.'.$file_extension;
        $path = $folder."/";
        // $file  -> move($path, $new_file_name);

        Storage::disk('local')->putFileAs(
            $path.$file_name,
            $file,
            $file_name
          );

        $filePath = $path.$file_name;
        
        return $filePath;
    }

    public function deleteFile($file , $folder)
    {
        $file_name = $folder.$file;
        if (File::exists($file_name))
        File::delete($file_name);

    }
}
