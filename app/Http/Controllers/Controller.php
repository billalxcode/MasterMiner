<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function response($message, $data = null, $status = true) {
        $base_resposne = [
            'status' => $status,
            'message' => $message,
        ];
        if ($data !== null) {
            $base_resposne['data'] = $data;
        }
        return response()->json($base_resposne);
    }
}
