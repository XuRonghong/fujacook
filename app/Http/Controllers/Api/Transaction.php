<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

trait Transaction
{
    /**
     * @param $method
     * @param $arguments
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function __call($method, $arguments)
    {
        try {
            DB::beginTransaction();
            $result = call_user_func_array([$this, $method], $arguments);
            DB::commit();
            
            return $result;
        } catch (\Exception $exception) {
            DB::rollback();
            
            if ($exception instanceof HttpResponseException) {
                throw $exception;
            }
            
            $message = $exception->getMessage();
            if ($exception->getCode() >= 500) {
                //系統錯誤
                Log::emergency($exception);
                $message = 'sorry, system say no!';
            } else {
                //未定義錯誤
                Log::error($exception);
            }
            
            return response()->json([
                'result'        => $exception->getCode(),
                'error_message' => $message,
            ], 200);
        }
    }
    
    
}