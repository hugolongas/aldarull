<?php
namespace App\Helpers;
  
use Illuminate\Support\Facades\DB;
use App\Resource;

class Resources {
 
    public static function GetResource($key) {        
        $resource =  Resource::where('key',$key)->first();
        if($resource!=null)
        $value = $resource->value;
        else
        $value = $key;
        return $value;
    }
}