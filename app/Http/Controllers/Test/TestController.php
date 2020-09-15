<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
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
        dd( resource_path('assets/sass/app.scss'));
    }

    // voyager 搭建 https://learnku.com/articles/18704
}
