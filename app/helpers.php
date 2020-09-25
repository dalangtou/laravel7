<?php

/**
 *
 * 返回数据封装
 *
 * @param int $code
 * @param string $message
 * @param mixed $data
 * @param bool $other
 * @return Illuminate\Http\JsonResponse
 * @author jreey and @ifehrim
 */
if (!function_exists("response_json")) {
    function response_json($first = 200, $message = "success", $data = [], $header = [])
    {
        if (!is_string($message) && is_null($data)) {
            $data = $message;
            $message = 'success';
        }

        if (is_array($first) || is_object($first)) {
            $data = $first;
            $message = "success";
            $first = 200;
        }

        if ($message == "success" && $first != 200) {
            $message = "failed";
        }

        $array = array(
            'status_code' => $first,
            'status' => $message,
            'data' => $data,
        );

        if(isset($header['Authorization'])) return response()->json($array, 200 , ['Authorization'=> 'Bearer '.$header['Authorization']]);

        return response()->json($array);
    }

}

if (!function_exists("avatar_url")) {
    function avatar_url($avatar)
    {
        if (preg_match('/^((https|http)?:\/\/)[^\s]+/', $avatar)) return $avatar;

        return asset('static/imgs').'/'.$avatar;
    }

}
