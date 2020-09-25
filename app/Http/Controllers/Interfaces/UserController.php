<?php

namespace App\Http\Controllers\Interfaces;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function user_list(Request $request)
    {
        $list = UserRepository::get_chat_user(auth()->user());

        return response_json($list);
    }
}
