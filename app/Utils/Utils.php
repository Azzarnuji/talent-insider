<?php
namespace App\Utils;

class Utils{
    public static function responseTemplate(int $statusCode, string $message, mixed $data = null){
        return response()->json([
            'httpCode'=>$statusCode,
            'message'=>$message,
            'data'=>$data
        ]);
    }
    public static function generateToken(mixed $data){
        return base64_encode(json_encode($data));
    }

    public static function convertToStdClass(mixed $data){
        return json_decode(json_encode($data), FALSE);
    }
}
