<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendSuccess($message='', $result = null)
    {   
        $code = 200;
        $response = [
            'status'    => true,
            'data'      => $result,
            'message'   => $message,
        ];
        return response()->json($response, $code);
    }

    public function sendError($httpCode=0, $message=null, $result = null)
    {   
        $code = $httpCode == 0 ? 401 : (strlen($httpCode) > 3 ? 500 : $httpCode);
        $response = [
            'status'    => false,
            'data'      => $result,
            'message'   => $message,
        ];
        if($code != 422){
            if(is_array($message)){
                Log::error(collect($message)->implode(', '));
            } else {
                Log::error($message);
            }
        }
        return response()->json($response);
    }

    public function mobileSuccess($message=null, $result = null)
    {   
        // if(is_array($result)){ ksort($result); }
        $code = 200;
        $response = [
            'status'    => self::statusByCode($code),
            'message'   => $message,
            'data'      => $result,
        ];
        return response()->json($response, $code);
    }

    public function mobileErrorCustom($e)
    {   
        $code = $e->getCode() == 0 ? 422 : (strlen($e->getCode()) > 3 ? 500 : $e->getCode());
        $logId = 'ErrorLogID: '.uniqid();
        $response = [
            'status'    => self::statusByCode($code),
            'message'   => $e->getMessage(),
            'data'      => null,
        ];
        if($code != 422){
            \Log::channel('mobile')->error('['.$logId.'] '.$e->getMessage());
        }
        return response()->json($response, $code);
    }

    public function mobileErrorValidation($e)
    {   
        $code = 422;
        $logId = 'ErrorLogID: '.uniqid();
        $response = [
            'status'    => self::statusByCode($code),
            'message'   => $e->getMessage(),
            'data'      => $e->validator->errors()->all(),
        ];
        \Log::channel('mobile')->error('['.$logId.'] '.$e->getMessage().' ('.collect($e->validator->errors()->all())->implode(', ').')');
        return response()->json($response, $code);
    }

    public function mobileErrorDuplicate($e)
    {   
        $code = 422;
        $logId = 'ErrorLogID: '.uniqid();
        $response = [
            'status'    => 'duplicate',
            'message'   => $e->getMessage(),
            'data'      => $e->errors(),
        ];
        \Log::channel('mobile')->error('['.$logId.'] '.$e->getMessage().' ('.$e->errors().')');
        return response()->json($response, $code);
    }

    public function mobileErrorQuery($e)
    {   
        $code = 500;
        $logId = 'ErrorLogID: '.uniqid();
        $response = [
            'status'    => self::statusByCode($code),
            'message'   => 'Error encountered processing to database server. '.$logId,
            'data'      => null,
        ];
        \Log::channel('mobile')->error('['.$logId.'] '.$e->getMessage());
        return response()->json($response, $code);
    }

    public function mobileError($e)
    {   
        $code = $e->getCode() == 0 ? 500 : (strlen($e->getCode()) > 3 ? 500 : $e->getCode());
        $logId = 'ErrorLogID: '.uniqid();
        $response = [
            'status'    => self::statusByCode($code),
            'message'   => 'Internal server Error. '.$logId,
            'data'      => null,
        ];
        \Log::channel('mobile')->error('['.$logId.'] '.$e->getMessage());
        return response()->json($response, $code);
    }

    public static function statusByCode($number)
    {   
        $code = [
            200 => 'success',
            401 => 'failed',
            403 => 'forbidden',
            404 => 'not_found',
            422 => 'failed',
            500 => 'failed',
        ];
        return $code[$number];
    }
}
