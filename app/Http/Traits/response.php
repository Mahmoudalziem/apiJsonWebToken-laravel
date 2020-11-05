<?php

namespace App\Http\Traits;


trait response {

    public static function returnData($status = true,$message = '',$data){

        return response()->json(
            [
                'status' => $status,
                'message' => $message,
                'data' => $data
            ]
        );
    }
}
