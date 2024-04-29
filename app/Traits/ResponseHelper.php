<?php
namespace App\Traits;
trait  ResponseHelper{
    function success(   $data = [] ,string $message = ''  , int  $status  = 200){
            return   response()->json([
            "status" => true 
            ,
            "data" => $data
            ,
            "message" => $message
        ], $status );
    }
    function failed(array $errors =[]   , int  $status  = 400)
    {
        return response()->json($errors, 422);
    }
} 

 