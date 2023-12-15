<?php

namespace app\Traits;

trait ApiResponse
{
    public function apiResponse($code = 200, $message = "Success", $data = [])
    {
        return json_encode([
            "code" => $code,
            "message" => $message,
            "data" => $data
        ]);
    }
}
