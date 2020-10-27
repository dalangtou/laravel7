<?php

namespace App\Http\Controllers\Voyager;

use App\Jobs\AfterLogin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use TCG\Voyager\Http\Controllers\VoyagerAuthController as BaseVoyagerAuthController;

class VoyagerAuthController extends BaseVoyagerAuthController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response|mixed
     */
    public function postLogin(Request $request)
    {
        $next = parent::postLogin($request);

        //自己的登录后置操作
        if ($next instanceof RedirectResponse){

            Log::info(date('H:i:s'));

            $info = ['name'=>'张三','content'=>'张三info'.time()];
            try{
                dispatch($info);//异步执行 database 不可用
                dispatch_now((new AfterLogin($info)));// 同步执行  可用
            }catch (\Exception $exception){
                Log::info(json_encode($exception));
            }
//            Log::info(json_encode());

        }

        return $next;
    }
}
