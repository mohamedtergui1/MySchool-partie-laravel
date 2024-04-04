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
    function failed(array $errors =[] , string $message = '' , int  $status  = 400)
    {
        return response()->json([
            "status" => false
            ,
            "errors" => $errors
            ,
            "message" => $message
        ] , $status);
    }
} 

 