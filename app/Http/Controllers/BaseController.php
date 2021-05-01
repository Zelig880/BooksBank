<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{

    protected $data = null;

    /**
     * @param int $errorCode
     * @param null $message
     * @return \Illuminate\Http\Response
     */
    protected function showErrorPage($errorCode = 404, $message = null)
    {
        $data['message'] = $message;
        return response()->view('errors.'.$errorCode, $data, $errorCode);
    }

    /**
     * @param bool $status
     * @param int $responseCode
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson($status = true, $responseCode = 200, $message = "", $data = [])
    {
        return response()->json([
            'status'         =>  $status,
            'message'       => $message,
            'data'          =>  $data
        ], $responseCode);
    }

}
