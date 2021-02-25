<?php

namespace App\Http\Controllers\Test;

use App\Extro\Redis;
use App\Http\Controllers\Controller;
use App\Jobs\AfterLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class TestController extends Controller
{
    //
    public function connect(Request $request)
    {
//        $data = DB::table('test')->first();
//        dd($data);
//        $a = new AfterLogin(['name'=>'张三','content'=>'张三info']);
//        dispatch($a);

        $redis = new Redis();

        $redis->set('foo', 'bar12312');
        $value = $redis->get('foo');
        dd($value);
    }

    public function testApi(Request $request)
    {
        $data = DB::table('test')->first();

        $param = $request->all();

        Log::info('被请求。。',[date('Y-m-d H:i:s'),$param]);


        if($data->status == 1) {
            $res = [
                'code'=>200,
                'message'=>'success',
                'data'=>new \stdClass(),
            ];
        } else {
            $res = [
                'code'=>1001,
                'message'=>'fail',
                'data'=>new \stdClass(),
            ];
        }
        return response()->json($res);
    }

    // voyager 搭建 https://learnku.com/articles/18704
}
