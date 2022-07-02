<?php 
use Illuminate\Support\Facades\Validator;


if(!function_exists('decodeFile')){
    function decodeFile($file){
        $extension = explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1]; 
        $replace = substr($file, 0, strpos($file, ',')+1); 
        $image = str_replace($replace, '', $file); 
        $image = str_replace(' ', '+', $image); 
        $imageName = Str::random(10).'.'.$extension;
        return ["image"=>$image,"name"=>$imageName,"base64Decode"=>base64_decode($image)];
    }
}