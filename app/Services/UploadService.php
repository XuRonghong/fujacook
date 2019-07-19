<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;

class UploadService
{
    /**
     * @param      $data
     * @param      $path
     * @param null $file_name
     * @param bool $public
     *
     * @return null
     */
    public function upload($data, $path, $file_name = null, $public = true)
    {
        $url     = null;
        $options = [
            'disk' => 's3',
            'CacheControl' => 'max-age=31536000,public',
        ];
        
        if ($public) {
            $options['visibility'] = 'public';
        }
        
        if (gettype($data) == 'string') {
            if ($file_name) {
                $file_parts = pathinfo("$path/$file_name");
                $full_path  = @$file_parts['dirname'] . '/' . @$file_parts['basename'];
    
                $upload_result = $this->storage()->put($full_path, $data, $options);
                if ($upload_result) {
                    $url = $this->storage()->url($full_path);
                    return $url;
                }
            }
            return null;
        } else {
            $file['file'] = $data;
            $validate     = Validator::make($file, ['file' => 'file']);
            
            if ($validate->fails() || $path == '') {
                return null;
            }
            $store_path = null;
            
            if ($file_name) {
                $file_parts = pathinfo($file_name);
                $extension  = array_get($file_parts, 'extension');
                
                if (!$extension) {
                    $file_name = array_get($file_parts, 'filename') . '.' . $data->guessExtension();
                }
                
                $store_path = $data->storeAs($path, $file_name, $options);
            } else {
                $store_path = $data->store($path, $options);
            }
            
            $url = $this->storage()->url($store_path);
        }
        
        return $url;
    }

    public function uploadImageWithResizeAndQuality(
        $file,
        $path,
        $file_name,
        $width = null,
        $height = null,
        $quality = 90
    ) {
        $fileParts = pathinfo("$path/$file_name");

        $extension  = array_get($fileParts, 'extension', 'jpeg');

        $options = [
            'disk' => 's3',
            'visibility' => 'public',
            'ContentType' => "image/$extension",
            'CacheControl' => 'max-age=31536000,public',
        ];

        $image = Image::make($file);
        
        if (!is_null($width) || !is_null($height)) {
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        $image->encode($extension, $quality);

        $fullPath = @$fileParts['dirname'] . '/' . @$fileParts['filename'] . '.' . $extension;

        $upload_result = $this->storage()->put($fullPath, (string) $image, $options);
        if ($upload_result) {
            $url = $this->storage()->url($fullPath);
            return $url;
        }

        return null;
    }
    
    public function getFilename($url)
    {
        $pos = strrpos($url, '/', -1);
        
        if ($pos === false) {
            return $url;
        }
        
        return substr($url, $pos + 1);
    }

    public function storage($disk = 's3')
    {
        return Storage::disk('s3');
    }
}
