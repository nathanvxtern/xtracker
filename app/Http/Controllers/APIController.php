<?php
namespace App\Http\Controllers;
use \App\Http\Controllers\Controller as BaseController;
class APIController extends BaseController
{
    protected function return_success($request, $data = '', $msg = '')
    {
        $response = $this->xt_build_response(STATUS_OK, $msg, $request->input('key_value'), $data);
        return response()->json($response, 200,[],JSON_UNESCAPED_SLASHES);
    }
    protected function return_file_success($lot_num,$content)
    {
        //$response = $this->xt_build_response(STATUS_OK, $msg, $request->input('key_value'), $data);
        //return response()->attachment($content, $lot_number);
        return response($content, 200)->withHeaders([
            'Content-Type'=> 'text/plain',
           'Content-Disposition'=>'attachment; filename="'.$lot_num.'.zpl"',
            'Lot-Number'=>'"'.$lot_num.'"'
        ]);
    }
    protected function return_error($request, $msg = '', $data = '')
    {
        $response = $this->xt_build_response(STATUS_ERROR, $msg, $request->input('key_value'), $data);
        return response()->json($response, 400);
    }
    protected function return_access_denied($request, $msg = 'Access denied.', $data = '')
    {
        $response = $this->xt_build_response(STATUS_ERROR, $msg, $request->input('key_value'), $data);
        return response()->json($response, 403);
    }
    protected function return_not_found($request, $msg = 'Not found.')
    {
        $response = $this->xt_build_response(STATUS_ERROR, $msg, $request->input('key_value'));
        return response()->json($response, 404);
    }
    protected function return_fatal($request, $msg = '')
    {
        $response = $this->xt_build_response(STATUS_FATAL, $msg, $request->input('key_value'));
        return response()->json($response, 500);
    }
    private function xt_build_response($status, $msg, $key_value, $data = '')
    {
        return  [   'status' => $status,
            'msg' => $msg,
            'key_value' => $key_value,
            'data' => $data
        ];
    }
}