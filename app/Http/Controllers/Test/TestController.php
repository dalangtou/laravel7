<?php

namespace App\Http\Controllers\Test;

use App\Extro\Redis;
use App\Http\Controllers\Controller;
use App\Jobs\AfterLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    // voyager 搭建 https://learnku.com/articles/18704
}
