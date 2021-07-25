<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{
    public function successResponse($message, $code)
    {
        return response()->json(["message" => $message, 'code' => $code], $code);
    }



    protected function errorResponse($message, $code)
    {
        return response()->json(["message" => $message, 'code' => $code], $code);
    }
}
