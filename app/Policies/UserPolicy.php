<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $currentUser 当前登录用户实例
     * @param User $user        进行授权用户的实例
     * @return bool
     */
    public function update(User $currentUser , User $user )
    {
        return $currentUser->id === $user->id;
    }
}
