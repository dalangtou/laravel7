<?php
/**
 * Created by PhpStorm.
 * User: HWT51
 * Date: 2019/2/21
 * Time: 14:51
 */

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Repository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UserRepository extends Repository
{
    public function model()
    {
        return User::class;
    }

    /**
     * @param $user
     * @return Collection
     */
    public static function get_chat_user($user)
    {
        $list = User::where('id','<>',$user->id)->get(User::CHAT_LIST_FIELD);

        $list->map(function ($user){
           $user->avatar = $user->user_avatar;
//           dd($user->avatar);
           return $user;
        });

        return $list;
    }


}
